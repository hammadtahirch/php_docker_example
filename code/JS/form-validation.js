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
// Model form validation 

$(document).ready(function() {
    $("#user-basic-form").validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            name: {
                required: true,
                minlength: 5,
                maxlength: 11
            },
            address: {
                required: true,
                minlength: 5,
                maxlength: 11
            },
            city: {
                required: true,
                minlength: 5,
                maxlength: 11
            },
            country: {
                required: true,
                minlength: 5,
                maxlength: 11
            }

        },
        messages: {
            name: {
                required: "Enter Shipper Name",
                minlength: " Name should be at least 5 characters",
                maxlength: "Name should be less then 11 characters"
            },
            address: {
                required: "Enter Shipping House Address",
                minlength: "Name should be at least 5 characters",
                maxlength: "Name should be less then 20 characters"
            },
            city: {
                required: "Enter Shipping City Name",
                minlength: "Name should be at least 5 characters",
                maxlength: "Name should be less then 20 characters "
            },
            country: {
                required: "Enter Shipping Country Name",
                minlength: "Name should be at least 5 characters",
                maxlength: "Name should be less then 20 characters "
            }

        }
    });
});