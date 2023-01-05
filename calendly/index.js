// FUNCTION FOR NAVBAR TRANSFROM RESPONSIVE LAYOUT
function myFunction() {
    var x = document.getElementById("myNavBar");
    if (x.className === "navbar") {
        x.className += " responsive";
        document.getElementById('section').style.marginTop = '200px';
    } else {
        x.className = "navbar";
        document.getElementById('section').style.marginTop = '0px';
    }
}

// COMMANDS TO VALIDATE PROFESSION SELECTION
function validate() {
    var inputArray = [];
    inputArray[0] = document.forms["myForm"]["lastname"];
    inputArray[1] = document.forms["myForm"]["firstname"];
    inputArray[2] = document.forms["myForm"]["address"];
    inputArray[3] = document.forms["myForm"]["country"];
    inputArray[4] = document.forms["myForm"]["state"];

    inputArray[5] = document.forms["myForm"]["phone_number"];
    inputArray[6] = document.forms["myForm"]["back_up"];
    inputArray[7] = document.forms["myForm"]["email"];

    inputArray[8] = document.forms["myForm"]["profession"];

    if (inputArray[0].value == "") {
        inputArray[0].style.border = "1px solid red";
        inputArray[1].style.border = "1px solid red";
    } else {
        inputArray[0].style.border = "none";
    }

    if (inputArray[1].value == "") {
        inputArray[1].style.border = "1px solid red";
        inputArray[2].style.border = "1px solid red";
    } else {
        inputArray[1].style.border = "none";
    }

    if (inputArray[2].value == "") {
        inputArray[2].style.border = "1px solid red";
        inputArray[3].style.border = "1px solid red";
    } else {
        inputArray[2].style.border = "none";
    }

    if (inputArray[3].value == "") {
        inputArray[3].style.border = "1px solid red";
        inputArray[4].style.border = "1px solid red";
    } else {
        inputArray[3].style.border = "none";
    }

    if (inputArray[4].value == "") {
        inputArray[4].style.border = "1px solid red";
        inputArray[5].style.border = "1px solid red";
    } else {
        inputArray[4].style.border = "none";
    }

    if (inputArray[5].value == "") {
        inputArray[5].style.border = "1px solid red";
        inputArray[6].style.border = "1px solid red";
    } else {
        inputArray[5].style.border = "none";
    }

    if (inputArray[6].value == "") {
        inputArray[6].style.border = "1px solid red";
        inputArray[7].style.border = "1px solid red";
    } else {
        inputArray[6].style.border = "none";
    }

    if (inputArray[7].value == "") {
        inputArray[7].style.border = "1px solid red";
    } else {
        inputArray[7].style.border = "none";
    }

    if (inputArray[8].value == "") {
        inputArray[8].style.border = "1px solid red";
    } else {
        inputArray[8].style.border = "none";
    }

    if (inputArray[0].value != "" &&
        inputArray[1].value != "" &&
        inputArray[2].value != "" &&
        inputArray[3].value != "" &&
        inputArray[4].value != "" &&
        inputArray[5].value != "" &&
        inputArray[6].value != "" &&
        inputArray[7].value != "" &&
        inputArray[8].value != "") {
        window.personalInfo = true;
        document.getElementById("yes").disabled = false;
        document.getElementById("yes_label").innerHTML = "YES!";
    } else {
        document.getElementById("yes").disabled = true;
        document.getElementById("no").click();
        document.getElementById("yes_label").innerHTML = "YES - If unclickable, please check form.";
        window.personalInfo = false;
    }

}

// COMMANDS TO VALIDATE PROFESSION SELECTION
function showfield(profession){
    if(profession != 'Other'){
        document.getElementById('profession').style.width="100%";
        document.getElementById('div1').style.display="none";
        document.getElementById("other").value = "Other";
        
    } else {
        document.getElementById('profession').style.width="30%";
        document.getElementById('div1').style.display="block";
        document.getElementById("other").value = "";
        change()
        
    }
}

function change() {
    if (document.forms["myForm"]["other_option"].value == "") {
        document.getElementById("other").value = "";
        document.forms["myForm"]["profession"].style.border = "1px solid red";
        document.forms["myForm"]["other_option"].style.border = "1px solid red";
        validate();
        document.getElementById("yes").disabled = true;
        
    } else {
        document.forms["myForm"]["other_option"].style.border = "none";
        document.forms["myForm"]["profession"].style.border = "none";
        document.getElementById("other").value = "Profession/" + document.getElementById("other_option").value;
        validate();
    }
    
}


function termsAgree() {
    validate()
    if (document.getElementById("terms").checked === true && document.getElementById("yes").checked === true){
        console.log(1);
        window.terms = true
    } else {
        validate();
        window.terms = false;
    }
}

function fileChecker() {
    var i = document.forms["myForm"]["resume"];
    var j = document.forms["myForm"]["credential"];
    var k = document.forms["myForm"]["reference"];
    var l = document.forms["myForm"]["passport"];
    if (i.files.length == 1) {
        document.getElementById("resume_label").style.backgroundColor = "green";
    }else{
        document.getElementById("resume_label").style.backgroundColor = "red";
    }
    
    if (j.files.length == 1) {
        document.getElementById("credential_label").style.backgroundColor = "green";
    }else{
        document.getElementById("credential_label").style.backgroundColor = "rgb(214, 214, 214)";
    }

    if (k.files.length == 1) {
        document.getElementById("reference_label").style.backgroundColor = "green";
    }else{
        document.getElementById("reference_label").style.backgroundColor = "rgb(214, 214, 214)";
    }

    if (l.files.length == 1) {
        document.getElementById("passport_label").style.backgroundColor = "green";
    }else{
        document.getElementById("passport_label").style.backgroundColor = "red";
    }

    if (i.files.length == 1 && l.files.length == 1) {
        window.a = true
    } else {
        window.a = false
    }
}

function submitActivator() {
    validate()
    if (window.a == true && window.terms == true && window.personalInfo == true) {
        document.getElementById("submit").disabled = false;
        document.getElementById("validity_check").innerHTML = "You're all set! :>"
    } else {
        document.getElementById("submit").disabled = true;
        document.getElementById("validity_check").innerHTML = "If submit button is still disabled, Please check the form's validity!"
    }
}
