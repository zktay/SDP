function passID() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      var packID = document.getElementById("packID").value;
      }
    xhttp.open("GET", "add_feedback.php", true);
    xhttp.send();
  }