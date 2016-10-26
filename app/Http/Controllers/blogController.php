<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use View;
use app\User;

class blogController extends BaseAdminController
{
  public function admin(Request $request)
  {

  	if(isseT($_POST['hidden'])){

  		if($_POST['hidden']==''){
  		        $insertID = DB::table('blog')->insertGetId(
                array(
                    'title_ge' => $request->input('title_ge'),
                    'text_ge' => $request->input('text_ge'),
                    'author_ge' => $request->input('author_ge'),
                    'active' => 1,
                    'dateTime' => date("Y-m-d H:i:s"),
                ));
  		}
  		else{

            DB::table('blog')->where('id', $_POST['hidden'])->update(
                array(
                    'title_ge' => $request->input('title_ge'),
                    'text_ge' => $request->input('text_ge'),
                    'author_ge' => $request->input('author_ge'),
                ));
    			return redirect()->back();
  		}
  	}

    $blog = DB::select("SELECT * FROM `blog`");
    $data['itemsList'] = $blog; 
    return view("admin/blog",$data);
  }
  public function adminAdd($id)
  {
    $blogitem = DB::select("SELECT * FROM `blog` WHERE id = $id");
    $data['items'] = $blogitem;

    $blogList = DB::select("SELECT id,title_ge,active FROM `blog`");
    $data['itemsList'] = $blogList; 

    return view("admin/blog",$data);
  }

public function deleteSubCat($id) {
    DB::table('blog')->where('id', '=', $id)->delete();
    return redirect()->back();
}
public function publish($id) {
            DB::table('blog')->where('id', $id)->update(
                array(
                    'active' => 1,
                ));
    return redirect()->back();
}



public function lisst() {
    $blogList = DB::select("SELECT * FROM `email`");
    $data['itemsList'] = $blogList; 
    return view("admin/faqList",$data);
}




  public function add(Request $request)
  {
    if(isset($_POST['_token'])){

              $insertID = DB::table('blog')->insertGetId(
                array(
                    'title_ge' => $request->input('title_ge'),
                    'text_ge' => $request->input('text_ge'),
                    'author_ge' => $request->input('author_ge'),
                    'email' => $request->input('email'),
                    'active' => 0,
                    'dateTime' => date("Y-m-d H:i:s"),
                ));
              $data['insertID'] = $insertID; 

    }
    $data['items'] = 123; 
    return view("blogadd",$data);
  }
  public function view($id)
  {
    $blog = DB::select("SELECT * FROM `blog` WHERE active = '1' AND id = $id");
    $data['items'] = $blog; 
    return view("blogview",$data);

  }
  public function index()
  {

    $blog = DB::table("blog")->where('active', '1')->paginate(20);
    $data['items'] = $blog; 
    return view("blog",$data);

  }
}
