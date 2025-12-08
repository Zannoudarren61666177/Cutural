<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Landing page avant connexion
    public function index()
    {
        return view('accueil'); // la vue que nous avons créée
    }
}
