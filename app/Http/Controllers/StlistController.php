<?php

namespace App\Http\Controllers;

use App\Stlist;
use Illuminate\Http\Request;

class StlistController extends Controller
{
   public function index()
    {
        return view('stlist.index');
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Stlist $stlist)
    {
        //
    }

    public function destroy(Stlist $stlist)
    {
        //
    }
}
