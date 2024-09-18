<?php

namespace App\Http\Controllers;

use App\Models\User\RegisterInvite;
use App\Models\User\User;
use App\Providers\RouteServiceProvider;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AuthController extends Controller
{
    // pubilc
    public function register(Request $request)
    {
        $token = $request->query('token');
        $invite = $token ? RegisterInvite::where('token', $token)->whereNull('accepted_at')->first() : null;

        if ($invite) {
            return view('register.valid_token', ['invite' => $invite]);
        }

        return view('register.invalid_token');
    }

    public function create(RegisterInvite $invite, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|confirmed',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'role_id' => 'required|string',
        ]);

        $user = new User();
        $user->fill($data);
        $invite->accepted_at = Carbon::now();

        try {
            $invite->save();
            $user->save();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([
                'error' => 'Не удалось зарегистрироваться, повторите попытку позже или свяжитесь с администратором.'
            ]);
        }

        return redirect()->route('login')->with('success', 'Вы успешно зарегистрировались!');
    }

    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $remember = (bool)$request->input('remember');

        if (Auth::attempt($data, $remember)) {
            return redirect(RouteServiceProvider::HOME);
        }

        return redirect()->back()->withErrors([
            'error' => 'Неверный логин или пароль'
        ]);
    }
}
