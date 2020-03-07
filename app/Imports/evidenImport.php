<?php

namespace App\Imports;

use App\Eviden;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class evidenImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Eviden::create([
                'nomor_urut' => $row[0],
                'nama_eviden' => $row[3],
                'area_id' => $row[1],
                'kriteria_id' => $row[2],
            ]);
        }
    }
}
