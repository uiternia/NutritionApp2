<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BmiController extends Controller
{
    public function bmi()
    {
        return Inertia::render('User/Bmi');
    }
}
