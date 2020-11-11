<?php

namespace App\Http\Controllers;

use Auth;
use App\Assesmen;
use App\Eviden;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect, Response;

class lke1Controller extends Controller
{
    public function index()
    {
        $user = Auth::user()->jenis_user;
        if ($user === 'ADMIN') {
            $data = Assesmen::paginate(10);
        } else {
            $data = Assesmen::where('area', $user)->paginate(5);
        }

        return view('user/lke/apm/index', ['data' => $data]);
    }

    public function get_data($id)
    {
        $data = Eviden::find($id);
        return url('assets/pdf/'.$data->file_upload);        
    }

    public function store(Request $request)
    {
        return Redirect::back()->with('message', 'Halaman Terkunci');
    }

    public function update(Request $request, Eviden $eviden, $id)
    {
        $update = Eviden::find($id);

        Storage::delete('pdf/' . $update->file_upload);
        $update->update($this->validasiRequest());
        $this->storeFile($request, $update);
        Response::json($update);
        return Redirect::back()->with('message', 'File Berhasil diupload');
    }

    public function hapus_pdf(Eviden $eviden, $id)
    {
        $pdf = Eviden::find($id);
        Storage::delete('pdf/' . $pdf->file_upload);
        $pdf->update(['file_upload' => '']);
        Response::json($pdf);
        return Redirect::back()->with('message', 'File Berhasil dihapus');
    }

    private function validasiRequest()
    {
        $messages = [
            'file' => 'File tidak ada!',
            'size' => 'Ukuran file maksimal 30 MB',
            'mimes' => 'Format file harus PDF',
            'required' => 'File tidak ada!',
        ];
        if (request()->hasFile('file_upload')) {
            return request()->validate([
                'file_upload' => 'file|required|max:30000|mimes:pdf'
            ], $messages);
        }
    }

    private function storeFile($request, $update)
    {
        if (request()->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $ext = $file->getClientOriginalExtension();
            $destination = 'assets/pdf';
            $filename = 'Eviden_' . uniqid() . '.' . $ext;
            $file->move($destination, $filename);

            $update->update([
                'file_upload' => $filename
            ]);
        }
    }
}
