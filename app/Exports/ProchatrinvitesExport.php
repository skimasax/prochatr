<?php

namespace App\Exports;

use App\Prochatrinvite;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProchatrinvitesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Prochatrinvite::all();
    }
}
