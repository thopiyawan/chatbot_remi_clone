<?php

namespace App\Http\Controllers;

use App\Models\pregnants as pregnants;
use App\Models\RecordOfPregnancy as RecordOfPregnancy;
use App\Models\sequents as sequents;
use App\Models\sequentsteps as sequentsteps;
use App\Models\users_register as users_register;
use App\Models\tracker as tracker;
use App\Models\question as question;
use App\Models\quizstep as quizstep;
use App\Models\reward as reward;
use App\Models\doctor as doctor;
use App\Models\personal_doctor_mom as personal_doctor_mom;
use App\Models\logmessage as logmessage;

use App\Http\Controllers\checkmessageController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SqlController;
use Auth;
use Hash;
use Session;
use Illuminate\Support\Facades\Redirect;

use Image; 
use Carbon\Carbon;
use DateTime;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
//use LINE\LINEBot\Event;
//use LINE\LINEBot\Event\BaseEvent;
//use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
class ApiController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


  public function addChild_api($token,$user) {
                      
    $users_register = (new SqlController)->users_register_select($user);
    $weight = $users_register->user_Pre_weight;
    $height = $users_register->user_height;
    $men = $users_register->date_preg;
    $addChild_api = array( 'access_token'=> $token,
                           'last_menstruation'=>  $men,
                           'time'=> '1',
                           'weight'=> $weight,
                           'height'=> $height
                          );
                             
    $addChild_json = json_encode($addChild_api);  
    $url ='http://128.199.147.57/api/v1/peat/addChild';
    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $addChild_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch1,CURLOPT_URL, $url2);
    // curl_setopt($ch1, CURLOPT_POST, 1);
    // curl_setopt($ch1,CURLOPT_POSTFIELDS, $graph_json);
    // curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
  }

  public function tracker_api($key,$user) {
    $tracker = tracker::where('user_id',$user)
                      ->whereNull('deleted_at')
                      ->where('data_to_ulife','0')
                      ->count();
    if($tracker>=1) {
      $tracker = tracker::where('user_id',$user)
                        ->whereNull('deleted_at')
                        ->where('data_to_ulife','0')
                        ->get();
                      
        foreach ( $tracker as $track) {
          $cre= $track->created_at;
          $up= $track->updated_at;
          $created_at = $cre->format('Y-m-d H:m:s');
          $updated_at =  $up->format('Y-m-d H:m:s');
                                               
            $tracker_api[] = array( 'id'=>$track->id,
                                    'user_key'=> $key,
                                    'breakfast'=>$track->breakfast,
                                    'lunch'=>$track->lunch,
                                    'dinner'=>$track->dinner,
                                    'dessert_lu'=>$track->dessert_lu,
                                    'dessert_din'=>$track->dessert_din,
                                    'exercise'=>$track->exercise,
                                    'vitamin'=>$track->vitamin,
                                    'created_at'=>$created_at,
                                    'updated_at'=>$updated_at,
                                    'deleted_at'=>$track->deleted_at
                                  );                                              
        }
                             
        $tracker_json = json_encode($tracker_api);  
        $url3 ='http://128.199.147.57/api/v1/peat/setTrackers';
        $ch3 = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch3,CURLOPT_URL, $url3);
                               
        curl_setopt($ch3, CURLOPT_POST, 1);
        curl_setopt($ch3,CURLOPT_POSTFIELDS, $tracker_json);
        curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch1,CURLOPT_URL, $url2);
        // curl_setopt($ch1, CURLOPT_POST, 1);
        // curl_setopt($ch1,CURLOPT_POSTFIELDS, $graph_json);
        // curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch3);
        //close connection
        curl_close($ch3);

        $tracker = NOW();
        $tracker_update = tracker::where('user_id', $user)
                                 ->whereNull('deleted_at')
                                 ->update([ 'data_to_ulife' =>$tracker]);
        return $result;
    }
           
  }
  public function setgraph_api($key,$user) {
                  
      $RecordOfPregnancy = RecordOfPregnancy::where('user_id',$user)
                                            ->whereNull('deleted_at')
                                            ->where('data_to_ulife','0')
                                            ->count();
                           
        if($RecordOfPregnancy>=1) {                  
          $RecordOfPregnancy = RecordOfPregnancy::where('user_id',$user)
                                                ->whereNull('deleted_at')
                                                ->where('data_to_ulife','0')
                                                ->get();
          $weight = [];
          $time = [];
            foreach ($RecordOfPregnancy as $object) {
              array_push($weight, $object->preg_weight);
              //$weight[] = $object->preg_weight;   
              array_push($time, $object->preg_week);    
              //$time []= $object->preg_week;     
              $data_graph = array( 'user_key'=> $key,
                                   'OFFSPRING'=>1,
                                   'GRAPH_WEIGHT'=>$weight,
                                   'GRAPH_TIME'=> $time,
                                   'deleted_at'=>NULL
                                 );                                 
            }
                        
            $graph_json = json_encode($data_graph);  
                                       
            $url2 ='http://128.199.147.57/api/v1/peat/setGraphWeight';
            $ch2 = curl_init();
            //set the url, number of POST vars, POST data
            curl_setopt($ch2,CURLOPT_URL, $url2);
            curl_setopt( $ch2, CURLOPT_POST, true );
            curl_setopt($ch2,CURLOPT_POSTFIELDS,  $graph_json);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            //execute post
            $result = curl_exec($ch2);
            //close connection
            curl_close($ch2);
            $tracker = NOW();
            $tracker_update = RecordOfPregnancy::where('user_id', $user)
                                               ->whereNull('deleted_at')
                                               ->update([ 'data_to_ulife' =>$tracker]);
            return $result;
        }       
  }
  public function check_ulife_weight_edit($user,$date) {
    $users_register =   (new SqlController)->users_register_select($user);
    $key = $users_register->ulife_connect;
      if($key!== 0) {
        $RecordOfPregnancy = RecordOfPregnancy::where('user_id',$user)
                                              ->whereNull('deleted_at')
                                              ->where('preg_week', $date)
                                              ->get();
        $weight = [];
        $time = [];
          foreach ($RecordOfPregnancy as $object) {
            array_push($weight, $object->preg_weight);
            //$weight[] = $object->preg_weight;   
            array_push($time, $object->preg_week);    
            //$time []= $object->preg_week;     
            $data_graph = array( 'user_key'=> $key,
                                 'OFFSPRING'=>1,
                                 'GRAPH_WEIGHT'=>$weight,
                                 'GRAPH_TIME'=> $time
                               );                                 
          }
                        
        $graph_json = json_encode($data_graph);  
        $url2 ='http://128.199.147.57/api/v1/peat/setGraphWeight';
        $ch2 = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch2,CURLOPT_URL, $url2);
        curl_setopt( $ch2, CURLOPT_POST, true );
        curl_setopt($ch2,CURLOPT_POSTFIELDS,  $graph_json);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        //execute post
        $result = curl_exec($ch2);
        //close connection
        curl_close($ch2);
        $tracker = NOW();
        $tracker_update = RecordOfPregnancy::where('user_id', $user)
                                           ->whereNull('deleted_at')
                                           ->update([ 'data_to_ulife' =>$tracker]);
        return $result;
                                   
      }
            
  }
  public function check_ulife_tracker_edit($user,$dt) {
              
    $users_register =   (new SqlController)->users_register_select($user);
    $key = $users_register->ulife_connect;
      if($key!== '0') {
        $tracker = tracker::where('user_id',$user)
                          ->whereNull('deleted_at')
                          ->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), $dt)
                          ->get();

        $tracker_api = [];
          foreach ( $tracker as $track) {
            $cre= $track->created_at;
            $up= $track->updated_at;
            $created_at = $cre->format('Y-m-d H:m:s');
            $updated_at =  $up->format('Y-m-d H:m:s');                           
            $tracker_api[] = array( 'id'=>$track->id,
                                    'user_key'=> $key,
                                    'breakfast'=>$track->breakfast,
                                    'lunch'=>$track->lunch,
                                    'dinner'=>$track->dinner,
                                    'dessert_lu'=>$track->dessert_lu,
                                    'dessert_din'=>$track->dessert_din,
                                    'exercise'=>$track->exercise,
                                    'vitamin'=>$track->vitamin,
                                    'created_at'=>$created_at,
                                    'updated_at'=>$updated_at,
                                    'deleted_at'=>$track->deleted_at
                                  );         
                                                          
          }
                             
        $tracker_json = json_encode($tracker_api);  
        $url3 ='http://128.199.147.57/api/v1/peat/setTrackers';
        $ch3 = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch3,CURLOPT_URL, $url3);
                                 
        curl_setopt($ch3, CURLOPT_POST, 1);
        curl_setopt($ch3,CURLOPT_POSTFIELDS, $tracker_json);
        curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch1,CURLOPT_URL, $url2);
        // curl_setopt($ch1, CURLOPT_POST, 1);
        // curl_setopt($ch1,CURLOPT_POSTFIELDS, $graph_json);
        // curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        //execute post
        $result = curl_exec($ch3);
        //close connection
        curl_close($ch3);
        $tracker = NOW();
        $tracker_update = tracker::where('user_id', $user)
                                 ->whereNull('deleted_at')
                                 ->update([ 'data_to_ulife' =>$tracker]);
        return $result;                            
      }
  }
  public function api_delete($user) {

    $date   = NOW();
    $deleted_at =  $date->format('Y-m-d H:m:s');
    $users_register =   (new SqlController)->users_register_select($user);
    $key = $users_register->ulife_connect;
      if($key!== 0) {
        $RecordOfPregnancy = RecordOfPregnancy::where('user_id',$user)
                                              ->whereNull('deleted_at')
                                              ->get();
        $weight = [];
        $time = [];
          foreach ($RecordOfPregnancy as $object) {
            array_push($weight, $object->preg_weight);
            //$weight[] = $object->preg_weight;   
            array_push($time, $object->preg_week);    
            //$time []= $object->preg_week;     
            $data_graph = array( 'user_key'=> $key,
                                 'OFFSPRING'=>1,
                                 'GRAPH_WEIGHT'=>$weight,
                                 'GRAPH_TIME'=> $time,
                                 'deleted_at'=>$deleted_at
                               );         
          }
        $graph_json = json_encode($data_graph);  
        $url2 ='http://128.199.147.57/api/v1/peat/setGraphWeight';
        $ch2 = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch2,CURLOPT_URL, $url2);
        curl_setopt( $ch2, CURLOPT_POST, true );
        curl_setopt($ch2,CURLOPT_POSTFIELDS,  $graph_json);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        //execute post
        $result = curl_exec($ch2);
        //close connection
        curl_close($ch2);

        $tracker_count = tracker::where('user_id',$user)
                                ->whereNull('deleted_at')
                                ->count();
                                  
        if( $tracker_count >= 1 ) {
                               
          $tracker = tracker::where('user_id',$user)
                            ->whereNull('deleted_at')
                            ->get();
                      
            foreach ( $tracker as $track) {
              $cre= $track->created_at;
              $up= $track->updated_at;
              $created_at = $cre->format('Y-m-d H:m:s');
              $updated_at =  $up->format('Y-m-d H:m:s');
                                               
              $tracker_api[] = array( 'id'=>$track->id,
                                      'user_key'=> $key,
                                      'breakfast'=>$track->breakfast,
                                      'lunch'=>$track->lunch,
                                      'dinner'=>$track->dinner,
                                      'dessert_lu'=>$track->dessert_lu,
                                      'dessert_din'=>$track->dessert_din,
                                      'exercise'=>$track->exercise,
                                      'vitamin'=>$track->vitamin,
                                      'created_at'=>$created_at,
                                      'updated_at'=>$updated_at,
                                      'deleted_at'=> $deleted_at,
                                    );                                          
            }
                             
          $tracker_json = json_encode($tracker_api);  
          $url3 ='http://128.199.147.57/api/v1/peat/setTrackers';
          $ch3 = curl_init();
          //set the url, number of POST vars, POST data
          curl_setopt($ch3,CURLOPT_URL, $url3);
          curl_setopt($ch3, CURLOPT_POST, 1);
          curl_setopt($ch3,CURLOPT_POSTFIELDS, $tracker_json);
          curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
          // curl_setopt($ch1,CURLOPT_URL, $url2);
          // curl_setopt($ch1, CURLOPT_POST, 1);
          // curl_setopt($ch1,CURLOPT_POSTFIELDS, $graph_json);
          // curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
          //execute post
          $result2 = curl_exec($ch3);
          //close connection
          curl_close($ch3);
          // print($result2);

        }
      }          
  }
  public function create() {
    return view('registration_doctor');
  }
  public function doctor_register(Request $request) {

    $doctor_id = $this->validate(request(), ['doctor_id' => 'required',]);
    $doctor = (new SqlController)->personal_doctor_select($doctor_id);
      if($doctor == NULL){
        $doctor_id = $request->input('doctor_id'); 
        $name = $request->input('name'); 
        $lastname = $request->input('lastname');
        $hospital = $request->input('hospital'); 
        $password = $request->input('password'); 
        $type_user = '1'; 
        $url ="https://remi.softbot.ai/personal_doctor/".$doctor_id;
        $url = $this->api_gen_qrcode($url);
        $qrcode ='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=line://app/'.$url.'&choe=UTF-8';
        $doctor = doctor::create(request(['doctor_id','name', 'lastname','hospital','type_user' ,'password']));
        $qrcode_update = doctor::where('doctor_id', $doctor_id)
                               ->update(['qr_code' => $qrcode ]);
        $message = 'ลงทะเบียนแล้วค่ะ';   
         return Redirect::to('/login')->with('success', true)->with('message','ลงทะเบียนแล้วค่ะ');  

      }else{
        $message = 'มีรหัสคุณหมอท่านนี้แล้วค่ะ';
         return Redirect::to('/doctor_register') ->with('message','มีรหัสคุณหมอท่านนี้แล้วค่ะ');
      }

         // return Redirect::to('layouts.home',compact('message'));
    return $message;  

  }
  
  public function api_gen_qrcode($url) {  
    $post_view = array (
                  'view' => 
                  array (
                    'type' => 'compact',
                    'url' => $url,
                  ),
                );
      $post = json_encode($post_view);   
      $authorization = "Authorization: Bearer qFLN6cTuyvSWdbB1FHgUBEsD9hM66QaW3+cKz/LsNkwzMrBNZrBkH9b1zuCGp9ks0IpGRLuT6W1wLOJSWQFAlnHT/KbDBpdpyDU4VTUdY6qs5o1RTuCDsL3jTxLZnW1qbgmLytIpgi1X1vqKKsYywAdB04t89/1O/w1cDnyilFU=";
      $url ='https://api.line.me/liff/v1/apps';    
      $ch = curl_init();
      curl_setopt($ch,CURLOPT_URL,$url);                               
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      $result = curl_exec($ch);
      curl_close($ch);
      $result = json_decode($result);   
      return $result->liffId; 
            
  }
  public function doctor_get_userdata(Request $request) {  
       $doctor_id = $request->input('doctor_id');
       $get_data = (new SqlController)->doctor_select_mom($doctor_id);
       return $get_data;       
  }
  public function get_log_message_mom(Request $request) {  
       $user = $request->input('user_id_line');
       $message_type = $request->input('message_type');
    
       $get_data = (new SqlController)->get_log_message_mom($user,$message_type);
       return $get_data;      
  }
  public function get_tracker_mom(Request $request) {  
       $user = $request->input('user_id_line');
       $get_data = (new SqlController)->get_tracker_mom($user);
       return $get_data;      
  }
  public function get_weight_mom(Request $request) {  
         $user = $request->input('user_id_line');
         $get_data = (new SqlController)->get_weight_mom($user);
         return $get_data;      
  }
  public function get_profile_doctor(Request $request) {  
         $doctor_id = $request->input('doctor_id');
         $get_data = (new SqlController)->personal_doctor_select($doctor_id);
         return $get_data;      
  }
  public function get_profile_mom(Request $request) {  
         $user = $request->input('user_id_line');
         $get_data = (new SqlController)->users_register_select($user);
         return $get_data;      
  }


// Update
	public function doctor_login(Request $request) {
	
		if (Session::get('doctor_id') == NULL){
		    $doctor_id = $request->input('doctor_id');
		    $password = $request->input('password');
		   
		    $doctor = (new SqlController)->personal_doctor_select($doctor_id);
  
     


		      if ($doctor == NULL ) {
		        $message = 'รหัสประจำตัวหรือรหัสผ่าน ไม่ถูกต้อง';
		        return view('management.login')->with('message', 'Login Failed');        
		      } else {
              
              $doctor_qr =$doctor->qr_code;
		        if (Hash::check($password, $doctor->password)){
    				    	Session::put('doctor_id',$doctor_id);
    		        	Session::put('doctor_name',$doctor->name." ".$doctor->lastname);
                  Session::put('qr_code',$doctor_qr);     
		          	  $message = 'เข้าสู่ระบบเรียบร้อย';
                	$type_user = (new SqlController)->doctor_sel_typuser($doctor_id);
                	//$get_data = (new SqlController)->doctor_select_mom($doctor_id);
                	$user = $this->get_dashboard($doctor_id);  
                  $weight_status = (new SqlController)->weight_status($doctor_id);
                         
                	return view('management.doctor', ["datas" => $user ,"weight_status"=>$weight_status]); 
		        } else {
		            	$message = 'รหัสประจำตัวหรือรหัสผ่าน ไม่ถูกต้อง';
		          	  return view('management.login')->with('message', 'Login Failed');
		        }
		      }  
				return \Redirect::to('layouts.home',compact('message'));   
		} else {
    
		    $user = $this->get_dashboard(Session::get('doctor_id'));
        $weight_status = (new SqlController)->weight_status(Session::get('doctor_id'));
			  return view('management.doctor', ["datas" => $user, "weight_status"=>$weight_status]);	
		}
	
    }
    public function doctor_logout() {
    	Session::flush();
    	return redirect('/');
    
    }

	public function viewInfo($user_id) {
	
		$doctor_id = Session::get('doctor_id');
    	$message_type = '03';
		$chat = (new SqlController)->get_log_message_mom($user_id, $message_type);
		$message = (new SqlController)->get_log($user_id, $message_type);
		$record = DB::table('RecordOfPregnancy')
		                  ->select('preg_week','preg_weight')
		                  ->where('user_id', $user_id)
		                  ->whereNull('deleted_at')
		                  ->distinct()
		                  ->orderBy('preg_week', 'asc')
		                  ->get();
		$record1 = DB::table('users_register')
		                  ->select('user_Pre_weight')
		                  ->where('user_id', $user_id)
		                  ->whereNull('deleted_at')
		                  ->get();
		$user = DB::table('users_register')
		               // ->select('user_Pre_weight')
		                  ->where('user_id', $user_id)
		                  ->whereNull('deleted_at')
		                  ->first();
		$preg_week= DB::table('RecordOfPregnancy')
		                  ->select('preg_week')
		                  ->where('user_id', $user_id)
		                  ->whereNull('deleted_at')
		                  ->orderBy('preg_week', 'asc')
		                  ->get();
		$preg_weight = DB::table('RecordOfPregnancy')
		                     ->select('preg_weight')
		                     ->where('user_id', $user_id)
		                     ->whereNull('deleted_at')
		                     ->orderBy('preg_week', 'asc')
		                     ->get();
		$preg_week = $preg_week->pluck('preg_week');
		$preg_weight = $preg_weight ->pluck('preg_weight');
		
		$user_height = $user->user_height;
		$user_weight = $user->user_Pre_weight;
		$height = $user_height*0.01;
		$bmi = $user_weight/($height*$height);
		$bmi = number_format($bmi, 2, '.', '');
		    
		$record_food = tracker::where('user_id',$user_id)
		                        ->whereNull('deleted_at')
		                        ->where('created_at', '>=',Carbon::now()->subDays(15))
		                        ->get();
			
		$record_vitamin = tracker::where('user_id',$user_id)
                               ->whereNull('deleted_at')
                               ->where('created_at', '>=',Carbon::now()->subDays(15))
                               ->get();
          
		$record_exercise = tracker::where('user_id',$user_id)
                               ->whereNull('deleted_at')
                               ->where('created_at', '>=',Carbon::now()->subDays(15))
                               ->get();		                        

		$mom_info = (new SqlController)->users_register_select($user_id);

  		return view('management.info',["doctor_id" => $doctor_id,'user_id' => $user_id,'all_message' => $message,'record' => $record, 'record1' => $record1 , 'bmi' => $bmi, 'preg_week' => $preg_week , 'preg_weight' => $preg_weight ,'record_food' => $record_food ,'record_vitamin' => $record_vitamin ,'record_exercise' => $record_exercise,'mom_info' => $mom_info , 'chats' => $chat , 'chats' => $chat]);
 	}




///admin
  public function list_user() {

     $users = (new SqlController)->doctor_sel();
      return view('admin_edit_user',['users'=>$users]);
    
  }
  public function show_edit($doctor_id) {
     $users =  (new SqlController)->personal_doctor_select($doctor_id);
     return view('user_update',['users'=>$users]);
  }
  public function edit(Request $request,$doctor_id){
        $name = $request->input('name');
        $lastname = $request->input('lastname');
        $hospital = $request->input('hospital');
        $password = $request->input('password');
        $users_register = doctor::where('doctor_id', $doctor_id)
                                ->update(['name' => $name ,'lastname' => $lastname,'hospital' => $hospital  ,'password' => $password  ]);
        echo "Record updated successfully.
        ";

  }




//last chat
  public function get_dashboard($doctor_id){
      //$doctor_id = $request->input('doctor_id');



        $users = DB::table('personal_doctor_mom')
                ->where('personal_doctor_mom.doctor_id',$doctor_id)
               
                ->join('users_register', function ($join) {
                $join->on('personal_doctor_mom.user_id', '=', 'users_register.user_id');
      
                })

                ->whereNull('personal_doctor_mom.deleted_at')
                ->whereNull('users_register.deleted_at')
                
                ->select('users_register.hospital_num','users_register.user_name','users_register.preg_week','users_register.due_date','users_register.user_weight', 'users_register.created_at', 'users_register.weight_status','users_register.user_id')
                ->orderBy('users_register.id', 'asc')
                ->distinct('users_register')
                ->get();
            return $users;
  }
  public function update_hospital_num($hospital_num,$user){
//        $hospital_num = $request->input('hospital_num');
//        $user = $request->input('user_id_line');
        $users_register = users_register::where('user_id', $user)
                                ->whereNull('deleted_at')
                                ->update(['hospital_num' => $hospital_num ]);
        return $users_register;
  }
  
  public function hnnumber_save(Request $request) {
	$hu_number = $request->input('hn_number');
	$user_id = $request->input('user_id');
	$this->update_hospital_num($hu_number,$user_id);
	return $this->viewInfo($user_id);
  }
  
  // public function update_user(Request $request){
  //       $user = $request->input('user_id_line');
  //       $name = $request->input('name');
  //       $lastname = $request->input('lastname');
  //       $hospital = $request->input('hospital');
  //       $password = $request->input('password');

  //       $doctor = doctor::where('doctor_id', $user)
  //                               ->whereNull('deleted_at')
  //                               ->update(['name' => $name ,'lastname' => $lastname ,'hospital' => $hospital,'password' => $password  ]);
  //       return $doctor;
  // }



    
    
}
