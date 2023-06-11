<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class MedicineController extends Controller
{
    public function store()
    {
        Medicine::create(
            Request::validate([
                'name' => ['required', 'max:100']
            ])
        );

        return Redirect::route('dashboard')->with('success', 'Medicine created.');
    }
}
