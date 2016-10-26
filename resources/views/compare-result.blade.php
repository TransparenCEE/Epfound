@extends('layouts.home')

@section('center')
<main>
    <section class="comparemunic2">
        <div class="wrapper">
            <div class="h">
                <h2>მუნიციპალიტეტების შედარება</h2>
            </div>
            <div class="left">
                <div class="h">
                    <div class="title" >
                        @if (count($first))
                            <h3 id="title1">{{$fentities[0]->name}}, <span id="name1"> {{$first[0]->name}}</span>, {{$first[0]->year}}</h3>
                        @else
                            <h3>მონაცემი არ მოიძებნა</h3>
                        @endif
                    </div>
                    <div class="drowpdown">
                        შეცვალე
                        <ul class="sub">
                            <li>
                                <label>მუნიციპალიტეტი:</label>
                                <select id="f1">
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                </select>
                            </li>
                            <li>
                                <label>კატეგორია:</label>
                                <select id="f2">
                                    @foreach ($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                </select>
                            </li>
                            <li>
                                <label>წელიწადი:</label>
                                <select id="f3">
                                    @foreach ($years as $year)
                                        <option value="{{$year->year}}">{{$year->year}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>
                                <input type="button" value="OK">
                            </li>
                        </ul>
                    </div>
                </div>

                @if (count($first))
                    <div class="tablecont">
                <table>
                    <thead>
                    <tr>
                        <td>სრული ხარჯი: </td><td id="val1" data-val="{{$first[0]->value}}">{{number_format($first[0]->value)}} ლარი</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($fsubcats as $first_sub)
                    <tr>
                        @if ($first_sub->value != "0")
                        <td>{{$first_sub->name}} </td>
                        <td>{{number_format($first_sub->value)}} ლარი</td>
                            @endif

                    </tr>
                    @endforeach
                    </tbody>
                </table>
                        </div>
                @else
                    <h4>მონაცემი არ არსებობს</h4>
                @endif
                <div class="donatchart">
                    <span class="title">პროცენტული შედარება ბიუჯეტთან:</span>
                    <div id="donat1">

                    </div>

                    <div class="desc">
                        სრული ბიუჯეტი:
                        @if (isset($first[0]->outcome) && isset($fpercent))
                        <span  class="val">{{!isset($first[0]->outcome) ? "0" : number_format($first[0]->outcome)}} ლარი</span>

                        კატეგორიის წილი ბიუჯეტიდან:
                        <span class="val" id="firstDonaut">{{!isset($fpercent) ? "0" : $fpercent}}%</span>
                        @else
                            <span id="val1" data-val="0" class="val">0 ლარი</span>

                            კატეგორიის წილი ბიუჯეტიდან:
                            <span class="val" id="firstDonaut">0%</span>
                            @endif
                    </div>
                </div>
                <div class="clear"></div>
                <span class="mosaxleoba">მოსახლეობა:</span><span class="humans">{{empty($first[0]->population) ? "0" : $first[0]->population}}</span>

            </div>

            <div class="right">
                <div class="h">
                    <div class="title">
                    @if (count($second))
                    <h3 id="title2" >{{$sentities[0]->name}}, <span id="name2"> {{$second[0]->name}}</span>, {{$second[0]->year}}</h3>
                    @else
                        <h3>მონაცემი არ არსებობს</h3>
                    @endif
                    </div>
                    <div class="drowpdown">
                        შეცვალე
                        <ul class="sub">
                            <li>
                                <label>მუნიციპალიტეტი:</label>
                                <select id="s1">
                                    @foreach($cities as $city)
                                        <option  value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>
                                <label>კატეგორია:</label>
                                <select id="s2">
                                    @foreach ($cats as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li>
                                <label>წელიწადი:</label>
                                <select id="s3">
                                    @foreach ($years as $year)
                                        <option value="{{$year->year}}">{{$year->year}}</option>
                                    @endforeach
                                </select>
                            </li>
                          <li>  <input type="button" value="OK"></li>
                        </ul>
                    </div>
                </div>
                <div class="tablecont">
                <table>
                    <thead>
                    <tr>

                        <td>სრული ხარჯი: </td><td id="val2" data-val2="{{$second[0]->value}}">{{!isset($second[0]->value) ? "0" : number_format($second[0]->value)}} ლარი</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    @if (isset($ssubcats))
                    @foreach ($ssubcats as $second_sub)
                        <tr>
                            @if ($second_sub->value != "0")
                            <td>{{$second_sub->name}} </td>
                            <td>{{number_format($second_sub->value)}} ლარი</td>
                            @endif

                        </tr>
                        @endforeach
                        @endif
                    </tr>
                    </tbody>
                </table>
                </div>
                <div class="donatchart">
                    <span class="title">პროცენტული შედარება ბიუჯეტთან:</span>
                    <div id="donat2">

                    </div>
                    <div class="desc">
                        სრული ბიუჯეტი:
                        <span class="val" >{{!isset($second[0]->outcome) ? "0" : number_format($second[0]->outcome)}} ლარი</span>
                        კატეგორიის წილი ბიუჯეტიდან:
                        <span class="val" id="secondDonaut">{{!isset($spercent) ? "0" : $spercent}}%</span>
                    </div>
                </div>
                <div class="clear"></div>
                <span class="mosaxleoba">მოსახლეობა:</span><span class="humans">{{!isset($second[0]->population) ? "0" : $second[0]->population}}</span>
            </div>
            <div class="candleChart">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <div class="chart">
                    <div class="column">
                        <span class="val">342 ლარი</span>
                        <span class="name">ჯანდაცვა, ახალციხე 2016</span>
                    </div>
                    <div class="column">
                        <span class="val">342 ლარი</span>
                        <span class="name">ჯანდაცვა, გორი, 2015</span>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
@endsection