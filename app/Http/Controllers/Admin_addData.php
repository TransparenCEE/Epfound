<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class Admin_addData extends BaseAdminController
{
    //
    public function index($id=''){


        !empty($id) || $id = 1;
        $entities = DB::select("SELECT id,name FROM `entities` WHERE catID = $id");
        $data['entities'] = $entities;

        $mainCategory = DB::select("SELECT id,name FROM `mainCategory` order by main DESC");
        $data['mainCategory'] = $mainCategory;

        $subcat_xarji = DB::select("SELECT * FROM `subcat` WHERE mainCategory = $id AND categoryType = 2");
        $data['subCat_xarji'] = $subcat_xarji;

        $subCat_shemosavali = DB::select("SELECT * FROM `subcat` WHERE mainCategory = $id AND categoryType = 1");
        $data['subCat_shemosavali'] = $subCat_shemosavali;



        return view("admin/addData",$data);

    }


    /*
     *  XARJIS UPDATE
          $addDataID = $request->input('editId');
                        $_value = (int) trim(str_replace(',','',$_value));
                        DB::table('addData_items')->where('id',$_key)->update(
                            array(
                                'value' => $_value,
                            ));
     *
     *
     */


    /* SHEMOSALvLIS UPDATE
    $addDataID = $request->input('editId');
$_value =  (str_replace(',','',$_value));

DB::table('addData_items')->where('id',$_key)->update(
array(
'value' =>  $_value,
));
    */
    public function add(Request $request) {

        if (isset($_POST['editId'])) { // UPDATE DATA

                $count = 1;

            foreach ($_POST['xarji'] as $key => $value) {
                foreach ($value as $_key => $_value) {

                    if (strpos($_key, 'y') !== false) {

                        $_key =  (str_replace('y','',$_key));
                        DB::table('addData_items')->insert(
                            array(
                                'addData_id' => $request->input('editId'),
                                'subcat_id' => $_key,
                                'value' => $_value,
                                'categoryType' => 2,

                            ));

                    } else {
                        $addDataID = $request->input('editId');
                        $_value = (str_replace(',', '', $_value));

                        DB::table('addData_items')->where('id', $_key)->update(
                            array(
                                'value' => $_value,
                            ));

                    }
                }
            }

            foreach ($_POST['shemosavali'] as $key => $value) {
                foreach ($value as $_key => $_value) {

                    if (strpos($_key, 'y') !== false) {

                        $_key =  (str_replace('y','',$_key));
                        DB::table('addData_items')->insert(
                            array(
                                'addData_id' => $request->input('editId'),
                                'subcat_id' => $_key,
                                'value' => $_value,
                                'categoryType' => 1,

                            ));

                    } else {
                        $addDataID = $request->input('editId');
                        $_value =  (str_replace(',','',$_value));

                        DB::table('addData_items')->where('id',$_key)->update(
                            array(
                                'value' =>  $_value,
                            ));
                    }
//                    echo "<pre>";
//                    echo "SHEMOSAVALI => " . $_key;

                }
            }


              DB::table('addData')->where('id', $addDataID)
                  ->update((
                array(
                    'year' => $request->input('year'),
                    'text' => $request->input('text'),
                    'outcome' => (str_replace(',','',$request->input('outcome'))),
                    'income' => (str_replace(',','',$request->input('income'))),
                    'population' => (str_replace(',','',$request->input('population'))),
                    'scheduled_costs' => (str_replace(',','',$request->input('scheduled'))),
                    'govern_incomes' => (str_replace(',','',$request->input('govern_incomes'))),
                    'budget_deficit' => (str_replace(',','',$request->input('budget_deficit'))),
                    'unemployment_level' => (str_replace(',','',$request->input('unemployment_level'))),
                    'overall_product' => (str_replace(',','',$request->input('overall_product'))),
                    'inflation' => (str_replace(',','',$request->input('inflation'))),
                    'country_debt' => (str_replace(',','',$request->input('country_debt'))),
                    'unclassified' => (str_replace(',','',$request->input('unclassified'))),
                )));
            /*
            DB::table('addData_items')->where('addData_id', $addDataID)->where('categoryType', 2)->update($data['xarji']);

            // loop through each post shemosavali and save it
            foreach ($_POST['shemosavali'] as $key => $value) {
                foreach ($value as $_key => $_value) {

                    $data['shemosavali'] = array(
                            'addData_id' => $request->input('editId'),
                            'subcat_id' => $_key,
                            'value' => $_value,
                            'categoryType' => 1,
                        );
                }
            }
            DB::table('addData_items')->where('addData_id', $addDataID)->where('categoryType', 1)->update($data['shemosavali']);
//            echo "<pre>". print_r($data['xarji']) . "</pre>";
//            echo "<pre>". print_r($data['shemosavali']) . "</pre>";

*/


      return redirect()->back();


        } else { // ADD DATA

            if ($request->hasFile('uploadFile')) {

                $destination = 'uploads/files';
                $extension = $request->file('uploadFile')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(1,99999).'.'.$extension; // Rename image
                $request->file('uploadFile')->move($destination, $fileName); // uploading file to given path
            } else {
                $fileName = '';
            }

            //      save top inputs (including year,file,info etc..)
            $topID = DB::table('addData')->insertGetId(
                array(
                    'mainCategory' => $request->input('mainCategory'),
                    'unit' => $request->input('unit'),
                    'year' => $request->input('year'),
                    'text' => $request->input('text'),
                    'file' => $fileName,
                    'outcome' => (str_replace(',','',$request->input('outcome'))),
                    'income' => (str_replace(',','',$request->input('income'))),
                    'population' => (str_replace(',','',$request->input('population'))),
                    'unit' => $request->input('unit'),
                    'scheduled_costs' => (str_replace(',','',$request->input('scheduled'))),
                    'govern_incomes' => (str_replace(',','',$request->input('govern_incomes'))),
                    'budget_deficit' => (str_replace(',','',$request->input('budget_deficit'))),
                    'unemployment_level' => (str_replace(',','',$request->input('unemployment_level'))),
                    'overall_product' => (str_replace(',','',$request->input('overall_product'))),
                    'inflation' => (str_replace(',','',$request->input('inflation'))),
                    'country_debt' => (str_replace(',','',$request->input('country_debt'))),
                    'deficit' => (str_replace(',','',$request->input('deficit'))),
                    'unclassified' => (str_replace(',','',$request->input('unclassified'))),
                ));

            // loop through each post xarji and save it
            if (isset($_POST['xarji'])) {

          foreach ($_POST['xarji'] as $key => $value) {
                    foreach ($value as $_key => $_value) {
                        $_value =  (str_replace(',','',$_value));
                        DB::table('addData_items')->insert(
                            array(
                                'addData_id' => $topID,
                                'subcat_id' => $_key,
                                'value' => $_value,
                                'categoryType' => 2,

                            ));
                    }
            }

          }
            // loop through each post shemosavali and save it
            if (isset($_POST['shemosavali'])) {
            foreach ($_POST['shemosavali'] as $key => $value) {
                foreach ($value as $_key => $_value) {
                    $_value =  (str_replace(',','',$_value));
                    DB::table('addData_items')->insert(
                        array(
                            'addData_id' => $topID,
                            'subcat_id' => $_key,
                            'value' => $_value,
                            'categoryType' => 1,
                        ));
                }
            }
            }


         return redirect('admin/addData');


        }



    }


}








