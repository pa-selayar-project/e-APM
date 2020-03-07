<?php

namespace App\Http\Controllers;

use App\Sklist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect, Response;

class SklistsController extends Controller
{
    public function index()
    {
        $data = Sklist::paginate(10);
        return view('sklist.index', ['data' => $data]);
    }

    public function store()
    {
        $insert = Sklist::create($this->validasiRequest('create'));
        $this->storeFile($insert);
        Response::json($insert);
        return redirect('sklist')->with('message', 'Data Berhasil ditambahkan');
    }

    public function update(Request $request, Sklist $sklist)
    {
        Storage::delete($sklist->file_upload);
        $sklist->update($this->validasiRequest('update'));
        $this->storeFile($sklist);
        Response::json($sklist);
        return redirect('sklist')->with('message', 'Data Berhasil dirubah');
    }

    public function destroy(Sklist $sklist)
    {
        $delete = Sklist::destroy($sklist->id);
        Response::json($delete);
        return redirect('sklist')->with('message', 'Data Berhasil dihapus');
    }

    private function validasiRequest($tipe)
    {
        $messages = [
            'required' => 'kolom :attribute wajib diisi!',
            'unique' => ':attribute sudah ada dalam database'
        ];

        if ($tipe == 'create') {
            $rule = 'required|unique:sklists';
        } else {
            $rule = 'required';
        }

        return tap(
            request()->validate([
                'nomor_sk' => $rule,
                'nama_sk' => 'required',
                'tanggal' => 'required',
                'penandatangan' => 'required'
            ], $messages),
            function () {
                $messages2 = ['file' => ':attribute harus berbentuk file PDF'];
                if (request()->hasFile('file_upload')) {
                    request()->validate([
                        'file_upload' => 'file|max:2000'
                    ], $messages2);
                }
            }
        );
    }

    private function storeFile($update)
    {
        if (request()->has('file_upload')) {
            $update->update([
                'file_upload' => request()->file_upload->storeAs('', 'SK_' . uniqid() . '.pdf'),
            ]);
        }
    }
}
