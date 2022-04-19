<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\Export;
use App\Imports\Import;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;
use DOMDocument;
use DOMXPath;

class E2IController extends Controller
{
    public function importExportView()
    {
       $resulted_images = [];
       $image = "";
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
            $image = "";
            $count = [];
            $success = 0;
            $failure = 0;

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

            for($i=0; $i <=sizeof($import_data); $i++) {
                foreach($import_data as $inner_array){
                    $view = view('result', ['import_data' => $import_data, 'inner_array' => $inner_array, 'image' => $image])->render();
                    $html = json_encode(['html' => $view]);
                            
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

                    if (curl_errno($curl)) {
                        echo 'Error:' . curl_error($curl);
                    } else {
                                array_push($resulted_images, $result);
                            }
                    curl_close ($curl);

                    $images_array = [];
                    $paths_array = [];
                    $res_array = [];

                    $res = json_decode($result, true);
                    $res_data = $res['data'];
                    $new_res_data = explode(',', $res_data);
                    $_64decode = base64_decode($new_res_data[ 1 ]);
                    // $_64decode = base64_decode(json_encode($new_res_data));

                    $image = "<img src='$res_data' alt='avs_image' width='100%' height='100%'>";
                    $path = md5(time().uniqid()).".jpg";

                    array_push($images_array, $image);
                    array_push($paths_array, $path);
                    array_push($res_array, $res_data);

                    foreach($images_array as $image_array){
                        echo $image_array;
                        array_push($count, $image_array);

                        $xpath = new DOMXPath(@DOMDocument::loadHTML($image));
                        $src = $xpath->evaluate("string(//img/@src)"); 
                        if(!$src){$failure += 1;} else {$success +=1;}

                        echo "<button style='float:right; margin-right:10%;'><a download='$path' href='$res_data'>Download</a></button><hr><br><br>";
                    }

                    file_put_contents("uploads/images/" . $path, $_64decode);
                    $pathdir = "uploads/images/";
                    $zipcreated = "avs.zip";
                    $zip = new ZipArchive;
                    if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) {
    
                        $dir = opendir($pathdir);
                        while($file = readdir($dir)) {
                            if(is_file($pathdir.$file)) {
                                $zip -> addFile($pathdir.$file, $file);
                            }
                        }
                        $zip ->close();
                    }
                } 

                echo "<center><button style='text-align: center; margin-right:30%; margin-left:30%;'>
                        <a href='$zipcreated' download>----------Download All(Zip)----------</a></button><br><br></center>";

                // dd($count);
                
                return view('display', [
                    'image_array' => $image_array, 
                    'images_array' => $images_array, 
                    'path' => $path, 
                    'paths_array' => $paths_array, 
                    'res_data' => $res_data,
                    'success' => $success,
                    'failure' => $failure
                ]);
            }
        }
        return back();
    }
    
    public function display($path) {
        return view('display', [
            'image' => $image, 
            'images' => $images, 
            'image_array' => $image_array, 
            'images_array' => $images_array, 
            'path' => $path, 
            'paths_array' => $paths_array, 
            'res_data' => $res_data,
        ] );
    }
}