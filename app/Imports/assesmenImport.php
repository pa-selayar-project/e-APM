<?php

namespace App\Imports;

use App\Assesmen;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class assesmenImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Assesmen::create([
                'nomor' => $row[0],
                'area' => $row[1],
                'kriteria' => $row[2],
            ]);
        }
    }
}
