@extends('layouts.home')

@section('center')

    <main>
        <section class="expances">
            <div class="header">
                <div class="wrapper">
                    <div class="h">
                        <h2>მუნიციპალიტეტის ხარჯების ქრონოლოგია</h2>
                        <div class="select">
                            <label for="Year">აირჩიეთ მუნიციპალიტეტი:</label>
                            <select id="chronology">
                                @foreach ($city as $cities)
                                    <?php if (Request::segment(3) == $cities->id) $active = "selected"; else $active = ""; ?>
                                <option value="{{$cities->id}}" {{$active}}>{{$cities->name}}</option>
                               @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="clear"></div>
                    <div class="chartplace">
                        <div class="left">
                            <span class="title">თბილისი</span>
                            <div id="splinechart"></div>
                        </div>
                        <div class="right">
                            <span class="title">გასული წლის ბიუჯეტი</span>
                            <div class="lastyear">
                                <div class="cont">
                                    <div id="dagegmili"></div>
                                    <div id="gaxarjuli"></div>
                                </div>
                                <div class="desc">
                                    <span>დაგეგმილი</span>
                                    <span>დახარჯული</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="wrapper">
                    <div class="info">
                    <p class="shenishvna">„ხარჯი“ გულისხმოს „სახელმწიფო ბიუჯეტის შესრულებას ფუნქციონალურ ჭრილში“</p>
                    <p class="shenishvna">„სახელმწიფო ბიუჯეტის შესრულება ფუნქციონალურ ჭრილში“ დათვლილია არაფინანსური აქტივების ცვლილების ჩათვლით</p>
                    <p class="shenishvna">ინფორმაცია მიმდინარე საბიუჯეტო წლის შესახებ არ არის ხელმისაწვდომი, რადგანაც ვებ-გვერდზე ასახული მონაცემები ეყრდნობა საბიუჯეტო წლის ბოლოს არსებული ფაქტობრივი ხარჯვის ანგარიშებს, და არა წინასწარ საბიუჯეტო გეგმას. </p>
<p class="shenishvna">ინფორმაციის ნაკლებობა 2014 წლამდე არსებული მონაცემების შესახებ განპირობებულია ადგილობრივი თვითმმართველობის კოდექსში, 2014 წლის 5 თებერვალს, საქართველოს პარლამენტის მიერ დამტკიცებული ცვლილებებით. ცვლილებების შედეგად, 7 ქალაქს (თელავი, ოზურგეთი, ზუგდიდი, ამბროლაური, გორი, მცხეთა და ახალციხე) მიენიჭა თვითმმართველი ქალაქის სტატუსი, ხოლო მათი მიმდებარე სოფლებისგან შეიქმნა მუნიციპალიტეტები (თვითმმართველი თემი). შედეგად, შეიქმნა ახალი თვითმმართველი ერთეულები, რომლებსაც საკუთარი ბიუჯეტი მხოლოდ 2014 წლიდან აქვთ. 2010-2013 წლების მონაცემები მოიცავს გაერთიანებულ ხარჯებს, ხოლო 2014 წლიდან - მხოლოდ თვითმმართველი ქალაქის ხარჯებს (რაც მოიცავს მხოლოდ ნახევარი წლის ხარჯებს, იმ მომენტიდან, როდესაც შეიქმნა თვითმმართველი ქალაქი).
</p>
<p class="shenishvna">საქართველოს კანონმდებლობით, საბიუჯეტო წელი  ემთხვევა კალენდარულ წელს. „დაგეგმილი“ ბიუჯეტი ასახავს საბიუჯეტო წლის დასაწყისში დაგეგმილ ბიუჯეტს, რომელშიც  წლის განმავლობაში გარკვეული ცვლილებები შედის. „დახარჯული“ ბიუჯეტი ასახავს საბიუჯეტო წლის ბოლოს არსებულ ფაქტობრივ დანახარჯებს, რაც, შესაძლოა, ზუსტად არ ემთხვეოდეს დაგეგმილს. ინფორმაცია დაგეგმილი ბიუჯეტის შესახებ მოწოდებულია 2016 წლის ივნისში გამოთხოვნილი საჯარო ინფორმაციის მდგომარეობით. </p>
<p class="shenishvna">ადგილობრივი თვითმმართველობის ბიუჯეტის შემოსავლები მოიცავს არასაკუთარ შემოსულობებს (კერძოდ, კაპიტალურ, სპეციალურ და მიზნობრივ ტრანსფერებს სახელმწიფო ბიუჯეტიდან) და საკუთარ შემოსულობებს (იხ. ადგილობრივი თვითმმართველობის კოდექსი, მუხლი 92 - <a href="https://matsne.gov.ge/ka/document/view/2244429" target="_blank">https://matsne.gov.ge/ka/document/view/2244429</a>)</p></div>
                </div>
            </div>
            <section class="dd">
                <div class="wrapper">

                    <div class="h">
                        <h2>შემოსავლები და ხარჯები</h2>
                        <div class="year">
                            <span class="selecty">აირჩიეთ წელიწადი:</span>
                            <select id="selectx">
                                @foreach ($years as $year)
                                    <?php if ($year->year == 2015) $active = "selected"; else $active = "" ?>
                                <option value="{{$year->year}}" {{$active}}>{{$year->year}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="desc">
                        <div class="h">
                            <div class="tabs">
                                <span class="active">მოკლე მიმოხილვა</span>
                                <span class="details">დეტალური აღწერა</span>
                            </div>
                            <div class="switcher">
                                <span class="active">შემოსავლები</span>
                                <span>ხარჯები</span>
                                <div class="bg"></div>
                            </div>
                        </div>
                        <article class="active">
                            <h2>შემოსავლები</h2>
                            <div id="grad1">
                                <div class="grad"></div>
                            </div>
                            <h2>ხარჯები</h2>
                            <div id="grad2">
                                <div class="grad"></div>
                            </div>
                        </article>

                        <article class="expances">
                            <div class="income active" id="incomeacordeon">
                                <ul class="first">



                                    @foreach($shemosavali as $income)
                                        @if ($income->value != "0")
                                    <li>{{$income->name}} <span class="amount">{{number_format($income->value)}} ლარი</span>
                                        @endif
                                        <ul>


                                            <?php
                                            $subIncome = DB::select("SELECT addData_items.value, subcat.id, subcat.name, addData.year
                                                FROM addData_items, subcat, addData
                                                 WHERE addData_items.categoryType = 1
                                                  AND addData_items.subcat_id = subcat.id
                                                  AND subcat.catId != 0
                                                  AND addData.year = 2015
                                                  AND subcat.catId = ".$income->id."
                                                  AND addData_items.addData_id = addData.id
                                                  AND addData.unit = 2");
                                            ?>

                                            @foreach ($subIncome as $subShemosavali)
                                                    @if ($subShemosavali->value != "0")
                                            <li>{{$subShemosavali->name}} <span class="amount">{{number_format($subShemosavali->value)}} ლარი</span></li>
                                                    @endif
                                                @endforeach

                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="expances">
                                <ul class="first">
                                        <?php if (isset($_GET['s'])); ?>
                                    @foreach($xarji as $outcome)
                                        @if($outcome->value != 0)
                                    <li>{{$outcome->name}}  <span class="amount">{{number_format($outcome->value)}} ლარი</span>
                                        @endif
                                        <li>

                                            <?php

                                            $subOutcome = DB::select("SELECT addData_items.value, subcat.id, subcat.name, addData.year
                                                                      FROM addData_items, subcat, addData
                                                                      WHERE addData_items.categoryType = 2
                                                                      AND addData_items.subcat_id = subcat.id
                                                                      AND subcat.catId != 0
                                                                      AND subcat.catId = ".$outcome->id."
                                                                      AND addData.year = 2015
                                                                      AND addData_items.addData_id = addData.id
                                                                      AND addData.unit = 2");

                                                ?>
                                            @foreach ($subOutcome as $subXarji)
                                                @if ($subXarji->value != "0")
                                                    <li> <ul> {{$subXarji->name}} <span class="amount">{{number_format($subXarji->value)}} ლარი</span></ul></li>
                                                    @endif
                                                @endforeach
                                        </li>
                                    </li>
                                        @endforeach
                                </ul>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </section>
    </main>


@endsection