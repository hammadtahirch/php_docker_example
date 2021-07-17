
// Useer Login/Reg form validation

$(document).ready(function() {
    $("#basic-form").validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            first_name : {
                required: true,
                minlength: 3,
                maxlength:11
            },
            last_name : {
                required: true,
                minlength: 3,
                maxlength:11
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
        messages : {
            first_name: {
                minlength: "Name should be at least 5 characters",
                maxlength:"Name should be less then 11 characters"
            },
            last_name: {
                minlength: "Name should be at least 5 characters",
                maxlength:"Name should be less then 11 characters"
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
                minlength: "03xx xxxxxxx"
            }

        }
    });
});

// Product Form Validation

$(document).ready(function() {
    $("#product-form").validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            product_name : {
                required: true,
                minlength: 3,
                maxlength:11
            },
            product_discription : {
                required: true,
                minlength: 20,
                maxlength:70
            },
            product_price: {
                required: true,
                number: true,
                minlength: 2,
                maxlength:3
            },
            product_image: {
                required: true,
            }

        },
        messages : {
            product_name: {
                minlength: " Product Name should be at least 5 characters",
                maxlength:"Name should be less then 11 characters"
            },
            product_discription: {
                minlength: "Name should be at least 20 characters",
                maxlength:"Name should be less then 60-70 characters"
            },
            product_price: {
                required: "Please enter your price",
                minlength: "Your price value must be at least 2 ",
                maxlength:"Your price value must be less then 3 "
            },
            product_image: {
                required: "JPG,PNG,JPGE,  less then 2MB"
            }

        }
    });
});