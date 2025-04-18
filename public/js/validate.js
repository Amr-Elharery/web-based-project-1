import { env } from '/config/env.js';

let isFullNameValid = false;
let isUserNameValid = false;
let isEmailValid = false;
let isPhoneValid = false;
let isWhatsappValid = false;
let isAddressValid = false;
let isPasswordValid = false;
let isImageValid = false;
let limit_exceeded = false;

async function userNameValidation(username) {
    const url = "/src/validation/checkUserName.php";
    try {
        const response = await fetch(url + "?username=" + username);
        const data = await response.text();
        return data === 'valid';
    } catch (error) {
        console.log("Error: ", error);
        return false;
    }
}

async function whatsappValidation(whatsapp) {
    const url = env.API_URL;

    const options = {
        method: 'POST',
        headers: {
            'x-rapidapi-key': env['x-rapidapi-key'],
            'x-rapidapi-host': env['x-rapidapi-host'],
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ phone_number: '+2' + whatsapp })
    };
    try {
        const response = await fetch(url, options);
        const result = await response.json();
        if (response.status === 200 && result.status === 'valid') {
            return true;
        } else if (response.status === 200 && result.status === 'invalid') {
            return false;
        } else {
            console.error('Error:', result);
            limit_exceeded = true;
            return false;
        }
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}

async function submitForm(full_name, user_name, email, phone, whatsapp, address, password, confirm_password) {
    const url = "/src/validation/register.php";
    const user_image = document.getElementById("user_image").files[0];
    const formData = new FormData();
    formData.append("full_name", full_name);
    formData.append("user_name", user_name);
    formData.append("email", email);
    formData.append("phone", phone);
    formData.append("whatsapp", whatsapp);
    formData.append("address", address);
    formData.append("password", password);
    formData.append("confirm_password", confirm_password);
    formData.append("user_image", user_image);

    try {
        const response = await fetch(url, {
            method: "POST",
            body: formData,
        });
        const data = await response.text();
        return data;
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}

// VALIDATION EVENTS

document.getElementById("full_name").addEventListener("blur", function () {
    const full_name = this.value;
    const full_name_error = document.getElementById("full_name_error");
    full_name_error.textContent = "";

    if (!full_name) {
        full_name_error.textContent = "please write your full name";
        full_name_error.style.color = "red";
        isFullNameValid = false;
    } else {
        full_name_error.textContent = "valid full name";
        full_name_error.style.color = "green";
        isFullNameValid = true;
    }
});

document.getElementById("user_name").addEventListener("blur", function () {
    const user_name = this.value;
    const user_name_error = document.getElementById("user_name_error");

    user_name_error.textContent = "";

    if (!user_name) {
        user_name_error.textContent = "Please write your name";
        user_name_error.style.color = "red";
        isUserNameValid = false;
        return;
    }
    if (user_name.length < 4 || user_name.length > 20) {
        user_name_error.textContent = "Username must be between 4 and 20 characters";
        user_name_error.style.color = "red";
        isUserNameValid = false;
        return;
    }

    userNameValidation(user_name).then(isValid => {
        if (isValid) {
            user_name_error.textContent = "Valid user name";
            user_name_error.style.color = "green";
            isUserNameValid = true;
        } else {
            user_name_error.textContent = "This user name is taken, choose another";
            user_name_error.style.color = "red";
            isUserNameValid = false;
        }
    });
});

document.getElementById("email").addEventListener("blur", function () {
    const email = this.value;
    const email_error = document.getElementById("email_error");
    email_error.textContent = "";

    if (!email) {
        email_error.textContent = "please write your Email address";
        email_error.style.color = "red";
        isEmailValid = false;
    } else {
        email_error.textContent = "valid email address";
        email_error.style.color = "green";
        isEmailValid = true;
    }
});

document.getElementById("phone").addEventListener("blur", function () {
    const phone = this.value;
    const phone_error = document.getElementById("phone_error");
    phone_error.textContent = "";

    if (!phone) {
        phone_error.textContent = "please write your phone number";
        phone_error.style.color = "red";
        isPhoneValid = false;
        return;
    }
    if (!/^01[0-2]\d{8}$/.test(phone)) {
        phone_error.textContent = "phone number must be 11 digits in Egypt";
        phone_error.style.color = "red";
        isPhoneValid = false;
    } else {
        phone_error.textContent = "valid phone number";
        phone_error.style.color = "green";
        isPhoneValid = true;
    }
});

document.getElementById("whatsapp").addEventListener("blur", function () {
    const whatsapp = this.value;
    const whatsapp_error = document.getElementById("whatsapp_error");

    whatsapp_error.textContent = "";

    if (!whatsapp) {
        whatsapp_error.textContent = "please write your whatsapp number";
        whatsapp_error.style.color = "red";
        isWhatsappValid = false;
        return;
    }
    if (!/^01[0-2]\d{8}$/.test(whatsapp)) {
        whatsapp_error.textContent = "whatsapp number must be 11 digits in Egypt";
        whatsapp_error.style.color = "red";
        isWhatsappValid = false;
        return;
    }

    whatsappValidation(whatsapp).then(isValid => {
        if (!isValid) {
            if (limit_exceeded) {
                whatsapp_error.textContent = "API limit exceeded. Continue anyway.";
                whatsapp_error.style.color = "orange";
                isWhatsappValid = true;
            } else {
                whatsapp_error.textContent = "Invalid whatsapp number";
                whatsapp_error.style.color = "red";
                isWhatsappValid = false;
            }
        } else {
            whatsapp_error.textContent = "valid whatsapp number";
            whatsapp_error.style.color = "green";
            isWhatsappValid = true;
        }
    });
});

document.getElementById("address").addEventListener("blur", function () {
    const address = this.value;
    const address_error = document.getElementById("address_error");
    address_error.textContent = "";

    if (!address) {
        address_error.textContent = "please write your Address";
        address_error.style.color = "red";
        isAddressValid = false;
    } else {
        address_error.textContent = "valid Address";
        address_error.style.color = "green";
        isAddressValid = true;
    }
});

document.getElementById("password").addEventListener("input", function () {
    const password = this.value;
    const password_error = document.getElementById("password_error");
    password_error.textContent = "";

    if (password.length < 8) {
        password_error.textContent = "password must be more than 8 characters";
        password_error.style.color = "red";
        isPasswordValid = false;
    } else if (!/\d/.test(password)) {
        password_error.textContent = "password must have at least 1 number";
        password_error.style.color = "red";
        isPasswordValid = false;
    } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        password_error.textContent = "password must have at least 1 special character";
        password_error.style.color = "red";
        isPasswordValid = false;
    } else {
        password_error.textContent = "strong password";
        password_error.style.color = "green";
        isPasswordValid = true;
    }
});

document.getElementById("user_image").addEventListener("change", function () {
    const user_image_error = document.getElementById("user_image_error");
    user_image_error.textContent = "";

    if (this.files.length === 0) {
        user_image_error.textContent = "Please choose your user image";
        user_image_error.style.color = "red";
        isImageValid = false;
    } else {
        user_image_error.textContent = "File: " + this.files[0].name;
        user_image_error.style.color = "green";
        isImageValid = true;
    }
});

document.getElementById("registrationForm").addEventListener("submit", function (e) {
    e.preventDefault();

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
        confirm_password_error.textContent = "Password does not match";
        confirm_password_error.style.color = "red";
        return;
    }

    const allValid = isFullNameValid && isUserNameValid && isEmailValid && isPhoneValid &&
        isWhatsappValid && isAddressValid && isPasswordValid && isImageValid;

    if (allValid) {
        submitForm(full_name, user_name, email, phone, whatsapp, address, password, confirm_password)
            .then(result => {
                if (result === 'success') {
                    form_error.textContent = "Registration successful!";
                    form_error.style.color = "green";
                    Swal.fire({
                        title: "Registration successful!",
                        icon: "success"
                    });
                } else {
                    form_error.textContent = "Registration failed! " + result;
                    form_error.style.color = "red";
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Registration failed! Please try again.",
                        footer: '<a href="/">Register again?</a>'
                    });
                }
            });
    } else {
        form_error.textContent = "Please fill in all the fields correctly.";
        form_error.style.color = "red";
    }
});
