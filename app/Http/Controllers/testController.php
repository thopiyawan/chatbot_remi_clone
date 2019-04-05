<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pregnants as pregnants;
use App\Models\RecordOfPregnancy as RecordOfPregnancy;
use App\Models\sequents as sequents;
use App\Models\sequentsteps as sequentsteps;
use App\Models\users_register as users_register;
use App\Models\tracker as tracker;
use App\Models\question as question;
use App\Models\quizstep as quizstep;
use App\Models\reward as reward;
use App\Models\personal_doctor_mom as personal_doctor_mom;

use View;
use DB;
use Carbon\Carbon;
use DateTime;

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

// define('LINE_MESSAGE_CHANNEL_SECRET','f571a88a60d19bb28d06383cdd7af631');
// define('LINE_MESSAGE_ACCESS_TOKEN','omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
define('LINE_MESSAGE_CHANNEL_SECRET','949b099c23a7c9ca8aebe11ad9b43a52');
define('LINE_MESSAGE_ACCESS_TOKEN','qFLN6cTuyvSWdbB1FHgUBEsD9hM66QaW3+cKz/LsNkwzMrBNZrBkH9b1zuCGp9ks0IpGRLuT6W1wLOJSWQFAlnHT/KbDBpdpyDU4VTUdY6qs5o1RTuCDsL3jTxLZnW1qbgmLytIpgi1X1vqKKsYywAdB04t89/1O/w1cDnyilFU=');

class testController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
     $user ='U2dc636d2cd052e82c29f5284e00f69b9';
     $user = json_encode($user);  



    $a = ' ';
    print($a);

     // $end = Carbon::parse('2018-07-14');
     // $now = Carbon::now();

     // $length = $end->diffInDays($now);
     // echo $length;
     // // $re = [];
     // $record = tracker::where('user_id',$user)
     //                           ->whereNull('deleted_at')
     //                           ->orderBy('created_at', 'DESC')
     //                           ->pluck('user_id')->all();

                  // $users = reward::select('user_id','point')
                  //    ->whereRaw('FIND_IN_SET(point,user_id)')
                  //    ->select(DB::raw('group_concat(point) as point'))
                  //    ->get();
                 // $results = DB::select( DB::raw("SELECT `id`, `user_id`, `point`, FIND_IN_SET( `point`, (SELECT GROUP_CONCAT( `point` ORDER BY `point` DESC ) FROM reward )) AS rank FROM reward where user_id = $user ORDER BY rank") );
                 //  dd($results);
    // $dayofweek = date('w', strtotime($date));

                            
///กำหนดการคลอด                      
                            // $strDate1 = "2018-10-30";
                            // $strDate2=date("Y-m-d");
                                        
                            // $date_pre =  (strtotime($strDate2) - strtotime($strDate1))/( 60 * 60 * 24 );
                            // $week = $date_pre/7;
                            // $w_preg = number_format($week);
                            // $day = $date_pre%7;
                            // $day_preg = number_format($day);

                            // $a = 40-$w_preg;

                            // $due_date = date("Y-m-d",strtotime($a." weeks"))."<br>"; 
////////////////
              // $doctor_id = '1234';
              //    $a = personal_doctor_mom::where('personal_doctor_mom.doctor_id',$doctor_id)
              //                              ->join('users_register','personal_doctor_mom.user_id','=','users_register.user_id')
              //                              ->whereNull('personal_doctor_mom.deleted_at')
              //                              ->whereNull('users_register.deleted_at')
              //                              ->where('users_register.weight_status','1')
              //                              ->count();
              //    $b = personal_doctor_mom::where('personal_doctor_mom.doctor_id',$doctor_id)
              //                              ->join('users_register','personal_doctor_mom.user_id','=','users_register.user_id')
              //                              ->whereNull('personal_doctor_mom.deleted_at')
              //                              ->whereNull('users_register.deleted_at')
              //                              ->where('users_register.weight_status','2')
              //                              ->count();
              //    $c = personal_doctor_mom::where('personal_doctor_mom.doctor_id',$doctor_id)
              //                              ->join('users_register','personal_doctor_mom.user_id','=','users_register.user_id')
              //                              ->whereNull('personal_doctor_mom.deleted_at')
              //                              ->whereNull('users_register.deleted_at')
              //                              ->where('users_register.weight_status','3')
              //                              ->count();
              //     $d = personal_doctor_mom::where('personal_doctor_mom.doctor_id',$doctor_id)
              //                              ->join('users_register','personal_doctor_mom.user_id','=','users_register.user_id')
              //                              ->whereNull('personal_doctor_mom.deleted_at')
              //                              ->whereNull('users_register.deleted_at')
              //                              ->where('users_register.weight_status','4')
              //                              ->count();
              //   $e = personal_doctor_mom::where('personal_doctor_mom.doctor_id',$doctor_id)
              //                              ->join('users_register','personal_doctor_mom.user_id','=','users_register.user_id')
              //                              ->whereNull('personal_doctor_mom.deleted_at')
              //                              ->whereNull('users_register.deleted_at')
              //                              ->whereNull('users_register.weight_status')
              //                              ->count();


              //   print('เขียว'.$a.', เหลือง'. $b.', ส้ม'. $c.',แดง'. $d.', น้ำเงิน'. $e);





          // $strDate1 = "2018-20-23";
          // $strDate2=date("Y-m-d");                 
          // $date_pre =  (strtotime($strDate2) - strtotime($strDate1))/( 60 * 60 * 24 );
          // $week = $date_pre/7;

          // echo $week;
         // echo date("Y-m-d H:i:s",strtotime($a." weeks"))."<br>"; 
//                   SELECT `id`, `name`, `point`, FIND_IN_SET( `point`, (    
// SELECT GROUP_CONCAT( `point`t
// ORDER BY `point` DESC ) 
// FROM students )
// ) AS rank
// FROM students
// ORDER BY rank
   // dd($record) ;
     //                           echo var_dump($record);
                                //   foreach( $record as $item1){
                              

                                //   $re= $item1->user_id;

                                //    echo$re ;
                             
                                                          
                                // }

      // $record->toArray
     // print($re);

     // $record1 = $record->breakfast  ;

    // $str = "ปลา";
    // // echo $str;
    // $d = explode(" ",$str);
    // $u = [];
    // $da= [];

    //   $json1 = file_get_contents('calfood.json');
    //   $json= json_decode($json1);
    //             foreach($json->data as $item)
    //               {
                    
    //                 foreach($d as $item1)
    //                   if(strpos( $item1, $item->id ) !== false )
    //                   {

    //                     $da[]= $item->content;
    //                     $u[] = $item->cal;
    //                     // $sum =  array_sum($u);
                                                
    //                   }   
    // }

    // if($u==null){
    //   echo '555';
    // }
    //   print_r($u);  
    //   // print_r($sum);   
     
    //      for ($i = 0, $c = count($da); $i < $c; $i++) {
    //                       // $da1 = $da[$i];
    //                        echo $da[$i],",";
                        // }
    //               // }
       //  $data = presenting_gift::where('presenting_gift.presenting_status',1)
       //           ->where('presenting_gift.user_id',$user)
       //           ->join('reward_gift', 'reward_gift.code_gift', '=', 'presenting_gift.code_gift')
       //           ->select('reward_gift.name_gift','presenting_gift.code_gift', DB::raw('count(*) as total'))
       //           ->groupBy('presenting_gift.code_gift')
       //           // ->orderBy('presenting_gift.id','asc')
       //           ->get();
       // print_r($data);

///////////////////////////////////////////////////////////////////////////

 // $id ='U2dc636d2cd052e82c29f5284e00f69b9';
//      $record = reward_gift::get();
//      //print $record;






// $user_update = (new SqlController)->reward_gift(); 
// print $user_update;
          //  $actionBuilder=[];
          // $user_update = (new SqlController)->reward_gift();  
          // print($user_update);
          // foreach($user_update as $value){
          //       // echo($value->name_gift);
             

          //   $actionBuilder[] = array(
          //                           new CarouselColumnTemplateBuilder(
          //                               $value->name_gift,
          //                               $value->point,
          //                               'https://peat.none.codes/image/diary4.jpg',
          //                               array(
          //                                   new MessageTemplateActionBuilder(
          //                                       'แลก',// ข้อความแสดงในปุ่ม
          //                                        $value->code_gift // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
          //                                   ),
          //                                  )
          //                           ),                                  
          //                       );

          //    $textMessageBuilder = new TemplateMessageBuilder('Carousel',
          //                   new CarouselTemplateBuilder(
          //                       $actionBuilder
          //                   )
          //               );

          //   }
 
        

//////////////////////////////////////////////////////////////////
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function graph($id)
    {

        $record = DB::table('RecordOfPregnancy')
                     ->select('preg_week','preg_weight')
                     ->where('user_id', $id)
                     ->where('deleted_at','NULL')
                     ->distinct()
                     ->orderBy('preg_week', 'asc')
                     ->get();
        $record1 = DB::table('users_register')
                     ->select('user_Pre_weight')
                     ->where('user_id', $id)
                     ->where('deleted_at', 'NULL')
                     ->get();
        $user = DB::table('users_register')
                     // ->select('user_Pre_weight')
                     ->where('user_id', $id)
                     ->where('deleted_at', 'NULL')
                     ->first();
        $preg_week= DB::table('RecordOfPregnancy')
                     ->select('preg_week')
                     ->where('user_id', $id)
                     ->where('deleted_at','NULL')
                     ->orderBy('preg_week', 'asc')
                     ->get();
        $preg_weight = DB::table('RecordOfPregnancy')
                     ->select('preg_weight')
                     ->where('user_id', $id)
                     ->where('deleted_at','NULL')
                     ->orderBy('preg_week', 'asc')
                     ->get();
        $preg_week = $preg_week->pluck('preg_week');
        $preg_weight = $preg_weight ->pluck('preg_weight');

        $user_height = $user->user_height;
        $user_weight = $user->user_Pre_weight;
        $height = $user_height*0.01;
        $bmi = $user_weight/($height*$height);
        $bmi = number_format($bmi, 2, '.', '');


        return View::make('graph1')->with('record',$record)->with('record1',$record1)->with('bmi',$bmi)->with('preg_week', $preg_week)->with('preg_weight', $preg_weight);
    }
    // public function bmi_calculator($user_weight,$user_height){
    //             $height = $user_height*0.01;
    //             $bmi = $user_weight/($height*$height);
    //             $bmi = number_format($bmi, 2, '.', '');
    //         return $bmi;
    // }
    public function notice_monday()
    {
       $httpClient = new CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
       $bot = new \LINE\LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));

       $status = 2;
       $user_select = $this->user_select($status);

       $arrlength = count($user_select);
       for($x = 0; $x < $arrlength ; ++$x) {
          $user_id = $user_select[$x];
          // $user_id = 'U2dc636d2cd052e82c29f5284e00f69b9';

          $RecordOfPregnancy = $this->RecordOfPregnancy($user_id);
          $preg_week = $RecordOfPregnancy->preg_week;
          $preg_week = $preg_week+1;

             if($preg_week>41){
                    $users_register = users_register::where('user_id', $user_id)
                                                   ->update(['status'=>'0']);


             }else{
          $pregnants = $this->pregnants($preg_week);
          $descript = $pregnants->descript;
          
          // $picFullSize = 'https://peat.none.codes/week/'.$preg_week.'.jpg';
          // $picThumbnail = 'https://peat.none.codes/week/'.$preg_week.'.jpg';
          
          $Message1 =  'สัปดาห์นี้คุณมีอายุครรภ์'.$preg_week.'สัปดาห์แล้วนะคะ';
          // $Message3 =  $descript;
          $Message4 = 'สัปดาห์นี้คุณแม่มีน้ำหนักเท่าไรแล้วคะ?';

          $textMessage1 = new TextMessageBuilder($Message1);
          // $textMessage2 = new ImageMessageBuilder($picFullSize,$picThumbnail);
          // $textMessage3 = new TextMessageBuilder($Message3);
          $textMessage4 = new TextMessageBuilder($Message4);
          
          $multiMessage = new MultiMessageBuilder;
          $multiMessage->add($textMessage1);
          // $multiMessage->add($textMessage2);
          // $multiMessage->add($textMessage3);
          $multiMessage->add($textMessage4);
          $textMessageBuilder = $multiMessage; 
       
          $seqcode     = 1003;
          $nextseqcode = 0000;
          $sequentsteps_insert =  $this->sequentsteps_update($user_id,$seqcode,$nextseqcode);

          $user_weight  = 'NULL';
          $RecordOfPregnancy = $this->RecordOfPregnancy_insert($preg_week, $user_weight,$user_id);

          $response = $bot->pushMessage( $user_id ,$textMessageBuilder);
          $response->getHTTPStatus() . ' ' . $response->getRawBody();
             }

        
             $up= $this->user_update($preg_week,$user_id);

       }
      
    }
        public function tracker_insert1($user_id,$tracker)
    {          
          $tracker = tracker::insert(['user_id'=>$user_id,'breakfast' => $tracker,'lunch' => 'NULL','dinner' => 'NULL','dessert_lu' => 'NULL' ,'dessert_din' => 'NULL' ,'exercise' => 'NULL','vitamin'=>'NULL','created_at'=>NOW(),'updated_at' =>NOW(),'deleted_at' => 'NULL','data_to_ulife'=>'0']);
    }
     public function user_select($status)
    {
       $user_select = users_register::select('user_id')
                      ->whereIn('preg_week', ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41'])
                       ->where('deleted_at', 'NULL')
                       ->whereIn('status', [1, $status])
                       ->where('user_id', 'U2dc636d2cd052e82c29f5284e00f69b9')
                       //->where('user_id', 'Udb5efc89a4729c093051ce8813454223')
                       ->distinct()
                       ->pluck('user_id')
                       ->all();
          
       //print_r($user_select);
       return  $user_select;
    }
    public function RecordOfPregnancy($user_id){

        $RecordOfPregnancy = RecordOfPregnancy::where('user_id',$user_id)
                                         ->whereBetween('preg_week', ['1','41'])
                                         ->orderBy('updated_at', 'desc')
                                         ->first();
        return $RecordOfPregnancy;

    }
      public function user_update($preg_week,$user_id)
    {
       $user_select = users_register::where('user_id', $user_id)
                      ->update(['preg_week' =>$preg_week]);
          
       //print_r($user_select);
       return  $user_select;
    }

    public function RecordOfPregnancy_asc($user_id){

        $RecordOfPregnancy = RecordOfPregnancy::where('user_id',$user_id)
                                         ->orderBy('updated_at', 'asc')
                                         ->first();
        return $RecordOfPregnancy;

    }
    


    public function  pregnants($preg_week){
         $pregnants = pregnants::where('week', $preg_week)->first();
        return $pregnants;

    }
    public function sequentsteps_update($user_id,$seqcode,$nextseqcode)
    {          
         $sequentsteps = sequentsteps::where('sender_id', $user_id)
                       ->update(['seqcode' =>$seqcode,'nextseqcode' => $nextseqcode]);
    }
    public function RecordOfPregnancy_insert($preg_week, $user_weight,$user_id){
     $RecordOfPregnancy = RecordOfPregnancy::insert(['user_id'=>$user_id,'preg_week' => $preg_week,'preg_weight' => $user_weight,  'created_at'=>NOW(),'updated_at' =>NOW(),'deleted_at' => 'NULL','data_to_ulife'=>'0']);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


 public function notice_day()
    {
       $httpClient = new CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
       $bot = new \LINE\LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));

       $status = 3;
       $user_select = $this->user_select($status);

       $arrlength = count($user_select);
       for($x = 0; $x < $arrlength ; ++$x) {
          $user_id = $user_select[$x];
          $Message1 =  'วันนี้คุณทานอะไรไปบ้างคะ';
          $textMessageBuilder = new TextMessageBuilder($Message1);
          
          $seqcode     = 2001;
          $nextseqcode = 2002;
          $sequentsteps_insert =  $this->sequentsteps_update($user_id,$seqcode,$nextseqcode);

          $response = $bot->pushMessage( $user_id ,$textMessageBuilder);
          $response->getHTTPStatus() . ' ' . $response->getRawBody();


       }

    }
 public function notice_breakfast()
    {
       $httpClient = new CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
       $bot = new \LINE\LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));

       $status = 3;
       $user_select = $this->user_select($status);

       $arrlength = count($user_select);
       for($x = 0; $x < $arrlength ; ++$x) {
          $user_id = $user_select[$x];

          $a = array("สวัสดีตอนเเช้าค่ะคุณแม่😊 ตอนเช้าคุณแม่ทานอะไรไปบ้างคะ?","มอนิ่งนะคะ😁 คุณแม่ทานอะไรหรือยังคะ ทานอะไรไปบ้างเอ่ย?","สวัสดีค่ะ☀ เช้านี้คุณแม่ทานอะไรบ้างคะ?","สวัสดีตอนเช้าค่ะคุณแม่😊 ทานข้าวเช้าหรือยังค่ะ ทานอะไรไปบ้างคะ?");
          $random_keys= array_rand($a,2) ;
          $Message1 =  $a[$random_keys[0]];
          $textMessageBuilder = new TextMessageBuilder($Message1);
          
          $seqcode     = 2005;
          $nextseqcode = 2006;
          $sequentsteps_insert =  $this->sequentsteps_update($user_id,$seqcode,$nextseqcode);

          $response = $bot->pushMessage( $user_id ,$textMessageBuilder);
          $response->getHTTPStatus() . ' ' . $response->getRawBody();
          $tracker= 'NULL';
          $tracker_insert =  $this->tracker_insert1($user_id,$tracker);

       }
      
    }
public function notice_lunch()
    {
       $httpClient = new CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
       $bot = new \LINE\LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));

       $status = 3;
       $user_select = $this->user_select($status);
      


       $arrlength = count($user_select);
       for($x = 0; $x < $arrlength ; ++$x) {
          $user_id = $user_select[$x];

          $a = array("😊มื้อเที่ยงนี้ทานข้าวหรือยังคะ ทานอะไรบ้างคะ? ","มื้อเที่ยงแล้ว😁 คุณแม่ทานอะไรหรือยังคะ ทานอะไรไปบ้างเอ่ย?","☀มื้อเที่ยงคุณแม่ทานอะไรบ้างคะ?","สวัสดีตอนเที่ยงค่ะคุณแม่😊 ทานข้าวหรือยังค่ะ ทานอะไรไปบ้างคะ?");
          
          
          $random_keys= array_rand($a,2) ;
          $Message1 =  $a[$random_keys[0]];
          $textMessageBuilder = new TextMessageBuilder($Message1);
          
          $seqcode     = 2006;
          $nextseqcode = 2007;
          $sequentsteps_insert =  $this->sequentsteps_update($user_id,$seqcode,$nextseqcode);

          $response = $bot->pushMessage( $user_id ,$textMessageBuilder);
          $response->getHTTPStatus() . ' ' . $response->getRawBody();


       }
      
    }
public function notice_dinner()
    {
       $httpClient = new CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
       $bot = new \LINE\LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));

       $status = 3;
       $user_select = $this->user_select($status);

       $arrlength = count($user_select);
       for($x = 0; $x < $arrlength ; ++$x) {
          $user_id = $user_select[$x];
            $a = array("มื้อเย็นแล้ว ทานข้าวหรือยังคะ ทานอะไรบ้างคะ?😊","มื้อเย็นแล้ว😁 คุณแม่ทานอะไรหรือยังคะ ทานอะไรไปบ้างเอ่ย?","มื้อเย็นคุณแม่ทานอะไรบ้างคะ?","สวัสดีตอนเย็นค่ะคุณแม่😊 ทานข้าวหรือยังค่ะ ทานอะไรไปบ้างคะ?");
          
          $random_keys= array_rand($a,2) ;
          $Message1 =  $a[$random_keys[0]];

          $textMessageBuilder = new TextMessageBuilder($Message1);
          
          $seqcode     = 2001;
          $nextseqcode = 2002;
          $sequentsteps_insert =  $this->sequentsteps_update($user_id,$seqcode,$nextseqcode);

          $response = $bot->pushMessage( $user_id ,$textMessageBuilder);
          $response->getHTTPStatus() . ' ' . $response->getRawBody();


       }
      
    }

     public function liff_register($user)
    {

  
        return View::make('liff');
    } 
}
