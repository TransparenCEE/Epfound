<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class AdminController extends BaseAdminController
{

    public function index($id = '')
    {
        !empty($id) || $id = 1;
        $data['municipality'] = DB::select("SELECT * FROM `entities` WHERE `catID` = $id");
        $data['headers'] = DB::select("SELECT `name` FROM `mainCategory` WHERE `id` = $id");

        return view("admin/index", $data);

    }
    // -----------------------------------------------------------------------------------------------------------------
    // category page
    public function category($id)
    {

        $mainCategory = DB::select("SELECT * FROM `entities` WHERE catID = $id ");
        $data['subCat'] = $mainCategory;
        return view("admin/category", $data);
    }

    // -----------------------------------------------------------------------------------------------------------------
    public function categoryAdd(Request $request, $id)
    {
        $mainCategory = DB::select("SELECT * FROM `entities` WHERE catID = $id ");
        $data['mainCategory'] = $mainCategory;

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $add = $request->all();
            DB::table('entities')->insert(
                [
                    'name' => $add['name'],
                    'name_en' => $add['name_en'],
                    'email' => $add['email'],
                    'catID' => $add['category'],
                    'text' => $add['info'],
                    'text_en' => $add['info_en']
                ]);
        }


        return view("admin/category_add", $data);

    }
    // -----------------------------------------------------------------------------------------------------------------
    # Category delete
    public function deleteCat($id = '', $id2) {

        DB::table('entities')->where('id', '=', $id2)->delete();
        return redirect()->back();

    }
    // -----------------------------------------------------------------------------------------------------------------
    # Category edit
    public function editCat(Request $request, $id = '', $id2) {
        $result =  DB::table('entities')
                                     ->select('*')
                                     ->where('id', '=', $id2)
                                     ->get();
        if ($request->isMethod('post')) {
            $name = $request->input('name');
            $name_en = $request->input('name_en');
            $text = $request->input('info');
            $text_en = $request->input('info_en');
            $email = $request->input('email');
            $category = $request->input('category');

            DB::table('entities')
                ->where('id', $id2)
                ->update([
                    'name' => $name,
                    'name_en' => $name_en,
                    'email' => $email,
                    'text' => $text,
                    'text_en' => $text_en,
                    'catID' => $category
                ]);
            return redirect()->back();
        }


        return view('admin/category_edit')->with('result', $result);
    }


    // -----------------------------------------------------------------------------------------------------------------
    # show all secondary categories with it's sub categories
    public function subcat($id)
    {   
        if(!isset($_GET['ctype'])) $_GET['ctype'] = 1;
        $mainCategory = DB::select("SELECT * FROM `subcat` WHERE mainCategory = $id AND categoryType =".$_GET['ctype']);
        $data['subCat'] = $mainCategory;

        $data['headers'] = DB::select("SELECT `name` FROM `mainCategory` WHERE `id` = $id");
       
        return view("admin/subcat", $data);
    }
    // -----------------------------------------------------------------------------------------------------------------
    # Sub category edit
    public function subCatEdit(Request $request, $id = '', $id2) {
        // for values
        $result = DB::table('subcat')->where('id', $id2)->get();

        if ($request->isMethod('post')) {
            $name = $request->input('name');
            $name_en = $request->input('name_en');
            $text = $request->input('info');
            $text_en = $request->input('info_en');


            DB::table('subcat')
                ->where('id', $id2)
                ->update([
                    'name' => $name,
                    'name_en' => $name_en,
                    'text' => $text,
                    'text_en' => $text_en
                ]);
            return redirect()->back();
        }
        return view('admin/subcat_edit')->with('result', $result);

    }
    // -----------------------------------------------------------------------------------------------------------------
    # delete sub categories
    public function deleteSubCat($id) {
        DB::table('subcat')->where('id', '=', $id)->delete();
        return redirect()->back();
    }

    // -----------------------------------------------------------------------------------------------------------------
    public function mainSubCat(Request $request, $mainCat, $id2 = '') {

        if ($request->isMethod('post')) {
            if ($request->hasFile('image')) {

                $destination = 'uploads/icons';
                $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111,99999).'.'.$extension; // Rename image
                $request->file('image')->move($destination, $fileName); // uploading file to given path
            } else {
                // set default value for $fileName
                $fileName = 'NULL';
            }


            $name = $request->input('name');
            $name_en = $request->input('name_en');
            $info = $request->input('info');
            $info_en = $request->input('info_en');
            $categoryType = $request->input('categoryType');


            DB::table('subcat')->insert(
                [   'name' => $name,
                    'name_en' => $name_en,
                    'icon' => $fileName,
                    'mainCategory' => $mainCat,
                    'catId' => 0,
                    'categoryType' => $categoryType,
                    'text' => $info,
                    'text_en' => $info_en
                ]
            );

            return redirect("admin/subcat/$mainCat");
        }


        return view("admin/mainSubCat_add");


    }
    public function mainSubCatUpdate(Request $request, $mainCat, $id2 = '') {

        $values = DB::table('subcat')->select('*')->where('id', $id2)->get();
        $data['result'] = $values;

        if ($request->isMethod('post')) {
            if ($request->hasFile('image')) {

                $destination = 'uploads/icons';
                $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(111,999999).'.'.$extension; // Rename image
                $request->file('image')->move($destination, $fileName); // uploading file to given path
            } else {
                // set default value for $fileName
                $fileName = 'NULL';
            }


            $categoryType = $request->input('categoryType');

            $name = $request->input('name');
            $name_en = $request->input('name_en');
            $info = $request->input('info');
            $info_en = $request->input('info_en');

            $update = DB::table('subcat')
                ->where('id', $id2)
                ->limit(1)
                ->update(array(
                    'name' => $name,
                    'name_en' => $name_en,
                    'icon' => $fileName,
                    'mainCategory' => $mainCat,
                    'categoryType' => $categoryType,
                    'catId' => 0,
                    'text' => $info,
                    'text_en' => $info_en
                ));
            $ctype = $_GET['ctype'];
            return redirect("admin/subcat/$mainCat/?ctype=$ctype");
        }


        return view("admin/mainSubCat_update", $data);


    }
    // -----------------------------------------------------------------------------------------------------------------
    // add subCat to main SubCategory
    public function subcatAdd(Request $request, $mainCat, $subCat)
    {
        if ($request->isMethod('post')) {
            //gather post info
            $name = $request->input('name');
            $name_en = $request->input('name_en');
            $info = $request->input('info');
            $info_en = $request->input('info_en');
            $categoryType = $request->input('Type');


            DB::table('subcat')->insert(
                [   'name' => $name,
                    'name_en' => $name_en,
                    'catId' => $subCat,
                    'categoryType' => $categoryType,
                    'text' => $info,
                    'text_en' => $info_en
                ]);

            return redirect("admin/subcat/$mainCat");

        }
        return view("admin/subcat_add");

    }

    // -----------------------------------------------------------------------------------------------------------------

    public function bacho() {
            $year = $_POST['year'];
            $unit = $_POST['unit'];

            $check = DB::table('addData')->select('*')->where('year',$year)->where('unit', $unit)->get();

            if (count($check)) {
                return json_encode($check);
            }

        }

}
