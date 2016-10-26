@extends('layouts.home')

@section('center')
<main>
    <section class="budgetcompare">
        <div class="wrapper">
            <div class="h">
                <h2>სახელმწიფო ბიუჯეტის ქრონოლოგია</h2>
            </div>
            <div class="chartheader"><span>შემოსავალი <img src="{{URL::asset('assets/images/greenline.png')}}" alt=""></span><span>ხარჯი <img src="{{URL::asset('assets/images/yellowline.png')}}" alt=""></span><span class="deficiti">დეფიციტი<span class="tooltip">ბიუჯეტის შემოსავლებსა და ხარჯებს შორის სხვაობა არის ბიუჯეტის საოპერაციო სალდო, ხოლო ბიუჯეტის საოპერაციო სალდოსა და არაფინანსური აქტივების ცვლილებას შორის სხვაობა – ბიუჯეტის მთლიანი სალდო.<br>
დადებითი მთლიანი სალდო არის ბიუჯეტის პროფიციტი, ხოლო უარყოფითი მთლიანი სალდო – ბიუჯეტის დეფიციტი. (წყარო: საქართველოს საბიუჯეტო კოდექსი, მუხლი 12). <a href="https://matsne.gov.ge/ka/document/view/91006" target="_blank">https://matsne.gov.ge/ka/document/view/91006</a>
</span> <img src="{{URL::asset('assets/images/redline.png')}}" alt=""></span></div>
            <div id="comparechart"></div>
        </div>
        <section class="dd">
            <div class="wrapper">
                <h2>შეადარეთ სახელმწიფო ბიუჯეტი წლების მიხედვით</h2>
                <div class="comparetable">
                    <div class="caption">
                        <div>
                        	<div class="switcher" id="gadamrtveli" style="opacity: 1;">
                                <span class="active" data-val="2">ხარჯები</span>
                                <span data-val="1">შემოსავლები</span>
                                <div class="bg" style="width: 131.703px;"></div>
                            </div>
                        </div>
                        <div><span class="y1">2014</span> <span class="arrow"></span>
                            <ul class="dropdown year1"><li data-year="2015">2015 წელი</li><li data-year="2014">2014 წელი</li><li data-year="2013">2013 წელი</li><li data-year="2012">2012 წელი</li><li data-year="2011">2011 წელი</li><li data-year="2010">2010 წელი</li></ul></div>
                        <div><span class="y2"> 2015</span> <span class="arrow"></span>
                            <ul class="dropdown year2"><li data-year="2015">2015 წელი</li><li data-year="2014">2014 წელი</li><li data-year="2013">2013 წელი</li><li data-year="2012">2012 წელი</li><li data-year="2011">2011 წელი</li><li data-year="2010">2010 წელი</li></ul>
                        </div>
                        <div>ცვლილება</div>
                    </div>
                    <div class="h">
                        <div>სახელმწიფო ხარჯები:</div>
                        <div></div>
                        <div></div>
                        <div class="increes">0%</div>
                    </div>
                    <div class="mwvane">
                        <div class="h">გაზრდილი ხარჯები</div>

                    </div>
                    <!-- mwvane -->
                    <div class="witeli">
                        <div class="h">შემცირებული ხარჯები</div>

                    </div>
                    <!-- witeli -->
                    <div class="other">

                    </div>
                </div>
            </div>
        </section>
    </section>
</main>
@endsection