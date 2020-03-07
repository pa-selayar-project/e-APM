<?php

namespace App\Http\Controllers;

use App\Soplist;
use Illuminate\Http\Request;

class SoplistController extends Controller
{
    public function index()
    {
        return view('soplist.index');
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Soplist $soplist)
    {
        //
    }

    public function destroy(Soplist $soplist)
    {
        //
    }
}
