<?php

namespace App\Http\Controllers;

use App\Models\PositionType;
use Illuminate\Http\Request;

class PositionTypeController extends Controller
{

    public function index()
    {
        return PositionType::all();
    }
    
}
