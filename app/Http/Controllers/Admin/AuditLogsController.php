<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Audit;
use App\User;

class AuditLogsController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAllowed');
    }
    
    public function index(Request $request){

    	if($request->ajax()){
            $audits = Audit::with('user', 'audit')->latest();
            return datatables($audits)->toJson();
        }

        $admins = User::whereHas('roles')->get();    	

    	return view('admin.audits.index', compact('admins'));
    }
}
