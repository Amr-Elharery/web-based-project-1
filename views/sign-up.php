<div class="container">
    <form id="registrationForm" class="signup-form shadow rad-6" enctype="multipart/form-data">
        <h1>Create Account</h1>
        <div class="flex flex-col-mobile">
            <div class="form-group flex-1">
                <label for="full_name">Full Name<span class="c-red fs-14">*</span> : </label>
                <input class="form-control" type="text" id="full_name" name="full_name" placeholder="Enter your full name" title="Full name should contain only letters and spaces">
                <span class="error-message fs-14" id="full_name_error"></span>
            </div>

            <div class="form-group flex-1">
                <label for="user_name">Username<span class="c-red fs-14">*</span> : </label>
                <input class="form-control" type="text" id="user_name" name="user_name" placeholder="Enter your username" minlength="4" maxlength="20">
                <span class="error-message fs-14" id="user_name_error"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email<span class="c-red fs-14">*</span> : </label>
            <input class="form-control" type="email" id="email" name="email" placeholder="Enter your email" >
            <span class="error-message fs-14" id="email_error"></span>
        </div>

        <div class="flex flex-col-mobile">
            <div class="form-group flex-1">
                <label for="phone">Phone Number<span class="c-red fs-14">*</span> : </label>
                <input class="form-control" type="tel" id="phone" name="phone" placeholder="Enter your phone number">
                <span class="error-message fs-14" id="phone_error"></span>
            </div>

          <div class="form-group flex-1">
              <label for="whatsapp">WhatsApp Number<span class="c-red fs-14">*</span> : </label>
              <input class="form-control" type="tel" id="whatsapp" name="whatsapp" placeholder="0123456789">
                <span class="error-message fs-14" id="whatsapp_error"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="address">Address<span class="c-red fs-14">*</span> : </label>
            <textarea class="form-control" id="address" name="address" placeholder="Enter your full address" rows="5"></textarea>
            <span class="error-message fs-14" id="address_error"></span>
        </div>

        <div class="form-group password-group">
            <label for="password">Password<span class="c-red fs-14">*</span> : </label>
            <input class="form-control" type="password" id="password" name="password" placeholder="Enter your password" title="Must contain at least 8 characters, one number, and one special character">
            <i class="fa-solid fa-eye-slash fs-14 c-gray" id="toggle_password"></i>
            <div class="password-requirements fs-14 c-grey">
                Password must be at least 8 characters long and contain at least one number and one special character
            </div>
            <span class="error-message fs-14" id="password_error"></span>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password<span class="c-red fs-14">*</span> : </label>
            <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
            <span class="error-message fs-14" id="confirm_password_error"></span>
        </div>

        <div class="form-group">
            <div class="flex items-center">
                <label for="user_image">Profile Picture<span class="c-red fs-14">*</span> : </label>
                <label for="user_image" class="btn btn-effect c-white w-fit">Choose File</label>
            </div>
            <span class="error-message fs-14" id="user_image_error"></span>
            <input class="form-control" type="file" id="user_image" name="user_image" accept="image/*" hidden>
        </div>

        <div class="form-group">
            <button class="btn btn-effect c-white w-full fs-22" type="submit">Register</button>
            <span class="error-message fs-14" id="form_error"></span>

        </div>
    </form>
</div>
