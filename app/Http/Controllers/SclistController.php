<?php

namespace App\Http\Controllers;

use App\Sclist;
use Illuminate\Http\Request;

class SclistController extends Controller
{
    public function index()
    {
        return view('sclist.index');
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Sclist $sclist)
    {
        //
    }

    public function destroy(Sclist $sclist)
    {
        //
    }
}
