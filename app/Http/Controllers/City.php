<?php

namespace App\Http\Controllers;
use Excel;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use PDO;
class City extends Controller
{
    public $result = array();
    public $range;
    public $start;
    public $end;
    public $common_outcomes;

    public function index($city = 2, $year = 2015) {


        $city_selector = DB::select("SELECT * FROM entities WHERE catID = 2");
        $data['city_selector'] = $city_selector;
        $year_selector = DB::select("SELECT DISTINCT year FROM addData WHERE `mainCategory` = 2 ORDER BY year ASC");
        $data['year_selector'] = $year_selector;

       $total_outcome = DB::select("SELECT outcome FROM `addData` WHERE year = $year AND unit = $city");
        $data['total_outcome'] = $total_outcome;



       $mainCat = DB::select("SELECT DISTINCT a.id as id, a.value, a.subcat_id as joli_id, b.icon, 
                                    b.mainCategory as subcat_mainCategory, b.name, b.id as Subcat_ID,
                                    c.mainCategory as addData_mainCategory, c.id as addData_Id, c.year
                                    FROM addData_items a, subcat b, addData c
                                    WHERE a.subcat_id = b.id
                                    AND b.catId = 0
                                    AND a.addData_id = c.id
                                    AND a.categoryType = 2
                                    AND b.mainCategory = 2
                                    AND c.unit = $city
                                    AND c.mainCategory = 2
                                    AND c.year = $year
                                    GROUP BY b.name");

        if (!empty($mainCat)) {
            $data['mainCat'] = $mainCat;
        } else {
            $data['mainCat'] = array();
        }

        DB::setFetchMode(PDO::FETCH_ASSOC);
        $data = DB::select(" SELECT subcat.name, addData.year, addData_items.value FROM subcat, addData, addData_items
                                                    WHERE addData_items.subcat_id = subcat.id
                                                    AND addData_items.addData_id = addData.id
                                                    AND subcat.id = 73
                                                    AND addData.mainCategory = 2
                                                    AND addData_items.categoryType = 2
                                                    AND subcat.categoryType = 2
                                                    AND addData_items.value != 0
                                                    AND addData.unit = 9
                                                    ORDER BY addData.year ASC
                                                    ");
        DB::setFetchMode(PDO::FETCH_CLASS);

        $year_excel = [];
        foreach ($data as $key => $value) {
     $year_excel[$key] =  $data[$key]['year'];
}
//        print_r($year_excel); die();
        Excel::create('Filename', function($excel) use($year_excel){

            $excel->setCreator('Epfound.ge');
            $excel->setTitle('Budget Monitoring Platform');


   
            $excel->sheet('testingg', function($sheet) use($year_excel) {

                $sheet->setColumnFormat(array(
                    'A' => 'BUHEHE',
                    'B' => 'ZDDDD',
                    'C' => 'aloo',
                    'D' => 'blablabla',
                ));
                    $sheet->fromArray($year_excel);

            });



        })->download('xls');

        return view('city_index', $data);
    }


    public function city_expenses_API() {

    }

    public function city_outcomes_API($subID, $unit)
    {
//        $this->common_outcomes = DB::select("SELECT  subcat.mainCategory as subMain, subcat.catId,subcat.name,  subcat.id, addData_items.addData_id,
//                                      addData_items.id, addData_items.subcat_id, addData_items.value
//                             FROM subcat
//                             LEFT JOIN addData_items
//                             ON subcat.id = addData_items.subcat_id
//                             WHERE subcat.catId = $subID
//                             AND addData_items.addData_id = $itemsID
//                             ORDER BY addData_items.value ASC");
//
//
//        $max_index = count($this->common_outcomes) - 1 ;
//        $this->common_outcomes['range_max'] = $this->common_outcomes[$max_index]->value;
//        $this->common_outcomes['MINIMAL-VALUE'] = $this->common_outcomes[0]->value;
//        $this->common_outcomes['count'] = count($this->common_outcomes) - 2;
//
//        if (count($this->common_outcomes) > 20) {
//
//            $this->range = ($this->common_outcomes['range_max'] -  $this->common_outcomes['MINIMAL-VALUE']) / 20;
//            $this->common_outcomes['range_min'] = $this->range;
//        } else {
//            $this->range = ($this->common_outcomes['range_max'] - $this->common_outcomes['MINIMAL-VALUE']) / (count($this->common_outcomes) - 3);
//            $this->common_outcomes['range_min'] = $this->range;
//        }
//
//        $this->start = $this->common_outcomes['MINIMAL-VALUE'];
//
//
//        for ($i = 0; $i < count($this->common_outcomes) - 4; $i++) {
//
//
//
//            if ($i == 0) { $this->end = $this->end + $this->range + $this->common_outcomes['MINIMAL-VALUE']; } else { $this->end = $this->end + $this->range; }
//            if ($i == (count($this->common_outcomes) - 4)) $this->end = $this->common_outcomes['range_max'];


            $this->common_outcomes = DB::select(" SELECT subcat.name, addData.year, addData_items.value FROM subcat, addData, addData_items
                                                    WHERE addData_items.subcat_id = subcat.id
                                                    AND addData_items.addData_id = addData.id
                                                    AND subcat.id = $subID
                                                    AND addData.mainCategory = 2
                                                    AND addData_items.categoryType = 2
                                                    AND subcat.categoryType = 2
                                                    AND addData_items.value != 0
                                                    AND addData.unit = $unit
                                                    ORDER BY addData.year ASC
                                                      ");
            return $this->common_outcomes;
//            $this->start = $this->start + $this->range;

//        }

        $this->common_outcomes['range_max'] = (int) $this->end;
        return $this->common_outcomes;
    }

}




