$(document).ready(function() {
    $("#basic-form").validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            first_name: {
                required: true,
                minlength: 3,
                maxlength: 11
            },
            last_name: {
                required: true,
                minlength: 3,
                maxlength: 11
            },
            password: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email: true
            },
            phone_number: {
                required: true,
                number: true,
                minlength: 11
            },

        },
        messages: {
            first_name: {
                minlength: "Name should be at least 3 characters",
                maxlength: "Name should be less then 11 characters"
            },
            last_name: {
                minlength: "Name should be at least 3 characters",
                maxlength: "Name should be less then 11 characters"
            },
            password: {
                required: "Please enter your Password",
                minlength: "Your password must be at least 5 characters long"
            },
            email: {
                email: "The email should be in the format: abc@domain.tld"
            },
            phone_number: {
                required: "Please enter your Phone Number",
                number: "Please enter your numerical value",
                minlength: "03xxxxxxxxx"
            }

        }
    });
});