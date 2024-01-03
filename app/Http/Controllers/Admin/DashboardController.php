<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ClientHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(auth('admin')->user()->role);
        return view('admin.dashboard.index');
    }

    public function setClient(Request $request)
    {
        if ($request->ajax()) {
            ClientHelper::setSession($request->clientId);
            return response()->json(['code' => 1, 'message' => 'Client ID set successfully.']);
        }
        return response()->json(['code' => 0, 'message' => 'Failed to set client ID.']);
    }
}
