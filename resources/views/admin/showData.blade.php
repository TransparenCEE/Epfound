@extends('layouts.admin')




@section('rightBlock')
<section class="sub-main">
    <section class="sub-main-header">
        <h3>მმართველობის ერთეულის დამატება</h3>
    </section>

   {{-- URI Segments section --}}
    <?php
        $id = Request::segment(3);
        $mainCatSegment = Request::segment(4);
    ?>



    <form method="POST" action="{{url('admin/addData/add')}}" class="showData">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="editId" value="{{$unitData[0]->id}}" />
        <input type="hidden" name="year" value="{{$activeYear}}" />
        <input type="hidden" name="population" value="{{$unitData[0]->population}}">
        <section class="adding-style">
            <ul class="add-governance-unit-ul">

                <li>
                    <label>მმართველობის ერთეულის ტიპი:</label>
                    <select name="mainCategory">
                        <option selected>{{$mainCategory[0]->name}}</option>
                    </select>
                </li>
                <li>
                    <label>დასახელება</label>
                    <input type="text" name="unit" value="{{$entities[0]->name}}" />
                </li>
                <li>
                    <label>საკონტაქტო ელ-ფოსტა</label>
                    <input type="email" name="" value="{{$entities[0]->email}}" />
                </li>

            </ul>
            <section class="adding-style-text">
                <label>დამატებით ინფირმაცია</label>
                <textarea class="adding-style-textarea" name="text" >{{$entities[0]->text}}</textarea>
            </section>
        </section>

        <section class="municipality-data">
            <section class="municipality-data-head">
                <h3>არსებული მონაცემები</h3>
                <section class="year-bar">
                    @foreach ($unitYears as $year)
                     <?php $active = $activeYear == $year->year ? "active" : '' ?>
                    <a href="{{url("admin/showdata/$id/$mainCatSegment/$year->year")}}" class="<?=$active?>">{{$year->year}}</a>
                    @endforeach
                </section>
            </section>


            <section class="municipality-block">

                <section class="block-head" name="outcome">
                    <span>ხარჯები</span>
                    <span>{{substr(chunk_split($unitData[0]->outcome, 3, ','), 0, -1)}}₾</span>
                    <li class="edit">ხარჯები: <input type="text" name="outcome" value="{{substr(chunk_split($unitData[0]->outcome, 3, ','), 0, -1)}}"></li>
                </section>

                {{-- SELECTING subcats WHERE catId = NULL --}}



                <section class="municipality-sub-block">
                    <? //echo '<pre>'; print_r($items_xarji); echo '</pre>'; ?>
                    @foreach($items_xarji as $xarji)
                        <?php  $mainSubcat = DB::select("SELECT subcat.mainCategory as subMain,subcat.catId,subcat.name, subcat.id as y, addData_items.addData_id, addData_items.id, addData_items.subcat_id, addData_items.value
                                                         FROM subcat
                                                         LEFT JOIN addData_items
                                                         ON subcat.id = addData_items.subcat_id AND addData_items.addData_id = $addData_selectID
                                                         WHERE subcat.catId = $xarji->Subcat_ID
                                                         "); // echo '<pre>'; print_r($mainSubcat); echo '</pre>';?>


                    <section class="datas">

                        <div class="view"><label>{{$xarji->name}}: <span> {{number_format($xarji->value)}} </span></label></div>
                        <div class="edit">{{$xarji->name}}:  <input type="text" name="xarji[][<? if($xarji->id=='') echo $xarji->Subcat_ID.'y'; else echo $xarji->id; ?>]" value="{{number_format($xarji->value)}}" /></div>

                        <ul>
                        @foreach($mainSubcat as $subItem)
                            <li class="view">{{$subItem->name}}: <span>{{number_format($subItem->value)}}</span></li>
                            <li class="edit">{{$subItem->name}}: <input type="text" name="xarji[][<? if($subItem->id=='') echo $subItem->y.'y'; else echo $subItem->id; ?>]" value="{{number_format($subItem->value)}}"></li>
                            @endforeach
                        </ul>
                    </section>

                        @endforeach



            </section>


            <section class="municipality-block">

                <section class="block-head">
                    <span>შემოსავლები</span>
                    <span>{{substr(chunk_split($unitData[0]->income, 3, ','), 0, -1)}}₾</span>
                    <li class="edit">შემოსავლები: <input type="text" name="income" value="{{substr(chunk_split($unitData[0]->income, 3, ','), 0, -1)}}"></li>
                </section>

                <section class="municipality-sub-block">
                    <? //echo '<pre>'; print_r($items_xarji); echo '</pre>'; ?>

                    @foreach($items_shemosavali as $shemosavali)
                    <?php  $mainSubcat = DB::select("SELECT subcat.mainCategory as subMain,subcat.catId,subcat.name, subcat.id as y, addData_items.id, addData_items.subcat_id, addData_items.value
                                                         FROM subcat
                                                         LEFT JOIN addData_items
                                                         ON subcat.id = addData_items.subcat_id AND addData_items.addData_id = $addData_selectID
                                                         WHERE subcat.catId = $shemosavali->Subcat_ID
                                                        "); //echo '<pre>'; print_r($mainSubcat); echo '</pre>';?>


                    <section class="datas">
                        <div class="view"> <label>{{$shemosavali->name}}: <span> {{number_format($shemosavali->value)}} </span></label></div>
                        <div class="edit">{{$shemosavali->name}}:  <input type="text" name="shemosavali[][<? if($shemosavali->id=='') echo $shemosavali->Subcat_ID.'y'; else echo $shemosavali->id; ?>]" value="{{number_format($shemosavali->value)}}" /></div>

                        <ul>
                            @foreach($mainSubcat as $subItem)
                            <li class="view">{{$subItem->name}}: <span>{{number_format($subItem->value)}}</span></li>
                            <li class="edit">{{$subItem->name}}: <input type="text" name="shemosavali[][<? if($subItem->id=='') echo $subItem->y.'y'; else echo $subItem->id; ?>]" value="{{number_format($subItem->value)}}"></li>
                            @endforeach
                        </ul>
                    </section>

                    @endforeach



                </section>

            </section>


            <section class="municipality-block">

                <section class="block-head">
                    <span>მოსახლეობა</span>
                    <span>{{substr(chunk_split($unitData[0]->population, 3, ','), 0, -1)}}</span>
                    <li class="edit">მოსახლეობა: <input type="text" name="population" value="{{substr(chunk_split($unitData[0]->population, 3, ','), 0, -1)}}"></li>
                </section>

                @if ($mainCatSegment != 5)
                <section class="block-head">
                <span>დაგეგმილი ხარჯი</span>
                <span>{{substr(chunk_split($unitData[0]->scheduled_costs, 3, ','), 0, -1)}}</span>
                <li class="edit">დაგეგმილი ხარჯი: <input type="text" class="formattedNumberField" name="scheduled" value="{{substr(chunk_split($unitData[0]->scheduled_costs, 3, ','), 0, -1)}}" /></li>

                <span>არაკლასიფიცირებული ხარჯები</span>
                <span>{{substr(chunk_split($unitData[0]->unclassified, 3, ','), 0, -1)}}</span>
                <li class="edit">არაკლასიფიცირებული ხარჯები: <input type="text" name="unclassified" class="formattedNumberField" value="{{substr(chunk_split($unitData[0]->unclassified, 3, ','), 0, -1)}}" /></li>

                </section>
                @else

                <section class="block-head">
                <span>სახელმწიფო ბიუჯეტის დეფიციტი</span>
                <span>{{substr(chunk_split($unitData[0]->budget_deficit, 3, ','), 0, -1)}}</span>
                <li class="edit">სახელმწიფო ბიუჯეტის დეფიციტი:<input type="text" name="budget_deficit" class="formattedNumberField" value="{{substr(chunk_split($unitData[0]->budget_deficit, 3, ','), 0, -1)}}" /></li>
                </section>

                <section class="block-head">
                <span>უმუშევრობის დონე</span>
                <span>{{$unitData[0]->unemployment_level}}</span>
                <li class="edit">უმუშევრობის დონე: <input type="text" name="unemployment_level" class="formattedNumberField" value="{{$unitData[0]->unemployment_level}}" /></li>
                </section>

                <section class="block-head">
                <span>ვალი წლის დასასრულს</span>
                <span>{{substr(chunk_split($unitData[0]->country_debt, 3, ','), 0, -1)}}</span>
                 <li class="edit">ვალი წლის დასასრულს: <input type="text" name="country_debt" class="formattedNumberField" value="{{substr(chunk_split($unitData[0]->country_debt, 3, ','), 0, -1)}}" /></li>
                </section>

                <section class="block-head">

                <span>მთლიანი შიდა პროდუქტი</span>
                <span>{{substr(chunk_split($unitData[0]->overall_product, 3, ','), 0, -1)}}</span>
                <li class="edit">მთლიანი შიდა პროდუქტი: <input type="text" name="overall_product" class="formattedNumberField" value="{{substr(chunk_split($unitData[0]->overall_product, 3, ','), 0, -1)}}" /></li>
                </section>

                <section class="block-head">

                <span>ინფლაცია</span>
                <span>{{substr(chunk_split($unitData[0]->inflation, 3, ','), 0, -1)}}</span>
                <li class="edit">ინფლაცია: <input type="text" name="inflation" class="formattedNumberField" value="{{substr(chunk_split($unitData[0]->inflation, 3, ','), 0, -1)}}" /></li>
                    </section>
                <section class="block-head">

            <section class="block-head">
                <span>დაგეგმილი ხარჯი</span>
                <span>{{substr(chunk_split($unitData[0]->scheduled_costs, 3, ','), 0, -1)}}</span>
                <li class="edit">დაგეგმილი ხარჯი: <input type="text" class="formattedNumberField" name="scheduled" value="{{substr(chunk_split($unitData[0]->scheduled_costs, 3, ','), 0, -1)}}" /></li>


                @endif

                <section class="municipality-sub-block"></section>


            </section>
        </section>


        <section class="buttons">
            <div class="view">
                <span class="editShowData">Edit Information</span>
            </div>
            <div class="edit">
                <span class="saveShowData">Save</span>
                <span class="cancelShowData">Cancel</span>
            </div>
            {{--<button type="reset" value="">CANCEL</button>--}}
        </section>
</section>
</section>
    </form>
@endsection
<!-- ------------------- Add Governance Unit END!!! ------------- -->