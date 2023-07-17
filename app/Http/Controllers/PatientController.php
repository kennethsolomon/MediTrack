<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Patients/Index', [
            'filters' => Request::all('search', 'trashed'),
            'patients' => Patient::orderByName()
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($patient) => [
                    'id' => $patient->id,
                    'name' => $patient->name,
                    'gender' => $patient->gender,
                    'birthdate' => $patient->birthdate,
                    'address' => $patient->address,
                    'status' => $patient->status,
                    'deleted_at' => $patient->deleted_at,
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
        return Inertia::render('Patients/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = Patient::create(
            Request::validate([
                'first_name' => ['required', 'max:522'],
                'last_name' => ['required', 'max:522'],
                'middle_name' => ['sometimes', 'max:522'],
                'suffix_name' => ['sometimes', 'max:522'],
                'gender' => ['required', 'max:522'],
                'address' => ['required', 'max:522'],
                'birth_date' => ['required', 'max:522'],
                'place_of_birth' => ['required', 'max:522'],
                'religion' => ['required', 'max:522'],
                'nationality' => ['required', 'max:522'],
                'civil_status' => ['required', 'max:522'],

                // 'user_id' => 'required|exists:App\Models\User,id',
            ]) + ['user_id' => auth()->id()]
        );

        return back()->with('success', $patient->first_name . ' ' . $patient->last_name . ' patient created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
