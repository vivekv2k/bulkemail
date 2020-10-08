<?php

namespace App\Excel\Import;
use App\Models\UserDetails\UserDetails;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;


class impUsersDetailsExcelSheet implements ToModel, WithStartRow
{

    private $setBatchId;
    private $setLoginUser;
    public function __construct($setBatchId,$setLoginUser){
      
        $this->setBatchId = $setBatchId;
        $this->setLoginUser = $setLoginUser;
    }

    public function startRow(): int
    {
        return 2;
    }
   
    public function model(array $row)
    {
        //dd($this->BatchNo);
      
        return new UserDetails([
            'name'   => $row[1],
            'contact_number' => $row[2],
            'email'  => $row[3],
            'batch_id' => $this->setBatchId,
            'added_user_id' => $this->setLoginUser


        ]);
    }
}