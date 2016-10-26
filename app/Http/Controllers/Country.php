<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class Country extends Controller
{

    private $year1 = array();
    private $year2 = array();
    private $compared = array();

    public function index()
    {
        return view('country_compare');
    }


    public function compare($year1 = 2014, $year2 = 2015, $type = 2)
    {

        $compared = DB::select("SELECT addData.year, addData_items.value, subcat.name, subcat.id as subcat_id 
                                FROM addData, subcat, addData_items
                                WHERE addData.mainCategory = 5
                                AND (addData.year = $year1 OR addData.year = $year2)
                                AND subcat.mainCategory = 5
                                AND addData_items.categoryType = $type
                                AND subcat.id = addData_items.subcat_id
                                AND addData_items.addData_id = addData.id
                                 ORDER BY addData.year ASC, subcat.name");



        for ($i = 0; $i < count($compared); $i++) {
            if ($compared[$i]->year == $year1) {
                $this->year1[$i]['year1'] = $compared[$i]->year;
                $this->year1[$i]['name'] = $compared[$i]->name;
                $this->year1[$i]['value'] = $compared[$i]->value;
            }

            if ($compared[$i]->year == $year2) {
                $this->year2[$i]['year2'] = $compared[$i]->year;
                $this->year2[$i]['value'] = $compared[$i]->value;
                $this->year2[$i]['name'] = $compared[$i]->name;
            }

        }

        $this->year2 = array_values($this->year2);
        $this->year1 = array_values($this->year1);

         for ($i = 0; $i < count($this->year1); $i++) {
             $result = round(($this->year2[$i]['value'] - $this->year1[$i]['value']) / max($this->year2[$i]['value'], $this->year1[$i]['value']) * 100, 2);
             $this->year1[$i]['compare'] = $result;

         }


       for ($i = 0; $i < count($this->year1); $i++)
       {
           $this->year1[$i]['year2'] = $this->year2[$i]['year2'];
           $this->year1[$i]['value2'] = $this->year2[$i]['value'];
       }

        return $this->year1;


    }

    public function separeted_json($year1 = 2014, $year2 = 2015, $type = "outcome") {

        if ($year1 < $year2) $order = "ORDER BY year ASC"; else   $order = "ORDER BY year DESC";;

        $json[] = DB::select("select $type,year from addData where mainCategory = 5 AND unit = 1 AND  (year = $year1 OR year = $year2) $order");


        if ($type == "outcome") {
            if ( count($json[0]) > 1) {

                $json['compare'] = round(($json[0][1]->outcome - $json[0][0]->outcome) / max($json[0][0]->outcome, $json[0][1]->outcome) * 100, 2);

            } else {
                $json['compare'] = round(($json[0][0]->outcome - $json[0][0]->outcome) / max($json[0][0]->outcome, $json[0][0]->outcome) * 100, 2);
            }
        } else {
            if ( count($json[0]) > 1) {

                $json['compare'] = round(($json[0][1]->income - $json[0][0]->income) / max($json[0][0]->income, $json[0][1]->income) * 100, 2);

            } else {
                $json['compare'] = round(($json[0][0]->income - $json[0][0]->income) / max($json[0][0]->income, $json[0][0]->income) * 100, 2);
            }
        }


        return $json;
    }

    public function budget_chart_chronology() {
        $ByYears = DB::select("SELECT DISTINCT addData.year,  addData.outcome, addData.income,addData.budget_deficit
                        FROM `addData_items`, `addData`, `subcat`
                        WHERE addData_items.subcat_id = subcat.id
                        AND subcat.catId = 0
                        AND addData_items.addData_id = addData.id
                        AND addData.mainCategory = 5
                        GROUP BY addData.year");

        //min shemosavali
        // max xarji
        $MIN_MAX = DB::select("SELECT DISTINCT 
                             CAST(MIN(addData.outcome) AS UNSIGNED) as min_outcome,
                             CAST(MAX(addData.outcome) AS UNSIGNED) as max_outcome,
                             CAST(MIN(addData.income) AS UNSIGNED) as min_income,
                             CAST(MAX(addData.income) AS UNSIGNED) as max_income
                              FROM addData 
                              WHERE addData.mainCategory = 5");


        $ByYears['MIN_MAX'] = $MIN_MAX;

        return $ByYears;
    }


    public function expenditures($year = 2015) {


        $data['getData'] = DB::select("SELECT DISTINCT a.id as id, a.value, a.subcat_id as joli_id, b.icon, 
                                    b.mainCategory as subcat_mainCategory, b.name, b.id as Subcat_ID,
                                    c.mainCategory as addData_mainCategory, c.id as addData_Id, c.year
                                    FROM addData_items a, subcat b, addData c
                                    WHERE a.subcat_id = b.id
                                    AND b.catId = 0
                                    AND a.addData_id = c.id
                                    AND a.categoryType = 2
                                    AND b.mainCategory = 5
                                    AND c.unit = 1
                                    AND c.mainCategory = 5
                                    AND c.year = $year
                                    GROUP BY b.name");




        if (isset($_GET['lines'])) {
            $subID = $_GET['lines'];


            $lines = DB::select(" SELECT subcat.name, addData.year, addData_items.value FROM subcat, addData, addData_items
                                                    WHERE addData_items.subcat_id = subcat.id
                                                    AND addData_items.addData_id = addData.id
                                                    AND subcat.id = $subID
                                                    AND addData.mainCategory = 5
                                                    AND addData_items.categoryType = 2
                                                    AND subcat.categoryType = 2
                                                    AND addData_items.value != 0
                                                    AND addData.unit = 1
                                                    ORDER BY addData.year ASC");

            return $lines;


        }

        // if there is not get request loading view

        //year selector query

        $years = DB::select("SELECT DISTINCT `year` FROM addData WHERE mainCategory = 5 ORDER BY year DESC");
        $data['years'] = $years;
        return view('expenditures', $data);

    }


    // ---------------------------------------------------------------------------------------------------------------------------------------------------------

    public function plan() {

        $data['country'] = DB::select("SELECT addData.year,addData.outcome, addData_items.value, addData.population, subcat.name, subcat.id as subcat_id 
                                FROM addData, subcat, addData_items
                                WHERE addData.mainCategory = 5
                                AND addData.year = 2015
                                AND subcat.mainCategory = 5
                                AND subcat.categoryType = 2
                                AND addData_items.categoryType = 2
                                AND subcat.id = addData_items.subcat_id
                                AND addData_items.addData_id = addData.id");

        return view('country_budget_plan', $data);
    }

}