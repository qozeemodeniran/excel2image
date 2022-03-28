<?php

namespace App\Imports;

use App\Models\excel2image;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Import implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new excel2image([
            'customer_name' => $row['customer_name'],
            'customer_address' => $row['customer_address'],
            'address_verification_status' => $row['address_verification_status'],
            'house_picture' => $row['house_picture'],
            'gps' => $row['gps'],
            'gps_latitude' => $row['gps_latitude'],
            'gps_longitude' => $row['gps_longitude'],
            'gps_altitude' => $row['gps_altitude'],
            'gps_precision' => $row['gps_precision'],
            'landmark_description' => $row['landmark_description'],
            'comment' => $row['comment'],
            'contact_person' => $row['contact_person'],
            'verification_officer_name' => $row['verification_officer_name'],
            'verification_date' => $row['verification_date']

        ]);
    }
}
