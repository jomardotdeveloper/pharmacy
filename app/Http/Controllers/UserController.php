<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.user.index", [
            "users" => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.user.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userValidated = $request->validate([
            "username" => "unique:users|required",
            "password" => "required|string",
            "role" => "required"
        ]);
        $userValidated["password"] = Hash::make($userValidated["password"]);

        $user = User::create($userValidated);
        $user->save();
        return redirect()->route("users.show", ["user" => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view("admin.user.show", [
            "user" => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("admin.user.edit", [
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->role = $request->get("role");
        $user->save();
        return redirect()->route("users.show", ["user" => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("users.index");
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        $user->password = Hash::make("123");
        return back()->withErrors([
            "success-window" => "Password was reset."
        ]);
    }

    public function removeFirstTime($id)
    {
        $user = User::find($id);
        $user->first_time = false;
        $user->save();
    }
}
