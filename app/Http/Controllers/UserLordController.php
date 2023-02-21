<?php

namespace App\Http\Controllers;

use App\Models\UserLord;
use Illuminate\Http\Request;

class UserLordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        return $request->header();

        $input = $request->all();  
        $useradmin = new User;
        $useradmin->name = $input['name'];
        $useradmin->email= $input['email'];
        $useradmin->password= bcrypt($input['password']);
        $useradmin->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserLord  $userLord
     * @return \Illuminate\Http\Response
     */
    public function show(UserLord $userLord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserLord  $userLord
     * @return \Illuminate\Http\Response
     */
    public function edit(UserLord $userLord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserLord  $userLord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserLord $userLord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserLord  $userLord
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLord $userLord)
    {
        //
    }
}
