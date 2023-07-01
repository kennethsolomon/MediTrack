<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Medicines/Index', [
            'filters' => Request::all('search', 'trashed'),
            'medicines' => Medicine::orderBy('name')
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($medicine) => [
                    'id' => $medicine->id,
                    'name' => $medicine->name,
                    'deleted_at' => $medicine->deleted_at,
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
        return Inertia::render('Medicines/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medicine = Medicine::create(
            Request::validate([
                'name' => ['required', 'max:522'],
            ])
        );

        return back()->with('success', $medicine->name . ' medicine created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        return Inertia::render('Medicines/Edit', [
            'medicine' => [
                'id' => $medicine->id,
                'name' => $medicine->name,
                'deleted_at' => $medicine->deleted_at,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
     public function update(Medicine $medicine)
    {
        $medicine->update(
            Request::validate([
                'name' => ['required', 'max:50'],
            ])
        );

        return Redirect::back()->with('success', 'Medicine updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
     public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return Redirect::back()->with('success', 'Medicine deleted.');
    }

    public function restore(Medicine $medicine)
    {
        $medicine->restore();

        return Redirect::back()->with('success', 'Medicine restored.');
    }
}
