<?php

namespace App\Http\Controllers;

// use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use DB;
use View;
use app\User;

class LashaController extends Controller
{

  public function viewquestion(Request $request, $id)
  {

    $startString = substr($id, 0, 32);
    $endString = substr($id, 33);
    $userType = substr($id, 32, 1);
    $searchToken = $startString.'-'.$endString;


    if(isset($_POST['token']) && $_POST['text']!='' && $id==$request->input('token')){ // INSERT

        if ($request->hasFile('file')) {

            $destination = 'uploads/files';
            $extension = $request->file('file')->getClientOriginalExtension(); // getting image extension
            $fileName = time().rand(111,999999).'.'.$extension; // Rename image
            $request->file('file')->move($destination, $fileName); // uploading file to given path
        } else {
            // set default value for $fileName
            $fileName = 'NULL';
        }


        $topID = DB::table('email')->insertGetId(
            array(
                'subid' => $request->input('id'),
                'type' => $userType,
                'entitiesID' => $request->input('entitiesID'),
                'text' => $request->input('text'),
                'token' => self::trimToken($request->input('token')),
                'dateTime' => date("Y-m-d H:i:s"),
                'file' => $fileName,
            ));
        $data['topID'] = $topID; // gadascems damatebis ID s da iq damatebis inputs aqrobs ro agar daamatos

    }
    $item = DB::select("SELECT * FROM `email` WHERE token = '".self::trimToken($id)."' ORDER BY `id` ASC ");


    if($userType==1){
      $parrams['email'] = $item[0]->email;
      $parrams['name'] = $item[0]->name;
      $parrams['pasuxi'] = $item[0]->subject;
      $parrams['token'] = $startString.'0'.$endString;

    }
    elseif($userType==0){
      $selectEntitle = DB::select("SELECT * FROM `entities` WHERE id = ".$item[1]->entitiesID); // იღებს მუნიციპალიტეტის Email ს
      //echo $selectEntitle[0]->email;
      $parrams['name'] = $selectEntitle[0]->name;
      $parrams['email'] = $selectEntitle[0]->email;
      $parrams['token'] = $startString.'1'.$endString;
    }
    
    if(isset($topID))self::sendMail($userType,$parrams);



    $userID = substr($id, 32, 1);



    $data['userID'] = $userID;
    $data['item'] = $item;
    $data['kitxva'] = $item[0]->subject;
    return view("admin/viewquestion",$data);


  }

  public function trimToken($token){

    $startString = substr($token, 0, 32);
    $endString = substr($token, 33);
    $mainToken = $startString.'-'.$endString;
    return $mainToken;
  }


  public function sendMail($userType,$parrams){

    if($userType==1){ // users egzavneba email
      //echo 'send mail = 1';

      $data = ['email'=> $parrams['email'],'name'=> $parrams['name'],'pasuxi' => $parrams['pasuxi'],'token' => $parrams['token']];
      Mail::send('emails.user', $data, function ($message) use($data) {
               $message->from('info@flash.ge');
               $message->to($data['email'], $data['name'])->subject('EPFUND');
      });
    }elseif($userType==0){
      $data = ['email'=> $parrams['email'],'name'=> $parrams['name'],'token' => $parrams['token']];
      Mail::send('emails.administration', $data, function ($message) use($data) {
               $message->from('info@flash.ge');
               $message->to($data['email'], $data['name'])->subject('EPFUND');
      });
    }
  }
  public function send(Request $request){
        $selectEntitle = DB::select("SELECT * FROM `entities` WHERE id = ".$request->input('entitleMail')); // იღებს მუნიციპალიტეტის Email ს

        //$email = $selectEntitle[0]->email;
        // echo $selectEntitle[0]->id;
        // echo $email;
        // echo time();

        $token = self::generateRandomString($selectEntitle[0]->id,10,1);  
        $token2 = self::generateRandomString($selectEntitle[0]->id,10,1);  
        $tokenforSite = $token.'1f9'.$token2;
        $token = $token.'-f9'.$token2;

        $topID = DB::table('email')->insertGetId(
            array(
                'type' => 0,
                'entitiesID' => $selectEntitle[0]->id,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'subject' => $request->input('subject'),
                'text' => $request->input('text'),
                'token' => $token,
                'dateTime' => date("Y-m-d H:i:s"),
                'sector' => $request->input('sector'),
            ));



        $data = ['email'=> $selectEntitle[0]->email,'entitleName'=> $selectEntitle[0]->name,'name'=> $request->input('name'),'subject' => $request->input('subject'),'text' => $request->input('text'),'token' => $tokenforSite, 'adress'=>$request->input('adress'),'phone'=>$request->input('phone'),'gender'=>$request->input('gender'),'sector'=>$request->input('sector'),'age'=>$request->input('age')];
        Mail::send('emails.welcome', $data, function ($message) use($data) {
                 $subject='კითხვა საიტიდან';
                 $message->from('info@flash.ge');
                 $message->to($data['email'], $data['name'])->subject($subject);
        });

        if($topID){
          $data['topID'] = $topID; // gadascems damatebis ID s da iq damatebis inputs aqrobs ro agar daamatos
        }


        $entitleList = DB::select("SELECT * FROM `entities` WHERE email != ''");
        $data['entitleList'] = $entitleList; 
        return view("lasha",$data);
        //return redirect()->back();
        // return redirect("admin/subcat/$mainCat");
  }

  public function generateRandomString($id,$length = 10,$md5) {    
    $string = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    if($md5==1){
      $string = md5($id.$string.time());
    }
    return $string;
  }

  public function faqs(Request $request){ 

    // თუ პასუხია გაცებული ის კითხვები გამოდის მართო
    // $questions = DB::select("SELECT 
    //                            FirstSet.id,
    //                            FirstSet.entitiesID,
    //                            FirstSet.subject,
    //                            FirstSet.token,
    //                            entitle.name,
    //                            SecondSet.subid
    //                         FROM (
    //                             SELECT id,entitiesID,subject,token FROM email
    //                         ) as FirstSet
    //                         inner join
    //                         (
    //                              SELECT id,name FROM entities 
    //                         ) as entitle
    //                         inner join
    //                         (
    //                              SELECT subid FROM email group by subid
    //                         ) as SecondSet
    //                         on FirstSet.id = SecondSet.subid AND entitle.id = FirstSet.entitiesID"); 


    $query = ''; 
    if(isset($_GET['kw'])){
      if($_GET['kw']!=''){ $query.= " AND `subject` LIKE  '%".urldecode($_GET['kw'])."%'";}
      if($_GET['category']!=''){ $query.= " AND `entitiesID` LIKE  '%".urldecode($_GET['category'])."%'";}
      if($_GET['from']!=''){ $query.= " AND `dateTime` >= '".urldecode($_GET['from'])." 00:00:00'";}
      if($_GET['to']!=''){ $query.= " AND `dateTime` <= '".urldecode($_GET['to'])." 23:59:59'";}
    }
 
    
    $questions = DB::select("SELECT * FROM email WHERE subid = 0 ".$query." ORDER BY id DESC"); 
    $entitleList = DB::select("SELECT * FROM `entities` WHERE `catID` != 5 AND `catID` != 1");

    $data['entitleList'] = $entitleList;
    $data['questions'] = $questions;
    return view("faq",$data);
    /*

    */
  }

  public function index()
  {
        $entitleList = DB::select("SELECT * FROM `entities` WHERE email != ''"); 

        $data['entitleList'] = $entitleList;
        return view("lasha",$data);
  }


  public function lisst(){

    $blogList = DB::select("SELECT id,title_ge,active FROM `blog`");
    $data['itemsList'] = $blogList; 

    return view("admin/faqList",$data);

  }


  public function bacho() {
      echo 1231;
  }
}
