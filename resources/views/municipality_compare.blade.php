@extends('layouts.home')

@section('center')

    <main>
    <section class="comparemunic">
        <div class="wrapper">
            <div class="h">
                <h2>მუნიციპალიტეტების შედარება</h2>
            </div>
            <p class="p">ამ აპლიკაციის საშუალებით,  თქვენ შეძლებთ ერთსა და იმავე მუნიციპალიტეტში არსებული სხვადასხვა კატეგორიის ხარჯების შედარებას, ან ერთი და იგივე კატეგორიის ხარჯის შედარებას სხვადასხვა მუნიციპალიტეტებს შორის.</p>
            <form action="{{URL('/self-governing/compare-result')}}" method="GET">
            <div class="left">


                <label>მუნიციპალიტეტი:</label>
                <select id="munic1" name="f1">
                    @foreach ($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
                <label>კატეგორია:</label>
                <select id="cat1" name="f2">
                    @foreach ($cats as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
                <label>წელიწადი:</label>
                <select id="y1" name="f3">
                    @foreach ($years as $year)
                        <option value="{{$year->year}}">{{$year->year}}</option>
                    @endforeach
                </select>

            </div>

            <div class="right">
                <label>მუნიციპალიტეტი:</label>
                <select id="munic1" name="s1">
                    @foreach ($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
                <label>კატეგორია:</label>
                <select id="cat1" name="s2">
                    @foreach ($cats as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
                <label>წელიწადი:</label>
                <select id="y1" name="s3">
                    @foreach ($years as $year)
                    <option value="{{$year->year}}">{{$year->year}}</option>
                        @endforeach
                </select>

            </div>

            <div class="clear"></div>
            <input type="submit" id="compare" value="შედარება" name="">
            </form>
        </div>
    </section>
</main>
@endsection