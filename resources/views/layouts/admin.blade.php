<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/style.css') }}" />
    <script src="{{URL::asset('admin/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('admin/js/functions.js')}}"></script>
</head>
<body style="background:#f1f2f7">
<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<style>
body {
overflow: hidden;
}

/* Preloader */

#preloader {
position:fixed;
top:0;
left:0;
right:0;
bottom:0;
background-color:#FFF;
z-index:99; /* makes sure it stays on top */
}

#status {
width:200px;
height:200px;
position:absolute;
left:50%; /* centers the loading animation horizontally one the screen */
top:50%; /* centers the loading animation vertically one the screen */
background-image:url({{URL::asset('admin/images/loading.gif')}}); /* path to your loading animation */

background-repeat:no-repeat;
background-position:center;
margin:-100px 0 0 -100px; /* is width and height divided by two */
}
</style>
<!--  -------------------------------Header-------------------------------------  -->
<header>
    <section class="logo-place">
        <a href="/admin"><img src="{{URL::asset('admin/images/flash.png')}}" alt="Flash.ge" title="" /></a>
    </section>

    <section class="user-corner">
        <section class="user-corner-img">
            {{--<img src="{{URL::asset('admin/images/user.png')}}" alt="" title="" />--}}
        </section>
        <section class="user-corner-name">

            <label>Welcome</label>
            <span class="user-name">{{ Auth::user()->email }}</span>
        </section>
        <img src="{{URL::asset('admin/images/right-arrow.png')}}" title="" alt="" />
    </section>
</header>
 {{-----------------------------Header END!!!------------------------------------ --}}

 {{--zzzzzzzzzzzzzzzzzzzzzzzz Mailn Content zzzzzzzzzzzzzzzzzzzzzzzz --}}
<main>

    <!-- zzzzzzzzzzzzz Left Menu zzzzzzzzzzzzz -->
    <section class="left-menu">
        <ul class="left-menu-first-part">
            <li>მმართველობის ერთეულები</li>
            @foreach ($menu['units'] as $units)
                <li><a href="/admin/category/{{ $units->id }}/">{{ $units->name }}</a></li>
            @endforeach
        </ul>
        <ul class="left-menu-second-part">
            <li>კატეგორიები</li>
            @foreach ($menu['allunits'] as $allunits)
                <li><a href="/admin/subcat/{{ $allunits->id }}/">{{ $allunits->name }} კატეგორიები</a></li>
            @endforeach
        </ul>
        <ul class="left-menu-third-part">
            <li>სხვადასხვა</li>
            {{--<li><a href="#">კონტრაქტების რეესტრი</a></li>--}}
			 <li><a href="/admin/addData/1">დამატება</a></li>
        </ul>
        <ul class="left-menu-third-part">
            <li><a href="/admin/blog/">ბლოგი</a></li>
            <li><a href="/admin/faq/">საჟარო ინფორმაცია</a></li>
        </ul>
       
    </section>
     {{-- Left Menu END!!!  --}}



@yield('rightBlock')


</main>
{{-------- Mailn Content END!!! ---------}}
        <!-- jQuery Plugin -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.min.js"></script>

<!-- Preloader -->
<script type="text/javascript">
    //<![CDATA[
    $(window).load(function() { // makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(350).css({'overflow':'visible'});
    })
    //]]>
</script>

<script>
        // price formatting
    $(document).ready(function () {
        $(".formattedNumberField").on('keyup',function () {

            if (this.value.match('^[a-z]+$')) { this.value = '' }
            if (this.value == '') {
                return false;
            } else {
                var n = parseInt(this.value.replace(/\D/g,''),10);
                this.value = n.toLocaleString();
            }
        });
    });
</script>

<script>
    // avoid duplicate years

    $(document).ready(function() {
        var _token = $('input[name=_token]').val();
        $("#year").change(function() {
            $('#alertYear').html('');
            var year = $("#year option:selected").text();
            var unit = $("#unit option:selected").val();



            //ajax
            $.ajax({
                url: '<?= url('admin/bacho'); ?>',
                method: 'post',
                dataType: 'json',
                data: {'_token': _token, 'year': year, 'unit':unit},
                cache: false
            }).done(function (json) {
                 if (json) {
                     $('#alertYear').html('ეს ჩანაწერი უკვე არსებობს');
                 }
                $.each(json, function (index, value) {

                });


            });


        })



    });



</script>
</body>
</html>








