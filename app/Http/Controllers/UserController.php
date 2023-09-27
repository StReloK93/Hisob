<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserOrganization;


class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }


    public function store(Request $request)
    {
        //
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
}
