<?php

namespace App\Http\Controllers;

use Auth;
use \App\Eviden;
use \App\Soplist;
use \App\Sklist;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $dataPoints = array(
            array("label" => "Pimpinan", "y" => $this->area(1)),
            array("label" => "Hakim WasBid", "y" => $this->area(2)),
            array("label" => "Hakim", "y" => $this->area(3)),
            array("label" => "Internal Asesor", "y" => $this->area(4)),            
            array("label" => "SKM", "y" => $this->area(5)),
            array("label" => "Panmud Hukum", "y" => $this->area(6)),
            array("label" => "Document Control", "y" => $this->area(7)),
            array("label" => "Panmud Gugatan", "y" => $this->area(8)),
            array("label" => "Panmud Permohonan", "y" => $this->area(9)),
            array("label" => "PP", "y" => $this->area(11)),
            array("label" => "JS/JSP", "y" => $this->area(12)),
            array("label" => "Kepeg", "y" => $this->area(13)),
            array("label" => "Umum", "y" => $this->area(14)),
            array("label" => "TI", "y" => $this->area(15))
        );

        return view('dashboard.index', ['dataPoints' => $dataPoints]);
    }

    private function area($id)
    {
        $x = Eviden::where([['area_id', $id], ['file_upload', '!=', '']])->count();
        $y = Eviden::where('area_id', $id)->count();

        return ($x / $y) *100;
    }
}
