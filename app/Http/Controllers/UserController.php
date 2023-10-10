<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserOrganization;
use Hash;
use Auth;
class UserController extends Controller
{

    public function index()
    {
        return User::all();
        return User::whereNot('id',Auth::user()->id)->get();
    }


    public function store(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'login' => $request->login,
            'password' => Hash::make('zzzz1111*'),
        ]);


        $this->insertOrganization($request->organizations, $user->id);
        $this->insertRole($request->roles, $user->id);

        return $user;
    }

    public function show($id)
    {
        return User::find($id);
    }


    public function update(Request $request, $id)
    {
        $this->insertOrganization($request->organizations, $id);
        $this->insertRole($request->roles, $id);

        $user = User::find($id);

        $user->name = $request->name;
        $user->save();

        $this->updateToken($user);

        return $user->fresh();
    }

    public function destroy($id)
    {
        //
    }










    private function insertOrganization($organizations, $id){
        UserOrganization::where('user_id', $id)->delete();
        $array = [];
        foreach ($organizations as $key => $organization) {
            $array[] = [
                'user_id' => $id,
                'organizations_id' => $organization,
            ];
        }
        UserOrganization::insert($array);
    }

    private function insertRole($roles, $id){
        UserRole::where('user_id', $id)->delete();
        $array = [];
        foreach ($roles as $key => $role) {
            $array[] = [
                'user_id' => $id,
                'role_id' => $role,
            ];
        }
        UserRole::insert($array);
    }


    private function updateToken($user){
        foreach ($user->tokens as $token) {
            $token->abilities = $user->rolenames;
            $token->save();
        }
    }
}
