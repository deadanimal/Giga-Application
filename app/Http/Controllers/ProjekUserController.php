<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjekUserRequest;
use App\Http\Requests\UpdateProjekUserRequest;
use App\Models\ProjekUser;

class ProjekUserController extends Controller
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
     * @param  \App\Http\Requests\StoreProjekUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjekUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjekUser  $projekUser
     * @return \Illuminate\Http\Response
     */
    public function show(ProjekUser $projekUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjekUser  $projekUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjekUser $projekUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjekUserRequest  $request
     * @param  \App\Models\ProjekUser  $projekUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjekUserRequest $request, ProjekUser $projekUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjekUser  $projekUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjekUser $projekUser)
    {
        //
    }
}
