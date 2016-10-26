@extends('layouts.admin')


    @section('rightBlock')

    <?php

    $segment = Request::segment(3);
    ?>


        <section class="sub-main">

            <section class="sub-main-header">
                <h3>მონაცემების დამატება</h3>

                <section class="data-bar">

                        @foreach ($mainCategory as $value)
                        <?php if ($value->id == $segment) { $active = 'background:#5ccdde;color:#fff;'; } else {$active = '';} ?>

                        <a href="/admin/addData/{{$value->id}}" style="{{$active}}">{{$value->name}}</a>
                        @endforeach
                </section>
            </section>
        <!-- -------------------- Add Data ------------------------- -->

        

    {{Form::open(array("url" => "admin/addData/add/", 'files' => true)) }}
    <input type="hidden" name="mainCategory" value="<?=$segment?>"/>
                <section class="adding-style">
                    <ul class="add-data-ul">

                        <li>
                            <label>აირჩიეთ ერთეული:</label>
                            <select name="unit" id="unit">
                                @foreach ($entities as $value)
                                     <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <label>აირჩიეთ წელიწადი: <? echo date('Y')?> <span id="alertYear" style="color:red" ></span></label>
                            <select name="year" id="year" required>
                                    <option>-- წელიწადი --</option>
                                    @for($i=2010;$i<=date('Y')+1;$i++)
                                        <option >{{$i}}</option>
                                    @endfor
                            </select>
                        </li>
                        <li>
                            <label>მონაცემთა ფაილი:</label>
                            <section>
                                <input type="text" name="" class="filetext" value="" />
                                <label for="data-file" class="browse-data" id="vax">BROWSE</label>
                                <input type="file" name="uploadFile" value="" id="data-file" />
                            </section>
                        </li>

                    </ul>
                    <section class="adding-style-text">
                        <label>დამატებით ინფირმაცია</label>
                        <textarea name="text" class="adding-style-textarea"></textarea>
                    </section>
                 </section>

            <section class="expenses-revenues">
                <section class="expenses">
                    <ul class="expenses-revenues-heading-ul">
                        <li><h4>ხარჯები არჩეული პერიოდისათვის და ერთეულისათვის</h4></li>
                        <li>
                            <label>სრული ხარჯი</label>
                            <input type="text" name="outcome" class="formattedNumberField" value="" />
                        </li>
                    </ul>



 

                    {{------------------------- Municipalities Category --------------------------}}
                    <?php $querySubcat_xarji = DB::select("SELECT * FROM `subcat` WHERE catId != 0 AND categoryType = 2 ORDER BY catId ASC"); ?>


                    @foreach ($subCat_xarji as $subCats)
                    <ul class="expenses-revenues-shablon"> 

                        <li><h5>{{$subCats->name}}</h5></li>

                        <li><label>სრული ხარჯი</label><input type="text" name="xarji[][{{$subCats->id}}]" class="formattedNumberField" value="" /></li>
                        @foreach ($querySubcat_xarji as $subitems_xarji)
                            @if ($subitems_xarji->catId == $subCats->id)

                            <li><label>{{$subitems_xarji->name}}</label><input type="text" name="xarji[][{{$subitems_xarji->id}}]" class="formattedNumberField" value="" /></li>
                            
                            @endif
                        @endforeach
                    </ul>
                    @endforeach
                </section>


                <section class="revenues">
                    <ul class="expenses-revenues-heading-ul">
                        <li><h4>შემოსავლები არჩეული პერიოდისათვის და ერთეულისათვის</h4></li>
                        <li>
                            <label>სრული შემოსავალი</label>
                            <input type="text" name="income" class="formattedNumberField" value="" />
                        </li>
                    </ul>





                    {{------------------------- Municipalities Category --------------------------}}
                    <?php $querySubcat_shemosavali = DB::select("SELECT * FROM `subcat` WHERE catId != 0 AND categoryType = 1 ORDER BY catId ASC"); ?>


                    @foreach ($subCat_shemosavali as $subCats)
                    <ul class="expenses-revenues-shablon">

                        <li><h5>{{$subCats->name}}</h5></li>

                        <li><label>სრული შემოსავალი</label><input type="text" name="shemosavali[][{{$subCats->id}}]" class="formattedNumberField" value="" /></li>
                        @foreach ($querySubcat_shemosavali as $subitems_shemosavali)
                            @if ($subitems_shemosavali->catId == $subCats->id)

                            <li><label>{{$subitems_shemosavali->name}}</label><input type="text" name="shemosavali[][{{$subitems_shemosavali->id}}]" class="formattedNumberField" value="" /></li>
                            
                            @endif
                        @endforeach
                    </ul>
                    @endforeach

                </section>
            </section>
            <section class="population-count">
                <label>მოსახლეობის რაოდენობა</label>
                <input type="text" name="population" class="formattedNumberField" value="" />


            @if ($segment != 5)

                <label>დაგეგმილი ხარჯი</label>
                <input type="text" class="formattedNumberField" name="scheduled" value="" />
                 <label>არაკლასიფიცირებული ხარჯები</label>
                <input type="text" class="formattedNumberField" name="unclassified" value="" />

            @else
                    <label>შემოსავლები სახელმწიფო ბიუჯეტში</label>
                    <input type="text" name="govern_incomes" class="formattedNumberField" value="" />
                    <label>სახელმწიფო ბიუჯეტის დეფიციტი</label>
                    <input type="text" name="budget_deficit" class="formattedNumberField" value="" />
                    <label>უმუშევრობის დონე</label>
                    <input type="text" name="unemployment_level" class="formattedNumberField" value="" />
                    <label>ვალი წლის დასასრულს</label>
                    <input type="text" name="country_debt" class="formattedNumberField" value="" />
                    <label>მთლიანი შიდა პროდუქტი</label>
                    <input type="text" name="overall_product" class="formattedNumberField" value="" />
                    <label>ინფლაცია</label>
                    <input type="text" name="inflation" class="formattedNumberField" value="" />
                    <label>დეფიციტი</label>
                    <input type="text" name="deficit" class="formattedNumberField" value="" />


                @endif
            </section>
            <section class="change-buttons">
                <button type="submit" value="">SAVE</button>
                <button type="reset" value="">CANCEL</button>
            </section>
        </section>
    {{ Form::close() }}



@endsection

