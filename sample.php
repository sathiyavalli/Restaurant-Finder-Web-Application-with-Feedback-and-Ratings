<?php
echo '<html>
<head>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
<style>
.rate ul li{
display: inline;
cursor: pointer;
}
.highlight{
color:yellow !important;
}
/*#star ul li a span:hover {
color: yellow;
}*/
</style>
<script>
var rating = [];
var comment = [];
$(document).ready(function(){
var n = localStorage.getItem("on_load_counter");
var com_submitted = localStorage.getItem("cnew");
var value_rating = "Rating is "+ localStorage.getItem("rate_value");
if (n === null) {
n = 0;
}
$(".rate ul li").mouseout(function(){
$(this).css("color","black");     
$(this).siblings().css("color","black");
}).mouseover(function(){
$(this).css("color","yellow");      
$(this).prevAll().css("color","yellow");      
})
$.urlParam = function(name){
var results = new RegExp("[\?&]" + name + "=([^&#]*)").exec(window.location.href);
if (results==null) {
return null;
}
return decodeURI(results[1]) || 0;
} 
var cityValue = $.urlParam("city");
var resValue = $.urlParam("restaurant");
var ratingVa = $.urlParam("rating");
$.ajax({
type: "GET",
url: "resources.json", // Using our resources.json file to serve results
success: function(result) {
for(var i =0; i <= result.length;i++){
if((result[i].city == cityValue) && (result[i].restaurant == resValue)){
$("#search_btn2").attr("disabled","disabled");
$("#number_fetch").html(result[i].Phone);
$("#dish_fetch").html(result[i].dish);
$("#cost_fetch").html(result[i].Cost);
$("#hour_fetch").html(result[i].Hours);
$("#old_comment").html(result[i].feedback);
$("#new_comment").html(com_submitted);
$("#result_span").html(n);
$("#rating_value").html(value_rating);
$(".rate ul li").on("click",function(){
$(this).addClass("highlight");
$(this).prevAll().addClass("highlight");
var ch = $(this).data("rate-id");
$("#rate_text").html("Rating is "+ch+"/5");
if($(".rate ul li").hasClass("highlight")){
$(this).nextAll().removeClass("highlight");
rating.push(ch);
var f = rating.length;
}
if(ch >= 1){
$("#search_btn2").removeAttr("disabled");
$("#search_btn2").click(function(event){
n++;
localStorage.setItem("on_load_counter", n);
var comments = $("#comments").val();
localStorage.setItem("cnew",comments);
localStorage.setItem("rating",f);
localStorage.setItem("rate_value",ch);
comment.push(comments);
var append_v = rating.length;
location.reload();
});
}
else{ 
$("#search_btn2").attr("disabled","disabled");
}
});       
}
}
}
});
//alert(ch);
});
</script>
</head>
<body class="result_page">
<div class="container">
<h3 class="text-center">'.$_GET['restaurant'].'</h3>
<h4 class="text-center">'.$_GET['city'].'</h4>
<hr/>
<div class="row">
<div class="col-xs-12 text-center">
<div class="col-xs-6">
<h4>Phone Number</h4>
<h6 id="number_fetch"></h6>
<h4>Averge Cost</h4>
<h6 id="cost_fetch"></h6>
</div>
<div class="col-xs-6">
<h4>Opening Hours</h4>
<h6 id="hour_fetch"></h6>
<h4>Cuisines</h4>
<h6 id="dish_fetch"></h6>
</div>
</div>
<form class="row col-sm-12" method="post">
<h4 class="text-center">Comment and Rate and Submit</h4>
<div class="form-group col-xs-12">
<textarea class="form-control" id="comments" rows="3"></textarea>
</div>
<div class="form-group col-xs-12">
<div data-user-id="2" id="star" class="rate col-xs-12 text-center"><ul>
<li data-rate-id="1">&#9733;</li>
<li data-rate-id="2">&#9733;</li>
<li data-rate-id="3">&#9733;</li>
<li data-rate-id="4">&#9733;</li>
<li data-rate-id="5">&#9733;</li>
</ul>
<div id="rate_text" class="text-justify"></div>
</div>
</div>
<div class="col-xs-12">
<div class="form-group col-sm-6 col-xs-6">
<button type="submit" class="btn btn-primary col-xs-6" id="search_btn2" value="submit">Submit Preview</button>
</div>
<div id="res" class="text-right col-xs-6">Total Reviews: <span id="result_span" data-value=""></span></div></div>
<h4>Comments</h4>
<hr/>
<div id="new_comment"></div><span id="rating_value"></span>
<h5 id="old_comment"></h5>
<div style="clear:both;"></div>
</form>
</div>
</div>
</body>
</html>';
?>
