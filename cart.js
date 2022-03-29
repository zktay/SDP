
function increase(id) {
    var temp = "quantity[" + id + "]";
    var temp1 = "quantity1[" + id +"]";
    var quantity = document.getElementById(temp).value;
    var new_quantity = parseInt(quantity) + 1;
    document.getElementById(temp1).value = new_quantity;
    document.getElementById(temp).value = new_quantity;
}

function decrease(id) {
    var temp = "quantity[" + id + "]";
    var temp1 = "quantity1[" + id +"]";
    var quantity = document.getElementById(temp).value;
    if (quantity >= 2){
        var new_quantity = parseInt(quantity) - 1;
        document.getElementById(temp1).value = new_quantity;
        document.getElementById(temp).value = new_quantity;
    }else{
        alert('Minimum 1 package!');
    }
}

function subtotal(id, action){
    var temp = "price[" + id +"]";
    var temp1 = "quantity1[" + id +"]";
    var price = document.getElementById(temp).value;
    price = price.replace("RM ", "");
    var quantity = (document.getElementById(temp1).value);
    if (action == "add"){
        var old_sub = document.getElementById('subtotal').value;
        old_sub = old_sub.replace("RM ", "");
        var new_sub = parseInt(price) + parseInt(old_sub);
        new_sub = "RM " + new_sub;
        document.getElementById('subtotal').value = new_sub;
    }else if(quantity >= 1 && action == "minus"){
        var old_sub = document.getElementById('subtotal').value;
        old_sub = old_sub.replace("RM ", "");
        var new_sub = parseInt(old_sub) - price;
        new_sub = "RM " + new_sub;
        document.getElementById('subtotal').value = new_sub;  
    }else{
        alert("Error!");
    }
}

function data_flow(){
    var quantity = document.querySelectorAll(".duration");
    var temp1 = "";
    var arrayLength = quantity.length;
    var sub = document.getElementById("subtotal").value;
    sub = sub.replace("RM ", "");
    for (var i = 0; i < arrayLength; i++) {
        console.log(quantity[i]);
        temp1 += quantity[i].value + ",";
    }
    console.log(temp1);
    console.log(sub);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        console.log(this.response);
    }
    xhttp.open("get", "cart_dataflow.php?qty=" + temp1 + "&&" +"sub=" + sub);
    xhttp.send();
}

function signup(){
    alert("Please Sign Up!");
    window.location.href ="signup.php";
}

function emptycart(){
    alert("Empty Cart!");
}