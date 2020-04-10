<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Audit;

class AuditLogsController extends Controller
{
    public function index(Request $request){

    	if($request->ajax()){
            $audits = Audit::with('user', 'audit')->orderBy('audits.created_at', 'desc');
            return datatables($audits)->toJson();
        }    	

    	return view('admin.audits.index');
    }
}
