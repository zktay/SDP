function number(){
    var num_select = document.querySelector('input[name="select_number"]:checked').value;
    console.log (num_select);
    var d_num = document.getElementById("default_num").value;
    var c_num = document.getElementById("custom_num").value;
    if (num_select == d_num){
        document.getElementById("phone").disabled = true;
        console.log ("True");
    }else if (num_select == c_num){
        document.getElementById("phone").disabled = false;
        document.getElementsByName("Phone")[0].placeholder = "0123456789"
        console.log ("False");
    } else {
        console.log("error_num");
    }
}

function address(){
    var add_select = document.querySelector('input[name="select_address"]:checked').value;
    console.log(add_select);
    var d_add = document.getElementById("default_add").value;
    var c_add = document.getElementById("custom_add").value;
    if (add_select == d_add){
        document.getElementById("Address_1").disabled = true;
        document.getElementById("Address_2").disabled = true;
        document.getElementById("zipcode").disabled = true;
        document.getElementById("State").disabled = true;
        console.log ("True");
    }else if (add_select == c_add){
        document.getElementById("Address_1").disabled = false;
        document.getElementById("Address_2").disabled = false;
        document.getElementById("zipcode").disabled = false;
        document.getElementById("State").disabled = false;
        document.getElementsByName("Address_1")[0].placeholder = "Address line 1:"
        document.getElementsByName("Address_2")[0].placeholder = "Address line 2:"
        document.getElementsByName("zipcode")[0].placeholder = "ZIP Code:"
        document.getElementsByName("State")[0].value = "Default"
        console.log ("False");
    } else {
        console.log("error_add");
    }
}

function bill_address(){
    var bill_select = document.querySelector('input[name="select_bill"]:checked').value;
    console.log(bill_select);
    var d_bill = document.getElementById("default_bill").value;
    var c_bill = document.getElementById("custom_bill").value;
    if (bill_select == d_bill){
        document.getElementById("bill_1").disabled = true;
        document.getElementById("bill_2").disabled = true;
        document.getElementById("bill_zip").disabled = true;
        document.getElementById("bill_state").disabled = true;
        console.log ("True");
    }else if (bill_select == c_bill){
        document.getElementById("bill_1").disabled = false;
        document.getElementById("bill_2").disabled = false;
        document.getElementById("bill_zip").disabled = false;
        document.getElementById("bill_state").disabled = false;
        document.getElementsByName("b_Address_1")[0].placeholder = "Address line 1:"
        document.getElementsByName("b_Address_2")[0].placeholder = "Address line 2:"
        document.getElementsByName("b_zipcode")[0].placeholder = "ZIP Code:"
        document.getElementsByName("b_State")[0].value = "Default"
        console.log ("False");
    } else {
        console.log("error_add");
    }
}

function d_handleClick(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        console.log (this.responseText);
        var d_add_strip = this.responseText.split("| ");
        console.log (d_add_strip);
        console.log (d_add_strip[0]);
        console.log (d_add_strip[1]);
        console.log (d_add_strip[2]);
        console.log (d_add_strip[3]);
        document.getElementsByName("Address_1")[0].placeholder = d_add_strip[0];
        document.getElementsByName("Address_2")[0].placeholder = d_add_strip[1];
        document.getElementsByName("zipcode")[0].placeholder = d_add_strip[2];
        document.getElementsByName("State")[0].value = d_add_strip[3];
    }
    xhttp.open("get", "../php/payment.php", true);
    xhttp.send();
}

function b_handleClick(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var d_add_strip = this.responseText.split("| ");
        console.log (d_add_strip[0]);
        console.log (d_add_strip[1]);
        console.log (d_add_strip[2]);
        console.log (d_add_strip[3]);
        document.getElementsByName("b_Address_1")[0].placeholder = d_add_strip[0];
        document.getElementsByName("b_Address_2")[0].placeholder = d_add_strip[1];
        document.getElementsByName("b_zipcode")[0].placeholder = d_add_strip[2];
        document.getElementsByName("b_State")[0].value = d_add_strip[3];
    }
    xhttp.open("get", "payment.php", true);
    xhttp.send();
}

function p_handleClick(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var d_add_strip = this.responseText.split("| ");
        console.log (d_add_strip[4]);
        document.getElementsByName("Phone")[0].placeholder = d_add_strip[4];
    }
    xhttp.open("get", "payment.php", true);
    xhttp.send();
}

function payment_done(){
    alert("Payment Done, Thanks!");
    window.location.href = "cart.php";
}
