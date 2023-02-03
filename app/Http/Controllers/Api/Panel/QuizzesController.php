<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Api\Controller;
use App\Models\Api\Quiz;
use App\Models\Api\QuizzesResult;
use Illuminate\Http\Request;

class QuizzesController extends Controller
{
    public function created(Request $request)
    {
        $user = apiAuth();
        $quizzes = $user->userCreatedQuizzes()->
        orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')->get()->map(function ($quiz) {
                return $quiz->details;
            });

        return apiResponse2(1, 'retrieved', trans('api.public.retrieved'), [
            'quizzes' => $quizzes
        ]);
    }

    public function notParticipated(Request $request)
    {
        $user = apiAuth();
        $webinarIds = $user->getPurchasedCoursesIds();

        $quizzes = Quiz::whereIn('webinar_id', $webinarIds)
            ->where('status', 'active')
            ->whereDoesntHave('quizResults', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->handleFilters()
            ->orderBy('created_at', 'desc')
            ->get()->map(function ($quiz) {
                return $quiz->details;
            });

        return apiResponse2(1, 'retrieved', trans('api.public.retrieved'), [
            'quizzes' => $quizzes
        ]);

    }

    public function resultsByQuiz($quizId)
    {

        $user = apiAuth();
        $query = QuizzesResult::where('user_id', $user->id)
            ->where('quiz_id', $quizId);

        abort_unless(deepClone($query)->count(), 404);

        $result = (deepClone($query)->where('status', QuizzesResult::$passed)->first()) ?: null;
        if (!$result) {
            $result = deepClone($query)->latest()->first();
        }


        return apiResponse2(1, 'retrieved', trans('api.public.retrieved')
            , $result->details
        );


    }

}
