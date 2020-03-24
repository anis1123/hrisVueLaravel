<?php

namespace App\Http\Controllers;

use App\Modules\Employee\Entities\Employee;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Attendance;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\Session;
use Carbon;
class AttendanceController extends Controller
{

    public function attendance_employee($id){
       $check_in_date = date('Y:m:d');
       $check_in_time = date('h:i:s');



        // $ssid= shell_exec('Netsh WLAN show interfaces');
        // if (strpos($ssid, 'navinb_Mama_wlink') !== false) {
        //     echo 'true';
        // }


    }

    public function check($id, $date)
    {

        $data = DB::table('attendances')->join('employees', 'attendances.emp_id', '=', 'employees.emp_id')
            ->where(['attendances.date' => $date, 'employees.department_id' => $id])
            ->select('attendances.date', 'attendances.present_status', 'attendances.id', 'employees.first_name', 'employees.last_name')
            ->get();
        return response()->json($data);
    }

    public function empget($date=null)
    {
        $post= Employee::with('attendance2')->get();
        return response()->json($post);
    }

    public function get()
    {

        $get = DB::table('employees')->join('attendances', 'employees.emp_id', '=', 'attendances.emp_id')
            ->select('employees.*', 'attendances.present_status', 'attendances.date')->get();

        // $atte = DB::table('attendances')->get();

        return response()->json($get);

    }
    public function browser_attendance(Request $req){



        if(Attendance::where('emp_id',$req->emp_id)->where('date',date('Y-m-d'))->exists()){
            $response['msg'] = 'Attendance already done';
            $response['status'] = '0';
            return response()->json($response);
        }else{
            $post = new Attendance;
            $post->date = date('Y-m');
            $post->day = date('d');
            $post->emp_id = $req->emp_id;
            $post->latitude = $req->latitude;
            $post->longitude = $req->longitude;
            $post->time = date('h:i:s');
            $post->save();
            $response['msg'] = 'Attendance Done';
            $response['status'] = '1';
            return response()->json($response);
        }

    }

    public function checkOut(Request $req){

        if(Attendance::where('emp_id',$req->emp_id)->where('date',date('Y-m-d'))->where('clockout','!=',null)->exists()){
            $response['msg'] = 'Checkout Already Done';
            $response['status'] ='0';
            return response()->json($response);
        }else{

            DB::table('attendances')
            ->where('emp_id',$req->emp_id)
            ->where('date',date('Y-m'))
            ->where('day',date('d'))
            ->update([
                'checkout_latitude'=>$req->latitude,
                'checkout_longitude'=>$req->longitude,
                'clockout'=>date('h:i:s')
       ]);
            $response['msg'] = 'Checkout Done';
            $response['status'] ='1';
            return response()->json($response);
        }
    }

    public function mobile_attendace(Request $req,$emp_id){


        if(Attendance::where([['emp_id','=',$emp_id],['date','=',$req->date]])->exists()){
            $response['msg'] = 'Attendance already done';
            $response['status'] = '0';
            return response()->json($response);
        }else{
            $post = new Attendance;
            $post->date = date('Y-m');
            $post->day = date('d');
            $post->emp_id = strtoupper($emp_id);
            $post->latitude = $req->latitude;
            $post->longitude = $req->longitude;
            $post->time = $req->time;
            $post->wifi_ssid = $req->wifi_ssid;
            $post->mobile_data_inf = $req->mobile_data_inf;
            $post->save();
            $response['msg'] = 'Attendance Done';
            $response['status'] = '1';
            return response()->json($response);

        }

    }
    public function check_att($id){

        if(Attendance::where('date',date('Y-m'))->where('day',date('d'))->where('emp_id',$id)->exists()){
            return 1;
        }else{
            return 0;
        }


    }

    public function attendance(Request $req,$id,$date)
    {
        $data= Employee::where('department_id',$id)->distinct('emp_id')->get();

        if (Attendance::where([['date','=', $date],['department_id','=',$id]])->exists()) {
            $get = Attendance::where('date',$date)->get();
            return response()->json($get);

        } else {

            foreach($data as $key => $datas){
                $post[$key]['date'] = $date;
                $post[$key]['emp_id'] = $datas->employee_id;
                $post[$key]['department_id'] = $datas->department_id;
            }

             DB::table('attendances')->insert($post);
            // return response()->json($post);
        }

    }


    public function store(Request $req, $id)
    {


        $reason = $req->get('reason');
        $emp_id = $req->get('emp_id');

        $status = $req->get('present_status');


        $data = DB::table('attendances')->where('id', $id)->update(['reason' => $reason, 'present_status' => $status]);

        return response()->json($data);


    }

    public function update(Request $req, $date)
    {


    }





    function getYearList($ytype, $yearname, $sel = '')
    {
        $start = ($ytype == 'NP') ? 2000 : 1944;
        $end = ($ytype == 'NP') ? 2089 : 2033;
        echo '<select class="form-control"  name="' . $yearname . '" id="' . $yearname . '">';
        for ($year = $start; $year <= $end; $year++)
        {
            echo '<option';
            if ($sel != '' and $year == $sel)
            {
                echo ' selected="selected" ';
            }
            echo '>';
            echo $year;
            echo '</option>';
        }
        echo '</select>';
    }

    function getMonthName($mon)
    {
        $arr_np = array('Baishakh', 'Jeth', 'Ashar', 'Shrawan', 'Bhadra', 'Ashoj', 'Kartik', 'Mangshir', 'Poush', 'Magh', 'Falgun', 'Chaitra');
        return $arr_np[$mon-1];
    }

    function getMonthList($monthname, $cur = '', $lng = 'NP')
    {
        $arr_np = array('Baishakh', 'Jeth', 'Ashar', 'Shrawan', 'Bhadra', 'Ashoj', 'Kartik', 'Mangshir', 'Poush', 'Magh', 'Falgun', 'Chaitra');
        $arr_en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        echo '<select class="form-control" name="' . $monthname . '" id="' . $monthname . '">';
        for ($i = 1; $i <= 12; $i++)
        {
            echo '<option';
            if ($cur != '' and $i == $cur)
            {
                echo ' selected="selected" ';
            }
            echo ' value="' . $i . '"';
            echo '>';
            if ($lng == 'EN')
                echo $arr_en[$i - 1];
            else
                echo $arr_np[$i - 1];
            echo '</option>';
        }
        echo '</select>';
    }

    function getDayList($max, $monthname, $cur = '')
    {
        echo '<select  class="form-control" name="' . $monthname . '" id="' . $monthname . '">';
        for ($i = 1; $i <= $max; $i++)
        {
            echo '<option';
            if ($cur != '' and $i == $cur)
            {
                echo ' selected="selected" ';
            }
            echo '>';
            echo $i;
            echo '</option>';
        }
        echo '</select>';
    }

    function crossCheck($y, $m, $d)
    {
        //takes nepali date
        $objC = new Nepali_Calendar();
        $engdate = $objC->nep_to_eng($y, $m, $d);
        $eyear = $engdate['year'];
        $emonth = $engdate['month'];
        $eday = $engdate['date'];
        //
        $nepdate = $objC->eng_to_nep($eyear, $emonth, $eday);
        $new_year = $nepdate['year'];
        $new_month = $nepdate['month'];
        $new_day = $nepdate['date'];
        if ($y == $new_year && $m == $new_month && $d == $new_day)
            return true;
        return false;
    }

    /**
     * showpre
     *
     * Displays formatted output
     *
     * @author Nilambar Sharma <nilambar@outlook.com>
     * @copyright Copyright (c) 2013, Nilambar Sharma
     * @version 1.0
     *
     * @param mixed $str What do you want to display
     * @param string $title Title
     * @param bool $die Enable/disable die
     * @param bool $style   Enable/disable styling
     * @param bool $html Encoded html content
     * @return null
     *
     * @todo Make more advanced
     */
    function showpre($str, $title = '', $die = false, $style = true, $html = false)
    {
        $o = '<pre';
        if ($style)
            $o.=' style="
            border:1px solid red; background-color:#eee;margin:3px;height:auto; margin-left:3%;
            overflow:hidden; width:94%;padding:5px; color:#000; text-align:left;
            white-space: pre-wrap;
            white-space: -moz-pre-wrap !important;
            word-wrap: break-word;
            white-space: -o-pre-wrap;
            white-space: -pre-wrap;"';
        $o.='>';
        if ($title != '')
        {
            $o.= '<p';
            if ($style)
                $o.= '  style="border-bottom:1px solid red; color:#f00;font-weight:bold;padding:2px; margin:0px; text-align:left;"';
            $o.= '>' . $title . '</p>';
        }
        if (!$html)
        {
            $o.= print_r($str, true);
        }
        else
        {
            $o.= print_r(htmlentities($str), true);
        }

        $o.='</pre>';
        echo $o;
        if ($die)
            die;
        return;
    }

		private $bs = array(
			0=>array(2000,30,32,31,32,31,30,30,30,29,30,29,31),
			1=>array(2001,31,31,32,31,31,31,30,29,30,29,30,30),
			2=>array(2002,31,31,32,32,31,30,30,29,30,29,30,30),
			3=>array(2003,31,32,31,32,31,30,30,30,29,29,30,31),
			4=>array(2004,30,32,31,32,31,30,30,30,29,30,29,31),
			5=>array(2005,31,31,32,31,31,31,30,29,30,29,30,30),
			6=>array(2006,31,31,32,32,31,30,30,29,30,29,30,30),
			7=>array(2007,31,32,31,32,31,30,30,30,29,29,30,31),
			8=>array(2008,31,31,31,32,31,31,29,30,30,29,29,31),
			9=>array(2009,31,31,32,31,31,31,30,29,30,29,30,30),
			10=>array(2010,31,31,32,32,31,30,30,29,30,29,30,30),
			11=>array(2011,31,32,31,32,31,30,30,30,29,29,30,31),
			12=>array(2012,31,31,31,32,31,31,29,30,30,29,30,30),
			13=>array(2013,31,31,32,31,31,31,30,29,30,29,30,30),
			14=>array(2014,31,31,32,32,31,30,30,29,30,29,30,30),
			15=>array(2015,31,32,31,32,31,30,30,30,29,29,30,31),
			16=>array(2016,31,31,31,32,31,31,29,30,30,29,30,30),
			17=>array(2017,31,31,32,31,31,31,30,29,30,29,30,30),
			18=>array(2018,31,32,31,32,31,30,30,29,30,29,30,30),
			19=>array(2019,31,32,31,32,31,30,30,30,29,30,29,31),
			20=>array(2020,31,31,31,32,31,31,30,29,30,29,30,30),
			21=>array(2021,31,31,32,31,31,31,30,29,30,29,30,30),
			22=>array(2022,31,32,31,32,31,30,30,30,29,29,30,30),
			23=>array(2023,31,32,31,32,31,30,30,30,29,30,29,31),
			24=>array(2024,31,31,31,32,31,31,30,29,30,29,30,30),
			25=>array(2025,31,31,32,31,31,31,30,29,30,29,30,30),
			26=>array(2026,31,32,31,32,31,30,30,30,29,29,30,31),
			27=>array(2027,30,32,31,32,31,30,30,30,29,30,29,31),
			28=>array(2028,31,31,32,31,31,31,30,29,30,29,30,30),
			29=>array(2029,31,31,32,31,32,30,30,29,30,29,30,30),
			30=>array(2030,31,32,31,32,31,30,30,30,29,29,30,31),
			31=>array(2031,30,32,31,32,31,30,30,30,29,30,29,31),
			32=>array(2032,31,31,32,31,31,31,30,29,30,29,30,30),
			33=>array(2033,31,31,32,32,31,30,30,29,30,29,30,30),
			34=>array(2034,31,32,31,32,31,30,30,30,29,29,30,31),
			35=>array(2035,30,32,31,32,31,31,29,30,30,29,29,31),
			36=>array(2036,31,31,32,31,31,31,30,29,30,29,30,30),
			37=>array(2037,31,31,32,32,31,30,30,29,30,29,30,30),
			38=>array(2038,31,32,31,32,31,30,30,30,29,29,30,31),
			39=>array(2039,31,31,31,32,31,31,29,30,30,29,30,30),
			40=>array(2040,31,31,32,31,31,31,30,29,30,29,30,30),
			41=>array(2041,31,31,32,32,31,30,30,29,30,29,30,30),
			42=>array(2042,31,32,31,32,31,30,30,30,29,29,30,31),
			43=>array(2043,31,31,31,32,31,31,29,30,30,29,30,30),
			44=>array(2044,31,31,32,31,31,31,30,29,30,29,30,30),
			45=>array(2045,31,32,31,32,31,30,30,29,30,29,30,30),
			46=>array(2046,31,32,31,32,31,30,30,30,29,29,30,31),
			47=>array(2047,31,31,31,32,31,31,30,29,30,29,30,30),
			48=>array(2048,31,31,32,31,31,31,30,29,30,29,30,30),
			49=>array(2049,31,32,31,32,31,30,30,30,29,29,30,30),
			50=>array(2050,31,32,31,32,31,30,30,30,29,30,29,31),
			51=>array(2051,31,31,31,32,31,31,30,29,30,29,30,30),
			52=>array(2052,31,31,32,31,31,31,30,29,30,29,30,30),
			53=>array(2053,31,32,31,32,31,30,30,30,29,29,30,30),
			54=>array(2054,31,32,31,32,31,30,30,30,29,30,29,31),
			55=>array(2055,31,31,32,31,31,31,30,29,30,29,30,30),
			56=>array(2056,31,31,32,31,32,30,30,29,30,29,30,30),
			57=>array(2057,31,32,31,32,31,30,30,30,29,29,30,31),
			58=>array(2058,30,32,31,32,31,30,30,30,29,30,29,31),
			59=>array(2059,31,31,32,31,31,31,30,29,30,29,30,30),
			60=>array(2060,31,31,32,32,31,30,30,29,30,29,30,30),
			61=>array(2061,31,32,31,32,31,30,30,30,29,29,30,31),
		    62=>array(2062,30,32,31,32,31,31,29,30,29,30,29,31),
			63=>array(2063,31,31,32,31,31,31,30,29,30,29,30,30),
			64=>array(2064,31,31,32,32,31,30,30,29,30,29,30,30),
			65=>array(2065,31,32,31,32,31,30,30,30,29,29,30,31),
			66=>array(2066,31,31,31,32,31,31,29,30,30,29,29,31),
			67=>array(2067,31,31,32,31,31,31,30,29,30,29,30,30),
			68=>array(2068,31,31,32,32,31,30,30,29,30,29,30,30),
			69=>array(2069,31,32,31,32,31,30,30,30,29,29,30,31),
			70=>array(2070,31,31,31,32,31,31,29,30,30,29,30,30),
			71=>array(2071,31,31,32,31,31,31,30,29,30,29,30,30),
			72=>array(2072,31,32,31,32,31,30,30,29,30,29,30,30),
			73=>array(2073,31,32,31,32,31,30,30,30,29,29,30,31),
			74=>array(2074,31,31,31,32,31,31,30,29,30,29,30,30),
			75=>array(2075,31,31,32,31,31,31,30,29,30,29,30,30),
			76=>array(2076,31,32,31,32,31,30,30,30,29,29,30,30),
			77=>array(2077,31,32,31,32,31,30,30,30,29,30,29,31),
			78=>array(2078,31,31,31,32,31,31,30,29,30,29,30,30),
			79=>array(2079,31,31,32,31,31,31,30,29,30,29,30,30),
			80=>array(2080,31,32,31,32,31,30,30,30,29,29,30,30),
			81=>array(2081, 31, 31, 32, 32, 31, 30, 30, 30, 29, 30, 30, 30),
			82=>array(2082, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
			83=>array(2083, 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30),
			84=>array(2084, 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30),
			85=>array(2085, 31, 32, 31, 32, 30, 31, 30, 30, 29, 30, 30, 30),
			86=>array(2086, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
			87=>array(2087, 31, 31, 32, 31, 31, 31, 30, 30, 29, 30, 30, 30),
			88=>array(2088, 30, 31, 32, 32, 30, 31, 30, 30, 29, 30, 30, 30),
			89=>array(2089, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30),
			90=>array(2090, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30)
			);

	 	private $nep_date = array('year'=>'', 'month'=>'', 'date'=>'', 'day'=>'','nmonth'=>'','num_day'=>'');
	 	private $eng_date = array('year'=>'', 'month'=>'', 'date'=>'', 'day'=>'','emonth'=>'','num_day'=>'');
	 	public $debug_info = "";


		/**
		 * Calculates wheather english year is leap year or not
		 *
		 * @param integer $year
		 * @return boolean
		 */
		public function is_leap_year($year)
		{
			$a = $year;
			if ($a%100==0)
			{
			 if($a%400==0)
			 {
				return true;
			 } else {
			 	return false;
			 }

			} else {
				if ($a%4==0)
				{
					return true;
				} else {
					return false;
				}
			}
		}

		private function get_nepali_month($m){
			$n_month = false;

			switch($m){
				case 1:
					$n_month = "Baishak";
					break;

				case 2:
					$n_month = "Jestha";
					break;

				case 3:
					$n_month = "Ashad";
					break;

				case 4:
					$n_month = "Shrawn";
					break;

				case 5:
					$n_month = "Bhadra";
					break;

				case 6:
					$n_month = "Ashwin";
					break;

				case 7:
					$n_month = "kartik";
					break;

				case 8:
					$n_month = "Mangshir";
					break;

				case 9:
					$n_month = "Poush";
					break;

				case 10:
					$n_month = "Magh";
					break;

				case 11:
					$n_month = "Falgun";
					break;

				case 12:
					$n_month = "Chaitra";
					break;
			}
			return  $n_month;
		}

		private function get_english_month($m){
			$eMonth = false;
			switch($m){
				case 1:
					$eMonth = "January";
					break;
				case 2:
					$eMonth = "February";
					break;
				case 3:
					$eMonth = "March";
					break;
				case 4:
					$eMonth = "April";
					break;
				case 5:
					$eMonth = "May";
					break;
				case 6:
					$eMonth = "June";
					break;
				case 7:
					$eMonth = "July";
					break;
				case 8:
					$eMonth = "August";
					break;
				case 9:
					$eMonth = "September";
					break;
				case 10:
					$eMonth = "October";
					break;
				case 11:
					$eMonth = "November";
					break;
				case 12:
					$eMonth = "December";
			}
			return $eMonth;
		}

		private function get_day_of_week($day){
			switch($day){
				case 1:
					$day = "Sunday";
					break;

				case 2:
					$day = "Monday";
					break;

				case 3:
					$day = "Tuesday";
					break;

				case 4:
					$day = "Wednesday";
					break;

				case 5:
					$day = "Thursday";
					break;

				case 6:
					$day = "Friday";
					break;

				case 7:
					$day = "Saturday";
					break;
			}
			return $day;
		}


		private function is_range_eng($yy, $mm, $dd){
			if($yy<1944 || $yy>2033){
				$this->debug_info = "Supported only between 1944-2022";
				return false;
			}

			if($mm<1 || $mm >12){
				$this->debug_info = "Error! value 1-12 only";
				return false;
			}

			if($dd<1 || $dd >31){
				$this->debug_info = "Error! value 1-31 only";
				return false;
			}

			return true;
		}

		private function is_range_nep($yy, $mm, $dd){
			if($yy<2000 || $yy>2089){
				$this->debug_info="Supported only between 2000-2089";
				return false;
			}

			if($mm<1 || $mm >12) {
				$this->debug_info="Error! value 1-12 only";
				return false;
			}

			if($dd<1 || $dd >32){
				$this->debug_info="Error! value 1-31 only";
				return false;
			}

			return true;
		}


		/**
		 * currently can only calculate the date between AD 1944-2033...
		 *
		 * @param unknown_type $yy
		 * @param unknown_type $mm
		 * @param unknown_type $dd
		 * @return unknown
		 */

		public function eng_to_nep($yy,$mm,$dd){
			//echo '--eng bhitra'.$yy.' '.$mm.'  '.$dd;
			if ($this->is_range_eng($yy, $mm, $dd) == false){
				return false;
			} else {

				// english month data.
			 	$month = array(31,28,31,30,31,30,31,31,30,31,30,31);
			 	$lmonth = array(31,29,31,30,31,30,31,31,30,31,30,31);

				$def_eyy = 1944;									//spear head english date...
				$def_nyy = 2000; $def_nmm = 9; $def_ndd = 17-1;		//spear head nepali date...
				$total_eDays=0; $total_nDays=0; $a=0; $day=7-1;		//all the initializations...
				$m = 0; $y = 0; $i =0; $j = 0;
				$numDay=0;

				// count total no. of days in-terms of year
				for($i=0; $i<($yy-$def_eyy); $i++){	//total days for month calculation...(english)
					if($this->is_leap_year($def_eyy+$i)==1)
						for($j=0; $j<12; $j++)
							$total_eDays += $lmonth[$j];
					else
						for($j=0; $j<12; $j++)
							$total_eDays += $month[$j];
				}

				// count total no. of days in-terms of month
				for($i=0; $i<($mm-1); $i++){
					if($this->is_leap_year($yy)==1)
						$total_eDays += $lmonth[$i];
					else
						$total_eDays += $month[$i];
				}

				// count total no. of days in-terms of date
				$total_eDays += $dd;


				$i = 0; $j = $def_nmm;
				$total_nDays = $def_ndd;
				$m = $def_nmm;
				$y = $def_nyy;

				// count nepali date from array
				while($total_eDays != 0) {
			        $a = $this->bs[$i][$j];
					$total_nDays++;						//count the days
					$day++;								//count the days interms of 7 days
					if($total_nDays > $a){
						$m++;
						$total_nDays=1;
						$j++;
					}
					if($day > 7)
						$day = 1;
					if($m > 12){
						$y++;
						$m = 1;
					}
				    if($j > 12){
						$j = 1; $i++;
					}
					$total_eDays--;
				}

				$numDay=$day;

				$this->nep_date["year"] = $y;
				$this->nep_date["month"] = $m;
				$this->nep_date["date"] = $total_nDays;
				$this->nep_date["day"] = $this->get_day_of_week($day);
				$this->nep_date["nmonth"] = $this->get_nepali_month($m);
				$this->nep_date["num_day"] = $numDay;

				return $this->nep_date;
			}
		}


		/**
		 * currently can only calculate the date between BS 2000-2089
		 *
		 * @param unknown_type $yy
		 * @param unknown_type $mm
		 * @param unknown_type $dd
		 * @return unknown
		 */
		public function nep_to_eng($yy,$mm,$dd){


			$def_eyy = 1943	; $def_emm=4 ; $def_edd=14-1;		// init english date.
			$def_nyy = 2000; $def_nmm = 1; $def_ndd = 1;		// equivalent nepali date.
			$total_eDays=0; $total_nDays=0; $a=0; $day=4-1;		// initializations...
			$m = 0; $y = 0; $i=0;
			$k = 0;	$numDay = 0;

			$month = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
 			$lmonth = array(0,31,29,31,30,31,30,31,31,30,31,30,31);

			if($this->is_range_nep($yy, $mm, $dd)===false){
				return false;

			} else {

				// count total days in-terms of year
				for($i=0; $i<($yy-$def_nyy); $i++){
					for($j=1; $j<=12; $j++){
						$total_nDays += $this->bs[$k][$j];
					}
					$k++;
				}

				// count total days in-terms of month
				for($j=1; $j<$mm; $j++){
					$total_nDays += $this->bs[$k][$j];
				}

				// count total days in-terms of dat
				$total_nDays += $dd;

				//calculation of equivalent english date...
				$total_eDays = $def_edd;
				$m = $def_emm;
				$y = $def_eyy;
				while($total_nDays != 0){
					if($this->is_leap_year($y))
					{
						$a = $lmonth[$m];
					}
					else
					{
						$a = $month[$m];
					}
					$total_eDays++;
					$day++;
					if($total_eDays > $a){
						$m++;
						$total_eDays = 1;
						if($m > 12){
							$y++;
							$m = 1;
						}
					}
					if($day > 7)
						$day = 1;
					$total_nDays--;
				}
				$numDay = $day;

				$this->eng_date["year"] = $y;
				$this->eng_date["month"] = $m;
				$this->eng_date["date"] = $total_eDays;
				$this->eng_date["day"] = $this->get_day_of_week($day);
				$this->eng_date["emonth"] = $this->get_english_month($m);
				$this->eng_date["num_day"] = $numDay;

				return $this->eng_date;
			}

        }
        public function getss(){

            $nepdate = $this->eng_to_nep(2019, 8, 25);

            $year_n = $nepdate['year'];
            $month_n = $nepdate['month'];
            $month_name_n = $nepdate['nmonth'];
            $day_n = $nepdate['date'];
            $day_name_n = $nepdate['day'];
            // $year = 2019;
            // $month = 8;
            // $day = 25;
            // $month_name = date('F', strtotime("$year-$month-$day"));
            // $day_name = date('l', strtotime("$year-$month-$day"));
            echo $day_n . ' ' . ucfirst($month_name_n) . ' ' . $year_n . ', ' . $day_name_n;
        }



    }

