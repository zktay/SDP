var countTarget = document.querySelector("#word-count-input");  
var characterCount = document.querySelector("#character-count");  
var count = function () {  
 var characters = countTarget.value;  
 var characterLength = characters.length;  
 var words = characters.split(/[\n\r\s]+/g).filter(function (word) {  
  return word.length > 0;  
 });  
 characterCount.innerHTML = characterLength;  
};  
count();  
window.addEventListener(  
 "input",  
 function (event) {  
  if (event.target.matches("#word-count-input")) {  
   count();  
  }  
 },  
 false  
);

function rating(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var rate = document.querySelector('input[name="rate"]:checked').value;
        console.log (rate);
    }
    xhttp.open("POST", "add_feedback.php", true);
    xhttp.send("rate=" + rate);
}

