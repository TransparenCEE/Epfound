//menu
$("header div.wrapper ul.mainmenu li").hover(function(){
	$("header div.wrapper ul.mainmenu > li").removeClass('active');
},
function(){
	$("header div.wrapper ul.mainmenu li.active1").addClass('active');
	//$("header div.wrapper ul.mainmenu li").eq(menuItem).addClass('active');
});


function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }
//categories click
$("section.categories article").click(function(){

	$("section.categories div.rem").remove();
	var tooltip = $(this).find('.tooltip').clone();
	var index = $(this).index()+1;
	var after = Math.ceil(index/5)*5;
	var rowIndex = 5 - (after - index);
	var id = $(this).attr("id");
	var year = $("#Year").val();
	$(tooltip).addClass('rem');
	$("section.categories article div.img img").css({filter: "brightness(1000%)", '-webkit-filter': "brightness(1000%)"});
	$("section.categories article span.cost").css({color: "#FFFFFF"});
	$("section.categories article").css({marginLeft: "0", marginRight: "32.5px", backgroundColor: "#2B7CBE"});
	$(this).css({backgroundColor: "#FFFFFF"});
	$(this).find("div.img img").css({filter: "brightness(100%)", '-webkit-filter': "brightness(100%)"});
	$(this).find("span.cost").css({color: "#103A62"});
	$("section.categories article:nth-child(5n+5)").css({marginRight: "0"});
  
  if(index <= $("section.categories article").length - ($("section.categories article").length % 5))
  {
  	$(tooltip).insertAfter($("section.categories article").eq(after - 1));
  }
  else
  {
  	$(tooltip).insertAfter($("section.categories article").eq($("section.categories article").length - 1));
  }

	var height = $(tooltip).innerHeight();
	//$(tooltip).css({height: "0", padding: "0"});
	$(tooltip).animate({height: height, padding: "30px"},500);
	$(tooltip).css('display','block');
	$(tooltip).find("span.before").css("left",(rowIndex*210)-(210/2) + (32.5 * (rowIndex-1))-15);
	$(tooltip).find(".diagram").html("<canvas id='wee'></canvas>");
  	$(tooltip).fadeIn();
  		var url = "http://epfund.flash.ge/common-outcomes-API/" + id + "/" + year;
		localBudget("section.categories .rem .diagram", url);

	$('body').animate({scrollTop: $(this).offset().top});
});


//city expances categories click
$("section.cityexpances section.categories div.wrapper article").click(function(){
  $("section.categories div.rem").remove();
  var tooltip = $(this).find('.tooltip').clone();
  var index = $(this).index()+1;
  var after = Math.ceil(index/5)*5;
  var rowIndex = 5 - (after - index);
  var id = $(this).attr("id");
  $(tooltip).addClass('rem');
  $("section.categories article div.img img").css({filter: "brightness(1000%)", '-webkit-filter': "brightness(1000%)"});
  $("section.categories article span.cost").css({color: "#FFFFFF"});
  $("section.categories article").css({marginLeft: "0", marginRight: "32.5px", backgroundColor: "#2B7CBE"});
  $(this).css({backgroundColor: "#FFFFFF"});
  $(this).find("div.img img").css({filter: "brightness(100%)", '-webkit-filter': "brightness(100%)"});
  $(this).find("span.cost").css({color: "#103A62"});
  $("section.categories article:nth-child(5n+5)").css({marginRight: "0"});

  if(index <= $("section.categories article").length - ($("section.categories article").length % 5))
  {
  	$(tooltip).insertAfter($("section.categories article").eq(after - 1));
  }
  else
  {
  	$(tooltip).insertAfter($("section.categories article").eq($("section.categories article").length - 1));
  }


  var height = $(tooltip).innerHeight();
  //$(tooltip).css({height: "0", padding: "0"});
  $(tooltip).animate({height: height, padding: "30px"},500);
  $(tooltip).css('display','block');
  $(tooltip).find("span.before").css("left",(rowIndex*210)-(210/2) + (32.5 * (rowIndex-1))-15);
  $(tooltip).find(".diagram").html("<canvas id='aee'></canvas>");
    $(tooltip).fadeIn();
    //CreateChart("aee",1120,230,res,"snap","#24BFAD",false);
    $(".categories .rem .diagram").css("position","relative");
    var shitId = $(".categories .rem .diagram").attr("id").match(/[0-9]+/)[0];
    var articleId = $(this).attr("id");
    var unit = $("#municip").val();
    $(tooltip).find(".diagram").html("<div id='shit" + shitId + "' style='width: 100%; height: 250px; position: absolute'></div>");
    try{
      $.getJSON("http://epfund.flash.ge/city_outcomes_API/" + articleId + "/" + unit, function(result){
        var dataPoints = [];
        var minimal = Number(result[0].value);
        var maximal = 0;
        for(i=0; i<result.length; i++){
        	if(maximal < Number(result[i].value))
        	{
        		maximal = Number(result[i].value);
        	}
        	if(minimal > Number(result[i].value))
        	{
        		minimal = Number(result[i].value);
        	}
        	dataPoints.push({x: parseInt(result[i].year), y: parseInt(result[i].value)});	
        }
        var interval = (maximal - minimal) / 5;
      var chart = new CanvasJS.Chart("shit" + shitId,
    {
    
      title:{
      text: ""
      },
      backgroundColor: "transparent",
       data: [
      {        
        type: "spline",
      markerSize: 10,
      markerColor: "#F5F5F5",
      markerBorderColor: "#F0A348",
      markerBorderThickness: 3,
      lineColor: "#F0A348",
        dataPoints
      }       
        
      ],
      toolTip: {
            shared: true,
            contentFormatter: function (e) {
                var content = "<span class='year'>წელი: " + e.entries[0].dataPoint.x + "</span> ";
                for (var i = 0; i < e.entries.length; i++) {

              content += "<span class='x'>" + "<strong>" + commaSeparateNumber(e.entries[i].dataPoint.y) + " ლარი</strong></span>";
              
                    content += "<br/>";
                }
                return content;
            }
        },
      axisX: {
      gridColor: "green",
      maximum: 2015.1,
      minimum: 2009.9,
      interval: 1,
      tickLength: 0,
      tickThickness: 0,
      valueFormatString: "###"
        },
        axisY: {
      includeZero: false,
      tickThickness: 0,
      gridColor: "#CCCCCC",
      gridThickness: 1,
      lineThickness: 0,
      maximum: maximal + (interval/2),
      minimum: minimal - (interval/2),
      interval: interval,
  		}
    });

    chart.render();

      });
    }
    catch(e){
      console.log(e);
    }

  $('body').animate({scrollTop: $(this).offset().top});
});




$().ready(function(){
	// $.getJSON("http://epfund.flash.ge/local-cities", function(result){
 //        CreateChart("c",1180,250,result, "snap", "#24BFAD",false);
 //    });


	// $.getJSON("http://epfund.flash.ge/last-year", function(result){
	// 	var max = Math.max(result[0].outcome, result[0].scheduled_costs);
 //        if(result[0].outcome > result[0].scheduled_costs){
 //        	$("#dagegmili").height("100%");
 //        	$("#dagegmili").data("val", result[0].outcome);
 //        	$("#gaxarjuli").height((100/result[0].outcome)*result[0].scheduled_costs + "%");
 //        	$("#gaxarjuli").data("val", result[0].scheduled_costs);
 //        }
 //        else
 //        {
 //        	$("#gaxarjuli").height("100%");
 //        	$("#dagegmili").data("val", result[0].outcome);
 //        	$("#dagegmili").height((100/result[0].scheduled_costs)*result[0].outcome + "%");
 //        	$("#gaxarjuli").data("val", result[0].scheduled_costs);
 //        }
 //    });






// last year tooltip
    $("div.lastyear div.cont div").hover(function(){
    	var height = $(".canvastooltip").innerHeight();
    	var width = $(".canvastooltip").innerWidth();
    	$(".canvastooltip").html("<span class='title'>რაოდენობა:</span> " + commaSeparateNumber($(this).data("val")) + " ლარი");
    	$(".canvastooltip").css({top: $(this).position().top - height, left: $(this).position().left-(width/2) + ($(this).innerWidth() / 2)});
    	$(".canvastooltip").show();
    }, function(){
    	$(".canvastooltip").hide();
    });

    $.getJSON("http://epfund.flash.ge/outcome_chart/2011", function(result){
    	var left = 0;
    	for(i=0; i<result.shemosavali.length; i++){
    		var width = (100/result.total_income)*result.shemosavali[i].min_income;
    		left += width;
    		var div = $("<div class='d1' data-val='" + result.shemosavali[i].min_income + "' data-name='" + result.shemosavali[i].name + "' style='width: " + width + "%; height: 100%; box-sizing: border-box; float: left; position: relative;'></div>");
    		var span = $("<span class='joxi' style='position: absolute; height: 100%; width: 3px; background-color: #F9FAFC; left: " + left + "%'></span>");
    		$("#grad2 div.grad").append(div);
    		$("#grad2 div.grad").append(span);
    	}
    	for(j=0; j<=16; j++){
    		var left = (100/result.total_income) * (j * result.total_income/16);
    		var span = $("<span class='skala' style='position: absolute; display: block; left: " + left + "%; width: 1px; background-color: #CCCCCC; height: 13px; top: 52px;'></span>");
    		var span2 = $("<span class='text' style='position: absolute; display: block; left: " + left + "%; top: 65px; font-size: 9px; color: #666666; font-family: BPG Phone Sans;'>" + ((j * result.total_income/16)/1000000).toFixed(2) + " მლნ</span>");
    		$("#grad2").append(span);
    		$("#grad2").append(span2);
    	}
    	//gradient chart tooltip
	    $("#grad2 .grad div").hover(function(){
	    	
    		
    		var tooltip2 = $("<div class='canvastooltip2'></div>");
    		$(tooltip2).html("<span class='title'>დანიშნულება:</span>" + $(this).data("name") + "<span class='title'>ხარჯი:</span> " + commaSeparateNumber($(this).data("val")) + " ლარი");
    		$("section.dd div.wrapper div.desc").append(tooltip2);
    		var width = $(tooltip2).innerWidth();
        var height = $(tooltip2).innerHeight();
	    	$(tooltip2).css({top: $("#grad2").position().top - height + 10, left: ($(this).position().left - 40) + ($(this).width()/2), width: width, display: "block"});
	    	//alert($(this).position().left);
	    	

	    }, function(){
	    	$("section.dd div.wrapper div.desc").find(".canvastooltip2").remove();
	    });
    });

    $.getJSON("http://epfund.flash.ge/income_chart/2011", function(result){
    	var left = 0;
      for(i=0; i<result.shemosavali.length; i++){
        var width = (100/result.total_income)*result.shemosavali[i].min_income;
        left += width;
        var div = $("<div class='d1' data-val='" + result.shemosavali[i].min_income + "' data-name='" + result.shemosavali[i].name + "' style='width: " + width + "%; height: 100%; box-sizing: border-box; float: left; position: relative;'></div>");
        var span = $("<span class='joxi' style='position: absolute; height: 100%; width: 3px; background-color: #F9FAFC; left: " + left + "%'></span>");
        $("#grad1 div.grad").append(div);
        $("#grad1 div.grad").append(span);
      }
      for(j=0; j<=16; j++){
        var left = (100/result.total_income) * (j * result.total_income/16);
        var span = $("<span class='skala' style='position: absolute; display: block; left: " + left + "%; width: 1px; background-color: #CCCCCC; height: 13px; top: 52px;'></span>");
        var span2 = $("<span class='text' style='position: absolute; display: block; left: " + left + "%; top: 65px; font-size: 9px; color: #666666; font-family: BPG Phone Sans;'>" + ((j * result.total_income/16)/1000000).toFixed(2) + " მლნ</span>");
        $("#grad1").append(span);
        $("#grad1").append(span2);
      }
      //gradient chart tooltip
      $("#grad1 .grad div").hover(function(){
        
        
        var tooltip2 = $("<div class='canvastooltip2'></div>");
        $(tooltip2).html("<span class='title'>დანიშნულება:</span>" + $(this).data("name") + "<span class='title'>ხარჯი:</span> " + commaSeparateNumber($(this).data("val")) + " ლარი");
        $("section.dd div.wrapper div.desc").append(tooltip2);
        var width = $(tooltip2).innerWidth();
        var height = $(tooltip2).innerHeight();
        $(tooltip2).css({top: $("#grad1").position().top - height + 10, left: ($(this).position().left - 40) + ($(this).width()/2), width: width, display: "block"});
        //alert($(this).position().left);
        

      }, function(){
        $("section.dd div.wrapper div.desc").find(".canvastooltip2").remove();
      });
	   
    });


    // qveynis agsasruli

function qveynischarti(val){
  var data = [
        { 
            type: "spline",
            name: "შემოსავალი",
      markerSize: 10,
      markerColor: "#F5F5F5",
      markerBorderColor: "#24BFAD",
      markerBorderThickness: 3,
      lineColor: "#24BFAD",
            dataPoints: [
            
            ]
    },
        {
            type: "spline",
            name: "ხარჯი",
      markerSize: 10,
      markerColor: "#F5F5F5",
      markerBorderColor: "#F0A348",
      markerBorderThickness: 3,
      lineColor: "#F0A348",
            dataPoints: [
            ]
      
     }
        ];

        $.getJSON("http://epfund.flash.ge/self-governing/chronology?m=" + val, function(result){ 
        	var minimal = Math.min(result['0'].income, result['0'].outcome);
        	//alert(minimal);
        	var maximal = 0;
  for(i in result){
      if($.isNumeric( i )){
      	if(result[i].income == "")
      	{
      		result[i].income = 0;
      	}
      	if(result[i].outcome == "")
      	{
      		result[i].outcome = 0;
      	}
      	// detect maximal value
      	if(maximal < Math.max(result[i].income, result[i].outcome))
      	{
      		maximal = Math.max(result[i].income, result[i].outcome);
      	}
      	// detect minimal value
      	if(minimal > Math.min(result[i].income, result[i].outcome))
      	{
      		minimal = Math.min(result[i].income, result[i].outcome);
      	}
        data[0].dataPoints[i] = { x: result[i].year, y: Number(result[i].income) };                                   
        data[1].dataPoints[i] = { x: result[i].year, y: Number(result[i].outcome) }; 
      }
}
var interval = (maximal - minimal) / 5;
    var chart = new CanvasJS.Chart("splinechart",
    {
        title: {
            text: " "
        },
        backgroundColor: "transparent",
        toolTip: {
            shared: true,
            contentFormatter: function (e) {
                var content = "<span class='title'>წელი:</span> " + e.entries[0].dataPoint.x + "<br> ";
          if(e.entries[0].dataPoint.y >= 1000000)
            {
              content += "<span class='shemosavali'>" + e.entries[0].dataSeries.name + "</span> " + "<strong>" + commaSeparateNumber(e.entries[0].dataPoint.y) + "მლნ</strong>";
            }
          else{
            content += "<span class='shemosavali'>" + e.entries[0].dataSeries.name + "</span> " + "<strong>" + commaSeparateNumber(e.entries[0].dataPoint.y) + "</strong>";
          }    
          content += "<br/>";
          if(e.entries[1].dataPoint.y >= 1000000)
            {
              content += "<span class='xarji'>" + e.entries[1].dataSeries.name + "</span> " + "<strong>" + commaSeparateNumber(e.entries[1].dataPoint.y) + "მლნ</strong>";
            }
          else{
            content += "<span class='xarji'>" + e.entries[1].dataSeries.name + "</span> " + "<strong>" + commaSeparateNumber(e.entries[1].dataPoint.y) + "</strong>";
          }               
                    content += "<br/>";
                return content;
          }
        },
        axisX: {
            gridColor: "green",
      maximum: 2015.1,
      minimum: 2009.9,
      interval: 1,
      tickLength: 15,
      tickThickness: 0,
      valueFormatString: "###"
        },
        axisY: {
      includeZero: false,
      tickThickness: 0,
      gridColor: "#CCCCCC",
      gridThickness: 1,
      lineThickness: 0,
      minimum: minimal - (interval/2),
      maximum: maximal + (interval/2),
      interval: interval,
      suffix: "",
      labelFormatter: function(e){
        if(e.value < 0)
          {
            e.value = " ";
          }
        else
          {
            e.value = Math.ceil(e.value/1000000) + " მლნ";
          }
        return e.value;
      }
        },
        data: data
    });
    chart.render();


    $.getJSON("http://epfund.flash.ge/self-governing/chronology?b=" + val, function(result){ 
        var max = Math.max(result[0].outcome, result[0].scheduled_costs);
        var min = Math.min(result[0].outcome, result[0].scheduled_costs);
        var height1 = 0;
        var height2 = 0;
          $("#dagegmili").height((100/max*result[0].scheduled_costs) + "%");
          $("#dagegmili").data("val", result[0].scheduled_costs);
          $("#gaxarjuli").height((100/max*result[0].outcome) + "%");
          $("#gaxarjuli").data("val", result[0].outcome);

    });
});
}


 qveynischarti(9);

 


    //expances tabs
    $("section.dd div.wrapper div.desc div.h div.tabs span").click(function(){
    	var index = $(this).index();
    	$("section.dd div.wrapper div.desc div.h div.tabs span").removeClass("active");
    	$(this).addClass("active");
    	if($(this).hasClass("details")){
    		$("section.dd div.wrapper div.desc div.h div.switcher").css({opacity: "1"});
    	}
    	else
    	{
    		$("section.dd div.wrapper div.desc div.h div.switcher").css({opacity: "0"});
    	}
    	$("section.dd div.wrapper div.desc article").removeClass("active");
    	$($("section.dd div.wrapper div.desc article")[index]).addClass("active");
    });

    //expances acordeon
    function expancesAcordeon(){

      $("article.expances > div ul.first li").click(function(e){
        var height = $(this).find("ul li").length * $(this).find("ul li").innerHeight();
      if($(this).hasClass("active")){
        $("ul.first > li").removeClass("active");
        $("ul.first > li").find("ul").css({height: "0"});
      }
      else{
        $("ul.first > li").removeClass("active");
        $("ul.first > li").find("ul").css({height: "0"});
        $(this).find("ul").css({height: height});
        $(this).addClass("active");
        
      }
       $("ul.first > li li").removeClass("active");
        return false;
    });
    }
    
    expancesAcordeon();

	//shemosavlebi to xarjebi switcher
	var switcherBgWidth = $("div.h div.switcher span.active").innerWidth() + 10;
	$("div.h div.switcher div.bg").css({width: switcherBgWidth});
	$("div.h div.switcher span").click(function(){
		$("div.h div.switcher span").removeClass("active");
		$(this).addClass("active");
		var x = $(this).position();
		var width = $(this).innerWidth();
		$("div.h div.switcher div.bg").css({left: x.left + 5, width: width+10});
		var index = $(this).index();
		$("section.dd div.wrapper div.desc article.expances div").removeClass("active");
		$($("section.dd div.wrapper div.desc article.expances div")[index]).addClass("active");
	});


  // budget cronologie switcher
  var switcherBgWidth = $("div.comparetable div.caption div.switcher span.active").innerWidth() + 10;
  $("div.comparetable div.caption div.switcher div.bg").css({width: switcherBgWidth});
  $("div.comparetable div.caption div.switcher span").click(function(){
    $("div.comparetable div.caption div.switcher span").removeClass("active");
    $(this).addClass("active");
    var x = $(this).position();
    var width = $(this).innerWidth();
    var inout = ($("#gadamrtveli").find(".active").data('val') == 2) ? "outcome" : "income";
    $("div.comparetable div.caption div.switcher div.bg").css({left: x.left + 5, width: width+10});
    sparate_compare($(".y1").html(),$(".y2").html(),$(this).data("val"));
    cauntry_sperate_compare($(".y1").html(), $(".y2").html(), inout);
  });


  
	$('#Year').change(function(){
		location.href = this.value;
	})

	$('#municip').change(function(){
		var str = ($("#municip").val() + "/" + $("#y").val());
		location.href = location.href.replace(/[0-9]+\/([0-9]+)$/, str);
	})
    $('#y').change(function(){
    	var str = ($("#municip").val() + "/" + $("#y").val());
        location.href = location.href.replace(/[0-9]+\/([0-9]+)$/, str);
    });

  $('#chronology').change(function(){
     qveynischarti(this.value);
     greenRed($("#selectx"));
     details($("#selectx").val(),$("#chronology").val());
     $(".chartplace .left .title").html($(this).find("option[value=" + $(this).val() + "]").text());
  });

details(2015,9);

//greenRed($("#selectx"));


// detluri agwera
function details(year,unit){
  $.getJSON("http://epfund.flash.ge/self-governing/chronology?joli_year=" + year + "&joli_unit=" + unit, function(result){
    //alert(result.shemosavali_subcategory.length);
    $("div.desc article.expances div.income").html("");
    $("div.desc article.expances div.expances").html("");
    // shemosavledbi 
    var firstUl = $("<ul class='first'></ul>");
    for(i=0; i<result.shemosavlebi.parent.length; i++){
      var li1 = $("<li>" + result.shemosavlebi.parent[i].name + " <span class='amount'>" + commaSeparateNumber(result.shemosavlebi.parent[i].value) + " ლარი</span></li>");
      var subul = $("<ul></ul>");
      for(j=0; j<result.shemosavali_subcategory.length; j++){
        if(result.shemosavlebi.parent[i].id == result.shemosavali_subcategory[j].parent_id){
          var li2 = $("<li>" + result.shemosavali_subcategory[j].child_name + " <span class='amount'>" + commaSeparateNumber(result.shemosavali_subcategory[j].child_value) + " ლარი</span></li>");
          $(subul).append(li2);
        }
      }
      $(li1).append(subul);
      $(firstUl).append(li1);
    }
    //xarjebi section
    var secondUl = $("<ul class='first'></ul>");
    for(i=0; i<result.xarji.parent.length; i++){
      var li1 = $("<li>" + result.xarji.parent[i].name + " <span class='amount'>" + commaSeparateNumber(result.xarji.parent[i].value) + " ლარი</span></li>");
      var subul = $("<ul></ul>");
      for(j=0; j<result.xarji.xarji_subcategory.length; j++){
        if(result.xarji.parent[i].id == result.xarji.xarji_subcategory[j].parent_id){

          var li2 = $("<li>" + result.xarji.xarji_subcategory[j].child_name + " <span class='amount'>" + commaSeparateNumber(result.xarji.xarji_subcategory[j].child_value) + " ლარი</span></li>");
          $(subul).append(li2);
        }
      }
      $(li1).append(subul);
      $(secondUl).append(li1);
    }
    $("div.desc article.expances div.income").append(firstUl);
    $("div.desc article.expances div.expances").append(secondUl);
    expancesAcordeon();
  });

}


function greenRed(obj){
  $.getJSON("http://epfund.flash.ge/self-governing/chronology?bottom="+ $(obj).val() + "&j=" + $('#chronology').val(), function(result){
      //green chart
      var left = 0;
      $("#grad1 span").remove();
      $("#grad1 .d1").remove();
      for(i=0; i<result.shemosavali.GREEN.length; i++){
        var width = (100/result.green_total_income)*result.shemosavali.GREEN[i].min_income;
        left += width;
        var div = $("<div class='d1' data-val='" + result.shemosavali.GREEN[i].min_income + "' data-name='" + result.shemosavali.GREEN[i].name + "' style='width: " + width + "%; height: 100%; box-sizing: border-box; float: left; position: relative;'></div>");
        var span = $("<span class='joxi' style='position: absolute; height: 100%; width: 3px; background-color: #F9FAFC; left: " + left + "%'></span>");
        $("#grad1 div.grad").append(div);
        $("#grad1 div.grad").append(span);
      }
      for(j=0; j<=16; j++){
        var left = (100/result.green_total_income) * (j * result.green_total_income/16);
        var span = $("<span class='skala' style='position: absolute; display: block; left: " + left + "%; width: 1px; background-color: #CCCCCC; height: 13px; top: 52px;'></span>");
        var span2 = $("<span class='text' style='position: absolute; display: block; left: " + left + "%; top: 65px; font-size: 9px; color: #666666; font-family: BPG Phone Sans;'>" + ((j * result.green_total_income/16)/1000000).toFixed(2) + " მლნ</span>");
        $("#grad1").append(span);
        $("#grad1").append(span2);
      }
      //gradient chart tooltip
      $("#grad1 .grad div").hover(function(){
        
        var tooltip2 = $("<div class='canvastooltip2'></div>");
        $(tooltip2).html("<span class='title'>დანიშნულება:</span>" + $(this).data("name") + "<span class='title'>ხარჯი:</span> " + commaSeparateNumber($(this).data("val")) + " ლარი");
        $("section.dd div.wrapper div.desc").append(tooltip2);
        var width = $(tooltip2).innerWidth();
        var height = $(tooltip2).innerHeight();
        $(tooltip2).css({top: $("#grad1").position().top - height + 10, left: ($(this).position().left - 40) + ($(this).width()/2), width: width, display: "block"});
        //alert($(this).position().left);
        

      }, function(){
        $("section.dd div.wrapper div.desc").find(".canvastooltip2").remove();
      });

      //red chart
      var left = 0;
      $("#grad2 span").remove();
      $("#grad2 .d1").remove();
      for(i=0; i<result.shemosavali.RED.length; i++){
        var width = (100/result.red_total_income)*result.shemosavali.RED[i].min_income;
        left += width;
        var div = $("<div class='d1' data-val='" + result.shemosavali.RED[i].min_income + "' data-name='" + result.shemosavali.RED[i].name + "' style='width: " + width + "%; height: 100%; box-sizing: border-box; float: left; position: relative;'></div>");
        var span = $("<span class='joxi' style='position: absolute; height: 100%; width: 3px; background-color: #F9FAFC; left: " + left + "%'></span>");
        $("#grad2 div.grad").append(div);
        $("#grad2 div.grad").append(span);
      }
      for(j=0; j<=16; j++){
        var left = (100/result.red_total_income) * (j * result.red_total_income/16);
        var span = $("<span class='skala' style='position: absolute; display: block; left: " + left + "%; width: 1px; background-color: #CCCCCC; height: 13px; top: 52px;'></span>");
        var span2 = $("<span class='text' style='position: absolute; display: block; left: " + left + "%; top: 65px; font-size: 9px; color: #666666; font-family: BPG Phone Sans;'>" + ((j * result.red_total_income/16)/1000000).toFixed(2) + " მლნ</span>");
        $("#grad2").append(span);
        $("#grad2").append(span2);
      }
      //gradient chart tooltip
      $("#grad2 .grad div").hover(function(){
        
        var tooltip2 = $("<div class='canvastooltip2'></div>");
        $(tooltip2).html("<span class='title'>დანიშნულება:</span>" + $(this).data("name") + "<span class='title'>ხარჯი:</span> " + commaSeparateNumber($(this).data("val")) + " ლარი");
        $("section.dd div.wrapper div.desc").append(tooltip2);
        var width = $(tooltip2).innerWidth();
        var height = $(tooltip2).innerHeight();
        $(tooltip2).css({top: $("#grad2").position().top - height + 10, left: ($(this).position().left - 40) + ($(this).width()/2), width: width, display: "block"});
        //alert($(this).position().left);
        

      }, function(){
        $("section.dd div.wrapper div.desc").find(".canvastooltip2").remove();
      });

    });
}

  $("#selectx").change(function(){
    greenRed(this);
    qveynischarti($("#chronology").val());
     details($(this).val(),$("#chronology").val());
  });

	// budget compare
	function sparate_compare(year1, year2, type){
		$.getJSON("http://epfund.flash.ge/country-compare/" + year1 + "/" + year2 + "/" + type, function(result){
      var val = (type == 2) ? "ხარჯები" : "შემოსავლები";
			$(".witeli").html("");
			$(".witeli").append("<div class='h'>შემცირებული " + val + "</div>");
			$(".mwvane").html("");
			$(".mwvane").append("<div class='h'>გაზრდილი " + val + "</div>");
		for(i in result)
		{
			if(result[i].compare > 0)
			{
				// increesed 
				var row = $("<div class='rows'><div>" + result[i].name + "</div><div> " + (result[i].value/1000000).toFixed(1) + " მლნ</div><div>" + (result[i].value2/1000000).toFixed(1) + " მლნ</div><div class='increes'>" + result[i].compare + " %</div></div>");
				$(".mwvane").append(row);
			}
			else if(result[i].compare == 0)
			{

			}
			else
			{
				//decreesed
				var row = $("<div class='rows'><div>" + result[i].name + "</div><div> " + (result[i].value/1000000).toFixed(1) + " მლნ</div><div>" + (result[i].value2/1000000).toFixed(1) + " მლნ</div><div class='decrees'>" + Math.abs(result[i].compare) + " %</div></div>");
				$(".witeli").append(row);
			}
		}
	});
	}

	function cauntry_sperate_compare(year1, year2, type){
		$.getJSON("http://epfund.flash.ge/separeted_json/" + year1 + "/" + year2 + "/" + type, function(result){
      if(year1 == year2)
      {
        $(".comparetable div.h div").eq(1).html((commaSeparateNumber((result[0][0][type]/1000000).toFixed(1))) + " მლნ");
        $(".comparetable div.h div").eq(2).html((commaSeparateNumber((result[0][0][type]/1000000).toFixed(1))) + " მლნ");
        if(result.compare < 0)
        {
        	$(".comparetable div.h div")[3].className = "";
          $(".comparetable div.h div").eq(3).addClass("decrees");
          $(".comparetable div.h div.decrees").html(result.compare + " %");

        }
        else if(result.compare == 0)
        {
        	$(".comparetable div.h div")[3].className = "";
          $(".comparetable div.h div").eq(3).addClass("equal");
          $(".comparetable div.h div.equal").html(result.compare + " %");
        }
        else
        {
        	$(".comparetable div.h div")[3].className = "";
          $(".comparetable div.h div").eq(3).addClass("increes");
          $(".comparetable div.h div.increes").html(result.compare + " %");
        }
      }
      else
      {
        $(".comparetable div.h div").eq(1).html((commaSeparateNumber((result[0][0][type]/1000000).toFixed(1))) + " მლნ");
        $(".comparetable div.h div").eq(2).html((commaSeparateNumber((result[0][1][type]/1000000).toFixed(1))) + " მლნ");
        if(result.compare < 0)
        {
        	$(".comparetable div.h div")[3].className = "";
          $(".comparetable div.h div").eq(3).addClass("decrees");
          $(".comparetable div.h div.decrees").html(result.compare + " %");
        }
        else if(result.compare == 0)
        {
        	$(".comparetable div.h div")[3].className = "";
          $(".comparetable div.h div").eq(3).addClass("equal");
          $(".comparetable div.h div.equal").html(result.compare + " %");
        }
        else
        {
        	$(".comparetable div.h div")[3].className = "";
          $(".comparetable div.h div").eq(3).addClass("increes");
          $(".comparetable div.h div.increes").html(result.compare + " %");
        }
      }
		});
	}

	cauntry_sperate_compare(2014, 2015, "outcome");
	sparate_compare(2014,2015,2);


	$("div.comparetable div.caption div ul.year1 li").click(function(){
    var inout = ($("#gadamrtveli").find(".active").data('val') == 2) ? "outcome" : "income";
		var year1 = parseInt($(this).data("year"));
		var year2 = parseInt($("div.comparetable div.caption div span.y2").html());

		$("div.comparetable div.caption div span.y1").html(year1);
	  	cauntry_sperate_compare(year1, year2, inout);
	  	sparate_compare(year1,year2, $("#gadamrtveli").find(".active").data('val'));
	  });
	$("div.comparetable div.caption div ul.year2 li").click(function(){
    var inout = ($("#gadamrtveli").find(".active").data('val') == 2) ? "outcome" : "income";
		var year1 = parseInt($("div.comparetable div.caption div span.y1").html());
		var year2 = parseInt($(this).data("year"));
		$("div.comparetable div.caption div span.y2").html(year2);
	  	cauntry_sperate_compare(year1, year2, inout);
	  	sparate_compare(year1,year2,$("#gadamrtveli").find(".active").data('val'));
	  });



	//comparechart

	var data2 = [
        { 
            type: "spline",
            name: "შემოსავალი",
      markerSize: 10,
      markerColor: "#F5F5F5",
      markerBorderColor: "#24BFAD",
      markerBorderThickness: 3,
      lineColor: "#24BFAD",
            dataPoints: [
            
            ]
    },
        {
            type: "spline",
            name: "ხარჯი",
      markerSize: 10,
      markerColor: "#F5F5F5",
      markerBorderColor: "#F0A348",
      markerBorderThickness: 3,
      lineColor: "#F0A348",
            dataPoints: [
            ]
      
     },
     {
            type: "spline",
            name: "დეფიციტი",
      markerSize: 10,
      markerColor: "#F5F5F5",
      markerBorderColor: "#F45E4D",
      markerBorderThickness: 3,
      lineColor: "#F45E4D",
            dataPoints: [
            ]
      
     },
        ];


	$.getJSON("http://epfund.flash.ge/budget-chart", function(result){ 
		//alert(result.MIN_MAX[0].max_income);
		//var min = Math.min(result.MIN_MAX[0].min_income,result.MIN_MAX[0].min_outcome);
		var max = Math.max(result.MIN_MAX[0].max_income, result.MIN_MAX[0].max_outcome);
    var min = 0;
  for(i in result){
      if($.isNumeric( i )){
        data2[0].dataPoints[i] = { x: result[i].year, y: Number(result[i].income) };                                   
        data2[1].dataPoints[i] = { x: result[i].year, y: Number(result[i].outcome) }; 
        data2[2].dataPoints[i] = { x: result[i].year, y: -Number(result[i].budget_deficit)};
        if(-Number(result[i].budget_deficit) < min)
        {
          min = -Number(result[i].budget_deficit);
        }
      }
}
//alert(min);
    var chart = new CanvasJS.Chart("comparechart",
    {
        title: {
            text: " "
        },
        backgroundColor: "transparent",
        toolTip: {
            shared: true,
            contentFormatter: function (e) {
                var content = "<span class='title'>წელი:</span> " + e.entries[0].dataPoint.x + "<br> ";
                for (var i = 0; i < e.entries.length; i++) {
          if(e.entries[i].dataPoint.y >= 1000000)
            {
              content += "<span class='title'>" + e.entries[i].dataSeries.name + "</span> " + "<strong><span>" + commaSeparateNumber(e.entries[i].dataPoint.y) + "</span></strong>";
            }
          else if(e.entries[i].dataPoint.y < 0)
          {
            content += "<span class='title'>" + e.entries[i].dataSeries.name + "</span> " + "<strong><span>" + commaSeparateNumber(e.entries[i].dataPoint.y) + "</span></strong>";
          }              
                    content += "<br/>";
                }
                return content;
            }
        },
        axisX: {
            gridColor: "green",
      maximum: 2015.1,
      minimum: 2009.9,
      interval: 1,
      tickLength: 15,
      tickThickness: 0,
      valueFormatString: "###"
        },
        axisY: {
      includeZero: false,
      tickThickness: 0,
      gridColor: "#CCCCCC",
      gridThickness: 1,
      lineThickness: 0,
      minimum: min + (min/2),
      maximum: max + ((max-min)/5)/2,//((max-max)/5)+150000000,
            interval: (max-min)/5,
      // minimum: 6486731900,
      // maximum: parseInt	(result.MIN_MAX[0].max_income),
      //       interval: (8110493100-6486731900)/5,
      suffix: "",
      labelFormatter: function(e){
        if(e.value < 0)
          {
            e.value = " ";
          }
        else
          {
            e.value = Math.ceil(e.value/1000000) + " მლნ";
          }
        return e.value;
      }
        },
        data: data2
    });
    chart.render();
});



	//date pickers
	$( "form.srch #from" ).datepicker({
  dateFormat: "yy-mm-dd"
});
	$("form.srch #to").datepicker({
  dateFormat: "yy-mm-dd"
});

  //change year dropdown
  $("div.comparetable div.caption div span.arrow").click(function(){
    if($(this).parent().find("ul.dropdown").html() != undefined){
      if($(this).parent().find("ul.dropdown").hasClass("active"))
      {
        //close
        $(this).removeAttr("style");
        $(this).parent().find("ul.dropdown").removeClass("active");
        $(this).parent().find("ul.dropdown").hide();
      }
      else
      {
        //open
        $(this).parent().find("ul.dropdown").css({left: $(this).position().left-$(this).parent().find("ul.dropdown").innerWidth() + 32});
        $(this).css({height: "30px", backgroundImage: "url('images/arrowup.png')", backgroundPosition: "center 7px", boxShadow: "0 0 5px rgba(0,0,0,0.3)", borderRadius: "50px 50px 0 0"});
        $(this).parent().find("ul.dropdown").addClass("active");
        $(this).parent().find("ul.dropdown").show();
      }
    }
  }); 



  $("div.comparetable div.caption div ul.dropdown li").click(function(){
       $(this).parent().removeAttr("style");
        $(this).parent().removeClass("active");
        $(this).parent().hide();
        $(this).parent().parent().find(".arrow").removeAttr("style");
        $(this).parent().find(".arrow").removeAttr("style");

  });



  //municipality compare
  $("section.comparemunic2 .drowpdown ul.sub").hide();


  $("section.comparemunic2 .drowpdown").click(function(e){
    $(this).css({height: "45px", borderRadius: "4px 4px 0 0"});
    $(this).find('ul.sub').show();
    e.stopPropagation();
    e.preventDefault();
  });
  $(document).click(function(e){
    $("section.comparemunic2 .drowpdown ul.sub").hide();
    $("section.comparemunic2 .drowpdown").css({height: "30px", borderRadius: "4px"});
  });


    function donutChart(name, persent, toolTipContent1, toolTipContent2){
      CanvasJS.addColorSet("myShades",
                [//colorSet Array

                "#EEEEEE",
                "#2B7CBE"               
                ]);

var chart = new CanvasJS.Chart(name,
    {
  colorSet: "myShades",
  backgroundColor: "transparent",
      data: [
      {
        toolTipContent: "{label}",  
       indexLabelPlacement: "inside",    //Try Changing to outside
       type: "doughnut",
        startAngle: -90,
        radius: "100%",
        innerRadius: "50%",
       dataPoints: [
         
       {  y: (100 - persent), label: toolTipContent2, indexLabel:(100 - persent) + "%", indexLabelFontColor: "#2B7CBE", },
       {  y: persent, label: toolTipContent1, indexLabel:persent + "%", indexLabelFontColor: "#FFFFFF", }

       ]
     }
     ]
   });

    chart.render();
    }

    try{
    	var v1 = Number($("div.left span.val").html().replace(/,/g,"").match(/[0-9]+/)[0]) - Number($("#val1").data('val'));
    	var v2 = Number($("div.right span.val").html().replace(/,/g,"").match(/[0-9]+/)[0]) - Number($("#val2").data('val2'));
      donutChart("donat1", parseFloat($("#firstDonaut").html()), $("#name1").html(), commaSeparateNumber(v1) + " ლარი");
      donutChart("donat2", parseFloat($("#secondDonaut").html()), $("#name2").html(), commaSeparateNumber(v2) + " ლარი");
    }
    catch(e){
      console.log(e);
    }


    $("section.comparemunic2 div.left div.drowpdown ul.sub input[type='button']").click(function(){
      var f1 = $("#f1").val();
      var f2 = $("#f2").val();
      var f3 = $("#f3").val();
      var link = location.href;
      link = link.replace(/f1=[0-9]+&f2=[0-9]+&f3=[0-9]+/,"f1="+f1+"&f2="+f2+"&f3="+f3);
      location.href = link;
    });

    $("section.comparemunic2 div.right div.drowpdown ul.sub input[type='button']").click(function(){
      var s1 = $("#s1").val();
      var s2 = $("#s2").val();
      var s3 = $("#s3").val();
      var link = location.href;
      link = link.replace(/s1=[0-9]+&s2=[0-9]+&s3=[0-9]+/,"s1="+s1+"&s2="+s2+"&s3="+s3);
      location.href = link;
    });

    //main page slider
    $("#mainslider").owlCarousel({
 
      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true
 
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
 
  });




});
    // expenditures
    $("section.expenditures article").click(function(){

     $("section.categories div.rem").remove();
  var tooltip = $(this).find('.tooltip').clone();
  var index = $(this).index()+1;
  var after = Math.ceil(index/5)*5;
  var rowIndex = 5 - (after - index);
  var id = $(this).attr("id");
  $(tooltip).addClass('rem');
  $("section.categories article div.img img").css({filter: "brightness(1000%)", '-webkit-filter': "brightness(1000%)"});
  $("section.categories article span.cost").css({color: "#FFFFFF"});
  $("section.categories article").css({marginLeft: "0", marginRight: "32.5px", backgroundColor: "#2B7CBE"});
  $(this).css({backgroundColor: "#FFFFFF"});
  $(this).find("div.img img").css({filter: "brightness(100%)", '-webkit-filter': "brightness(100%)"});
  $(this).find("span.cost").css({color: "#103A62"});
  $("section.categories article:nth-child(5n+5)").css({marginRight: "0"});
  if($("section.categories article").length % 5 != 0 && (index > ($("section.categories article").length - 5))){
    $(tooltip).insertAfter($("section.categories article").eq(index));
  }
  
  if($("section.categories article").length % 5 != 0 && (index == $("section.categories article").length)){
    $(tooltip).insertAfter($("section.categories article").eq(index-1));
  }

    $(tooltip).insertAfter($("section.categories article").eq(after - 1));
  var height = $(tooltip).innerHeight();
  //$(tooltip).css({height: "0", padding: "0"});
  $(tooltip).animate({height: height, padding: "30px"},500);
  $(tooltip).css('display','block');
  $(tooltip).find("span.before").css("left",(rowIndex*210)-(210/2) + (32.5 * (rowIndex-1))-15);
    $(tooltip).fadeIn();
    $(".categories .rem .diagram").css("position","relative");
    var shitId = $(".categories .rem .diagram").attr("id").match(/[0-9]+/)[0];
    $(tooltip).find(".diagram").html("<div id='shit" + shitId + "' style='width: 100%; height: 250px; position: absolute'></div>");
    try{

      $.getJSON("http://epfund.flash.ge/mycountry/expenditures?lines=" + id, function(result){
        var dataPoints = [];
        var minimal = parseInt(result[0].value);
        var maximal = 0;
        for(i=0; i<result.length; i++){
        	if(parseInt(result[i].value) > maximal)
        	{
        		maximal = parseInt(result[i].value);
        	}
        	if(i < result.length - 2)
        	{
        		minimal = Math.min(minimal, parseInt(result[i+1].value));
        	}
        	dataPoints.push({x: parseInt(result[i].year), y: parseInt(result[i].value)});	
        }
        var interval = (maximal - minimal) / 5;
      var chart = new CanvasJS.Chart("shit" + shitId,
    	{
      title:{
      text: ""
      },
      backgroundColor: "transparent",
       data: [
      {        
        type: "spline", 
      markerSize: 10,
      markerColor: "#F5F5F5",
      markerBorderColor: "#F0A348",
      markerBorderThickness: 3,
      lineColor: "#F0A348",
        dataPoints
      }       
        
      ],
      toolTip: {
            shared: true,
            contentFormatter: function (e) {
                var content = "<span class='year'>წელი: " + e.entries[0].dataPoint.x + "</span> ";
                for (var i = 0; i < e.entries.length; i++) {
          if(e.entries[i].dataPoint.y >= 1000000)
            {
              content += "<span class='x'>" + "<strong>" + commaSeparateNumber(e.entries[i].dataPoint.y) + "მლნ</strong></span>";
            }
          else{
              content += "<span class='x'>" + "<strong>" + commaSeparateNumber(e.entries[i].dataPoint.y) + "</strong></span>";
          }                 
                    content += "<br/>";
                }
                return content;
            }
        },
      axisX: {
      gridColor: "green",
      maximum: 2015.1,
      minimum: 2009.9,
      interval: 1,
      tickLength: 0,
      tickThickness: 0,
      valueFormatString: "###"
        },
        axisY: {
      includeZero: false,
      tickThickness: 0,
      gridThickness: 1,
      lineColor: "#CCCCCC",
      lineThickness: 0,
      minimum: minimal - (interval / 2),
      maximum: maximal + (interval / 2), 
      interval: interval,
  		}
    });

    chart.render();

      });
    }
    catch(e){
      console.log(e);
    }
  $('body').animate({scrollTop: $(this).offset().top});
    });

    
    // range slider
    $("div.range").each(function(){
      var amount = $(this).data("amount");
      $(this).slider({
        min: 0,
        max: (amount * 2),
        value: amount,
        slide: function(event, ui){
          $(this).prev().html(commaSeparateNumber(ui.value));
        }
      });
    });



//  local budget chart

function localBudget(selector, url){
  $.getJSON(url, function(result){
    var html = "<div class='ch'><div class='area'>";
    var containerWidth = $(selector).innerWidth();
    var size = result[0].length;
    var width = (containerWidth-(12*size)) / size;
    for(i=0; i<size; i++){
      var height = 100 / result.max_value * result[0][i].value;
      html += "<div class='column' data-value='" + result[0][i].value + "' data-name='" + result[0][i].name + "' style='width:" + width + "px; height: " + height + "%; margin-left: 10px'></div>";
    }
    html += "</div><div class='Lpoint'></div><div class='Rpoint'></div><div class='line'></div></div>";
    $(selector).html(html);
    localBudgetTooltip(selector);
  });
  
}
var localCitiesUrl = "http://epfund.flash.ge/local-cities/" + $("#Year").val();
localBudget("#mainchart .wrapper", localCitiesUrl);

function localBudgetTooltip(selector){
 $(selector + " .column").hover(function(){
        var tooltip2 = $("<div class='canvastooltip2'></div>");
        $(tooltip2).html("<span class='title'>მუნიციპალიტეტი: </span>" + $(this).data("name") + "<span class='title'>ხარჯი: </span>" + commaSeparateNumber($(this).data("value")) + " ლარი");
        $(this).append(tooltip2);
        var width = $(tooltip2).outerWidth();
        var height = $(tooltip2).innerHeight();
        $(tooltip2).css({top: $(this).position().top - height, left: ($(this).position().left + $(this).width()/2 - width/2), width: width, display: "block"});
        

      }, function(){
        $(selector).find(".canvastooltip2").remove();
      });
}


$("#stylizer").selectmenu({
  change: function( event, ui ) {
    console.log();
    location.href = "http://epfund.flash.ge/self-governing/chronology/" + ui.item.index;
  }
});


$("#exp_year").change(function(){
	location.href = this.value;
});


// compare Candle
function candleChart(val1, val2, name1, name2){
  var max = Math.max(val1,val2);
  var min = Math.min(val1,val2);

  var height1 = 100 / max * val1;
  var height2 = 100 / max * val2;
  $(".candleChart .chart .column").eq(0).css({height: height1 + "%"});
  $(".candleChart .chart .column").eq(0).find(".val").html(commaSeparateNumber(val1) + " ლარი");
  $(".candleChart .chart .column").eq(0).find(".name").html(name1);
  $(".candleChart .chart .column").eq(1).css({height: height2 + "%"});
  $(".candleChart .chart .column").eq(1).find(".val").html(commaSeparateNumber(val2) + " ლარი");
  $(".candleChart .chart .column").eq(1).find(".name").html(name2);
}

try{
	var val1 = $("#val1").data("val");
	var val2 = $("#val2").data("val2");
	var name1 = $("h3#title1").html(); 
	var name2 = $("h3#title2").html();
	candleChart(val1, val2, name1, name2);
}
catch(e){
	console.log(e);
}



// adjust compare table sizes

var maxtablesize = Math.max($("div.tablecont").eq(0).innerHeight(),$("div.tablecont").eq(1).innerHeight());
$("div.tablecont").height(maxtablesize);


// form validations
$("#phone").keypress(restrictChars);

$("#fullname").keypress(restrictNums);

$("#yourname").keypress(restrictNums);

function restrictChars(e){
  if(e.keyCode != 8 && e.keyCode != 9 && e.keyCode != 46 && String.fromCharCode(e.charCode).search(/[0-9]/) == -1)
  {
    return false;
  }
}

function restrictNums(e){
  if(e.keyCode != 8 && e.keyCode != 9 && e.keyCode != 46 && String.fromCharCode(e.charCode).search(/[a-z,A-Z,ა-ჰ]/) == -1)
  {
    return false;
  }
}

$.validate();
