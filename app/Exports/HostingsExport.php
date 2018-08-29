<?php

namespace App\Exports;

use App\Model\Admin\Hosting\Hosting;
use Maatwebsite\Excel\Concerns\FromCollection;

class HostingsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Hosting::all();
    }
}
