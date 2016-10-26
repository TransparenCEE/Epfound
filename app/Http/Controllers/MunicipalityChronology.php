<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
class MunicipalityChronology extends Controller
{

    public $range;
    public $start;
    public $end;
    public $chartFiles = array();
    public $common_outcomes = [];



    public function index(Request $request, $unit = "", $year = 2015)
    {

        if (isset($_GET['m'])) {
            $unit = $_GET['m'];

            $outcomes_byYear = DB::select("SELECT a.outcome,a.scheduled_costs,a.year,b.name,a.income
                                       FROM `addData` a, `entities` b
                                       WHERE a.unit = $unit
                                       AND a.unit = b.id
                                       ORDER BY a.year ASC");

            $outcomes_byYear['min_year'] = $outcomes_byYear[0]->year;
            $MAX = count($outcomes_byYear) - 2;
            $outcomes_byYear['max_year'] = $outcomes_byYear[$MAX]->year;

            $MIN_MAX = DB::select("SELECT DISTINCT CAST(MAX(addData.outcome) AS UNSIGNED) as max_outcome, CAST(MIN(addData.outcome) AS UNSIGNED) as min_outcome,
                               CAST(MAX(addData.scheduled_costs) AS UNSIGNED) as scheduled_MAX, MIN(addData.scheduled_costs) as scheduled_min
                              FROM addData 
                              WHERE addData.unit = $unit 
");
            $outcomes_byYear['MIN_AND_MAX'] = $MIN_MAX;
//        END OF TOP SECTION

            return $outcomes_byYear;
        }

        if (isset($_GET['b'])) {
            $unit = $_GET['b'];
            $scheduled_outcome = DB::select("SELECT a.outcome,a.scheduled_costs,a.year 
                                         FROM `addData` a, `entities` b WHERE a.year = 2015 
                                         AND mainCategory = 2
                                          AND unit = $unit
                                         AND a.unit = b.id");


            return $scheduled_outcome;
        }

//        GREEN CHART

        if (isset($_GET['bottom'])) {
            $year = $_GET['bottom'];
            $unit = $_GET['j'];

            $bottom_chart_minincome = DB::select("SELECT addData_items.value as min_income
                                                  FROM addData_items, subcat, addData
                                                  WHERE addData_items.categoryType = 1
                                                  AND addData_items.subcat_id = subcat.id 
                                                  AND subcat.catId = 0 
                                                  AND addData.year = $year 
                                                  AND addData_items.addData_id = addData.id 
                                                  AND addData.unit = $unit
                                                  ORDER BY addData_items.value ASC");

            $this->chartFiles['green_rows'] = count($bottom_chart_minincome);


            $bottom_chart_maxincome = DB::select("SELECT max(addData_items.value) as max_income, addData.income
                                                  FROM addData_items, subcat, addData
                                                  WHERE addData_items.categoryType = 1
                                                  AND addData_items.subcat_id = subcat.id 
                                                  AND subcat.catId = 0 
                                                  AND addData.year = $year
                                                  AND addData_items.addData_id = addData.id 
                                                  AND addData.unit = $unit");
            $this->chartFiles['green_total_income'] = $bottom_chart_maxincome[0]->income;



            $this->chartFiles['shemosavali']['GREEN'] = DB::select("SELECT addData_items.value as min_income, subcat.name
                                              FROM addData_items, subcat, addData
                                              WHERE addData_items.categoryType = 1
                                              AND addData_items.subcat_id = subcat.id 
                                              AND subcat.catId = 0 
                                              AND addData.year = $year 
                                              AND addData_items.addData_id = addData.id 
                                              AND addData.unit = $unit
                                              ORDER BY addData_items.value ASC");


            // RED CHART
            // * RED CHART
            $red_chart_minincome = DB::select("SELECT addData_items.value as min_income
                                              FROM addData_items, subcat, addData
                                              WHERE addData_items.categoryType = 2
                                              AND addData_items.subcat_id = subcat.id 
                                              AND subcat.catId = 0 
                                              AND addData.year = $year 
                                              AND addData_items.addData_id = addData.id 
                                              AND addData.unit = $unit
                                              ORDER BY addData_items.value ASC");
            $this->chartFiles['red_rows'] = count($bottom_chart_minincome);


            $red_chart_maxincome = DB::select("SELECT max(addData_items.value) as max_income, addData.outcome
                                                  FROM addData_items, subcat, addData
                                                  WHERE addData_items.categoryType = 2
                                                  AND addData_items.subcat_id = subcat.id 
                                                  AND subcat.catId = 0 
                                                  AND addData.year = $year 
                                                  AND addData_items.addData_id = addData.id 
                                                  AND addData.unit = $unit ");
            $this->chartFiles['red_total_income'] = $red_chart_maxincome[0]->outcome;
//        $this->chartFiles['max_income'] = $bottom_chart_maxincome[0]->max_income;



            $this->chartFiles['shemosavali']['RED'] = DB::select("SELECT addData_items.value as min_income, subcat.name
                                                       FROM addData_items, subcat, addData
                                                       WHERE addData_items.categoryType = 2
                                                       AND addData_items.subcat_id = subcat.id 
                                                       AND subcat.catId = 0 
                                                       AND addData.year = $year  
                                                       AND addData_items.addData_id = addData.id 
                                                       AND addData.unit = $unit
                                                       ORDER BY addData_items.value DESC");




            return $this->chartFiles;
        }

        if (isset($_GET['joli_year'])) {
                $year = $_GET['joli_year'];
                $unit = $_GET['joli_unit'];
            return $this->details($year, $unit);
            exit();

        }

        // * --------------------------- Detailed Description

        $detaluri_shemosavlebi = DB::select("SELECT addData_items.value, subcat.id, subcat.name, addData.year 
                                                FROM addData_items, subcat, addData
                                                 WHERE addData_items.categoryType = 1
                                                  AND addData_items.subcat_id = subcat.id 
                                                  AND subcat.catId = 0 
                                                  AND addData.year = $year
                                                  AND addData_items.addData_id = addData.id 
                                                  AND addData.unit = 2");


        $detaluri_xarjebi = DB::select("SELECT addData_items.value, subcat.name, subcat.id, addData.year FROM addData_items, subcat, addData
                                         WHERE addData_items.categoryType = 2 
                                         AND addData_items.subcat_id = subcat.id 
                                         AND subcat.catId = 0 
                                         AND addData.year = $year 
                                         AND addData_items.addData_id = addData.id 
                                         AND addData.unit = $unit");

       $data['shemosavali'] = $detaluri_shemosavlebi;
       $data['xarji'] = $detaluri_xarjebi;

        $city = DB::select("SELECT name, id FROM entities WHERE catID = 2");
        $data['city'] = $city;

        $years = DB::select("SELECT DISTINCT year FROM addData WHERE mainCategory = 2");
        $data['years'] = $years;
        return view('municipality_chronology', $data);

    }

    public function municipality_expenses() {
        // TOP SECTION OF Chronology




        $outcomes_byYear = DB::select("SELECT a.outcome,a.scheduled_costs,a.year,b.name,a.income
                                       FROM `addData` a, `entities` b
                                       WHERE a.unit = 2
                                       AND a.unit = b.id
                                       ORDER BY a.year ASC");

        $outcomes_byYear['min_year'] = $outcomes_byYear[0]->year;
        $MAX = count($outcomes_byYear) - 2;
        $outcomes_byYear['max_year'] = $outcomes_byYear[$MAX]->year;

        $MIN_MAX = DB::select("SELECT DISTINCT CAST(MAX(addData.outcome) AS UNSIGNED) as max_outcome, CAST(MIN(addData.outcome) AS UNSIGNED) as min_outcome,
                               CAST(MAX(addData.scheduled_costs) AS UNSIGNED) as scheduled_MAX, MIN(addData.scheduled_costs) as scheduled_min
                              FROM addData 
                              WHERE addData.unit = 2
                            
");
      $outcomes_byYear['MIN_AND_MAX'] = $MIN_MAX;
//        END OF TOP SECTION

//        BOTTOM SECTION MOVED TO NEW METHOD
        return $outcomes_byYear;

    }

    public function income_chart($year = "")
    {


//* GREEN CHART
        $bottom_chart_minincome = DB::select("SELECT addData_items.value as min_income
                                              FROM addData_items, subcat, addData
                                              WHERE addData_items.categoryType = 1
                                              AND addData_items.subcat_id = subcat.id 
                                              AND subcat.catId = 0 
                                              AND addData.year = $year 
                                              AND addData_items.addData_id = addData.id 
                                              AND addData.unit = 2
                                              ORDER BY addData_items.value ASC
                                               ");
        $this->chartFiles['rows'] = count($bottom_chart_minincome);


        $bottom_chart_maxincome = DB::select("SELECT max(addData_items.value) as max_income, addData.income
                                                  FROM addData_items, subcat, addData
                                                  WHERE addData_items.categoryType = 1
                                                  AND addData_items.subcat_id = subcat.id 
                                                  AND subcat.catId = 0 
                                                  AND addData.year = $year
                                                  AND addData_items.addData_id = addData.id 
                                                  AND addData.unit = 2");
        $this->chartFiles['total_income'] = $bottom_chart_maxincome[0]->income;



        $this->chartFiles['shemosavali'] = DB::select("SELECT addData_items.value as min_income, subcat.name
                                              FROM addData_items, subcat, addData
                                              WHERE addData_items.categoryType = 1
                                              AND addData_items.subcat_id = subcat.id 
                                              AND subcat.catId = 0 
                                              AND addData.year = $year 
                                              AND addData_items.addData_id = addData.id 
                                              AND addData.unit = 2
                                              ORDER BY addData_items.value ASC");

        return $this->chartFiles;


    }

    public function outcome_chart($year = "") {


        // * RED CHART
        $bottom_chart_minincome = DB::select("SELECT addData_items.value as min_income
                                              FROM addData_items, subcat, addData
                                              WHERE addData_items.categoryType = 2
                                              AND addData_items.subcat_id = subcat.id 
                                              AND subcat.catId = 0 
                                              AND addData.year = $year 
                                              AND addData_items.addData_id = addData.id 
                                              AND addData.unit = 2
                                              ORDER BY addData_items.value ASC");
        $this->chartFiles['rows'] = count($bottom_chart_minincome);


        $bottom_chart_maxincome = DB::select("SELECT max(addData_items.value) as max_income, addData.outcome
                                                  FROM addData_items, subcat, addData
                                                  WHERE addData_items.categoryType = 2
                                                  AND addData_items.subcat_id = subcat.id 
                                                  AND subcat.catId = 0 
                                                  AND addData.year = $year 
                                                  AND addData_items.addData_id = addData.id 
                                                  AND addData.unit = 2 ");
        $this->chartFiles['total_income'] = $bottom_chart_maxincome[0]->outcome;
//        $this->chartFiles['max_income'] = $bottom_chart_maxincome[0]->max_income;



        $this->chartFiles['shemosavali'] = DB::select("SELECT addData_items.value as min_income, subcat.name
                                                       FROM addData_items, subcat, addData
                                                       WHERE addData_items.categoryType = 2
                                                       AND addData_items.subcat_id = subcat.id 
                                                       AND subcat.catId = 0 
                                                       AND addData.year = $year  
                                                       AND addData_items.addData_id = addData.id 
                                                       AND addData.unit = 2
                                                       ORDER BY addData_items.value ASC");

        return $this->chartFiles;
    }


    public function last_year() {
        $scheduled_outcome = DB::select("SELECT a.outcome,a.scheduled_costs,a.year 
                                         FROM `addData` a, `entities` b WHERE a.year = 2015 
                                         AND mainCategory = 2
                                          AND unit = 2015
                                         AND a.unit = b.id");


        return $scheduled_outcome;
    }

    public function details($year = "", $unit = "") {

                // main category
                $detaluri_shemosavlebi['shemosavlebi']['parent'] = DB::select("SELECT addData_items.value, subcat.id, subcat.name, addData.year 
                                                FROM addData_items, subcat, addData
                                                 WHERE addData_items.categoryType = 1
                                                  AND addData_items.subcat_id = subcat.id 
                                                  AND subcat.catId = 0 
                                                   AND addData_items.value != 0
                                                  AND addData.year = $year
                                                  AND addData_items.addData_id = addData.id 
                                                  AND addData.unit = $unit");
                 // sub cat
                foreach ($detaluri_shemosavlebi['shemosavlebi']['parent'] as $income) {
                    $subIncome = DB::select("SELECT addData_items.value, subcat.id, subcat.name, addData.year
                                                FROM addData_items, subcat, addData
                                                 WHERE addData_items.categoryType = 1
                                                  AND addData_items.subcat_id = subcat.id
                                                  AND subcat.catId != 0
                                                  AND addData.year = $year
                                                  AND subcat.catId = ".$income->id."
                                                  AND addData_items.addData_id = addData.id
                                                  AND addData.unit = $unit");

                    foreach ($subIncome as $subShemosavali) {
                        if ($subShemosavali->value != "0") {
                            $data = array('child_value' => $subShemosavali->value, 'child_name' => $subShemosavali->name, 'parent_id' => $income->id);
                            $detaluri_shemosavlebi['shemosavali_subcategory'][] = $data;
                        }

                    }


                }



                $detaluri_shemosavlebi['xarji']['parent'] = DB::select("SELECT addData_items.value, subcat.name, subcat.id, addData.year FROM addData_items, subcat, addData
                                         WHERE addData_items.categoryType = 2 
                                         AND addData_items.subcat_id = subcat.id 
                                         AND subcat.catId = 0 
                                         AND addData.year = $year 
                                          AND addData_items.value != 0
                                         AND addData_items.addData_id = addData.id 
                                         AND addData.unit = $unit");


                        foreach ($detaluri_shemosavlebi['xarji']['parent'] as $outcome) {
                            $subOutcome = DB::select("SELECT addData_items.value, subcat.id, subcat.name, addData.year
                                                                      FROM addData_items, subcat, addData
                                                                      WHERE addData_items.categoryType = 2
                                                                      AND addData_items.subcat_id = subcat.id
                                                                      AND subcat.catId != 0
                                                                      AND subcat.catId = ".$outcome->id."
                                                                      AND addData.year = $year
                                                                      AND addData_items.addData_id = addData.id
                                                                      AND addData.unit = $unit");

                    foreach ($subOutcome as $subXarji) {
                        if ($subXarji->value != "0") {
                            $data = array('child_value' => $subXarji->value, 'child_name' => $subXarji->name, 'parent_id' => $outcome->id);
                            $detaluri_shemosavlebi['xarji']['xarji_subcategory'][] = $data;
                        }
                    }
                }
                return $detaluri_shemosavlebi;

    }

}

