<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the login form.
     */
    public function login()
    {
        return response()->json(['message' => 'login form']);
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        // Authentication logic placeholder
        return response()->json(['message' => 'authenticated']);
    }

    /**
     * Display a listing of admins.
     */
    public function index()
    {
        return response()->json(Admin::all());
    }

    /**
     * Store a newly created admin in storage.
     */
    public function store(Request $request)
    {
        $admin = Admin::create($request->all());
        return response()->json($admin, 201);
    }

    /**
     * Update the specified admin in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $admin->update($request->all());
        return response()->json($admin);
    }

    /**
     * Remove the specified admin from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->json();
    }
}
