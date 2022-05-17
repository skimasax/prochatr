<?php

namespace App\Imports;

use App\Prochatrinvite;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProchatrinvitesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Prochatrinvite([
            'inviteid'     => session('prochatr_login_id'),
            'name'     => $row['name'],
            'email'    => $row['email'],
            'image'    => $_SERVER['HTTP_ORIGIN']."/asset/img/excel.png",
            'count'    => 0,
        ]);

    }
}
