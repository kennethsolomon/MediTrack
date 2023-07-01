<?php

namespace App\Http\Controllers;

use App\Models\Frequency;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class FrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Frequencies/Index', [
            'filters' => Request::all('search', 'trashed'),
            'frequencies' => Frequency::orderBy('name')
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($frequency) => [
                    'id' => $frequency->id,
                    'name' => $frequency->name,
                    'deleted_at' => $frequency->deleted_at,
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Frequencies/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $frequency = Frequency::create(
            Request::validate([
                'name' => ['required', 'max:522'],
            ])
        );

        return back()->with('success', $frequency->name . ' frequency created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frequency  $frequency
     * @return \Illuminate\Http\Response
     */
    public function edit(Frequency $frequency)
    {
        return Inertia::render('Frequencies/Edit', [
            'frequency' => [
                'id' => $frequency->id,
                'name' => $frequency->name,
                'deleted_at' => $frequency->deleted_at,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frequency  $frequency
     * @return \Illuminate\Http\Response
     */
     public function update(Frequency $frequency)
    {
        $frequency->update(
            Request::validate([
                'name' => ['required', 'max:50'],
            ])
        );

        return Redirect::back()->with('success', 'Frequency updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frequency  $frequency
     * @return \Illuminate\Http\Response
     */
     public function destroy(Frequency $frequency)
    {
        $frequency->delete();

        return Redirect::back()->with('success', 'Frequency deleted.');
    }

    public function restore(Frequency $frequency)
    {
        $frequency->restore();

        return Redirect::back()->with('success', 'Frequency restored.');
    }
}
