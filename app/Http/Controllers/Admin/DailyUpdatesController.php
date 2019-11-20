<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DailyUpdate;

class DailyUpdatesController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAllowed');
    }
    
	public function index(){
		$dailyUpdates = DailyUpdate::with('species', 'species.genus')
			->latest()
			->paginate(50);

    	return view('admin.daily_updates.index', compact('dailyUpdates'));
    }
}
