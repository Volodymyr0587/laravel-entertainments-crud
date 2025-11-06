<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntertainmentRequest;
use App\Http\Requests\UpdateEntertainmentRequest;
use App\Models\Entertainment;

class EntertainmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entertainments = Entertainment::paginate(2);

        return view('entertainments.index', ['entertainments' => $entertainments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entertainments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntertainmentRequest $request)
    {
        $data = $request->validated();

        $entertainment = Entertainment::create($data);

        return to_route('entertainments.index')->with('success', "$entertainment created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Entertainment $entertainment)
    {
        return view('entertainments.show', ['entertainment' => $entertainment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entertainment $entertainment)
    {
        return view('entertainments.edit', ['entertainment' => $entertainment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntertainmentRequest $request, Entertainment $entertainment)
    {
        $data = $request->validated();

        $entertainment->update($data);

        return to_route('entertainments.index')->with('success', "$entertainment updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entertainment $entertainment)
    {
        $entertainment->delete();

        return to_route('entertainments.index')->with('success', "$entertainment deleted successfully");
    }
}
