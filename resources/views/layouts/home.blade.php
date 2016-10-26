<!DOCTYPE html>
<html>
<head>
    <title>EpFund</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/normalize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/StyleSheet1.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/ka.css')}}">
    {{--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="/vendor/comments/css/prism-okaidia.css"> <!-- Optional -->
    <link rel="stylesheet" href="/vendor/comments/css/comments.css">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/owl.theme.css')}}">


    {{--<script src="//code.jquery.com/jquery-2.2.0.min.js"></script>--}}
{{session('locale')}}

</head>
<body>
<div class="canvastooltip">
<span class="title">ხარჯი</span>
<span class="xarji"></span>
  <span class="title">მუნიციპალიტეტები</span>
  <span class="munic"></span>
</div>

<?php
$nested = Request::segment(2);

if (Request::segment(1) == 'mycountry')  $menu1 = "main-menu-li-active active1"; else $menu1 = "";
if (Request::segment(1) == 'self-governing')  $menu2 = "main-menu-li-active active1"; else $menu2 = "";
if (Request::segment(1) == 'answers')  $menu3 = "main-menu-li-active active1"; else $menu3 = "";
if (Request::segment(1) == 'blog')  $menu4 = "main-menu-li-active active1"; else $menu4 = "";


if (Request::segment(2) == "chronology") $chronology = "main-menu-li-active active1 active"; else $chronology = "";
if (Request::segment(2) == "budget-chronology") $budget = "main-menu-li-active active1 active"; else $budget = "";
if (Request::segment(2) == "local-budget") $local = "main-menu-li-active active1 active"; else $local = "";
if (Request::segment(2) == "city-expanses") $expanses = "main-menu-li-active active1 active"; else $expanses = "";
if (Request::segment(2) == "faqs") $faqs = "main-menu-li-active active1 active"; else $faqs = "";
if (Request::segment(2) == "ask-question") $ask = "main-menu-li-active active1 active"; else $ask = "";
if (Request::segment(2) == "compare") $compare = "main-menu-li-active active1 active"; else $compare = "";
if (Request::segment(2) == "compare-result") $compare_result = "main-menu-li-active active1 active"; else $compare_result = "";
if (Request::segment(2) == "expenditures") $expenditures = "main-menu-li-active active1 active"; else $expenditures = "";
if (Request::segment(2) == "infographic") $infographic = "main-menu-li-active active1 active"; else $infographic = "";

//            print_r($menu2); die();
?>

<header>
    <section class="header-bg"></section>
    <section class="left-bg"></section>
    <section class="sub-header">
        <section class="logo-place">
            <a href="{{URL('/')}}"><img src="{{URL('/assets/images/mainlogo.png')}}" alt="" title="" /></a>
        </section>
        <nav>
            <ul class="main-menu">
                <li class="{{$menu1}}"><a href="#!">{{ trans('greetings.my_country') }}</a>
                    <ul>
                        {{--<li><a href="#!">სახელმწიფო ბიუჯეტის ქრონოლოგია</a></li>--}}
                        {{--<li><a href="#!">შედარებითი კალკულატორი </a></li>--}}
                        {{--<li><a href="#!">როგორ განკარგავდით ბიუჯეტს ? </a></li>--}}
                        {{--<li><a href="#!">სახელმწიფო ხარჯების ქრონოლოგია</a></li>--}}
                        <li class="{{$budget}}"><a href="{{url('/mycountry/budget-chronology')}}">{{ trans('greetings.state-expenses-chronology') }}</a></li>
                        <li  class="{{$expenditures}}"><a href="{{url('/mycountry/expenditures/2015')}}">{{ trans('greetings.expenses-by-category') }}</a></li>
                         <li class="{{$infographic}}"><a href="{{url('/mycountry/infographic')}}">{{ trans('greetings.infographic') }}</a></li>
                    </ul>
                </li>
                <li class="{{$menu2}}"><a href="#!">{{ trans('greetings.self-governing-city') }}</a>
                    <ul>
                        {{--<li><a href="#!"> ბიუჯეტის ქრონოლოგია</a></li>--}}
                        {{--<li><a href="#!">შედარებითი  </a></li>--}}
                        {{--<li><a href="#!">როგორ განკარგავდით ბიუჯეტს ? </a></li>--}}
                        {{--<li><a href="#!">სახელმწიფო ხარჯების ქრონოლოგია</a></li>--}}

                        <li class="{{$local}}"><a href="{{url('/self-governing/local-budget/2015')}}">{{ trans('greetings.local-budget') }}</a></li>
                        <li class="{{$chronology}}"><a href="{{url('/self-governing/chronology/9')}}">{{ trans('greetings.expenses-chronology') }}</a></li>
                        <li class="{{$expanses}}"><a href="{{url('/self-governing/city-expanses/9/2015')}}">{{ trans('greetings.self-governing') }}</a></li>
                        <!-- <li><a href="#">ინფოგრაფიკა</a></li> -->
                        <li class="{{$compare}}{{$compare_result}}"><a href="{{url('/self-governing/compare')}}">{{ trans('greetings.municipality-compare') }}</a></li>
                    </ul>
                </li>
                <li class="{{$menu3}}"><a href="#!">{{ trans('greetings.public-info') }}</a>
                    <ul>
                        {{--<li><a href="#!">სახელმწიფო ბიუჯეტის ქრონოლოგია</a></li>--}}
                        {{--<li><a href="#!"> კალკულატორი </a></li>--}}
                        {{--<li><a href="#!">როგორ განკარგავდით ბიუჯეტს ? </a></li>--}}
                        {{--<li><a href="#!">სახელმწიფო  ქრონოლოგია</a></li>--}}

                        <li class="{{$faqs}}"><a href="{{url('/answers/faqs')}}">{{ trans('greetings.requested-public-info') }}</a></li>
                        <li class="{{$ask}}"><a href="{{url('/answers/ask-question')}}">{{ trans('greetings.request-public-info') }}</a></li>
                    </ul>
                </li>
                <li class="{{$menu4}}"><a href="{{url('/blog')}}">{{ trans('greetings.blog') }}</a>
                    <ul>
                        <li><a href="{{url('/blog')}}">{{ trans('greetings.blog-articles') }}</a></li>
                        <li><a href="{{url('/blog/add')}}">{{ trans('greetings.add-blog') }}</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
<?php
        if (Request::session()->has('locale')) {
           /// language active algorithm
        }
            ?>

        <section class="soc-lang-bar">
            <a href="#!"><img src="{{URL('/assets/images/fbfb.png')}}" alt="" title="" /></a>
            <form action="{{url('/language')}}" method="POST">
            <section>
                <input type="submit" style="cursor: pointer;"  name="locale" value="ge" class="lang-active">
                <input type="submit" style="cursor: pointer;"  name="locale" value="en">
                {{ csrf_field() }}
            </section>
            </form>
        </section>
    </section>
</header>


@yield('center')




<footer>
    <div class="wrapper">
        <a href="#!" class="flogo"></a>
        <p class="desc">ვებ-გვერდზე ასახული დემოგრაფიული მონაცემების წყაროა <a href="http://www.geostat.ge/" target="_blank">საქართველოს სტატისტიკის ეროვნული სამსახური (საქსტატი)</a>. ვებ-გვერდზე ასახული ინფორმაცია თვითმმართველი ერთეულების საბიუჯეტო ხარჯების შესახებ მოწოდებულია შესაბამისი თვითმმართველი ერთეულების მიერ, საჯარო ინფორმაციის გამოთხოვნის შედეგად. ინფორმაცია სახელმწიფო ბიუჯეტის შესახებ აღებულია საქართველოს ფინანსთა სამინისტროს ოფიციალური ვებ-გვერდიდან: <a href="http://www.mof.ge" target="_blank">www.mof.ge</a><br>
        ევროპის ფონდი პასუხს არ აგებს მონაცემების სიზუსტეზე. 
        </p>
        <section class="usa-corner">
            <p>
                The project is possible thanks to the U.S. Department of State under the TransparenCEE program - an initiative started by TechSoup in partnership with ePaństwo Foundation.
            </p>
            <a href="http://www.state.gov/" target="_blank"><img src="{{URL('/assets/images/usaflag.jpg')}}" alt="" title=""></a>
            <a href="http://transparencee.org" target="_blank"><img src="{{URL('/assets/images/transparencee.png')}}" alt="" title=""></a>
        </section>
    </div>
    <div class="hr"></div>
    <div class="wrapper">
        <span>ყველა უფლება დაცულია &copy; 2016, <a href="http://epfound.org" target="_blank">ევროპის ფონდი</a></span>
        <span>შექმნილია <a href="http://flash.ge/" target="_blank">Flash Studio</a>-ს მიერ</span>
    </div>
</footer>
<script type="text/javascript" src="{{URL::asset('assets/js/jquery-3.0.0.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/canvasjs.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/chart.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/jquery.form-validator.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/main.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/functions.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/vue/1.0.16/vue.min.js"></script>
<script src="/vendor/comments/js/utils.js"></script>
<script src="/vendor/comments/js/comments.js"></script>
<script>new Vue({el: '#comments'});</script>
<script type="text/javascript">
//    window.onload = function () {
//    	var data = [
//			{
//				type: "spline",
//				markerSize: 10,
//		        markerColor: "transparent",
//		        markerBorderColor: "#24BFAD",
//		        markerBorderThickness: 3,
//		        lineColor: "#24BFAD",
//				dataPoints: [
//
//				]
//	    },
//			{
//				type: "spline",
//				name: "ხარჯი",
//				markerSize: 10,
//		        markerColor: "transparent",
//		        markerBorderColor: "#F0A348",
//		        markerBorderThickness: 3,
//		        lineColor: "#F0A348",
//				dataPoints: [
//				]
//	     }
//			];
//        $.getJSON("http://epfund.flash.ge/expenses_API", function(result){
//
//        		for(i in result){
//      				if($.isNumeric( i )){
//        					data[0].dataPoints[i] = { x: result[i].year, y: Number(result[i].outcome) };
//        					data[1].dataPoints[i] = { x: result[i].year, y: Number(result[i].scheduled_costs) };
//      				}
//				}
//            var chart = new CanvasJS.Chart("splinechart",
//			{
//				title: {
//					text: " "
//				},
//				backgroundColor: "transparent",
//				toolTip: {
//					shared: true,
//					contentFormatter: function (e) {
//						var content = "წელი: " + e.entries[0].dataPoint.x + "<br> ";
//						for (var i = 0; i < e.entries.length; i++) {
//		          if(e.entries[i].dataPoint.y >= 1000000)
//		            {
//		              content += e.entries[i].dataSeries.name + " " + "<strong>" + e.entries[i].dataPoint.y + "მლნ</strong>";
//		            }
//		          else{
//		            content += e.entries[i].dataSeries.name + " " + "<strong>" + e.entries[i].dataPoint.y + "</strong>";
//		          }
//							content += "<br/>";
//						}
//						return content;
//					}
//				},
//				axisX: {
//				gridColor: "green",
//			      maximum: 2016,
//			      minimum: 2010,
//			      interval: 1,
//			      tickLength: 15,
//			      tickThickness: 0,
//			      valueFormatString: "###"
//				},
//				axisY: {
//		      includeZero: false,
//		      tickThickness: 0,
//		      gridThickness: 2,
//		      lineThickness: 0,
//		      minimum: -(95000000 - 23)/5,
//		      maximum: 95000000,
//					interval: (95000000-23)/5,
//		      suffix: "",
//		      labelFormatter: function(e){
//		        if(e.value < 0)
//		          {
//		            e.value = " ";
//		          }
//		        else
//		          {
//		            e.value = Math.ceil(e.value/1000000) + " მლნ";
//		          }
//		        return e.value;
//		      }
//				},
//				data: data
//			});
//			chart.render();
//        });
//
//    }
</script>
</body>
</html>