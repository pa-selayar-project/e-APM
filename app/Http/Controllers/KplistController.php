<?php

namespace App\Http\Controllers;

use App\Kplist;
use Illuminate\Http\Request;

class KplistController extends Controller
{
    public function index()
    {
        return view('kplist.index');
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Kplist $kplist)
    {
        //
    }

    public function destroy(Kplist $kplist)
    {
        //
    }
}
