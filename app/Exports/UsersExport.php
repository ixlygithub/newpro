<?php

namespace App\Exports;

use App\Models\Report;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $reports= DB::table('usertests')
        ->selectRaw('users.id,users.name as user_name,users.last_name as last_name,users.mobile as mobile,users.email as email,count(usertests.id) as testcount')
        ->leftjoin('users','users.id','usertests.user_id')
        ->where('users.role','user')
        ->groupBy('users.id')->get();
        return $reports;
    }
    public function headings() :array
    {
        return ["No","First Name", "Last Name", "Mobile","Email","No Of Tests"];
    }
}
