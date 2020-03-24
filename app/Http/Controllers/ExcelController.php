<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
class ExcelController extends Controller
{
            public function export(){
                return Excel::download(new UsersExport, 'user.xlsx');
            }

            public function calender(){
                $data['calender'] = DB::table('nepali_calender')->get();
                $data['year'] = DB::table('nepali_calender')->distinct()->select('year')->get();
                $data['month'] = DB::table('nepali_calender')->distinct()->select('month','month_num')->get();


                return response()->json($data);
            }
           public function import(Request $request,$date)
           {

            $post = $request->select_file->getClientOriginalName();

            $request->select_file->storeAs('public',$post);

            Session::put('date',$date);

            $path = $request->select_file;

            Excel::import(new UsersImports,$path);



        }



        public function excel(Request $request)
        {
            $path = public_path('excel/finalvvvv.xlsx');

            $data = Excel::import(new UsersImport,$path);

            // print_r($data);
            // if($data->count()){
            //     foreach ($data as $key => $value) {
            //         $arr[] = ['title' => $value->title, 'description' => $value->description];
            //     }

            //   }
            // }
        }

        public function employee(Request $request)
        {
            $path = public_path('excel/Deposited.xlsx');

            $data = Excel::import(new EmployeeImports,$path);

            // print_r($data);
            // if($data->count()){
            //     foreach ($data as $key => $value) {
            //         $arr[] = ['title' => $value->title, 'description' => $value->description];
            //     }

            //   }
            // }
        }


        public function fetchdata(){
            $gratuity = 8.33;
            $tax =
          $data = DB::table('employees')->get();
          echo '<pre>';
          print_r($data);

        }


}
