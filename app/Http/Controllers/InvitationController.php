<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    /**
     * Show invitation form
     */
    public function create()
    {
        $authUser = Auth::user();
        $roleName = $authUser->role->name;

        // ❌ SuperAdmin cannot invite Admin
        if ($roleName === 'SuperAdmin') {
            $roles = Role::whereNotIn('name', ['Admin'])->get();
            return view('invitations.create', compact('roles'));
        }

        // ❌ Admin cannot invite Admin or Member
        if ($roleName === 'Admin') {
            $roles = Role::whereNotIn('name', ['Admin', 'Member'])->get();
            return view('invitations.create', compact('roles'));
        }

        abort(403, 'You are not allowed to invite users');
    }

    /**
     * Send invitation (create inactive user)
     */
    public function store(Request $request)
    {
        $authUser = Auth::user();
        $authRole = $authUser->role->name;

        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
        ]);

        $inviteRole = Role::findOrFail($request->role_id)->name;

        // ❌ SuperAdmin restriction
        if ($authRole === 'SuperAdmin' && $inviteRole === 'Admin') {
            abort(403, 'SuperAdmin cannot invite Admin');
        }

        // ❌ Admin restriction
        if ($authRole === 'Admin' && in_array($inviteRole, ['Admin', 'Member'])) {
            abort(403, 'Admin cannot invite Admin or Member');
        }

        // Create invited user (password random, user activates later)
        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make(Str::random(12)),
            'role_id'    => $request->role_id,
            'company_id' => $authUser->company_id, // single company rule
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Invitation sent successfully');
    }
}
