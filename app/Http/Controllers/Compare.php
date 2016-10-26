<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class Compare extends Controller
{

    public function compare() {
       $years = DB::select("SELECT DISTINCT `year` FROM `addData` WHERE `mainCategory` = 2  ORDER BY year DESC");
       $data['years'] = $years;

       $cats = DB::select("SELECT * FROM `subcat` WHERE `mainCategory` = 2");
        $data['cats'] = $cats;

        $data['cities'] = DB::select("SELECT * FROM `entities` WHERE catId = 2");


        return view('municipality_compare', $data);
    }

    public function getEntities($param1) {

        return DB::select("SELECT `name` FROM `entities` WHERE `id` = $param1");
    }

    public function getSubs($subcat_id, $unit, $year) {
        return DB::select("SELECT addData_items.value, subcat.name, subcat.id, addData.year FROM addData_items, subcat, addData
                                               WHERE addData_items.categoryType = 2
                                               AND addData_items.subcat_id = subcat.id
                                               AND subcat.catId =  $subcat_id
                                               AND addData.year = $year
                                               AND addData_items.addData_id = addData.id
                                               AND addData.unit = $unit");
    }

    public function innerCompare(Request $request)
    {

        if (isset($_GET['f1'])) {
            $subcat_id = $request->input('f2');
            $unit = $request->input('f1');
            $year = $request->input('f3');
            $data['first'] = DB::select("SELECT addData_items.value, subcat.name, addData.population,  addData.outcome, subcat.id, addData.year FROM addData_items, subcat, addData
                                        WHERE addData_items.categoryType = 2 
                                        AND addData_items.subcat_id = subcat.id 
                                        AND subcat.id =  $subcat_id
                                        AND addData.year = $year
                                        AND addData_items.addData_id = addData.id 
                                        AND addData.unit = $unit");

            if(count($data['first'])) {
                $data['fsubcats'] = $this->getSubs($subcat_id,$unit,$year);

//            print_r($data['subcats']);

                $data['fentities'] = $this->getEntities($unit);

                // some functionality for donut chart
                if ($data['first'][0]->outcome != "0") {
                    $data['fpercent'] = round(($data['first'][0]->value / $data['first'][0]->outcome) * 100,2);
                }

            }




        }
        if (isset($_GET['s1'])) {
            $subcat_id = $request->input('s2');
            $unit = $request->input('s1');
            $year = $request->input('s3');
            $data['second'] = DB::select("SELECT addData_items.value, subcat.name, addData.outcome, addData.population, subcat.id, addData.year FROM addData_items, subcat, addData
                                WHERE addData_items.categoryType = 2 
                                AND addData_items.subcat_id = subcat.id 
                                AND subcat.id =  $subcat_id
                                AND addData.year = $year
                                AND addData_items.addData_id = addData.id 
                                AND addData.unit = $unit");

            if(count($data['second'])) {
                $data['ssubcats'] = $this->getSubs($subcat_id,$unit,$year);

                $data['sentities'] = $this->getEntities($unit);

                $data['spercent'] = round(($data['second'][0]->value / $data['second'][0]->outcome) * 100,2);
            }



        }


        $years = DB::select("SELECT DISTINCT `year` FROM `addData` WHERE `mainCategory` = 2 ORDER BY year DESC");
        $data['years'] = $years;

        $cats = DB::select("SELECT * FROM `subcat` WHERE `mainCategory` = 2");
        $data['cats'] = $cats;

        $data['cities'] = DB::select("SELECT * FROM `entities` WHERE catId = 2");


        return view('compare-result', $data);
    }
}
