@extends('layouts.home')

@section('center')
<main>
    <section class="welcome">
        <div class="wrapper">
            <div id="mainslider" class="owl-carousel owl-theme">

                <div class="item">
                    <div class="desc">
                        <h3>მიიღე ინფორმაცია ხარჯებისა და შემოსავლების შესახებ</h3>
                        <p>ვებ-გვერდი საშუალებას აძლევს ყველა დაინტერესებულ პირს, მიიღოს ინფორმაცია სახელმწიფო და თვითმმართველი ერთეულების საბიუჯეტო ხარჯებისა და შემოსავლების შესახებ, შეადაროს სხვადასხვა სახის ხარჯი ერთმანეთს და მოახდინოს შედარებითი ანალიზი. სხვადასხვა სასარგებლო აპლიკაციის მეშვეობით, ვებ-გვერდი  დაგეხმარებათ, მარტივად მოითხოვოთ ადგილობრივი თვითმმართველობისაგან სასურველი საჯარო ინფორმაცია, და საჯაროდ გამოხატოთ მოსაზრება საბიუჯეტო ხარჯებთან დაკავშირებით. </p>
                        <ul>
                            <li><a href="{{URL('mycountry/budget-chronology')}}"><span>სახელმწიფო ბიუჯეტის ქრონოლოგია</span></a></li>
                            <li><a href="{{URL('self-governing/local-budget/2015')}}"><span>ადგილობრივი თვითმმართველობის ბიუჯეტი</span></a></li>
                            <li><a href="{{URL('self-governing/compare')}}"><span>მუნიციპალიტეტების შედარება</span></a></li>
                            <!-- <li><a href=""><span>ინფოგრაფიკა</span></a></li> -->
                        </ul>
                    </div>
                    <div class="video">
                        <img src="{{URL('assets/images/slide1.png')}}">
                    </div>
                </div>
                <div class="item">
                    <div class="desc">
                        <h3>ადგილობრივი ბიუჯეტი</h3>
                        <p>ინფორმაცია ადგილობრივი ბიუჯეტის შესახებ გაძლევთ შესაძლებლობას, გაიგოთ, თუ რა სახის დანახარჯები და შემოსავლები აქვს თქვენთვის საინტერესო თვითმმართველ ერთეულს</p>
                        <ul>
                            <li><a href="{{URL('self-governing/local-budget/2015')}}"><span>ადგილობრივი თვითმმართველობის ბიუჯეტი</span></a></li>
                            <li><a href="{{URL('self-governing/chronology/9')}}"><span>მუნიციპალიტეტის ხარჯების ქრონოლოგია</span></a></li>
                            <li><a href="{{URL('self-governing/city-expanses/9/2015')}}"><span>თვითმმართველობის ბიუჯეტი კატეგორიებად</span></a></li>
                        </ul>
                    </div>
                    <div class="video">
                    	<img src="{{URL('public/assets/images/slide2.png')}}" alt="img">
                    </div>
                </div>
                <div class="item">
                    <div class="desc">
                        <h3>შეადარე მუნიციპალიტეტების ხარჯები</h3>
                        <p>ამ აპლიკაციის საშუალებით,  თქვენ შეძლებთ ერთსა და იმავე მუნიციპალიტეტში არსებული სხვადასხვა კატეგორიის ხარჯების შედარებას, ან ერთი და იგივე კატეგორიის ხარჯის შედარებას სხვადასხვა მუნიციპალიტეტებს შორის.</p>
                        <ul>
                            <li><a href="{{URL('self-governing/compare')}}"><span>მუნიციპალიტეტების შედარება</span></a></li>
                        </ul>
                    </div>
                    <div class="video">
                    	<img src="{{URL('public/assets/images/slide3.png')}}" alt="img">
                    </div>
                </div>

            </div>
            <section class="cat">
                <article>
                    <p>ქვეყნის ბიუჯეტის ქრონოლოგია, გაიგე რაში ხარჯავს შნეი ქვეყანა მოგროვილ გადასახადებს წლების მიხედვით.</p>
                    <a href="{{URL('mycountry/budget-chronology')}}" class="more">დეტალურად</a>
                </article>
                <article>
                    <p>გაიგე რაში იხარჯება სახელმწიფო ხარჯები და რამდენს ხარჯავს სახელმწიფო ყოველ წელს სხვადასხვა მიმართულებით</p>
                    <a href="{{URL('mycountry/expenditures/2015')}}" class="more">დეტალურად</a>
                </article>
                <article>
                    <p>შეადარე წლების განმავლობაში სახელმწიფოს მიერ დახარჯული თანხები პროცენტულად და რიცხობრივად. </p>
                    <a href="{{URL('mycountry/infographic')}}" class="more">დეტალურად</a>
                </article>
            </section>
        </div>
    </section>
</main>
@endsection