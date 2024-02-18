<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportType;

class ReportTypeController extends Controller
{
	public function index()
	{
		return ReportType::all();
	}
}
