<?php

namespace App\Imports;

use App\Lkeobservasi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class observasiImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        // dd($collection);
        foreach($collection as $row){
            Lkeobservasi::create([
               'lke_observasi_id' => 1, 
               'penilaian' => $row[0], 
               'bobot' => $row[1], 
               'skor' => 0, 
               'catatan' => '' 
            ]);

        }
    }
}
