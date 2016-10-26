
function Chart(canvas, width, height, data, type, color, grad, colors){
  this.canvas = canvas;
  this.ctx = this.canvas.getContext("2d");
  this.width = width;
  this.height = height;
  this.data = data;
  this.minimum = data["MINIMAL-VALUE"];
  this.maximum = data["range_max"];
  this.mid = this.maximum - this.minimum;
  this.step = this.mid/data["count"];
  this.scalenum = data["count"];
  this.columns = [];
  this.type = type;
  this.colors = colors;
  this.color = color;
  this.grad = grad;
  //display text
  this.drawText = function(fontSize, font, color,text,x,y){
    this.ctx.font = fontSize + "px " + font;
    this.ctx.fillStyle = color;
    this.ctx.fillText(text,x,y);
  }

  //add Columns to chart
  this.addColls = function(){
    var c = 0;
      for(i in this.data){
      for(j=0; j<this.data.count; j++){
        if(i == j){
          if(this.data[i].length > 0){
            var arr = [];
            for(k=0; k<this.data[i].length; k++){
              arr.push(this.data[i][k].name);
            }
            var color = this.color;
            if(this.grad == true && this.colors !== undefined)
            {
            	 var grad = this.ctx.createLinearGradient(0,0, this.canvas.width,0);
            	 for(g = 0; g < this.colors.length; g++){
            	 	grad.addColorStop(g,this.colors[g]);
            	 }
            	 color = grad;
            }
            else if(this.colors == undefined)
            {
              color = this.color;
            }
            else
            {
              color = this.colors[c];
              c++;
            }
            if(this.type == "snap")
            {
              var rangestr = this.data[i][0].value/1000000 + " - " + this.data[i][this.data[i].length-1].value/1000000 + "მლნ";//((this.data["MINIMAL-VALUE"] + (i*this.step))/1000000) + " - " + (((this.data["MINIMAL-VALUE"] + (i*this.step)) + this.step)/1000000) + "მლნ";
              this.columns.push(new Column(i*(((this.canvas.width-12) / this.scalenum)*1)+6,this.canvas.height - (38 + (arr.length * 10)),(this.canvas.width / this.scalenum)*1,arr.length * 10,color,arr,rangestr));
            }
            else{
              var rangestr = ((this.data["MINIMAL-VALUE"] + (i*this.step))/1000000) + " - " + (((this.data["MINIMAL-VALUE"] + (i*this.step)) + this.step)/1000000) + "მლნ";
              var xcoord = (this.canvas.width/this.mid)*(this.data[i][0].value-18000000);
              var xcoord2 = (this.canvas.width/this.mid)*(this.data[i][this.data[i].length-1].value-18000000); 
              var colwidth = xcoord2-xcoord;
              this.columns.push(new Column((this.canvas.width/this.mid)*(this.data[i][0].value-this.data["MINIMAL-VALUE"])+6,this.canvas.height - (38 + (arr.length * 10)),colwidth-12,arr.length * 10,color,arr,rangestr));
            }
          }
        }
      }
    }
    console.log(this.columns);
  }
  //draw Columns
  this.drawColls = function(){
    for(i=0; i<this.columns.length; i++){
      this.columns[i].draw(this.ctx);
    }
  }
  //clear canvas
  this.clearCanvas = function(){
    this.ctx.clearRect(0,0,this.canvas.width,this.canvas.height);
  }
  //draw chart
  this.drawScreen = function(){
    var grd=this.ctx.createLinearGradient(0,0,this.canvas.width,0);
    grd.addColorStop(0,"#12AAEA");
    grd.addColorStop(1,"#FF0000");

    var line = new Line(6,this.canvas.height-34, this.canvas.width-6,this.canvas.height-34, 8, grd);

    this.addColls();

    var point1 = new Point(6,6,this.canvas.height-34,"#587A96");

    var point2 = new Point(6,this.canvas.width-6,this.canvas.height-34,"#587A96");

    this.clearCanvas();
      line.draw(this.ctx);
    //   for(i = 0; i <= this.scalenum; i++ ){
    //     var line2 = new Line(((this.canvas.width-12) / this.scalenum)*i + 6,this.canvas.height-30, ((this.canvas.width-12) / this.scalenum)*i + 6,this.canvas.height-17, 1, "#CCCCCC");
    //     line2.draw(this.ctx);
    //     this.drawText(9,"BPG Phone Sans","#666666",Math.round((this.data["MINIMAL-VALUE"]+ (this.step * i))/1000000) + "მლნ",((this.canvas.width-24) / this.scalenum)*i-6,this.canvas.height-5);
    // }
      this.drawColls();
      point1.draw(this.ctx);
      point2.draw(this.ctx);
  }
}

// Column Object
function Column(x,y,width,height, fill, municarr, range){
  this.x = x;
  this.y = y;
  this.width = width;
  this.height = height;
  this.fill = fill;
  this.municarr = municarr;
  this.range = range;
}

Column.prototype.draw = function(ctx){
  ctx.save();
  ctx.beginPath();
  ctx.fillStyle = this.fill;
  ctx.rect(this.x,this.y,this.width,this.height);
  ctx.fill();
  ctx.restore();
  ctx.closePath();
}

Column.prototype.isHover = function(x,y){
  if((x>=this.x && x<=this.x+this.width) && (y>=this.y && y<=this.y+this.height)){
    return true;
  }
}


//Line Object
function Line(x, y,  endX, endY, width, fill){
  this.x = x;
  this.y = y;
  this.endX = endX;
  this.endY = endY;
  this.fill = fill;
  this.width = width;
}

Line.prototype.draw = function(ctx){
  ctx.save();
  ctx.strokeStyle = this.fill;
  ctx.lineWidth = this.width;
  ctx.beginPath();
  ctx.moveTo(this.x,this.y);
  ctx.lineTo(this.endX, this.endY);
  ctx.stroke();
  ctx.restore();
  ctx.closePath();
}

//Point Object
function Point(radius, x, y, fill){
  this.radius = radius;
  this.x = x;
  this.y = y;
  this.fill = fill;
}

Point.prototype.draw = function(ctx){
  ctx.fillStyle = this.fill;
  ctx.strokeStyle = "green";
  ctx.beginPath();
  ctx.arc(this.x,this.y,this.radius,0,2*Math.PI);
  ctx.fill();
  ctx.closePath();
}

function clearCanvas(){
  ctx.clearRect(0,0,canvas.width,canvas.height);
}


function CreateChart(id,width, height, data, type, color, grad, colors){
  var canvas = document.getElementById(id);
  canvas.width = width;
  canvas.height = height;
  var chart = new Chart(canvas,width,height,data,type,color,grad,colors);
  chart.drawScreen();
  $(canvas).on('mousemove',function(e){
    for(i=0; i<chart.columns.length; i++){
     if(chart.columns[i].isHover(e.offsetX,e.offsetY)){
     	canvastooltip(chart.columns[i].range,chart.columns[i].municarr.join(", "));
        var canvastooltipwidth = $("div.canvastooltip").width();
       var canvastooltipheight = $("div.canvastooltip").innerHeight();
       var canvasoffset = $(canvas).offset();
        $("div.canvastooltip").css({left: ((e.clientX - e.offsetX) + chart.columns[i].x)-canvastooltipwidth/2 + (chart.columns[i].width/2) - 10, top: canvasoffset.top + canvas.height-48-chart.columns[i].height-canvastooltipheight});
          $("div.canvastooltip").show();
        chart.drawScreen();
      }
      else{
        $("div.canvastooltip").hide();
        chart.columns[i].fill="#24BFAD";
      }
    }  
  });
}

//fill tooltip
function canvastooltip(xarji,munic){
  var text01 = $("span.xarji");
  text01.text(xarji);
  var text02 = $("span.munic");
  text02.text(munic);
}