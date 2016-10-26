@extends('layouts.home')

@section('center')
<main>
    <section class="innerPage">
        <div class="header">
            <div class="wrapper">
                <h1>ადგილობრივი თვითმმართველობის ბიუჯეტი</h1>
                <div class="select">
                    <label for="Year">აირჩიეთ წელიწადი:</label>
                    <select id="Year">
                        @foreach ($selector as $years)
                        <?php $activator = $years->year == Request::segment(3) ? 'selected' : '';   ?>
                        <option value="{{$years->year}}" {{$activator}}>{{$years->year}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <article class="diagram" id="mainchart">
            <div class="wrapper">
                <div class="ch">
                    <div class="area">
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column"></div>
                    </div>
                    <div class="Lpoint"></div>
                    <div class="Rpoint"></div>
                    <div class="line"></div>
                </div>
            </div>
        </article>
        <section class="avarageCosts">
            <div class="wrapper">
                <h2>მოძებნეთ სასურველი მუნიციპალიტეტი</h2>
                <div class="search">
                  <select id="stylizer">
                      @foreach ($self_governing as $governing)
                      <option value="{{$governing->id}}">{{$governing->name}}</option>
                          @endforeach
                  </select>

                </div>
                <h2>მუნიციპალიტეტების საერთო ხარჯები არჩეული წლისათვის</h2>
                <section class="categories">
                    @foreach ($common_mtavari as $mtavari)

                     <?php $common_qve = DB::select("SELECT subcat.mainCategory as subMain,subcat.catId,subcat.name, subcat.id, addData_items.addData_id, addData_items.id, addData_items.subcat_id, addData_items.value
                                                    FROM subcat
                                                    LEFT JOIN addData_items
                                                    ON subcat.id = addData_items.subcat_id
                                                    WHERE subcat.catId = $mtavari->Subcat_ID
                                                    AND addData_items.addData_id = $mtavari->addData_Id");?>

                        <?php if ($mtavari->value != "0") : ?>
                         <article id="{{$mtavari->joli_id}}">
                             <h3 class="cattitle1">{{$mtavari->name}}</h3>
                             <div class="img"><img src="{{URL::asset('uploads/icons/'.$mtavari->icon)}}"> </div>
                             <span class="cost">{{round($mtavari->value / 1000000, 1)}} მლნ</span>
                             <div class="tooltip">
                                 <span class="before"></span>
                                 <h3 class="cattitle2">{{$mtavari->name}}</h3>
                                 <div class="diagram" id="asd">
                                 </div>
                                 <h3>ხარჯების დეტალური განშლა</h3>
                                 @foreach ($common_qve as $qve)
                                     @if ($qve->value != "0")
                                     <div class="info"><span>{{$qve->name}}</span><span>{{number_format($qve->value)}} მლნ</span></div>
                                     @endif
                                 @endforeach
                             </div>
                         </article>
                        <?php endif; ?>
                @endforeach
                </section>
            </div>
        </section>
    </section>
</main>
@endsection