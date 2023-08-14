<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $pageTitle = 'data';
        return view('firebase.data.index', ['pageTitle' => $pageTitle]);
    }

    public function create()
    {
        $pageTitle = 'create';
        return view('firebase.data.create', ['pageTitle' => $pageTitle]);
    }
}