<?php

namespace App\Http\Controllers;

use App\Kgblist;
use Illuminate\Http\Request;

class KgblistController extends Controller
{
    public function index()
    {
        return view('kgblist.index');
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Kgblist $kgblist)
    {
        //
    }

    public function destroy(Kgblist $kgblist)
    {
        //
    }
}
