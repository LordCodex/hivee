<?php

namespace App\Http\Controllers;

use App\Models\hostel;
use App\Http\Requests\StorehostelRequest;
use App\Http\Requests\UpdatehostelRequest;

class HostelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorehostelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(hostel $hostel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(hostel $hostel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatehostelRequest $request, hostel $hostel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(hostel $hostel)
    {
        //
    }
}
