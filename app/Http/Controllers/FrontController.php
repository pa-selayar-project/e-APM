<?php

namespace App\Http\Controllers;

use App\Assesmen;
use App\Eviden;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect, Response;

class FrontController extends Controller
{
    public function index()
    {
        $data = Assesmen::paginate(10);
        return view('front/index', ['data' => $data]);
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show(Front $front)
    {
        //
    }

    
    public function edit(Front $front)
    {
        //
    }

   
    public function update(Request $request, Front $front)
    {
        //
    }

    
    public function destroy(Front $front)
    {
        //
    }

    public function get_data($id)
    {
        $data = Eviden::where('id', $id)->first();
        return url('assets/pdf/'.$data->file_upload);        
    }
}
