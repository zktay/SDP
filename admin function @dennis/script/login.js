function verification(option) {
    //the pop out box
    var resetModal = document.getElementById("forgetPassword");
    var loginInfo = document.getElementById("loginForm");

    if (option == 'open') {
        resetModal.style.display = "block";
    }
    else if (option == "loginOpen") {
        loginInfo.style.display = "block";
    }
    else if (option=="loginClose") {
        loginInfo.style.display = "none";
    }
    else if (option == "close") {
        resetModal.style.display = "none";
        document.getElementById("email").value = "";
    }
    else if (option == 'submit') {
        var emailStatus = emailVerify();

        if (emailStatus == "-1") {
            alert("Email address cannot be blank!");
        }
        else if (emailStatus == "-2") {
            alert("Invalid Email Address. Please check again");
        }
        else {
            alert("A reset link has been sent to your email ~");
            resetModal.style.display = "none";
            document.getElementById("email").value = "";
        }
    }
    else {
        alert("An error has occured. Please try again")
    }
}

// Check for valid email address (Forget Password)
function emailVerify() {
    email = document.getElementById("email");

    if (email.value == "") {
        email.style.border = "2px solid red";
        return -1;
    }
    else if (!email.value.includes("@") && !email.value.includes(".com")) {
        email.style.border = "2px solid red";
        return -2;
    }
    else {
        email.style.border = "";
        return 0;
    }
}
