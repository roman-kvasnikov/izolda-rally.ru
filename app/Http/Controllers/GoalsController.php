<?php

namespace App\Http\Controllers;

class GoalsController extends Controller
{
    public function __invoke()
    {
        return view('goals');
    }
}
