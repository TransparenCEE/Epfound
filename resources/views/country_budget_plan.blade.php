@extends('layouts.home')

@section('center')
<main>
    <section class="budgetplan">
        <div class="wrapper">
            <div class="h">
                <h2>როგორ გადაანაწილებდი ბიუჯეტს?</h2>
            </div>
            <section class="budgetplantable">
                @foreach ($country as $data)
                <div class="h">
                    <div>{{$data->name}}</div>
                    <div>სულ</div>
                    <div>ერთ სულ მოსახლეზე</div>
                    <div></div>
                </div>

<?php
                        $total = $data->value / $data->population;
                 $subcats =  DB::select("SELECT addData_items.value, subcat.id, subcat.name, addData.year
                    FROM addData_items, subcat, addData
                    WHERE addData_items.categoryType = 2
                    AND addData_items.subcat_id = subcat.id
                    AND subcat.catId != 0
                    AND subcat.catId = $data->subcat_id
                    AND addData.year = 2015
                    AND addData_items.addData_id = addData.id
                    AND addData.maincategory = 5"); ?>
                <div class="cont">
                    <div class="row">

                        <div>სულ</div>
                        <div>{{number_format($data->value)}} მლნ</div>
                        <div>{{round($total, 2)}} ლარი</div>
                        <div>
                            <span class="amount">{{number_format($data->value)}}</span>
                            <div class="range" data-amount="{{$data->value}}"></div>
                            <div class="skala">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="rangetext">
                                <span>0%</span>
                                <span>100%</span>
                                <span>200%</span>
                            </div>
                        </div>
                        </div>
                    @foreach ($subcats as $subcat)
                        <?php $person = $subcat->value / $data->population; ?>
                            @if ($subcat->value != "0")
                                <div class="cont">
                    <div class="row">

                        <div>{{$subcat->name}}</div>
                        <div>{{number_format($subcat->value)}} მლნ</div>
                        <div>{{round($person, 2)}} ლარი</div>
                        <div>
                            <span class="amount">{{number_format($subcat->value)}}</span>
                            <div class="range" data-amount="{{$subcat->value}}"></div>
                            <div class="skala">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="rangetext">
                                <span>0%</span>
                                <span>100%</span>
                                <span>200%</span>
                            </div>
                        </div>

                    </div>
                            @endif
                    @endforeach
                    @endforeach
                </div>
            </section>
            <input type="button" value="გამოთვლას" id="calc" name="">
        </div>
    </section>
</main>
@endsection