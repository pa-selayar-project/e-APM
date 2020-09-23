<?php

namespace App\Http\Controllers;

use App\Assesmen;
use App\Eviden;
use App\Area;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect, Response;

class FrontController extends Controller
{
    public function index()
    {
        $area = Area::all();
        return view('front/index', compact('area'));
    }

    public function get_data($id)
    {
        $data = Eviden::where('id', $id)->first();
        return url('assets/pdf/'.$data->file_upload);        
    }
   
    public function get_front($id)
    {
		$area = Area::find($id);
        $asses = Assesmen::where('area', $area->nama_area)->paginate(5);
        return view('front/tabel', compact('asses','area'));        
    }
}
