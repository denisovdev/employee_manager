<?php

namespace App\Http\Controllers;

use App\Exports\ExportUser;
use App\Mail\Register;
use App\Models\User\RegisterInvite;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

use App\Models\User\User;
use App\Models\Role\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
//    protected
    protected function createToken(): string
    {
        $token = bin2hex(random_bytes(16));
        if ((new RegisterInvite())->where('token', $token)->count()) {
            $token = $this->createToken();
        }
        return $token;
    }

    protected function sendInviteMail(RegisterInvite $invite): RedirectResponse
    {
        try {
           Mail::to($invite->email)->send(new Register($invite));
            // Mail::to('dxngee@gmail.com')->send(new Register($invite));
            $invite->send_at = Carbon::now();
            $invite->save();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }

        return redirect()->back()->with('success', 'Приглашение отправлено!');
    }

//    public
    public function index(): View
    {
        Gate::authorize('user.view');

        return view('user.index', [
            'items' => User::orderBy('last_name')->paginate(10),
            'roles' => Role::all()->pluck('title', 'id'),
            'invites' => RegisterInvite::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function sendInvite(Request $request): RedirectResponse
    {
        Gate::authorize('user.invite');
        $data = $request->validate([
            'email' => 'required|string|email|max:255|unique:user|unique:register_invite',
            'role_id' => 'required|string'
        ]);
        $data['token'] = $this->createToken();

        $invite = new RegisterInvite();
        $invite->fill($data);
        $invite->save();

        return $this->sendInviteMail($invite);
    }

    public function resendInvite(RegisterInvite $invite): RedirectResponse
    {
        Gate::authorize('user.invite');

        return $this->sendInviteMail($invite);
    }

    public function deleteInvite(RegisterInvite $invite): RedirectResponse
    {
        Gate::authorize('user.invite');
        try {
            $invite->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
        return redirect()->back()->with('success', 'Приглашение отменено!');
    }

    public function show(User $user): View
    {
        return view('user.show', ['user' => $user]);
    }

    public function edit(User $user): View
    {
        return view('user.edit', [
            'user' => $user,
            'roles' => Role::all()->pluck('title', 'id'),
        ]);
    }
    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'role_id' => 'required|string'
        ]);

        $user->fill($data);

        try {
            $user->save();
            return redirect()->route('user.show', $user)->with('success', 'Информация обновлена!');
        } catch (\Exception $exception) {
            return redirect()->route('user.show', $user)->withErrors(['Не удалось обновить. Повторите попытку позже или обратитесь к администратору']);
        }
    }

    public function export(Request $request){
        return Excel::download(new ExportUser, 'users.xlsx');
    }
}

