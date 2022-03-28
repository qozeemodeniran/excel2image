<?php

namespace App\Exports;

use App\Models\excel2image;
use Maatwebsite\Excel\Concerns\FromCollection;

class Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return excel2image::all();
    }
}
