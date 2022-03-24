function editUser(){
  document.getElementById("manUser").style.display = "block"
}

function editEmail(){
  document.getElementById("manEmail").style.display = "block"
}

function editContact(){
  document.getElementById("manContact").style.display = "block"
}

function editPass(){
  document.getElementById("manPass").style.display = "block"
}

function editPic(){
  document.getElementById("manPic").style.display = "block"
}


function closeUser(){
  document.getElementById("manUser").style.display = "none"
}

function closeEmail(){
  document.getElementById("manEmail").style.display = "none"
}

function closePass(){
  document.getElementById("manPass").style.display = "none"
}

function closeContact(){
  document.getElementById("manContact").style.display = "none"
}

function closePic(){
  document.getElementById("manPic").style.display = "none"
}

function checkPass(){
  var pass  = document.getElementById("new_pass").value;
  var cpass  = document.getElementById("con_pass").value;
  if(pass != cpass){
      alert("Confirmation Password is not the same!");
      document.getElementById("submit").disabled = true;
      
  }else{
      document.getElementById("submit").disabled = false; 
  }
}

function preview_image(event) {
  var reader = new FileReader();
  reader.onload = function(){
    var output = document.getElementById('output_image');
    output.src = reader.result;
  }
  reader.readAsDataURL(event.target.files[0]);
}