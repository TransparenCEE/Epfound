@extends('layouts.home')

@section('center')

<main>
    <section class="cityexpances">
        <div class="h">
            <div class="wrapper">
                <h2>თვითმმართველობის ბიუჯეტი კატეგორიებად</h2>
                <div class="select">
                    <label>მუნიციპალიტეტი</label>
                    <select id="municip">
                        @foreach ($city_selector as $city)
                        <?php if(Request::segment(3) == $city->id) $active = "selected"; else $active = ""; ?>
                        <option value="{{$city->id}}" {{$active}}>{{$city->name}}</option>
                            @endforeach
                    </select>
                    <label>წელიწადი:</label>
                    <select id="y">
                        @foreach ($year_selector as $year)
                            <?php if(Request::segment(4) == $year->year) $active = "selected"; else $active = ""; ?>
                        <option value="{{$year->year}}" {{$active}}>{{$year->year}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="m">
            <div class="wrapper">
                <p class="f">აღნიშნული წლისათვის დახარჯული თანხის სრული რაოდეობა შეადგენს</p>
                <h3>{{ isset($total_outcome[0]->outcome) ? number_format($total_outcome[0]->outcome) : 'მონაცემი ვერ მოიძებნა' }} </h3>
                <p class="s">
                    ლარს
                </p>
                <p class="t">ქვემოთ შეგიძლიათ იხილოთ თუ როგორ გადანაწილდა ეს თანხები სხვადასხვა სფეროზე</p>
                <p class="p">ინფორმაცია თვითმმართველი ერთეულების საბიუჯეტო ფონდების განაწილების შესახებ ასახავს შესაბამისი თვითმმართველი ერთეულის ფაქტობრივ ხარჯვას.</p>
            </div>
        </div>
        <section class="categories">
            <div class="wrapper">

                @foreach ($mainCat as $main)

                    <?php $common_qve = DB::select("SELECT subcat.mainCategory as subMain,subcat.catId,subcat.name, subcat.id, addData_items.addData_id, addData_items.id, addData_items.subcat_id, addData_items.value
                                                    FROM subcat
                                                    LEFT JOIN addData_items
                                                    ON subcat.id = addData_items.subcat_id
                                                    WHERE subcat.catId = $main->Subcat_ID
                                                    AND addData_items.addData_id = $main->addData_Id");?>

                    <?php if ($main->value != "0") : ?>

                <article id="{{$main->joli_id}}">
                    <h3>{{$main->name}}</h3>
                    <div class="img"><img src="{{URL::asset('uploads/icons/'.$main->icon)}}"> </div>

                    <span class="cost">{{round($main->value / 1000000, 1)}} მლნ</span>



                    <div class="tooltip">
                        <span class="before"></span>
                        <h3>{{$main->name}}</h3>
                        <div class="diagram" id="chart5">
                        </div>
                        <h3>ხარჯების დეტალური განშლა</h3>
                        @foreach ($common_qve as $qve)
                            @if ($qve->value != "0")
                            <div class="info"><span>{{$qve->name}}</span><span>{{number_format($qve->value)}} ლარი</span></div>
                            @endif
                        @endforeach

                    </div>
                </article>
                        <?php endif; ?>
                    @endforeach
            </div>
        </section>
    </section>
</main>
@endsection