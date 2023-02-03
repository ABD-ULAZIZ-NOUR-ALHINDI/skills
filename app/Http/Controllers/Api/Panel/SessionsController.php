<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Panel\AgoraController;
use App\Models\AgoraHistory;
use App\Models\Sale;
use App\Models\Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    //
//  $user = User::find($request->input('user_id'));
//        Auth::login($user);

    public function BigBlueButton(Request $request)
    {

        $session_id = $request->input('session_id');
        $user = User::find($request->input('user_id'));
        Auth::login($user);

     return   redirect(url('panel/sessions/' . $session_id . '/joinToBigBlueButton'));

    }

    public function agora(Request $request)
    {

        $session_id = $request->input('session_id');
        $user = User::find($request->input('user_id'));
        Auth::login($user);

       return redirect(url('panel/sessions/' . $session_id . '/joinToAgora'));
    }
}
