import { env } from '/config/env.js';

async function whatsappValidation(whatsapp) {
    const url = env.API_URL;

    const options = {
        method: 'POST',
        headers: {
            'x-rapidapi-key': env['x-rapidapi-key'],
            'x-rapidapi-host': env['x-rapidapi-host'],
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            phone_number: '+2' + whatsapp,
        })
    };
    try {
        const response = await fetch(url, options);
        const result = await response.json();
        if(response.status === 200 && result.status === 'valid'){
            return true;
        }
        else if(response.status === 200 && result.status === 'invalid'){
            return false;
        }
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}


document.getElementById("full_name").addEventListener("blur", function () {
    const full_name = document.getElementById("full_name").value;
    const full_name_error = document.getElementById("full_name_error");

    full_name_error.textContent = " ";

    if (!full_name) {
        full_name_error.textContent = "please write your full name";
    }
})


document.getElementById("user_name").addEventListener("blur", function () {
    const user_name = document.getElementById("user_name").value;
    const user_name_error = document.getElementById("user_name_error");

    user_name_error.textContent = " ";

    if (!user_name) {
        user_name_error.textContent = "please write your name";
    }
})


document.getElementById("email").addEventListener("blur", function () {
    const email = document.getElementById("email").value;
    const email_error = document.getElementById("email_error");

    email_error.textContent = " ";

    if (!email) {
        email_error.textContent = "please write your Email address";
    }
})

document.getElementById("phone").addEventListener("blur", function () {
    const phone = document.getElementById("phone").value;
    const phone_error = document.getElementById("phone_error");

    phone_error.textContent = " ";

    if (!phone) {
        phone_error.textContent = "please write your phone number";
    }
})


document.getElementById("whatsapp").addEventListener("blur", function () {
    const whatsapp = document.getElementById("whatsapp").value;
    const whatsapp_error = document.getElementById("whatsapp_error");

    whatsapp_error.textContent = " ";

    if (!whatsapp) {
        whatsapp_error.textContent = "please write your whatsapp number";
    }
    if (whatsapp.length < 11) {
        whatsapp_error.textContent = "whatsapp number must be 11 number in Egypt";
        whatsapp_error.style.color = "red"
    }
    if(/[0-9]{10,15}/.test(whatsapp)) {
        whatsapp_error.textContent = "whatsapp number must be 11 number in Egypt";
        whatsapp_error.style.color = "red"
    }
    if (whatsapp.length === 11 && /[0-9]{10,15}/.test(whatsapp)) {
        whatsappValidation(whatsapp).then(isValid => {
            if (!isValid) {
                whatsapp_error.textContent = "invalid whatsapp number";
                whatsapp_error.style.color = "red"
            } else {
                whatsapp_error.textContent = "valid whatsapp number";
                whatsapp_error.style.color = "green"
            }
        });
    }
})


document.getElementById("address").addEventListener("blur", function () {
    const address = document.getElementById("address").value;
    const address_error = document.getElementById("address_error");

    address_error.textContent = " ";

    if (!address) {
        address_error.textContent = "please write your Address";
    }
})

document.getElementById("password").addEventListener("input", function () {
    const password = document.getElementById("password").value;
    const password_error = document.getElementById("password_error");

    password_error.textContent = "";

    if (password.length < 8) {
        password_error.textContent = "password must be more than 8 characters"
        password_error.style.color = "red"
    }

    else if (!/\d/.test(password)) {
        password_error.textContent = "password must have at least 1 number"
        password_error.style.color = "red"
    }

    else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        password_error.textContent = "password must have at least 1 special character"
        password_error.style.color = "red"
    }

    else {
        password_error.textContent = "strong password"
        password_error.style.color = "green"
    }
})

document.getElementById("user_image").addEventListener("change", function () {
    const user_image = document.getElementById("user_image").value;
    const user_image_error = document.getElementById("user_image_error");

    user_image_error.textContent = " ";

    if (this.files.length == 0) {
        user_image_error.textContent = "please choose your user image";
    }
})

document.getElementById("registrationForm").addEventListener("submit", function (e) {

    const full_name = document.getElementById("full_name").value;
    const user_name = document.getElementById("user_name").value;
    const address = document.getElementById("address").value;
    const whatsapp = document.getElementById("whatsapp").value;
    const phone = document.getElementById("phone").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirm_password = document.getElementById("confirm_password").value;
    const confirm_password_error = document.getElementById("confirm_password_error");
    const form_error = document.getElementById("form_error");

    confirm_password_error.textContent = "";
    if (password !== confirm_password) {
        confirm_password_error.textContent = "password does not match";
        e.preventDefault();
    }

    else if (!full_name || !user_name || !email || !phone || !whatsapp || !address || !password || !confirm_password) {
        form_error.textContent = "please fill in all the feilds";
        e.preventDefault();
    }
})





