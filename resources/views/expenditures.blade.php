@extends('layouts.home')

@section('center')

    <main>
        <section class="expenditures">
            <div class="wrapper">
                <div class="h">
                    <h3>სახელმწიფო ხარჯების ქრონოლოგია</h3>
                    <div class="select">
                        <label for="year">აირჩიეთ წელიწადი:</label>
                        <select id="exp_year">
                            @foreach($years as $year)
                                <?php if(Request::segment(3) == $year->year) $active = "selected"; else $active = ""; ?>
                            <option {{$active}}>{{$year->year}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <section class="categories" >
                    @foreach ($getData as $country)
                    <article id="{{$country->joli_id}}">
                        <h3 >{{$country->name}}</h3>
                        <div class="img"><img src="{{URL::asset('uploads/icons/'.$country->icon)}}"> </div>
                        <span class="cost">{{number_format($country->value)}} ლარი</span>
                        <div class="tooltip">
                            <span class="before"></span>
                            <div class="h">
                                <h3>{{$country->name}}</h3>
                                <span>ხარჯი <img src="{{URL('assets/images/yellowline.png')}}" alt=""></span>
                            </div>
                            <div class="diagram" id="chart{{$country->joli_id}}">
                            </div>
                            <div class="table">

                                <?php

                                $subcats = DB::select("SELECT a.id as id, a.value, b.name, b.id as Subcat_ID,c.year
                                   FROM addData_items a, subcat b, addData c
                                   WHERE a.subcat_id = b.id
                                   AND a.addData_id = c.id
                                   AND b.catId = 0
                                   AND a.categoryType = 2
                                   AND b.mainCategory = 5
                                   AND b.id = $country->joli_id
                                   GROUP by a.id");

                              ?>
                                <div class="rows caption">
                                    <div></div>
                                    @foreach ($subcats as $year)
                                        <div>{{$year->year}}</div>
                                    @endforeach
                                </div>
                                <div class="rows">
                                    <div>ხარჯი</div>

                                    @foreach ($subcats as $value)
                                        <div>{{number_format($value->value)}}</div>
                                    @endforeach
                                </div>
                                    <?php
                                        $rows = count($subcats);
                                        for ($k = 0; $k <= $rows; $k = $k+1){
                                            if ($k == 5) break;
                                        $changes[] = round(($subcats[$k+1]->value - $subcats[$k]->value) / max($subcats[$k]->value,$subcats[$k+1]->value ) * 100,2);

                                        }

                                    ?>
                                <div class="rows">
                                    <div>წლიური ცვლილება</div>
                                  <?php $count = 1; foreach  ($changes as $key) : ?>
                                    @if ($count == 1) <div> </div> @endif
                                    <?php $count++; ?>
                                    <div>{{$key}}%</div>
                                        <?php unset($changes); ?>
                                        <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                        @endforeach
                </section>
            </div>
        </section>
    </main>


@endsection