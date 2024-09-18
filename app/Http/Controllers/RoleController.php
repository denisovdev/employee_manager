<?php

namespace App\Http\Controllers;

use App\Models\Right;
use App\Models\Role\RoleRight;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Models\Role\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;

class RoleController extends Controller
{
    public function index(): View {
        return view('role.index', [
            'items' => Role::paginate(20)
        ]);
    }

    public function show(Role $role) {
        if (Auth::user()->can('right.moderate')) {
            $rights = Right::all();
        }
        else {
            $rights = $role->Rights->all();
        }
        return view('role.show', [
            'item' => $role,
            'rights' => $rights,
        ]);
    }

    public function create(Request $request): RedirectResponse {
        $data = $request->validate([
            'code' => 'string|required',
            'title' => 'string|required'
        ]);

        $role = new Role;
        $role->fill($data);
        $role->save();
        return redirect()->back()->with('success', 'Роль была успешно создана');
    }

    public function delete(Role $role): RedirectResponse {
        $role->delete();
        return redirect()->back()->with('success', 'Роль была успешно удалена');
    }

    public function updateRight(Request $request, Role $role) : RedirectResponse {
        foreach (Right::all() as $right) {
            $right_value = $request->input($right->id);
            if ($right_value && !$role->can($right->code)) {
                $role_right = new RoleRight();
                $role_right->role_id = $role->id;
                $role_right->right_id = $right->id;
                $role_right->save();
            }
            elseif (!$right_value && $role->can($right->code)) {
                $role_right = (new RoleRight())::where('role_id', $role->id)->where('right_id', $right->id)->first();
                $role_right->delete();
            }
        }
        return redirect()->back()->with('success', 'Набор прав был успешно обновлен');
    }
}
