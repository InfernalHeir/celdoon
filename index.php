<?php
session_start();
include 'dbconnection.php';

?>

<!doctype html>
<html class="no-js" lang="en">
   
   <?php include("assets/headpart/head.php");
   ?>
<body>
   <?php include("assets/headpart/header.php");
   ?>
  
<!-- preloader start ->
<div id="loader-overlay">
  <div class="loader-container">
    <span class="loader-loadtext"><h3 style="color:#ff8c00;">CELDOON</h3></span>
    <div class="loader-spinner"></div>
  </div>
</div>
<!-- preloader end -->

<!-- Hero Section Start -->
<div class="hero-section section mb-10">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="hero-side-category">
                    <div class="category-toggle-wrap">
                        <button class="category-toggle">Categories<i class="ti-menu"></i></button>
                    </div>
                        <!-- Category Menu -->
                    <nav class="category-menu">
                        <?php
                             $select_cat_id=$conn->prepare('SELECT * FROM `category`');
                             $select_cat_id->execute();
                             $foreach=$select_cat_id->fetchAll();
                        foreach($foreach as $value_cat)
                        {
                        ?>
                        <ul>
                           <li class="menu-item-has-children">
                            <a href="#"><?php echo $value_cat['cat_name']; ?></a>
                              <ul class="category-mega-menu">
                                <?php
                                  $cat_id=$value_cat['cat_id'];
                                  $query=$conn->prepare("SELECT * FROM `sub_category` WHERE `cat_id`='$cat_id'");
                                  $query->execute();
                                  $run=$query->fetchAll();
                                foreach($run as $value_sub) 
                                {
                                  $subcat_name=$value_sub['subcat_name'];
                                ?>
                                  <li><a href="category-sidebar.php?subcat_name=<?php echo $subcat_name; ?>"><?php echo $value_sub['subcat_name']; ?></a></li>
                                <?php
                                }
                                ?>
                              </ul>
                            </li>
                        </ul>
                        <?php
                        }
                        ?>
                    </nav>
                </div>
                    
                    
                    
                    <style>
                        
.nivoSlider {
	position:relative;
	width:100%;
	height:auto;
	overflow: hidden;
}
.nivoSlider img {
	position:absolute;
	top:0px;
	left:0px;
	max-width: none;
}
.nivo-main-image {
	display: block !important;
	position: relative !important; 
	width: 100% !important;
}
.nivoSlider a.nivo-imageLink {
	position:absolute;
	top:0px;
	left:0px;
	width:100%;
	height:100%;
	border:0;
	padding:0;
	margin:0;
	z-index:auto;
	display:none;
	background:white; 
	filter:alpha(opacity=0); 
	opacity:0;
}

.nivo-slice {
	display:block;
	position:absolute;
	z-index:auto;
	height:100%;
	top:0;
}
.nivo-box {
	display:block;
	position:absolute;
	z-index:auto;
	overflow:hidden;
}
.nivo-box img { display:block; }

.nivo-caption{
	display: none !important;
}
.nivo-caption p {
	display: none;
}
.nivo-directionNav a {
	position:absolute;
	top:45%;
	z-index:auto;
	cursor:pointer;
}
.nivo-prevNav {
	left:0px;
	padding:10px;
	border:1px solid #000;
	background: #999;
	border-radius: 5px;
  padding-right:4px;
  display: none;
  
}
.nivo-nextNav {
	right:0px;
	padding:10px;
	border:1px solid #000;
	background: #999;
	border-radius: 5px;
  padding-left:4px;
  display: none;
}
.nivo-controlNav {
	text-align:center;
}
.nivo-controlNav a {
	cursor:pointer;
	display: none;
}
.nivo-controlNav a.active {
	font-weight:bold;
	display: none;
}
.slider{
  text-align:center;
}
                    </style>
                    
                    
                    
                    
           <div class="container-fluid" style="padding: 0px!important;">
  <div class="row">
    <div class="col">
         

    <div id='slider' class="nivoSlider slider" >
    <!--  <img src="assets/images/hero/slider6.jpg"/>-->
      <img src="assets/images/hero/slider4.jpg"/>
      <!--<img src="assets/images/hero/slider5.jpg"/>-->
    </div>
    
    
    </div>
    </div>
    </div>
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
   --> 

<script>
    	$(window).load(function(){
        $('#slider').nivoSlider()
     });

(function(e){var t=function(t,n){var r=e.extend({},e.fn.nivoSlider.defaults,n);var i={currentSlide:0,currentImage:"",totalSlides:0,running:false,paused:false,stop:false,controlNavEl:false};var s=e(t);s.data("nivo:vars",i).addClass("nivoSlider");var o=s.children();o.each(function(){var t=e(this);var n="";if(!t.is("img")){if(t.is("a")){t.addClass("nivo-imageLink");n=t}t=t.find("img:first")}var r=r===0?t.attr("width"):t.width(),s=s===0?t.attr("height"):t.height();if(n!==""){n.css("display","none")}t.css("display","none");i.totalSlides++});if(r.randomStart){r.startSlide=Math.floor(Math.random()*i.totalSlides)}if(r.startSlide>0){if(r.startSlide>=i.totalSlides){r.startSlide=i.totalSlides-1}i.currentSlide=r.startSlide}if(e(o[i.currentSlide]).is("img")){i.currentImage=e(o[i.currentSlide])}else{i.currentImage=e(o[i.currentSlide]).find("img:first")}if(e(o[i.currentSlide]).is("a")){e(o[i.currentSlide]).css("display","block")}var u=e("<img/>").addClass("nivo-main-image");u.attr("src",i.currentImage.attr("src")).show();s.append(u);e(window).resize(function(){s.children("img").width(s.width());u.attr("src",i.currentImage.attr("src"));u.stop().height("auto");e(".nivo-slice").remove();e(".nivo-box").remove()});s.append(e('<div class="nivo-caption"></div>'));var a=function(t){var n=e(".nivo-caption",s);if(i.currentImage.attr("title")!=""&&i.currentImage.attr("title")!=undefined){var r=i.currentImage.attr("title");if(r.substr(0,1)=="#")r=e(r).html();if(n.css("display")=="block"){setTimeout(function(){n.html(r)},t.animSpeed)}else{n.html(r);n.stop().fadeIn(t.animSpeed)}}else{n.stop().fadeOut(t.animSpeed)}};a(r);var f=0;if(!r.manualAdvance&&o.length>1){f=setInterval(function(){d(s,o,r,false)},r.pauseTime)}if(r.directionNav){s.append('<div class="nivo-directionNav"><a class="nivo-prevNav">'+r.prevText+'</a><a class="nivo-nextNav">'+r.nextText+"</a></div>");e(s).on("click","a.nivo-prevNav",function(){if(i.running){return false}clearInterval(f);f="";i.currentSlide-=2;d(s,o,r,"")});e(s).on("click","a.nivo-nextNav",function(){if(i.running){return false}clearInterval(f);f="";d(s,o,r,)})}if(r.controlNav){i.controlNavEl=e('<div class="nivo-controlNav"></div>');s.after(i.controlNavEl);for(var l=0;l<o.length;l++){if(r.controlNavThumbs){i.controlNavEl.addClass("nivo-thumbs-enabled");var c=o.eq(l);if(!c.is("img")){c=c.find("img:first")}if(c.attr("data-thumb"))i.controlNavEl.append('<a class="nivo-control" rel="'+l+'"><img src="'+c.attr("data-thumb")+'" alt="" /></a>')}else{i.controlNavEl.append('<a class="nivo-control" rel="'+l+'">'+(l+1)+"</a>")}}e("a:eq("+i.currentSlide+")",i.controlNavEl).addClass("active");e("a",i.controlNavEl).bind("click",function(){if(i.running)return false;if(e(this).hasClass("active"))return false;clearInterval(f);f="";u.attr("src",i.currentImage.attr("src"));i.currentSlide=e(this).attr("rel")-1;d(s,o,r,"control")})}if(r.pauseOnHover){s.hover(function(){i.paused=true;clearInterval(f);f=""},function(){i.paused=false;if(f===""&&!r.manualAdvance){f=setInterval(function(){d(s,o,r,false)},r.pauseTime)}})}s.bind("nivo:animFinished",function(){u.attr("src",i.currentImage.attr("src"));i.running=false;e(o).each(function(){if(e(this).is("a")){e(this).css("display","none")}});if(e(o[i.currentSlide]).is("a")){e(o[i.currentSlide]).css("display","block")}if(f===""&&!i.paused&&!r.manualAdvance){f=setInterval(function(){d(s,o,r,false)},r.pauseTime)}r.afterChange.call(this)});var h=function(t,n,r){if(e(r.currentImage).parent().is("a"))e(r.currentImage).parent().css("display","block");e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").width(t.width()).css("visibility","hidden").show();var i=e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").parent().is("a")?e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").parent().height():e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").height();for(var s=0;s<n.slices;s++){var o=Math.round(t.width()/n.slices);if(s===n.slices-1){t.append(e('<div class="nivo-slice" name="'+s+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block !important; top:0; left:-"+(o+s*o-o)+'px;" /></div>').css({left:o*s+"px",width:t.width()-o*s+"px",height:i+"px",opacity:"0",overflow:"hidden"}))}else{t.append(e('<div class="nivo-slice" name="'+s+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block !important; top:0; left:-"+(o+s*o-o)+'px;" /></div>').css({left:o*s+"px",width:o+"px",height:i+"px",opacity:"0",overflow:"hidden"}))}}e(".nivo-slice",t).height(i);u.stop().animate({height:e(r.currentImage).height()},n.animSpeed)};var p=function(t,n,r){if(e(r.currentImage).parent().is("a"))e(r.currentImage).parent().css("display","block");e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").width(t.width()).css("visibility","hidden").show();var i=Math.round(t.width()/n.boxCols),s=Math.round(e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").height()/n.boxRows);for(var o=0;o<n.boxRows;o++){for(var a=0;a<n.boxCols;a++){if(a===n.boxCols-1){t.append(e('<div class="nivo-box" name="'+a+'" rel="'+o+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block; top:-"+s*o+"px; left:-"+i*a+'px;" /></div>').css({opacity:0,left:i*a+"px",top:s*o+"px",width:t.width()-i*a+"px"}));e('.nivo-box[name="'+a+'"]',t).height(e('.nivo-box[name="'+a+'"] img',t).height()+"px")}else{t.append(e('<div class="nivo-box" name="'+a+'" rel="'+o+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block; top:-"+s*o+"px; left:-"+i*a+'px;" /></div>').css({opacity:0,left:i*a+"px",top:s*o+"px",width:i+"px"}));e('.nivo-box[name="'+a+'"]',t).height(e('.nivo-box[name="'+a+'"] img',t).height()+"px")}}}u.stop().animate({height:e(r.currentImage).height()},n.animSpeed)};var d=function(t,n,r,i){var s=t.data("nivo:vars");if(s&&s.currentSlide===s.totalSlides-1){r.lastSlide.call(this)}if((!s||s.stop)&&!i){return false}r.beforeChange.call(this);if(!i){u.attr("src",s.currentImage.attr("src"))}else{if(i==="prev"){u.attr("src",s.currentImage.attr("src"))}if(i==="next"){u.attr("src",s.currentImage.attr("src"))}}s.currentSlide++;if(s.currentSlide===s.totalSlides){s.currentSlide=0;r.slideshowEnd.call(this)}if(s.currentSlide<0){s.currentSlide=s.totalSlides-1}if(e(n[s.currentSlide]).is("img")){s.currentImage=e(n[s.currentSlide])}else{s.currentImage=e(n[s.currentSlide]).find("img:first")}if(r.controlNav){e("a",s.controlNavEl).removeClass("active");e("a:eq("+s.currentSlide+")",s.controlNavEl).addClass("active")}a(r);e(".nivo-slice",t).remove();e(".nivo-box",t).remove();var o=r.effect,f="";if(r.effect==="random"){f=new Array("sliceDownRight","sliceDownLeft","sliceUpRight","sliceUpLeft","sliceUpDown","sliceUpDownLeft","fold","fade","boxRandom","boxRain","boxRainReverse","boxRainGrow","boxRainGrowReverse");o=f[Math.floor(Math.random()*(f.length+1))];if(o===undefined){o="fade"}}if(r.effect.indexOf(",")!==-1){f=r.effect.split(",");o=f[Math.floor(Math.random()*f.length)];if(o===undefined){o="fade"}}if(s.currentImage.attr("data-transition")){o=s.currentImage.attr("data-transition")}s.running=true;var l=0,c=0,d="",m="",g="",y="";if(o==="sliceDown"||o==="sliceDownRight"||o==="sliceDownLeft"){h(t,r,s);l=0;c=0;d=e(".nivo-slice",t);if(o==="sliceDownLeft"){d=e(".nivo-slice",t)._reverse()}d.each(function(){var n=e(this);n.css({top:"0px"});if(c===r.slices-1){setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed)},100+l)}l+=50;c++})}else if(o==="sliceUp"||o==="sliceUpRight"||o==="sliceUpLeft"){h(t,r,s);l=0;c=0;d=e(".nivo-slice",t);if(o==="sliceUpLeft"){d=e(".nivo-slice",t)._reverse()}d.each(function(){var n=e(this);n.css({bottom:"0px"});if(c===r.slices-1){setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed)},100+l)}l+=50;c++})}else if(o==="sliceUpDown"||o==="sliceUpDownRight"||o==="sliceUpDownLeft"){h(t,r,s);l=0;c=0;var b=0;d=e(".nivo-slice",t);if(o==="sliceUpDownLeft"){d=e(".nivo-slice",t)._reverse()}d.each(function(){var n=e(this);if(c===0){n.css("top","0px");c++}else{n.css("bottom","0px");c=0}if(b===r.slices-1){setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed)},100+l)}l+=50;b++})}else if(o==="fold"){h(t,r,s);l=0;c=0;e(".nivo-slice",t).each(function(){var n=e(this);var i=n.width();n.css({top:"0px",width:"0px"});if(c===r.slices-1){setTimeout(function(){n.animate({width:i,opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({width:i,opacity:"1.0"},r.animSpeed)},100+l)}l+=50;c++})}else if(o==="fade"){h(t,r,s);m=e(".nivo-slice:first",t);m.css({width:t.width()+"px"});m.animate({opacity:"1.0"},r.animSpeed*2,"",function(){t.trigger("nivo:animFinished")})}else if(o==="slideInRight"){h(t,r,s);m=e(".nivo-slice:first",t);m.css({width:"0px",opacity:"1"});m.animate({width:t.width()+"px"},r.animSpeed*2,"",function(){t.trigger("nivo:animFinished")})}else if(o==="slideInLeft"){h(t,r,s);m=e(".nivo-slice:first",t);m.css({width:"0px",opacity:"1",left:"",right:"0px"});m.animate({width:t.width()+"px"},r.animSpeed*2,"",function(){m.css({left:"0px",right:""});t.trigger("nivo:animFinished")})}else if(o==="boxRandom"){p(t,r,s);g=r.boxCols*r.boxRows;c=0;l=0;y=v(e(".nivo-box",t));y.each(function(){var n=e(this);if(c===g-1){setTimeout(function(){n.animate({opacity:"1"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1"},r.animSpeed)},100+l)}l+=20;c++})}else if(o==="boxRain"||o==="boxRainReverse"||o==="boxRainGrow"||o==="boxRainGrowReverse"){p(t,r,s);g=r.boxCols*r.boxRows;c=0;l=0;var w=0;var E=0;var S=[];S[w]=[];y=e(".nivo-box",t);if(o==="boxRainReverse"||o==="boxRainGrowReverse"){y=e(".nivo-box",t)._reverse()}y.each(function(){S[w][E]=e(this);E++;if(E===r.boxCols){w++;E=0;S[w]=[]}});for(var x=0;x<r.boxCols*2;x++){var T=x;for(var N=0;N<r.boxRows;N++){if(T>=0&&T<r.boxCols){(function(n,i,s,u,a){var f=e(S[n][i]);var l=f.width();var c=f.height();if(o==="boxRainGrow"||o==="boxRainGrowReverse"){f.width(0).height(0)}if(u===a-1){setTimeout(function(){f.animate({opacity:"1",width:l,height:c},r.animSpeed/1.3,"",function(){t.trigger("nivo:animFinished")})},100+s)}else{setTimeout(function(){f.animate({opacity:"1",width:l,height:c},r.animSpeed/1.3)},100+s)}})(N,T,l,c,g);c++}T--}l+=100}}};var v=function(e){for(var t,n,r=e.length;r;t=parseInt(Math.random()*r,10),n=e[--r],e[r]=e[t],e[t]=n);return e};var m=function(e){if(this.console&&typeof console.log!=="undefined"){console.log(e)}};this.stop=function(){if(!e(t).data("nivo:vars").stop){e(t).data("nivo:vars").stop=true;m("Stop Slider")}};this.start=function(){if(e(t).data("nivo:vars").stop){e(t).data("nivo:vars").stop=false;m("Start Slider")}};r.afterLoad.call(this);return this};e.fn.nivoSlider=function(n){return this.each(function(r,i){var s=e(this);if(s.data("nivoslider")){return s.data("nivoslider")}var o=new t(this,n);s.data("nivoslider",o)})};e.fn.nivoSlider.defaults={effect:"random",slices:15,boxCols:8,boxRows:4,animSpeed:500,pauseTime:3e3,startSlide:0,directionNav:true,controlNav:true,controlNavThumbs:false,pauseOnHover:true,manualAdvance:false,prevText:"Prev",nextText:"Next",randomStart:false,beforeChange:function(){},afterChange:function(){},slideshowEnd:function(){},lastSlide:function(){},afterLoad:function(){}};e.fn._reverse=[].reverse})(jQuery)
</script>
                    
                    <!--
                 <style>
 

.carousel-control.right,
.carousel-control.left {
	background-image: none;
}
.carousel-item {
	min-height: 350px; 
	height: 100%;
	width:100%; 
}
.carousel-caption h3,
.carousel .icon-container,
.carousel-caption button {
	background-color: #09c;
}
.carousel-caption h3 {
	padding: .5em;
}
.carousel .icon-container {
	display: inline-block;
	font-size: 25px;
	line-height: 25px;
	padding: 1em;
	text-align: center;
	border-radius: 50%;
}
.carousel-caption button {
	border-color: #00bfff;
	margin-top: 1em; 
}

/* Animation delays */
.carousel-caption h3:first-child {
	animation-delay: 1s;
}
.carousel-caption h3:nth-child(2) {
	animation-delay: 2s;
}
.carousel-caption button {
	animation-delay: 3s;
}

h1 {
  text-align: center;  
  margin-bottom: 30px;
  font-size: 30px;
  font-weight: bold;
}

.p {
  padding-top: 125px;
  text-align: center;
}

.p a {
  text-decoration: underline;
}
@media only screen and (max-width: 600px) and (min-width: 300px) {
    .salim img{
        width: 200px;
        text-align : center;
    }
}
</style> 
<div class="container-fluid" style="padding: 0px!important;">
  <div class="row">
    <div class="col">

      <div id="carouselExampleIndicators" class="carousel slide">
       <div class="carousel-inner">

          <div class="carousel-item active" style="background-image: url(assets/images/hero/slider-01.jpg)">
             <div class="row align-items-center">
                    <div class="ero-content-three col">
                        <h1>BEST QUALITY</h1>
                        <h1>Antminer S9<br>(12.5Th)</h1>
                    </div>
                    <div class="ero-image-three col  salim">
                        <img src="assets/images/hero/check.png" alt="Hero Image" style=" width: 400px;padding: 70px 0px;">
                    </div>
                </div>
            </div>

          <!-- second slide ->
          <div class="carousel-item" style="background-image: url(assets/images/hero/1.jpg)">
            <div class="row align-items-center">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <h1>BUY YOUR</h1>
                    <h1>Antminer<br>T9+ (10.5Th)</h1>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 salim">
                    <img src="assets/images/hero/check1.png" alt="Hero Image"  style="width: 350px; padding: 80px 0px;">
                </div>
            </div>
          </div>

          <!-- third slide ->
            <div class="carousel-item" style="background-image: url(assets/images/hero/140652.jpg)">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <h1>BEST FEATURED</h1>
                        <h1>Samsung<br>NP530XBB</h1>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 salim">
                        <img src="assets/images/hero/laptop_for banner1.png" alt="Hero Image" style="width: 350px; padding: 80px 0px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- controls ->
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
      </div>

    </div>
  </div>
</div>
<script>
 (function($) {
   function doAnimations(elems) {
     var animEndEv = "webkitAnimationEnd animationend";

    elems.each(function() {
      var $this = $(this),
        $animationType = $this.data("animation");
      $this.addClass($animationType).one(animEndEv, function() {
        $this.removeClass($animationType);
      });
    });
  }
var $myCarousel = $("#carouselExampleIndicators"),
    $firstAnimatingElems = $myCarousel
      .find(".carousel-item:first")
      .find("[data-animation ^= 'animated']");

  $myCarousel.carousel();

   doAnimations($firstAnimatingElems);

  $myCarousel.on("slide.bs.carousel", function(e) {
    var $animatingElems = $(e.relatedTarget).find(
      "[data-animation ^= 'animated']"
    );
    doAnimations($animatingElems);
  });
})(jQuery);

</script>
                <!-- Hero Slider Start ->
                <div class="hero-slider hero-slider-three fix">
                    <div class="hero-item-three" style="background-image: url(assets/images/hero/hero-3-bg-1.jpg)">
                        <div class="row align-items-center justify-content-between">
                            <div class="hero-content-three col">
                                <h1>BEST QUALITY</h1>
                                <h1>Antminer S9<br>(12.5Th)</h1>
                            </div>
                            <div class="hero-image-three col">
                               <img src="assets/images/hero/check.png" alt="Hero Image" style=" width: 400px;padding: 70px 0px;">
                            </div>
                        </div>     
                    </div>
                    <div class="hero-item-three">
                        <div class="row align-items-center justify-content-between">
                            <div class="hero-content-three col">
                                <h1>BUY YOUR</h1>
                                <h1>Antminer<br>T9+ (10.5Th)</h1>
                            </div>
                            <div class="hero-image-three col">
                               <img src="assets/images/hero/check1.png" alt="Hero Image"  style="width: 350px; padding: 80px 0px;">
                            </div>
                        </div>     
                    </div>
                   <div class="hero-item-three" style="">
                        <div class="row align-items-center justify-content-between">
                            <div class="hero-content-three col">
                                <h1>BEST FEATURED</h1>
                                <h1>Samsung<br>NP530XBB</h1>
                            </div>
                            <div class="hero-image-three col">
                               <img src="assets/images/hero/laptop_for banner1.png" alt="Hero Image" style="width: 350px; padding: 80px 0px;">
                            </div>
                        </div>     
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div><!-- Hero Section End -->



<!-- Feature Section Start -->
<div class="feature-section section mb-80">
    <div class="container-fluid">
        <div class="row row-5">
            <div class="col-lg-3 col-md-6 col-12 mb-10">
                <div class="feature-two feature-three" style="background-image: url(assets/images/icons/feature-van-2-bg.png); background-color: #e9f2c3; height: 200px;">
                    <div class="feature-wrap">
                        <div class="icon"><img src="assets/images/icons/feature-van-2.png" alt="Feature"></div>
                        <h4> WORLD WIDE FREE SHIPPING AVAILABLE</h4>
                        <p>5-7 Working days</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-10">
                <div class="feature-two feature-three" style="background-image: url(assets/images/icons/feature-walet-2-bg.png); background-color: #efe47a; height: 200px;">
                    <div class="feature-wrap">
                        <div class="icon"><img src="assets/images/icons/feature-walet-2.png" alt="Feature"></div>
                        <h4>10 DAYS REPLACEMENT GUARANTEED</h4>
                        <p>100% Cashback</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-10">
                <div class="feature-two feature-three" style="background-image: url(assets/images/icons/feature-shield-2-bg.png); background-color: #ffe6e6; height: 200px;">
                    <div class="feature-wrap">
                        <div class="icon"><img src="assets/images/icons/protection.png" alt="Feature"></div>
                        <h4>100% SECURE QUALITY SERVICE</h4>
                        <p>Fast/Safe Delievery Worldwide</p>
                    </div>
                </div>
            </div>
			<div class="col-lg-3 col-md-6 col-12 mb-10">
                <div class="feature-two feature-three" style="background-image: url(assets/images/icons/feature-shield-2-bg.png); background-color: #9fecf0; height: 200px;">
                    <div class="feature-wrap">
                        <div class="icon"><img src="assets/images/icons/feature-shield-2.png" alt="Feature"></div>
                        <h4>100% Customer Satisfaction</h4>
                        <p>Payment Security</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Feature Section End -->


<!-- Feature Product Section Start -->
<div class="product-section section mb-70">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-40">
                <div class="section-title-one" data-title="FEATURED ITEMS"><h1>FEATURED ITEMS</h1></div>
            </div>
            <div class="col-12 mb-30">
                <div class="col-12 mb-30 float-right">
                    <div class="product-tab-filter">
                        <button class="product-tab-filter-toggle">Showing All: <span></span><i class="icofont icofont-simple-down"></i>
                        </button>
                        <?php
                         $select_cat_id=$conn->prepare('SELECT `cat_name`,`cat_id` FROM `category` ORDER by `cat_id` ASC');
                         $select_cat_id->execute();
                         $foreach=$select_cat_id->fetchAll();
                        ?>
                        <ul class="nav product-tab-list">
                        <?php
                        foreach($foreach as $value_cat)
                        {
                            $cat_id=$value_cat['cat_id'];
                        ?>
                        <li><a href="<?php echo "?cat_id=$cat_id";  ?>" onclick='tab("<?php echo $cat_id ?>")'><?php echo $value_cat['cat_name']; ?></a>
                        </li>
                        <?php
                        }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-one">
                        <div class="product-slider-wrap product-slider-arrow-one">
                            <div class="product-slider product-slider-4">
                                <?php
                                   
                                    $stmt=$conn->prepare("SELECT * FROM `product`");
                                    $stmt->execute();
                                    $fea_info=$stmt->fetchAll();
                                foreach($fea_info as $feavalue)
                                {
                                    
                                    $fea_id=$value['pro_id'];
                                    $stmt=$conn->prepare("SELECT * FROM `product`");
                                    $stmt->execute();
                                    $fea_in=$stmt->fetchAll();
                                foreach($fea_in as $feaval)
                                {
                                ?>
                                <div class="col pb-20 pt-10">
                                    <div class="ee-product">
                                        <div class="image"  style="height: 260px;">
                                            <a href="single-product-3.php?pro_id=<? echo $feaval['pro_id']?>" class="img">
                                               <div class="zoom">
                                                <img src="admin/<?php  echo $feaval['pro_image1']; ?>" alt="Product Image" style="width:200px; margin:auto !important;">
                                               </div>
                                            </a>
                                        </div>
                                        <div class="content">
                                            <div class="category-title" style="height: 60px;">
                                                <h5 class="title"><a href="single-product-3.php?pro_id=<?  echo $feaval['pro_id']?>"><?php  echo $feaval['pro_name']; ?></a></h5>
                                            </div>
                                            <div class="price-ratting">
                                                <h5 class="price"><span class="old">$ <?php  echo $feaval['pro_mrp']; ?></span>
                                                </h5>
                                                <div class="ratting">
                                                    <h5 class="price">$ <?php  echo $feaval['pro_dis_price']; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                }
                                ?>
                                
                            </div>
                        </div>
                    </div><!-- Tab Pane End -->
                    
                    <!-- Tab Pane Start -->
                    <div class="tab-pane fade" id="tab-two">
                        <div class="product-slider-wrap product-slider-arrow-one">
                            <div class="product-slider product-slider-4">
                                <div class="col pb-20 pt-10">
                                    <div class="ee-product">
                                        <div class="image">
                                            <a href="#" class="img"><img src="assets/images/product/product-10.png" alt="Product Image"></a>
                                            
                                            <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>
                                        </div>
                                        <div class="content">
                                            <div class="category-title">
                                                <h5 class="title"><a href="#">Z Bluetooth Headphone</a></h5>
                                            </div>
                                            <div class="price-ratting">
                                                <h5 class="price"><span class="old">$700</span>
                                                </h5>
                                                <div class="ratting">
                                                    <h5 class="price">$650</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Tab Pane End -->
                </div>
            </div>
        </div>
    </div>
</div><!-- Feature Product Section End -->


<!-- Best Sell Product Section Start -->
<div class="product-section section mb-60">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-40">
                <div class="section-title-one" data-title="BEST SELLER"><h1>BEST SELLERS</h1></div>
            </div>
        </div>
            <div class="row">
                <?php   
                    $sql = "SELECT * FROM product ORDER BY `pro_id` ASC LIMIT 8";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll();
                foreach($results as $value)
                {
                    $pro_id=$value['pro_id'];
                    $stmt=$conn->prepare("SELECT * FROM `product` WHERE `pro_id`='$pro_id'");
                    $stmt->execute();
                    $pro_info=$stmt->fetchAll();
                foreach($pro_info as $val)
                {
                ?>
                <div class="col-xl-3 col-lg-4 col-md-6 col-12 pb-30 pt-10">
                    <div class="ee-product">
                        <div class="image text-center"  style="height: 260px;">
                            <div class="zoom">
                                <a href="single-product-3.php?pro_id=<?=$val['pro_id']?>" class="img"><img src="admin/<?php  echo $val['pro_image1']; ?>" alt="Product Image" style="width:200px; margin:auto !important;"></a>
                            </div>
                        </div>
                        <div class="content">
                            <div class="category-title" style="height: 60px;">
                                <h5 class="title"><a href="single-product-3.php?pro_id=<?=$val['pro_id']?>"><?  echo $val['pro_name'] ?></a></h5>
                            </div>
                            <div class="price-ratting">
                                <h5 class="price"><span class="old">$<?  echo $val['pro_mrp'] ?></span>
                                </h5>
                                <div class="ratting">
                                    <h5 class="price">$<?  echo $val['pro_dis_price'] ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                }
                ?>
            </div>
    </div>
</div>
<!-- Best Sell Product Section End -->

<style>
    @media only screen and (min-width:300px) and (max-width: 437px) {
        .imgset img{
            width: 150px;
        }
    }
</style>

<div class="container-fluid" style="padding-top: 30px; padding-bottom: 100px;">
	<div class="row">
	        <div class="col-12 mb-40">
                <div class="section-title-one" data-title="BEST DEALS"><h1>BEST DEALS</h1></div>
            </div>
            <div class="col-md-4">
	           <div class="col mb-30">
                    <div class="offer-time-wrap" style="background-image: url(assets/images/bg/offer-products.jpg)">
                        <h1><span>SALE</span>4-14th fab</h1>
                        <h3>BUY 1 <span>GET 1 FREE</span></h3>
                        <h4><span>LIMITED TIME OFFER</span> GET YOUR PRODUCT</h4>
                        <div class="countdown" data-countdown="2020/02/14"></div>
                    </div>
                </div>
	        </div>
		<div class="col-md-8 m-auto">
		
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>   
			<div class="carousel-inner">
				<div class="item carousel-item active"><!--  1 carousel Start -->
					    
				    <?php
					    $stmt=$conn->prepare("SELECT * FROM `bestdeal`");
                        $stmt->execute();
                        $best_info=$stmt->fetchAll();
                    foreach($best_info as $bestval)
                    {
                        $best_deal_id=$bestval['bestdeal_id'];
                        //echo "<script>alert('$best_deal_id')</script>";
                        $query =$conn->prepare("SELECT * FROM `bestdeal` WHERE `bestdeal_id`='$best_deal_id'");
                        $query->execute();
                        $fetchAll_best_deals=$query->fetchAll();
                    foreach($fetchAll_best_deals as $ok)
                    {
                    ?>
                  <!--  <div class="col-12 pb-20 pt-10">-->
                        <div class="ee-product"><!-- Product Start -->
                            <div class="row">
                                <div class="col-6">
                                   <span class="label new" style="color: #ff8c00;">OFFER</span>
                                    <div class="zoom">
                                        <a href="bestdealshow.php?1st_pro_id=<?=$ok['bestdeal_id']?>" class="img imgset"><img src="admin/<?php echo $ok['1st_pro_img1']; ?>" alt="Product Image" style="height:250px; margin:auto !important;"></a>
                                    </div>
                                    <div class="content">
                                        <div class="category-title" style="height: 60px;">
                                            <h5 class="title"><a href="bestdealshow.php?1st_pro_id=<?=$ok['bestdeal_id']?>">$<?php echo $ok['1st_pro_name'] ?></a></h5>
                                        </div>
                                        <div class="price-ratting">
                                            <h5 class="price"><h5 class="price">$ <?php echo $ok['1st_pro_price'] ?></h5></h5>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="col-6">
                                    <span class="label new" style="color: red;">FREE</span>
                                    <div class="zoom">
                                        <a href="bestdealshow.php?1st_pro_id=<?=$ok['bestdeal_id']?>" class="img imgset"><img src="admin/<?php echo $ok['2nd_pro_img1']; ?>" alt="Product Image" style="height:250px; margin:auto !important;"></a>
                                    </div>
                                    <div class="content">
                                        <div class="category-title" style="height: 60px;">
                                            <h5 class="title"><a href="bestdealshow.php?1st_pro_id=<?=$ok['bestdeal_id']?>"><? echo $ok['2nd_pro_name'] ?></a></h5>
                                        </div>
                                        <div class="price-ratting">
                                            <h5 class="price"> <span class="old">$<? echo $ok['2nd_pro_price'] ?></span> Free</h5>
                                            
                                        </div>
                                    </div>
                                </div> 
                                <div id="selfbtn">
                                    <button class="btn btn-warning mb-4 text-center w-100" style="border-radius: 40px;"><a href="bestdealshow.php?1st_pro_id=<?=$ok['bestdeal_id']?>" ><span> View Details</span></a></button> 
                                </div>
                            </div>
                        </div><!-- Product End -->
                   <!-- </div>-->
                    <?php
                    }
                    }
                    ?>
                    
                    
                </div><!-- 1  carousel end -->
				</div>
	    	</div>
    	</div>
    </div>
</div>









<!--

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="ee-product">
                            <div class="row">
                                <div class="col-6">
                                   <span class="label new" style="color: #ff8c00;">OFFER</span>
                                    <div class="zoom">
                                        <a href="bestdealshow.php?1st_pro_id=<?=$ok['bestdeal_id']?>" class="img imgset"><img src="admin/<?php echo $ok['1st_pro_img1']; ?>" alt="Product Image" style="height:250px; margin:auto !important;"></a>
                                    </div>
                                    <div class="content">
                                        <div class="category-title" style="height: 60px;">
                                            <h5 class="title"><a href="bestdealshow.php?1st_pro_id=<?=$ok['bestdeal_id']?>">$<?php echo $ok['1st_pro_name'] ?></a></h5>
                                        </div>
                                        <div class="price-ratting">
                                            <h5 class="price"><h5 class="price">$ <?php echo $ok['1st_pro_price'] ?></h5></h5>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="col-6">
                                    <span class="label new" style="color: red;">FREE</span>
                                    <div class="zoom">
                                        <a href="bestdealshow.php?1st_pro_id=<?=$ok['bestdeal_id']?>" class="img imgset"><img src="admin/<?php echo $ok['2nd_pro_img1']; ?>" alt="Product Image" style="height:250px; margin:auto !important;"></a>
                                    </div>
                                    <div class="content">
                                        <div class="category-title" style="height: 60px;">
                                            <h5 class="title"><a href="bestdealshow.php?1st_pro_id=<?=$ok['bestdeal_id']?>"><? echo $ok['2nd_pro_name'] ?></a></h5>
                                        </div>
                                        <div class="price-ratting">
                                            <h5 class="price"> <span class="old">$<? echo $ok['2nd_pro_price'] ?></span> Free</h5>
                                            
                                        </div>
                                    </div>
                                </div> 
                                <div id="selfbtn">
                                    <button class="btn btn-warning mb-4 text-center w-100" style="border-radius: 40px;"><a href="bestdealshow.php?1st_pro_id=<?=$ok['bestdeal_id']?>" ><span> View Details</span></a></button> 
                                </div>
                            </div>
                        </div>
    </div>
    <!--<div class="carousel-item">
      <img class="d-block w-100" src="https://images.unsplash.com/photo-1504736038806-94bd1115084e?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ&s=3d045bbf1ecc01c4c9ec011ce5c8977d" data-color="firebrick" alt="Second Image">
      <div class="carousel-caption d-md-block">
        <h5>Second Image</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://images.unsplash.com/photo-1419064642531-e575728395f2?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ&s=76d5c793e4f8d02d7a9be27bc71256f7" data-color="violet" alt="Third Image">
      <div class="carousel-caption d-md-block">
        <h5>Third Image</h5>
      </div>
    </div>-->
  </div>
  <!-- Controls ->
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>



<script>
    $('.carousel').carousel({
  interval: 6000,
  pause: "false"
});
</script>


<!--   preloader script start   ->  
 <script>
  $(document).ready(function() {
  $("#loader-overlay").delay(50).fadeOut();
});
 </script>
 <!--   preloader script end   -->
 
 
 
 
 
 
 
 
 
 
 
 <style>
     @import url(http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css);
.col-item
{
    border: 1px solid #E1E1E1;
    border-radius: 5px;
    background: #FFF;
}
.col-item .photo img
{
    margin: 0 auto;
    width: 100%;
}

.col-item .info
{
    padding: 10px;
    border-radius: 0 0 5px 5px;
    margin-top: 1px;
}

.col-item:hover .info {
    background-color: #F5F5DC;
}
.col-item .price
{
    /*width: 50%;*/
    float: left;
    margin-top: 5px;
}

.col-item .price h5
{
    line-height: 20px;
    margin: 0;
}

.price-text-color
{
    color: #219FD1;
}

.col-item .info .rating
{
    color: #777;
}

.col-item .rating
{
    /*width: 50%;*/
    float: left;
    font-size: 17px;
    text-align: right;
    line-height: 52px;
    margin-bottom: 10px;
    height: 52px;
}

.col-item .separator
{
    border-top: 1px solid #E1E1E1;
}

.clear-left
{
    clear: left;
}

.col-item .separator p
{
    line-height: 20px;
    margin-bottom: 0;
    margin-top: 10px;
    text-align: center;
}

.col-item .separator p i
{
    margin-right: 5px;
}
.col-item .btn-add
{
    width: 50%;
    float: left;
}

.col-item .btn-add
{
    border-right: 1px solid #E1E1E1;
}

.col-item .btn-details
{
    width: 50%;
    float: left;
    padding-left: 10px;
}
.controls
{
    margin-top: 20px;
}
[data-slide="prev"]
{
    margin-right: 10px;
}

 </style>
 
 
 
 
<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-9">
                <h3>
                    Carousel Product Cart Slider</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example"
                        data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example"
                            data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-3 col-lg-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="#" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-lg-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product Example</h5>
                                            <h5 class="price-text-color">
                                                $249.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="#" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-lg-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Next Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $149.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="#" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-lg-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="#" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-3 col-lg-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="#" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-lg-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Grouped Product</h5>
                                            <h5 class="price-text-color">
                                                $249.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="#" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-lg-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $149.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="#" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-3 col-lg-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="#" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="#" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

 
 
 <?php include("assets/headpart/footer.php"); ?>
 
</body>
</html>