<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class Admin_showData extends BaseAdminController
{
    public function showData(Request $request, $unit, $categoryID, $year = '') {

        // select addData
        $selectYear = $year != '' ? "AND `year` = $year" : " ";


        $unitData = DB::select("SELECT * FROM `addData` WHERE `unit` = $unit $selectYear LIMIT 1");

        if (!count($unitData)) {
            $request->session()->flash('dataError', 'ამ ერთეულზე არაფერია დამატებული');
            return redirect()->back();
        }
        // takes first matching year which will be active
        $data['activeYear'] = $unitData[0]->year;

        // select all years of this unit
        $unitYears = DB::select("SELECT year FROM `addData` WHERE `unit` = $unit");





        $addData_id = $unitData[0]->id;
        $data['addData_selectID'] = $addData_id;

        // select addData_items
        //
            // $items_xarji = DB::select("SELECT a.subcat_id, b.mainCategory, FROM addData_items a, subcat b WHERE `addData_id` = $addData_id AND `categoryType` = 2");
//        $items_xarji = DB::select("SELECT DISTINCT a.id as id, a.value, b.mainCategory, b.name, b.id as Subcat_ID
//                                   FROM addData_items a, subcat b
//                                   WHERE a.subcat_id = b.id
//                                   AND b.catId = 0
//                                   AND a.addData_id = $addData_id
//                                   AND a.categoryType = 2");

//

        // 2 JOINS
        $items_xarji = DB::select("SELECT subcat.id as Subcat_ID,subcat.name,addData_items.value, addData_items.id as id
                                FROM subcat
                                LEFT JOIN addData_items ON subcat.id = addData_items.subcat_id AND addData_items.addData_id = $addData_id
                                WHERE subcat.mainCategory = $categoryID
                                AND subcat.categoryType = 2      
                                                         ");

//        $items_shemosavali = DB::select("SELECT DISTINCT a.id as id, a.value, b.mainCategory, b.name, b.id as Subcat_ID
//                                         FROM addData_items a, subcat b
//                                         WHERE a.subcat_id = b.id
//                                         AND b.catId = 0
//                                         AND a.addData_id = $addData_id
//                                         AND a.categoryType = 1");

        $items_shemosavali = DB::select("SELECT subcat.id as Subcat_ID,subcat.name,addData_items.value,addData_items.id as id
                                FROM subcat
                                LEFT JOIN addData_items ON subcat.id = addData_items.subcat_id AND addData_items.addData_id = $addData_id
                                WHERE subcat.mainCategory = $categoryID
                                AND subcat.categoryType = 1");

        // select unit
        $mainCategory = DB::select("SELECT * FROM `mainCategory` WHERE `id` = $categoryID");
 
        // select entities
        $entities = DB::select("SELECT * FROM `entities` WHERE `id` = $unit");

        $data['unitData'] = $unitData;
        $data['items_xarji'] = $items_xarji;
        $data['items_shemosavali'] = $items_shemosavali;
        $data['mainCategory'] = $mainCategory;
        $data['entities'] = $entities;
        $data['unitYears'] = $unitYears;

        return view('admin/showData', $data);
    }

    public function editData(Request $request, $id, $categoryID, $year) {


    }
}
