var circles = [];

$(document).ready(function(){
	$('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 220, // Creates a dropdown of 15 years to control year
		format: 'mm-dd-yyyy'
	});

	$("#other2").click(function()
	{
		$("#other1").prop("checked", true)
	});
	$("#other4").click(function()
	{
		$("#other3").prop("checked", true)
	});
	$("#other6").click(function()
	{
		$("#other5").prop("checked", true)
	});
	$("#other8").click(function()
	{
		$("#other7").prop("checked", true)
	});
	$("#other10").click(function()
	{
		$("#other9").prop("checked", true)
	});
	$("#other12").click(function()
	{
		$("#other11").prop("checked", true)
	});
	$("#other14").click(function()
	{
		$("#other13").prop("checked", true)
	});

	$("#clear-circles").click(function()
	{
		for (i = 0; i < circles.length; i++)
		{
			circles[i].remove();
		}
		circles = [];
	});

	$("form").submit(function()
	{
		var canvasb = document.getElementById("c");
		var img = canvasb.toDataURL("image/png");
		$("#hihi").val(img);
	});

	canvasStuff();
});

function canvasStuff()
{
	var canvas = new fabric.Canvas("c");
	fabric.Image.fromURL("img/bodies1.jpg", function(oImg){
		oImg.selectable = false;
		oImg.stroke = "black";
		oImg.strokeWidth = 2;
		canvas.add(oImg);
	});
	fabric.Image.fromURL("img/bodies2.jpg", function(oImg){
		oImg.top = 203;
		oImg.selectable = false;
		oImg.stroke = "black";
		oImg.strokeWidth = 2;
		canvas.add(oImg);
	});
	canvas.on('touch:drag', function(options) {
		fabric.Image.fromURL("img/circle.png", function(oImg){
			oImg.scale(0.05);
			oImg.originX = "center";
			oImg.originY = "center";
			oImg.top = options.e.layerY;
			oImg.left = options.e.layerX;
			oImg.selectable = false;
			circles.push(oImg);
			canvas.add(oImg);
			var canvasb = document.getElementById("c");
			var img = canvas.toDataURL("image/png");
			$("#hihi").val(img);
		});
	});
}