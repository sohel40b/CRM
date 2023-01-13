<?php

namespace App\Http\Controllers;

use App\Models\AdminAuth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminAuthRequest;

class AdminAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminAuthRequest $request)
    {
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
        {
            $user = auth()->guard('admin')->user();
            $d = auth()->guard('admin')->user()->name;

            \Session::put('success','You are Login successfully!!');
            return redirect()->route('admin.home');

        } else {
            return back()->with('error','your username and password are wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminAuth  $adminAuth
     * @return \Illuminate\Http\Response
     */
    public function show(AdminAuth $adminAuth)
    {
        return view('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminAuth  $adminAuth
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminAuth $adminAuth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminAuth  $adminAuth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminAuth $adminAuth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminAuth  $adminAuth
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminAuth $adminAuth)
    {
        auth()->guard('admin')->logout();
        \Session::flush();
        \Session::put('success','You are logout successfully');        
        return redirect(route('admin.login'));
    }
}
