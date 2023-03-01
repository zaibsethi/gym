<?php
//
//namespace App\Imports;
//
//use App\Models\Member;
//use Illuminate\Support\Collection;
//use Illuminate\Support\Facades\Hash;
//use Maatwebsite\Excel\Concerns\ToCollection;
//
//class MembersImport implements ToCollection
//{
//    /**
//     * @param Collection $collection
//     */
//    public function collection(Collection $collection)
//    {
//        return new Member([
//            'id' => $collection[0],
//
//        ]);
//    }
//
//
//}


namespace App\Imports;
use Carbon\Carbon;

use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MembersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Member([
            "id" => $row['id'],
            "member_name" => $row['member_name'],
            "member_phone" => $row['member_phone'],
            "member_gender" => $row['member_gender'],
            "member_fee_start_date" => $row['member_fee_start_date'],
            "member_fee_end_date" => $row['member_fee_end_date'],
            "member_joining_date" => $row['member_joining_date'],
//            "member_fee_end_date" => new Carbon($row['member_fee_end_date']),
            "member_shift" => $row['member_shift'],
            "member_package" => $row['member_package'],


        ]);
    }
}
