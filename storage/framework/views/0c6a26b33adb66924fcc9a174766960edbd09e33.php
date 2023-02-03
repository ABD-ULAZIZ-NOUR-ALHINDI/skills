<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/persian-datepicker/persian-datepicker.min.css"/>
    <link rel="stylesheet" href="/assets/default/css/css-stars.css">
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
    <section class="site-top-banner position-relative">
        <img src="<?php echo e($user->getCover()); ?>" class="img-cover" alt=""/>
    </section>


    <section class="container">
        <div class="rounded-lg shadow-sm px-25 py-20 px-lg-50 py-lg-35 position-relative user-profile-info bg-white">
            <div class="profile-info-box d-flex align-items-start justify-content-between">
                <div class="user-details d-flex align-items-center">
                    <div class="user-profile-avatar">
                        <img src="<?php echo e($user->getAvatar()); ?>" class="img-cover" alt="<?php echo e($user["full_name"]); ?>"/>

                        <?php if($user->offline): ?>
                            <span class="user-circle-badge unavailable d-flex align-items-center justify-content-center">
                                <i data-feather="slash" width="20" height="20" class="text-white"></i>
                            </span>
                        <?php elseif($user->verified): ?>
                            <span class="user-circle-badge has-verified d-flex align-items-center justify-content-center">
                                <i data-feather="check" width="20" height="20" class="text-white"></i>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="ml-20 ml-lg-40">
                        <h1 class="font-24 font-weight-bold text-dark-blue"><?php echo e($user["full_name"]); ?></h1>
                        <span class="text-gray"><?php echo e($user["headline"]); ?></span>

                        <div class="stars-card d-flex align-items-center mt-5">
                            <?php echo $__env->make('web.default.includes.webinar.rate',['rate' => $userRates], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <div class="w-100 mt-10 d-flex align-items-center justify-content-center justify-content-lg-start">
                            <div class="d-flex flex-column followers-status">
                                <span class="font-20 font-weight-bold text-dark-blue"><?php echo e($userFollowers->count()); ?></span>
                                <span class="font-14 text-gray"><?php echo e(trans('panel.followers')); ?></span>
                            </div>

                            <div class="d-flex flex-column ml-25 pl-5 following-status">
                                <span class="font-20 font-weight-bold text-dark-blue"><?php echo e($userFollowing->count()); ?></span>
                                <span class="font-14 text-gray"><?php echo e(trans('panel.following')); ?></span>
                            </div>
                        </div>

                        <div class="user-reward-badges d-flex align-items-center mt-15">
                            <?php if(!empty($userBadges)): ?>
                                <?php $__currentLoopData = $userBadges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userBadge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mr-15" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<?php echo (!empty($userBadge->badge_id) ? nl2br($userBadge->badge->description) : nl2br($userBadge->description)); ?>">
                                        <img src="<?php echo e(!empty($userBadge->badge_id) ? $userBadge->badge->image : $userBadge->image); ?>" width="32" height="32" alt="<?php echo e(!empty($userBadge->badge_id) ? $userBadge->badge->title : $userBadge->title); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="user-actions d-flex flex-column">
                    <button type="button" id="followToggle" data-user-id="<?php echo e($user['id']); ?>" class="btn btn-<?php echo e((!empty($authUserIsFollower) and $authUserIsFollower) ? 'danger' : 'primary'); ?> btn-sm">
                        <?php if(!empty($authUserIsFollower) and $authUserIsFollower): ?>
                            <?php echo e(trans('panel.unfollow')); ?>

                        <?php else: ?>
                            <?php echo e(trans('panel.follow')); ?>

                        <?php endif; ?>
                    </button>

                    <?php if($user->public_message): ?>
                        <button type="button" class="js-send-message btn btn-border-white rounded btn-sm mt-15"><?php echo e(trans('site.send_message')); ?></button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mt-40 border-top"></div>

            <div class="row mt-30 w-100 d-flex align-items-center justify-content-around">
                <div class="col-6 col-md-3 user-profile-state d-flex flex-column align-items-center">
                    <div class="state-icon orange p-15 rounded-lg">
                        <img src="/assets/default/img/profile/students.svg" alt="">
                    </div>
                    <span class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($user->students_count); ?></span>
                    <span class="font-14 text-gray"><?php echo e(trans('quiz.students')); ?></span>
                </div>

                <div class="col-6 col-md-3 user-profile-state d-flex flex-column align-items-center">
                    <div class="state-icon blue p-15 rounded-lg">
                        <img src="/assets/default/img/profile/webinars.svg" alt="">
                    </div>
                    <span class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e(count($webinars)); ?></span>
                    <span class="font-14 text-gray"><?php echo e(trans('webinars.classes')); ?></span>
                </div>

                <div class="col-6 col-md-3 mt-20 mt-md-0 user-profile-state d-flex flex-column align-items-center">
                    <div class="state-icon green p-15 rounded-lg">
                        <img src="/assets/default/img/profile/reviews.svg" alt="">
                    </div>
                    <span class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($user->reviewsCount()); ?></span>
                    <span class="font-14 text-gray"><?php echo e(trans('product.reviews')); ?></span>
                </div>


                <div class="col-6 col-md-3 mt-20 mt-md-0 user-profile-state d-flex flex-column align-items-center">
                    <div class="state-icon royalblue p-15 rounded-lg">
                        <img src="/assets/default/img/profile/appointments.svg" alt="">
                    </div>
                    <span class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($appointments); ?></span>
                    <span class="font-14 text-gray"><?php echo e(trans('site.appointments')); ?></span>
                </div>

            </div>
        </div>
    </section>

    <div class="container mt-30">
        <section class="rounded-lg border px-10 pb-35 pt-5 position-relative">
            <ul class="nav nav-tabs d-flex align-items-center px-20 px-lg-50 pb-15" id="tabs-tab" role="tablist">
                <li class="nav-item mr-20 mr-lg-50 mt-30">
                    <a class="position-relative text-dark-blue font-weight-500 font-16 <?php echo e((empty(request()->get('tab')) or request()->get('tab') == 'about') ? 'active' : ''); ?>" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true"><?php echo e(trans('site.about')); ?></a>
                </li>
                <li class="nav-item mr-20 mr-lg-50 mt-30">
                    <a class="position-relative text-dark-blue font-weight-500 font-16 <?php echo e((request()->get('tab') == 'webinars') ? 'active' : ''); ?>" id="webinars-tab" data-toggle="tab" href="#webinars" role="tab" aria-controls="webinars" aria-selected="false"><?php echo e(trans('webinars.classes')); ?></a>
                </li>
                <li class="nav-item mr-20 mr-lg-50 mt-30">
                    <a class="position-relative text-dark-blue font-weight-500 font-16 <?php echo e((request()->get('tab') == 'badges') ? 'active' : ''); ?>" id="badges-tab" data-toggle="tab" href="#badges" role="tab" aria-controls="badges" aria-selected="false"><?php echo e(trans('site.badges')); ?></a>
                </li>

                <li class="nav-item mr-20 mr-lg-50 mt-30">
                    <a class="position-relative text-dark-blue font-weight-500 font-16 <?php echo e((request()->get('tab') == 'appointments') ? 'active' : ''); ?>" id="appointments-tab" data-toggle="tab" href="#appointments" role="tab" aria-controls="appointments" aria-selected="false"><?php echo e(trans('site.book_an_appointment')); ?></a>
                </li>
            </ul>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade px-20 px-lg-50 <?php echo e((empty(request()->get('tab')) or request()->get('tab') == 'about') ? 'show active' : ''); ?>" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <?php echo $__env->make(getTemplate().'.user.profile_tabs.about', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="tab-pane fade" id="webinars" role="tabpanel" aria-labelledby="webinars-tab">
                    <?php echo $__env->make(getTemplate().'.user.profile_tabs.webinars', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="tab-pane fade" id="badges" role="tabpanel" aria-labelledby="badges-tab">
                    <?php echo $__env->make(getTemplate().'.user.profile_tabs.badges', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div class="tab-pane fade px-20 px-lg-50 <?php echo e((request()->get('tab') == 'appointments') ? 'show active' : ''); ?>" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">
                    <?php echo $__env->make(getTemplate().'.user.profile_tabs.appointments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </section>
    </div>

    <div class="d-none" id="sendMessageModal">
        <h3 class="section-title after-line font-20 text-dark-blue mb-25"><?php echo e(trans('site.send_message')); ?></h3>

        <form action="/users/<?php echo e($user->id); ?>/send-message" method="post">
            <?php echo e(csrf_field()); ?>


            <div class="form-group">
                <label class="input-label"><?php echo e(trans('public.title')); ?></label>
                <input type="text" name="title" class="form-control"/>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label class="input-label"><?php echo e(trans('public.email')); ?></label>
                <input type="text" name="email" class="form-control"/>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label class="input-label"><?php echo e(trans('public.description')); ?></label>
                <textarea name="description" class="form-control" rows="6"></textarea>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label class="input-label font-weight-500"><?php echo e(trans('site.captcha')); ?></label>
                <div class="row align-items-center">
                    <div class="col">
                        <input type="text" name="captcha" class="form-control">

                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col d-flex align-items-center">
                        <img id="captchaImageComment" class="captcha-image" src="">

                        <button type="button" class="js-refresh-captcha btn-transparent ml-15">
                            <i data-feather="refresh-ccw" width="24" height="24" class=""></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-30 d-flex align-items-center justify-content-end">
                <button type="button" class="js-send-message-submit btn btn-primary"><?php echo e(trans('site.send_message')); ?></button>
                <button type="button" class="btn btn-danger ml-10 close-swl"><?php echo e(trans('public.close')); ?></button>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script>
        var unFollowLang = '<?php echo e(trans('panel.unfollow')); ?>';
        var followLang = '<?php echo e(trans('panel.follow')); ?>';
        var reservedLang = '<?php echo e(trans('meeting.reserved')); ?>';
        var availableDays = <?php echo e(json_encode($times)); ?>;
        var messageSuccessSentLang = '<?php echo e(trans('site.message_success_sent')); ?>';
    </script>

    <script src="/assets/default/vendors/persian-datepicker/persian-date.js"></script>
    <script src="/assets/default/vendors/persian-datepicker/persian-datepicker.js"></script>

    <script src="/assets/default/js/parts/profile.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate().'.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u275401563/domains/tomouh.online/public_html/resources/views/web/default/user/profile.blade.php ENDPATH**/ ?>