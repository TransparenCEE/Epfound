<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class MunicipalityController extends Controller
{
    public $range;
    public $start;
    public $end;
    public $chartFiles = array();
    public $common_outcomes = array();

    public function index($year)
    {

        $selectYears = DB::select("SELECT DISTINCT year FROM `addData` WHERE mainCategory = 2 ORDER BY year DESC");
        $data['selector'] = $selectYears;

        $data['self_governing'] = DB::select("select * from `entities` where `catID` = 2");

        $common_mtavari = DB::select("SELECT DISTINCT a.id as id, a.value, a.subcat_id as joli_id, b.icon, 
                                    b.mainCategory as subcat_mainCategory, b.name, b.id as Subcat_ID,
                                    c.mainCategory as addData_mainCategory, c.id as addData_Id, c.year
                                    FROM addData_items a, subcat b, addData c
                                    WHERE a.subcat_id = b.id
                                    AND b.catId = 0
                                    AND a.addData_id = c.id
                                    AND a.categoryType = 2
                                    AND b.mainCategory = 2
                                    AND c.unit = 2
                                    AND c.mainCategory = 2
                                    AND c.year = $year
                                    GROUP BY b.name");

        $data['common_mtavari'] = $common_mtavari;
        return view('local_budget', $data);
    }

    /*
     * LOCAL City's API, TOP CHART
     * -------------------------------------------------------------------------------------------------------------------------------------------------------
     */

    public function local_cities_API($year = 2015)
    {
//        $minValue = DB::select("SELECT addData.id,addData.mainCategory,addData.year, addData.outcome,addData.unit, entities.name, entities.id as qalaqiID
//                                FROM addData, entities
//                                WHERE mainCategory = 2
//                                AND year = 2015
//                                AND addData.unit = entities.id
//                                ORDER BY addData.outcome ASC");
//
        $maxValue = DB::select("SELECT addData.id,addData.mainCategory,addData.year, addData.outcome,addData.unit, entities.name, entities.id as qalaqiID
                                FROM addData, entities
                                WHERE mainCategory = 2
                                AND year = $year
                                AND addData.unit = entities.id
                                ORDER BY addData.outcome DESC
                                LIMIT 1");
           $this->chartFiles['max_value'] = $maxValue[0]->outcome;

//        $this->chartFiles['count'] = count($minValue);
//        $this->chartFiles['MINIMAL-VALUE'] = (int) $minValue[0]->outcome;
//        if (count($minValue) > 20) {
//
//            $this->range = ($maxValue[0]->outcome - $minValue[0]->outcome) / 20;
//            $this->chartFiles['range_min'] = $this->range;
//        } else {
//            $this->range = ($maxValue[0]->outcome - $minValue[0]->outcome) / count($minValue);
//            $this->chartFiles['range_min'] = $this->range;
//
//        }
//        $this->start = $this->chartFiles['MINIMAL-VALUE'];
//
//        for ($i = 0; $i < count($minValue); $i++) {
//
//            if ($i == 0) { $this->end = $this->end + $this->range + $this->chartFiles['MINIMAL-VALUE']; } else { $this->end = $this->end + $this->range; }
//            if ($i == (count($minValue) - 1)) $this->end = $maxValue[0]->outcome;

            $this->chartFiles[] = DB::select("SELECT addData.id,addData.mainCategory,addData.year, addData.outcome as value,addData.unit,
                                                entities.name, entities.id as qalaqiID
                                                FROM addData, entities
                                                WHERE mainCategory = 2
                                                AND year = $year
                                                AND addData.unit = entities.id
                                                ORDER BY addData.outcome DESC
                                              
                                                ");

//            $this->start = $this->start + $this->range;
//                             // 1925    +  // 1925
//
//        }
//
//        $this->chartFiles['range_max'] = (int) $this->end;
        return $this->chartFiles;

    }

/*
* COMMON OUTCOMES, Middle div's Charts
 * -------------------------------------------------------------------------------------------------------------------------------------------------------
*/
    public function common_outcomes_API($id, $year = 2015)
    {
//        $this->range = 0;
//        $this->start = 0;
//        $this->end = 0;
//
//        $outcomes_min = DB::select("SELECT addData.id, addData_items.value,addData.unit,entities.name
//                                       FROM addData,addData_items,entities
//                                       WHERE addData.mainCategory = 2
//                                       AND addData.year = 2015
//                                       AND addData_items.addData_id = addData.id
//                                       AND addData_items.subcat_id  = $id
//                                       AND addData.unit = entities.id
//                                       AND addData_items.categoryType = 2
//                                        ORDER BY addData_items.value ASC");
//        //  echo $outcomes_min[0]->value . '-'; // MINIMUM VALUE
//
//
        $outcomes_max = DB::select("SELECT
                                     addData.id, addData_items.value,addData.unit,entities.name
                                    FROM
                                       addData,addData_items,entities
                                    WHERE
                                       addData.mainCategory = 2
                                       AND
                                       addData.year = $year
                                       AND
                                       addData_items.addData_id = addData.id
                                       AND
                                       addData_items.subcat_id  = $id
                                       AND
                                       addData.unit = entities.id
                                       AND
                                       addData_items.categoryType = 2
                                       ORDER BY addData_items.value DESC");

         $this->common_outcomes['max_value'] = $outcomes_max[0]->value; // MAXIMUM VALUE


//
//        if (count($outcomes_min) > 20) {
//
//            $this->range = ($outcomes_max[0]->value - $outcomes_min[0]->value) / 20;
//            $this->common_outcomes['range_min'] = $this->range;
//        } else {
//            $this->range = ($outcomes_max[0]->value - $outcomes_min[0]->value) / count($outcomes_min);
//
//            $this->common_outcomes['range_min'] = $this->range;
//        }
//
//        $this->chartFiles['MINIMAL-VALUE'] = $outcomes_min[0]->value;
//        $this->common_outcomes['MINIMAL-VALUE'] = $outcomes_min[0]->value;
//        $this->start = $this->chartFiles['MINIMAL-VALUE'];
//        $this->common_outcomes['count'] = count($outcomes_min);
//
//             for ($i = 0; $i < count($outcomes_min); $i++) {
//
//
//
//                 if ($i == 0) { $this->end = $this->end + $this->range + $this->chartFiles['MINIMAL-VALUE']; } else { $this->end = $this->end + $this->range; }
//                 if ($i == (count($outcomes_min) - 1)) $this->end = $outcomes_max[0]->value;


            $this->common_outcomes[] = DB::select(" SELECT addData.id, addData_items.value,addData.unit,entities.name
                                                       FROM addData,addData_items,entities
                                                       WHERE addData.mainCategory = 2
                                                       AND addData.year = $year
                                                       AND addData_items.addData_id = addData.id
                                                       AND addData_items.subcat_id  = $id
                                                       AND  addData.unit = entities.id
                                                       AND addData_items.categoryType = 2
                                                       ORDER BY addData_items.value DESC");

            $this->start = $this->start + $this->range;

//        }

//        $this->common_outcomes['range_max'] = (int) $this->end;
        return $this->common_outcomes;
    }


}










