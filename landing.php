<!-- main html for normal users-->
<div class="slideshow-container">

<div class="mySlides fade">
	<img src="image/bath.jpg" style="width:100%">
</div>

<div class="mySlides fade">
	<img src="image/bath1.jpg" style="width:100%">
</div>

<div class="mySlides fade">
	<img src="image/bath2.jpg" style="width:100%">
</div>

<div class="mySlides fade">
	<img src="image/bath3.jpg" style="width:100%">
</div>

<div class="mySlides fade">
	<img src="image/bath5.jpg" style="width:100%">
</div>

</div>
<br>

<div style="text-align:center">
	<span class="dot" onclick="currentSlide(1)"></span> 
	<span class="dot" onclick="currentSlide(2)"></span> 
	<span class="dot" onclick="currentSlide(3)"></span>
	<span class="dot" onclick="currentSlide(4)"></span> 
	<span class="dot" onclick="currentSlide(5)"></span> 
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
	showSlides(slideIndex += n);
}

function currentSlide(n) {
	showSlides(slideIndex = n);
}

function showSlides(n) {
	var i;
	var slides = document.getElementsByClassName("mySlides");
	var dots = document.getElementsByClassName("dot");
	if (n > slides.length)
		slideIndex = 1;
	if (n < 1)
		slideIndex = slides.length;
	for (i = 0; i < slides.length; i++)
		slides[i].style.display = "none";
	for (i = 0; i < dots.length; i++)
		dots[i].className = dots[i].className.replace(" active", "");
	slides[slideIndex-1].style.display = "block";
	dots[slideIndex-1].className += " active";
}
</script>