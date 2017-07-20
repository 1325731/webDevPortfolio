<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>Draw my Thang</title>
<link rel="stylesheet" target=_blank href="lib/drawer.css" >
<script src="lib/jquery-2.1.4.js"></script>
<script src="lib/jscolor.min.js"></script>
<script src="lib/draw.js"></script>
</head>
<body><br>
	<h2>Yo, <?php echo $_SESSION['user']?></h2>
	<div id="drawarea">
		<canvas id="can" class="dropper" width="600" height="600"></canvas>
		<div id="sidebar">
			<div style="background:red;" 	 	 onclick="color(this)" class="colors" id="red"></div>
			<div style="background:orange;"  	 onclick="color(this)" class="colors" id="orange"></div>
			<div style="background:yellow;" 	 onclick="color(this)" class="colors" id="yellow"></div>
			<div style="background:lime;" 		 onclick="color(this)" class="colors" id="lime"></div>
			<div style="background:green;" 		 onclick="color(this)" class="colors" id="green"></div>
			<div style="background:blue;" 	 	 onclick="color(this)" class="colors" id="blue"></div>
			<div style="background:cyan;" 		 onclick="color(this)" class="colors" id="cyan"></div>
			<div style="background:purple;" 	 onclick="color(this)" class="colors" id="purple"></div>
			<div style="background:pink;" 		 onclick="color(this)" class="colors" id="pink"></div>
			<div style="background:saddlebrown;" onclick="color(this)" class="colors" id="saddlebrown"></div>
			<div style="background:gray;"  		 onclick="color(this)" class="colors" id="gray"></div>
			<div style="background:black;" 		 onclick="color(this)" class="colors" id="black"></div>
			<div style="background:white;" 		 onclick="color(this)" class="colors" id="white"></div>
			<button class="jscolor {valueElement:'chosen-value', value:'000', onFineChange:'picked(this)'}" id="curcol"></button>
			<div id="sizes">
				<pre onclick="size(this,2)"   id="s2">2</pre><hr>
				<pre onclick="size(this,4)"   id="s4">4</pre><hr>
				<pre onclick="size(this,8)"   id="s8">8</pre><hr>
				<pre onclick="size(this,16)"  id="s16">16</pre><hr>
				<pre onclick="size(this,32)"  id="s32">32</pre><hr>
				<pre onclick="size(this,64)"  id="s64">64</pre><hr>
				<pre onclick="size(this,128)" id="s128">128</pre>
			</div>
			<div id="tools">
				<pre onclick="tools(this)" id="pencil">Pencil</pre><hr>
				<pre onclick="tools(this)" id="backchange">Canvas</pre><hr>
				<pre onclick="tools(this)" id="dropper">Dropper</pre>
			</div>
			<div id="sizes">
				<pre onclick="erase()">Clear</pre><!--<hr>
				<pre onclick="saveImage()">Save</pre><hr>
				<pre onclick="loadImage()">Load</pre>-->
			</div>
		</div>
	</div>
</html>