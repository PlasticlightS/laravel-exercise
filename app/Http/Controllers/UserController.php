<?php

namespace App\Http\Controllers;

use App\Events\UserSaved;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('User/Index', [
            'mustVerifyEmail' => false,
            'status' => session('status'),
            'trashed' => false,
            'users' => User::all()->map(fn($user) => [
                'id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email,
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('User/Create', [
            'mustVerifyEmail' => false,
            'status' => session('status'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        event(new UserSaved($user));

        return redirect(route('users.edit', $user));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return Inertia::render('User/Show', [
            'mustVerifyEmail' => false,
            'status' => session('status'),
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('User/Edit', [
            'user' => $user,
            'submitRoute' => route('users.update', $user),
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        event(new UserSaved(User::findOrFail($user->id)));

        return redirect(route('users.edit', $user));
    }

    /**
     * Display a listing of the resources deleted items.
     */
    public function trashed()
    {
        return Inertia::render('User/Index', [
            'mustVerifyEmail' => false,
            'status' => session('status'),
            'users' => User::onlyTrashed()->get(),
            'trashed' => true,
        ]);
    }

    /**
     * Soft delete the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('users.index'));
    }

    /**
     * Restore the specified resource to storage.
     */
    public function restore(int $id)
    {
        User::withTrashed()->where('id', $id)->restore();

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $id)
    {
        User::withTrashed()->where('id', $id)->forceDelete();

        return redirect(route('users.index'));
    }
}
