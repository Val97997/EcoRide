//slider part 1
let sliderTop = document.getElementById("slider1");
let sliderBottom = document.getElementById("slider2");
let sliderContainer = document.getElementById("form-container");
sliderContainer.addEventListener('mouseover', function(){
    sliderBottom.style.transform = 'translateY(0rem)';
    sliderTop.style.transform = 'translateY(0rem)';
})
// slider part 2
let sliderTop2 = document.getElementById("slider3");
let sliderBottom2 = document.getElementById("slider4");
let sliderContainer2 = document.getElementById("form-container2");
sliderContainer2.addEventListener('mouseover', function(){
    sliderBottom2.style.transform = 'translateY(0rem)';
    sliderTop2.style.transform = 'translateY(0rem)';
})


//form registration styling and User Xp enrichment
let submitBtn = document.getElementById("submit-btn");
let passwLabel = document.getElementById("");
let pseudoInput = document.getElementById("registration_form_pseudo");
let fnameInput = document.getElementById("registration_form_first_name");
let lnameInput = document.getElementById("registration_form_last_name");
let passwordInput = document.getElementById("registration_form_plainPassword");
const passwRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;
let confirmPwInput = document.getElementById("registration_form_confirmPw");

confirmPwInput.disabled = true;
submitBtn.disabled =true;

passwordInput.addEventListener("keyup", function(){
    confirmPwInput.disabled = false;
    if((this.value).match(passwRegex)){
        this.style.color = "green";
        submitBtn.disabled = false;
    }
    else{
        this.style.color = "red";
        submitBtn.disabled = true;
    }
})

confirmPwInput.addEventListener("keyup", function(){
    if(this.value === passwordInput.value){
        submitBtn.disabled = false;
    }
    else {
        submitBtn.disabled = true;
    }
})
fnameInput.addEventListener("keyup", function(){
    pseudoInput.value = this.value + lnameInput.value + Math.floor(Math.random()* 10);
})
lnameInput.addEventListener("keyup", function(){
    pseudoInput.value = fnameInput.value + this.value + Math.floor(Math.random()* 10);
})