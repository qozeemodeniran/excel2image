<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\Export;
use App\Imports\Import;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use File;

class E2IController extends Controller
{
    public function importExportView()
    {
    //    $import_data_array = [];
       $resulted_images = [];
       $res = [];
    //    return view('import', [/**'import_data_array' => $import_data_array,*/ 'inner_array' => $inner_array, 'resulted_images' => $resulted_images, 'res' => $res]);
        return view('import');
    }

    public function export() 
    {
        return Excel::download(new Export, 'excel2image.xlsx');
    }

    public function import(Request $request) 
    {
       $file = request()->file('file');

        if($file) {
           $filename = $file->getClientOriginalName();
           $extension = $file->getClientOriginalExtension();
           $tempPath = $file->getRealPath();
           $fileSize = $file->getSize();
           $location = 'uploads';

           Excel::import(new Import, $file);

           $file->move($location, $filename);
           $filepath = public_path($location . "/" . $filename);
           $file = fopen($filepath, "r");
           
            $i = 0;
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
               $num = count($filedata);
               if ($i == 0) {
                   $i++;
                   continue;
               }
               for ($c = 0; $c < $num; $c++) {
                   $importData_arr[$i][] = $filedata[$c];
               }
               $i++;
            }
            fclose($file);

            $import_data_array = [];
            $resulted_images = [];
            $res = [];
            
            // foreach($importData_arr as $importData) {
                // dd($importData_arr);
                $import_data = [
                    "customer_one" => $importData_arr[1],
                    "customer_two" => $importData_arr[2],
                    "customer_three" => $importData_arr[3],
                    "customer_four" => $importData_arr[4],
                    "customer_five" => $importData_arr[5],
                    "customer_six" => $importData_arr[6],
                    "customer_seven" => $importData_arr[7],
                    "customer_eight" => $importData_arr[8],
                    "customer_nine" => $importData_arr[9],
                    "customer_ten" => $importData_arr[10],
                ];
                // dd($import_data);
                // array_push($import_data_array, $import_data);
                // foreach($import_data_array as $inner_array) {
                    // dd($inner_array);
                    // return view('result', ['inner_array' => $inner_array])->render();
                    // dd($import_data_array);

                    for($i=0; $i <=sizeof($import_data); $i++) {
                        foreach($import_data as $inner_array){
                            // dd($inner_array);
                            $view = view('result', ['import_data' => $import_data, 'inner_array' => $inner_array])->render();
                            $html = json_encode(['html' => $view]);
                            // dd($html);

                            // for($i=0; $i <=sizeof($import_data); $i++) {
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => 'http://imagecanvas-lb-598317900.us-east-2.elb.amazonaws.com/api/v1/htmlconversion/render',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 100,  
                                CURLOPT_SSL_VERIFYHOST => false,
                                CURLOPT_SSL_VERIFYPEER => false,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_CUSTOMREQUEST => 'POST',
                                CURLOPT_POSTFIELDS => $html,
                                CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json',
                                    "SERVICEID: 00000"
                                ),
                            ));

                            $result = curl_exec($curl);
                            // dd($result);
                            if (curl_errno($curl)) {
                                // dd('Error');
                                echo 'Error:' . curl_error($curl);
                            } else {
                                // dd('Success');
                                array_push($resulted_images, $result);
                                // dd($resulted_images);
                            }
                            curl_close ($curl);

                            $res = json_decode($result, true);
                            // array_push($res, $res);
                            // dd($res);
                            $res = $res['data'];
                            $res = explode(',' , $res);
                            $res = $res[1];
                            // dd($res);

                            // $res = base64_decode($res);
            
                            $filename_path =  md5(time().uniqid()).".jpg"; 
                            $res = base64_decode($res);
                            file_put_contents("uploads/".$filename_path,$res); 
                            // dd($res);
                        }
                        return view('result', ['res' => $res, 'import_data' => $import_data, 'inner_array' => $inner_array]);
                    }

                // }
            // }
        }
        return back();
    }

    // public function result()
    // {
    //     // $inner_array = [];
    //     return view('result');
    // }
}
