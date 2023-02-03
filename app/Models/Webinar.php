<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Jorenvh\Share\ShareFacade;
use Spatie\CalendarLinks\Link;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Webinar extends Model implements TranslatableContract
{
    use Translatable;
    use Sluggable;

    protected $table = 'webinars';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    static $active = 'active';
    static $pending = 'pending';
    static $isDraft = 'is_draft';
    static $inactive = 'inactive';

    static $webinar = 'webinar';
    static $course = 'course';
    static $textLesson = 'text_lesson';

    static $statuses = [
        'active', 'pending', 'is_draft', 'inactive'
    ];

    static $videoDemoSource = ['upload', 'youtube', 'vimeo', 'external_link'];

    public $translatedAttributes = ['title', 'description', 'seo_description'];

    public function getTitleAttribute()
    {
        return getTranslateAttributeValue($this, 'title');
    }

    public function getDescriptionAttribute()
    {
        return getTranslateAttributeValue($this, 'description');
    }

    public function getSeoDescriptionAttribute()
    {
        return getTranslateAttributeValue($this, 'seo_description');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\User', 'teacher_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function filterOptions()
    {
        return $this->hasMany('App\Models\WebinarFilterOption', 'webinar_id', 'id');
    }

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'webinar_id', 'id');
    }


    public function chapters()
    {
        return $this->hasMany('App\Models\WebinarChapter', 'webinar_id', 'id');
    }

    public function sessions()
    {
        return $this->hasMany('App\Models\Session', 'webinar_id', 'id');
    }

    public function files()
    {
        return $this->hasMany('App\Models\File', 'webinar_id', 'id');
    }

    public function textLessons()
    {
        return $this->hasMany('App\Models\TextLesson', 'webinar_id', 'id');
    }

    public function faqs()
    {
        return $this->hasMany('App\Models\Faq', 'webinar_id', 'id');
    }

    public function prerequisites()
    {
        return $this->hasMany('App\Models\Prerequisite', 'webinar_id', 'id');
    }

    public function quizzes()
    {
        return $this->hasMany('App\Models\Quiz', 'webinar_id', 'id');
    }

    public function webinarPartnerTeacher()
    {
        return $this->hasMany('App\Models\WebinarPartnerTeacher', 'webinar_id', 'id');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\Tag', 'webinar_id', 'id');
    }

    public function purchases()
    {
        return $this->hasMany('App\Models\Purchase', 'webinar_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'webinar_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\WebinarReview', 'webinar_id', 'id');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sale', 'webinar_id', 'id')
            ->whereNull('refund_at')
            ->where('type', 'webinar');
    }

    public function feature()
    {
        return $this->hasOne('App\Models\FeatureWebinar', 'webinar_id', 'id');
    }

    public function getRate()
    {
        $rate = 0;

        if (!empty($this->avg_rates)) {
            $rate = $this->avg_rates;
        } else {
            $reviews = $this->reviews()
                ->where('status', 'active')
                ->get();

            if (!empty($reviews) and $reviews->count() > 0) {
                $rate = number_format($reviews->avg('rates'), 2);
            }
        }


        if ($rate > 5) {
            $rate = 5;
        }

        return $rate > 0 ? number_format($rate, 2) : 0;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function makeSlug($title)
    {
        return SlugService::createSlug(self::class, 'slug', $title);
    }

    public function bestTicket($with_percent = false)
    {
        $ticketPercent = 0;
        $bestTicket = $this->price;

        $activeSpecialOffer = $this->activeSpecialOffer();

        if ($activeSpecialOffer) {
            $bestTicket = $this->price - ($this->price * $activeSpecialOffer->percent / 100);
            $ticketPercent = $activeSpecialOffer->percent;
        } else {
            foreach ($this->tickets as $ticket) {

                if ($ticket->isValid()) {
                    $discount = $this->price - ($this->price * $ticket->discount / 100);

                    if ($bestTicket > $discount) {
                        $bestTicket = $discount;
                        $ticketPercent = $ticket->discount;
                    }
                }
            }
        }

        if ($with_percent) {
            return [
                'bestTicket' => $bestTicket,
                'percent' => $ticketPercent
            ];
        }

        return $bestTicket;
    }

    public function getDiscount($ticket = null, $user = null)
    {
        $activeSpecialOffer = $this->activeSpecialOffer();

        $discountOut = $activeSpecialOffer ? $this->price * $activeSpecialOffer->percent / 100 : 0;

        if (!empty($user) and !empty($user->getUserGroup()) and isset($user->getUserGroup()->discount) and $user->getUserGroup()->discount > 0) {
            $discountOut += $this->price * $user->getUserGroup()->discount / 100;
        }

        if (!empty($ticket) and $ticket->isValid()) {
            $discountOut += $this->price * $ticket->discount / 100;
        }

        return $discountOut;
    }

    public function getDiscountPercent()
    {
        $percent = 0;

        $activeSpecialOffer = $this->activeSpecialOffer();

        if (!empty($activeSpecialOffer)) {
            $percent += $activeSpecialOffer->percent;
        }

        $tickets = Ticket::where('webinar_id', $this->id)->get();

        foreach ($tickets as $ticket) {
            if (!empty($ticket) and $ticket->isValid()) {
                $percent += $ticket->discount;
            }
        }

        return $percent;
    }

    public function getWebinarCapacity()
    {
        $salesCount = !empty($this->sales_count) ? $this->sales_count : $this->sales()->count();

        $capacity = $this->capacity - $salesCount;

        return $capacity > 0 ? $capacity : 0;
    }

    public function checkUserHasBought($user = null): bool
    {
        $hasBought = false;

        if (empty($user) and auth()->check()) {
            $user = auth()->user();
        }

        if (!empty($user)) {
            $sale = Sale::where('buyer_id', $user->id)
                ->where('webinar_id', $this->id)
                ->where('type', 'webinar')
                ->whereNull('refund_at')
                ->first();

            if (!empty($sale)) {
                $hasBought = true;

                if ($sale->payment_method == Sale::$subscribe) {
                    $subscribe = $sale->getUsedSubscribe($sale->buyer_id, $sale->webinar_id);

                    if (!empty($subscribe)) {
                        $subscribeSale = Sale::where('buyer_id', $user->id)
                            ->where('type', Sale::$subscribe)
                            ->where('subscribe_id', $subscribe->id)
                            ->whereNull('refund_at')
                            ->latest('created_at')
                            ->first();

                        if (!empty($subscribeSale)) {
                            $usedDays = (int)diffTimestampDay(time(), $subscribeSale->created_at);

                            if ($usedDays > $subscribe->days) {
                                $hasBought = false;
                            }
                        }
                    } else {
                        $hasBought = false;
                    }
                }
            }

            if (!$hasBought) {
                $hasBought = ($this->creator_id == $user->id or $this->teacher_id == $user->id);

                if (!$hasBought) {
                    $partnerTeachers = !empty($this->webinarPartnerTeacher) ? $this->webinarPartnerTeacher->pluck('teacher_id')->toArray() : [];

                    $hasBought = in_array($user->id, $partnerTeachers);
                }
            }

            if (!$hasBought) {
                $hasBought = $user->isAdmin();
            }

        }

        return $hasBought;
    }

    public function getProgress($isLearningPage = false)
    {
        $progress = 0;

        if ($this->isWebinar()) {
            if (auth()->check() and ($this->isProgressing() or $isLearningPage) and $this->checkUserHasBought()) {
                $user_id = auth()->id();
                $sessions = $this->sessions;
                $files = $this->files;
                $passed = 0;

                foreach ($files as $file) {
                    $status = CourseLearning::where('user_id', $user_id)
                        ->where('file_id', $file->id)
                        ->first();

                    if (!empty($status)) {
                        $passed += 1;
                    }
                }

                foreach ($sessions as $session) {
                    $status = CourseLearning::where('user_id', $user_id)
                        ->where('session_id', $session->id)
                        ->first();

                    if (!empty($status)) {
                        $passed += 1;
                    }
                }

                if ($passed > 0) {
                    $progress = ($passed * 100) / ($sessions->count() + $files->count());

                    $this->handleLearningProgress100Reward($progress, $user_id, $this->id);
                }
            } else if (!empty($this->capacity)) {
                $salesCount = !empty($this->sales_count) ? $this->sales_count : $this->sales()->count();

                if ($salesCount > 0) {
                    $progress = ($salesCount * 100) / $this->capacity;
                }
            }
        } elseif ($this->checkUserHasBought()) {
            $user_id = auth()->id();
            $files = $this->files;
            $textLessons = $this->textLessons;

            $passed = 0;

            foreach ($files as $file) {
                $status = CourseLearning::where('user_id', $user_id)
                    ->where('file_id', $file->id)
                    ->first();

                if (!empty($status)) {
                    $passed += 1;
                }
            }

            foreach ($textLessons as $textLesson) {
                $status = CourseLearning::where('user_id', $user_id)
                    ->where('text_lesson_id', $textLesson->id)
                    ->first();

                if (!empty($status)) {
                    $passed += 1;
                }
            }

            if ($passed > 0) {
                $progress = ($passed * 100) / ($files->count() + $textLessons->count());

                $this->handleLearningProgress100Reward($progress, $user_id, $this->id);
            }
        }

        return round($progress, 2);
    }

    protected function handleLearningProgress100Reward($progress, $userId, $itemId)
    {
        if ($progress >= 100) {
            $rewardScore = RewardAccounting::calculateScore(Reward::LEARNING_PROGRESS_100);
            RewardAccounting::makeRewardAccounting($userId, $rewardScore, Reward::LEARNING_PROGRESS_100, $itemId, true);
        }
    }

    public function getImageCover()
    {
        return config('app_url') . $this->image_cover;
    }

    public function getImage()
    {
        return config('app_url') . $this->thumbnail;
    }

    public function getUrl()
    {
        return url('/course/' . $this->slug);
    }

    public function getLearningPageUrl()
    {
        return url('/course/learning/' . $this->slug);
    }

    public function isCourse()
    {
        return ($this->type == 'course');
    }

    public function isTextCourse()
    {
        return ($this->type == 'text_lesson');
    }

    public function isWebinar()
    {
        return ($this->type == 'webinar');
    }

    public function canAccess($user = null)
    {
        if (!$user) {
            $user = auth()->user();
        }

        if (!empty($user)) {
            return ($this->creator_id == $user->id or $this->teacher_id == $user->id);
        }

        return false;
    }

    public function canSale()
    {
        $salesCount = !empty($this->sales_count) ? $this->sales_count : $this->sales()->count();

        if ($this->type == 'webinar') {
            return ($this->start_date > time() and $salesCount < $this->capacity);
        }

        return true;
    }

    public function addToCalendarLink()
    {

        $date = \DateTime::createFromFormat('j M Y H:i', dateTimeFormat($this->start_date, 'j M Y H:i', false));

        $link = Link::create($this->title, $date, $date); //->description('Cookies & cocktails!')

        return $link->google();
    }

    public function activeSpecialOffer()
    {
        $activeSpecialOffer = SpecialOffer::where('webinar_id', $this->id)
            ->where('status', SpecialOffer::$active)
            ->where('from_date', '<', time())
            ->where('to_date', '>', time())
            ->first();

        return $activeSpecialOffer ?? false;
    }

    public function nextSession()
    {
        $sessions = $this->sessions()
            ->orderBy('date', 'asc')
            ->get();
        $time = time();

        foreach ($sessions as $session) {
            if ($session->date > $time) {
                return $session;
            }
        }

        return null;
    }

    public function lastSession()
    {
        $session = $this->sessions()
            ->orderBy('date', 'desc')
            ->first();

        return $session;
    }

    public function isProgressing()
    {
        $lastSession = $this->lastSession();
        //$nextSession = $this->nextSession();
        $isProgressing = false;

        if ($this->start_date <= time() or (!empty($lastSession) and $lastSession->date > time())) {
            $isProgressing = true;
        }

        return $isProgressing;
    }

    public function getShareLink($social)
    {
       
        $link = '';
        return 'fff' ;
        switch ($social) {
            case 'facebook':
                $link = ShareFacade::page($this->getUrl())->facebook()->getRawLinks();
                break;
            case 'twitter':
                $link = ShareFacade::page($this->getUrl())->twitter()->getRawLinks();
                break;
            case 'whatsapp':
                $link = ShareFacade::page($this->getUrl())->whatsapp()->getRawLinks();
                break;
            case 'telegram':
                $link = ShareFacade::page($this->getUrl())->telegram()->getRawLinks();
                break;
        }
        
       

        return $link;
    }

    public function isDownloadable()
    {
        $downloadable = $this->downloadable;

        if ($this->files->count() > 0) {
            $downloadableFiles = $this->files->where('downloadable', true)->count();

            if ($downloadableFiles > 0) {
                $downloadable = true;
            }
        }

        return $downloadable;
    }
}
