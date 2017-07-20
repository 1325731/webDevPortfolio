var canvas, ctx, flag = false,
prevX = 0,
currX = 0,
prevY = 0,
currY = 0,
h = 0,
w = 0,
addOffX = 9,
addOffY = 9,
dot_flag = false,
offsetX = 0,
offsetY = 0,
canvasOffset = false;

var x = "black";
var y = 4;
var mouseup=1;
var tool="pencil";

$(document).ready(function() {
	canvas = document.getElementById('can');
	ctx = canvas.getContext("2d");
	w = canvas.width;
	h = canvas.height;
	loadImage();
	canvasOffset = $("#can").offset();
	offsetX = canvasOffset.left;
	offsetY = canvasOffset.top;
	
	canvas.addEventListener("mousemove", function (e) {
		if(e.button === 0)
			findxy('move', e);
	}, false);
	canvas.addEventListener("mousedown", function (e) {
		mouseup=0;
		if(e.button === 0)
			findxy('down', e);
	}, false);
	canvas.addEventListener("mouseup", function (e) {
		mouseup = 1;
			findxy('up', e);
	}, false);
	canvas.addEventListener("mouseout", function (e) {
			findxy('out', e);
	}, false);
	
    $("#s4").addClass("clickeds");
    $("#pencil").addClass("clickedt");
	
	$("#can").mousemove(function (e) {
	    handleMouseMove(e);
	});
	
	setInterval (loadImage, 1000);		//Reload file every .25 seconds
});

function color(obj) {
	x = obj.id;
	document.getElementById("curcol").style.backgroundColor = x;
}

function picked(picker) {	
	x = '#' + picker.toString();	
}

function size(obj, size) {
	$(".clickeds").removeClass("clickeds");
	y = size;
    $(obj).addClass("clickeds");
}

function tools(obj) {
	$(".clickedt").removeClass("clickedt");
	tool = obj.id;
    $(obj).addClass("clickedt");
}

function saveImage(){
	var dataURL = canvas.toDataURL();
	$.ajax({
	   url: 'lib/saveimg.php',
	   type: 'POST',
	   data: { img: dataURL }
	})

/*
	$.post( "lib/saveimg.php",  
    // POST_VAR: JS_VAR; passing in the javascript values through post
    { img: dataURL }) */
    
    /*  Done Method 
        -----------  */
    .done(function( data ) {
    })
          
    /*  Fail Method 
        -----------  */
    .fail(function( data ) {
	  console.log('nope'); 
    });
	
}

function loadImage() {
	if (mouseup == 1) {
		var d = new Date();
		var drawing = new Image();
		drawing.src = "../cache/canvas.png?"+d.getTime(); // can also be a remote URL e.g. http://
		drawing.onload = function() {
		   ctx.drawImage(drawing,0,0);
		};
	}
}

function draw() {
	ctx.beginPath();
	ctx.moveTo(prevX, prevY);
	ctx.lineTo(currX, currY);
	ctx.lineJoin = 'round';
	ctx.lineCap = 'round';
	ctx.strokeStyle = x;
	ctx.lineWidth = y;
	ctx.stroke();
	ctx.closePath();
	}

function erase() {
	ctx.fillStyle = "white";
	ctx.fillRect(0, 0, w, h);
	saveImage();
}

function findxy(res, e) {
	if (tool == 'pencil') {
		if (res == 'down') {
			prevX = currX;
			prevY = currY;
			currX = e.clientX - canvasOffset.left;
			currY = e.clientY - canvasOffset.top;
	
			flag = true;
			dot_flag = true;
			if (dot_flag) {
				ctx.beginPath();
				ctx.arc(currX, currY, y/2, 0, 2*Math.PI);
				ctx.fillStyle = x;
				ctx.fill();
				ctx.closePath();
				dot_flag = false;
			}
		}
		if (res == 'up' || res == 'out') {
			flag = false;
			saveImage();
		}
		if (res == 'move') {
			if (flag) {
				prevX = currX;
				prevY = currY;
				currX = e.clientX - canvasOffset.left;
				currY = e.clientY - canvasOffset.top;
				draw();
			}
		}
	}
	
	if (tool == 'backchange') {
		if (res == 'down') {
			ctx.fillStyle = x;
			ctx.fillRect(0, 0, w, h);
			saveImage();
		}
	}
	
	if (tool == 'dropper') {
		if (res == 'down') {
			$(".clickedt").removeClass("clickedt");
			tool = 'pencil';
		    $('#pencil').addClass("clickedt");
		}
	}
}

function getPixelColor(x, y) {
    var pxData = ctx.getImageData(x, y, 1, 1);
    return ("rgb(" + pxData.data[0] + "," + pxData.data[1] + "," + pxData.data[2] + ")");
}

function handleMouseMove(e) {
    if (tool != "dropper") {
        return;
    }

    var mouseX = parseInt(e.clientX - offsetX);
    var mouseY = parseInt(e.clientY - offsetY);

    // Put your mousemove stuff here
	x = getPixelColor(mouseX, mouseY);
	document.getElementById("curcol").style.backgroundColor = x;
}
