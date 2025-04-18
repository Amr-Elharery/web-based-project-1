import { env } from '/config/env.js';

let formValid = false;

async function userNameValidation(username) {
    const url = "/src/validation/checkUserName.php";
    try{
        const response = await fetch(url + "?username=" + username);
        const data = await response.text();
        if(data == 'valid')
            return true;
        else
            return false;
    }
    catch(error){
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
        else{
            console.error('Error:', result);
            return true; // TODO handle this case properly
        }
    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}

async function submitForm(full_name, user_name, email, phone, whatsapp, address, password, confirm_password){
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

document.getElementById("full_name").addEventListener("blur", function () {
    const full_name = document.getElementById("full_name").value;
    const full_name_error = document.getElementById("full_name_error");

    full_name_error.textContent = " ";

    if (!full_name) {
        full_name_error.textContent = "please write your full name";
        formValid = false;
        return;
    }else{
        full_name_error.textContent = "valid full name";
        full_name_error.style.color = "green";
        formValid = true;
    }
})


document.getElementById("user_name").addEventListener("blur", function () {
    const user_name = document.getElementById("user_name").value;
    const user_name_error = document.getElementById("user_name_error");

    user_name_error.textContent = " ";

    if (!user_name) {
        user_name_error.textContent = "Please write your name";
        user_name_error.style.color = "red";
        return;
    }
    if (user_name.length < 4 || user_name.length > 20) {
        user_name_error.textContent = "Username must be between 4 and 20 characters";
        user_name_error.style.color = "red";
        return;
    }
    userNameValidation(user_name).then((isValid) => {
        if(isValid){
            user_name_error.textContent = "Valid user name";
            user_name_error.style.color = "green";
            formValid = true;
        }
        else{
            user_name_error.textContent = "This user name is exist, please choose another username";
            user_name_error.style.color = "red";
            formValid = false;
        }
    })

})


document.getElementById("email").addEventListener("blur", function () {
    const email = document.getElementById("email").value;
    const email_error = document.getElementById("email_error");

    email_error.textContent = " ";

    if (!email) {
        email_error.textContent = "please write your Email address";
        email_error.style.color = "red";
        formValid = false;
        return;
    }else{
        email_error.textContent = "valid email address";
        email_error.style.color = "green";
        formValid = true;
    }
})

document.getElementById("phone").addEventListener("blur", function () {
    const phone = document.getElementById("phone").value;
    const phone_error = document.getElementById("phone_error");

    phone_error.textContent = " ";

    if (!phone) {
        phone_error.textContent = "please write your phone number";
        phone_error.style.color = "red";
        formValid = false;
        return;
    }
    if(/^01[0-2]\d{1,8}$/.test(+phone)) {
        phone_error.textContent = "phone number must be 11 number in Egypt";
        phone_error.style.color = "red";
        formValid = false;
        return;
    }
    else{
        phone_error.textContent = "valid phone number";
        phone_error.style.color = "green";
        formValid = true;
    }
})


document.getElementById("whatsapp").addEventListener("blur", function () {
    const whatsapp = document.getElementById("whatsapp").value;
    const whatsapp_error = document.getElementById("whatsapp_error");

    whatsapp_error.textContent = " ";

    if (!whatsapp) {
        whatsapp_error.textContent = "please write your whatsapp number";
        whatsapp_error.style.color = "red";
        formValid = false;
        return;
    }
    if(/^01[0-2]\d{1,8}$/.test(+whatsapp)) {
        whatsapp_error.textContent = "whatsapp number must be 11 number in Egypt";
        whatsapp_error.style.color = "red";
        formValid = false;
        return;
    }
    whatsappValidation(whatsapp).then(isValid => {
        if (!isValid) {
            whatsapp_error.textContent = "invalid whatsapp number";
            whatsapp_error.style.color = "red";
            formValid = false;
        } else {
            whatsapp_error.textContent = "valid whatsapp number";
            whatsapp_error.style.color = "green";
            formValid = true;
        }
    });
})


document.getElementById("address").addEventListener("blur", function () {
    const address = document.getElementById("address").value;
    const address_error = document.getElementById("address_error");

    address_error.textContent = " ";

    if (!address) {
        address_error.textContent = "please write your Address";
        address_error.style.color = "red";
        formValid = false;
        return;
    }else{
        address_error.textContent = "valid Address";
        address_error.style.color = "green";
        formValid = true;
    }
})

document.getElementById("password").addEventListener("input", function () {
    const password = document.getElementById("password").value;
    const password_error = document.getElementById("password_error");

    password_error.textContent = "";

    if (password.length < 8) {
        password_error.textContent = "password must be more than 8 characters"
        password_error.style.color = "red"
        formValid = false;
        return;
    }

    else if (!/\d/.test(password)) {
        password_error.textContent = "password must have at least 1 number"
        password_error.style.color = "red"
        formValid = false;
        return;
    }

    else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        password_error.textContent = "password must have at least 1 special character"
        password_error.style.color = "red";
        formValid = false;
        return;
    }

    else {
        password_error.textContent = "strong password"
        password_error.style.color = "green"
        formValid = true;
    }
})

document.getElementById("user_image").addEventListener("change", function () {
    const user_image = document.getElementById("user_image").value;
    const user_image_error = document.getElementById("user_image_error");

    user_image_error.textContent = " ";

    if (this.files.length == 0) {
        user_image_error.textContent = "Please choose your user image";
        user_image_error.style.color = "red";
        formValid = false;
        return;
    }else{
        user_image_error.textContent = "File: " + this.files[0].name;
        user_image_error.style.color = "green";
        formValid = true;
    }
})

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
    }

    if(formValid){
        submitForm(full_name, user_name, email, phone, whatsapp, address, password, confirm_password).then((result) => {
            if (result == 'success') {
                form_error.textContent = "Registration successful!";
                form_error.style.color = "green";
            } else {
                form_error.textContent = "Registration failed! Please try again.<br>" + result;
                form_error.style.color = "red";
            }
        })
    }else{
        form_error.textContent = "Please fill in all the feilds";
        form_error.style.color = "red";
    }
});