<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class OrganizationController extends Controller
{
    public function index(){
        return Organization::all();
    }


    public function show($id){
        return Organization::find($id);
    }
}
