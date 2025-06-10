<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsersController extends Controller
{

    public function getAdminUsers()
    {
        $response = Http::get(env('BASE_API') . '/admin/by-role/2'); // role_id = 1
        $admins = $response->json();

        return view('admin.admin', compact('admins'));
    }
    public function getManagerUsers()
    {
        $response = Http::get(env('BASE_API') . '/users/by-role/3'); // role_id = 1
        $admins = $response->json();

        return view('admin.manager', compact('managers'));
    }
    public function getCommitteeUsers()
    {
        $response = Http::get(env('BASE_API') . '/users/by-role/4'); // role_id = 1
        $admins = $response->json();

        return view('admin.committee', compact('committee'));
    }
}
