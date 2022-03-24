var imageIndex = 1;
changeImages(imageIndex);

function nextImage(n) {
  changeImages(imageIndex += n);
}

function currentImage(n) {
  changeImages(imageIndex = n);
}

function changeImages(n) {
  var i;
  var images = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > images.length) {imageIndex = 1}    
  if (n < 1) {imageIndex = images.length}
  for (i = 0; i < images.length; i++) {
      images[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  images[imageIndex-1].style.display = "block";  
  dots[imageIndex-1].className += " active";
}