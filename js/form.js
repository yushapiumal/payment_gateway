
function simplifyResponseHandler(data) {
    var $paymentForm = $("#paymentForm");
    $(".error").remove();
    if (data.error) {
        if (data.error.code === "validation") {
            var fieldErrors = data.error.fieldErrors;
            fieldErrors.forEach(function(fieldError) {
                $paymentForm.after(`<div class='error'>Field: '${fieldError.field}' is invalid - ${fieldError.message}</div>`);
            });
        }
        $("#submit").removeAttr("disabled");
    } else {
        $paymentForm.append(`<input type='hidden' name='simplifyToken' value='${data.id}' />`);
        $paymentForm.get(0).submit();
    }
}

$(document).ready(function() {
    $("#paymentForm").on("submit", function(e) {
        e.preventDefault();
        $("#submit").attr("disabled", "disabled");

        SimplifyCommerce.generateToken({
            key: "sbpb_ZTQ3ODk5YWItNjE3YS00ZjNjLTg3MDgtMDM2YjFmOGJjOGY5",
            card: {
                number: $("#card_number").val(),
                cvc: $("#cvv").val(),
                expMonth: $("#cc-exp-month").val(),
                expYear: $("#cc-exp-year").val()
            }
        }, simplifyResponseHandler);
    });
});



$("#expiry-date").on("input", function() {
    let value = $(this).val().replace(/\D/g, "").slice(0, 4);
    if (value.length >= 3) {
        $(this).val(value.slice(0, 2) + "/" + value.slice(2, 4));
    } else {
        $(this).val(value);
    }
    validateExpiryDate($(this).val());
});

$("#cvv").on("input", function() {
    let value = $(this).val().replace(/\D/g, "").slice(0, 3);
    $(this).val(value);
    validateCVV(value);
});

$("#amount").on("input", function() {
    validateAmount($(this).val());
});

function validateCardNumber(value) {
    const messageElement = $("#card_number_msg");
    if (value.length === 16) {
        messageElement.text("Valid card number").css("color", "green");
        $("#card_number").removeClass("invalid").addClass("valid");
    } else {
        messageElement.text("Invalid card number").css("color", "red");
        $("#card_number").removeClass("valid").addClass("invalid");
    }
}



function validateCVV(value) {
    const messageElement = $("#cvv_msg");
    if (value.length === 3) {
        messageElement.text("Valid CVV").css("color", "green");
        $("#cvv").removeClass("invalid").addClass("valid");
    } else {
        messageElement.text("Invalid CVV").css("color", "red");
        $("#cvv").removeClass("valid").addClass("invalid");
    }
}



// <!-- <script type="text/javascript">
// function simplifyResponseHandler(data) {
//     var $paymentForm = $("#paymentForm");
//     $(".error").remove();
//     if (data.error) {

//         if (data.error.code === "validation") {
//             var fieldErrors = data.error.fieldErrors;
//             fieldErrors.forEach(function(fieldError) {
//                 $paymentForm.after(`<div class='error'>Field: '${fieldError.field}' is invalid - ${fieldError.message}</div>`);
//             });
//         }
//         $("#submit").removeAttr("disabled");
//     } else {

//         var token = data.id;
//         $paymentForm.append(`<input type='hidden' name='simplifyToken' value='${token}' />`);
//         $paymentForm.get(0).submit();
//     }
// }

// $(document).ready(function() {
//     $("#paymentForm").on("submit", function(e) {
//         e.preventDefault();
//         $("#submit").attr("disabled", "disabled");

//         SimplifyCommerce.generateToken({
//             key: "lvpb_MDMwNGEzMmYtNzQxZi00MWNkLWEyOTktMTZlNDJjY2FlZTYw",
//             card: {
//                 number: $("#card_number").val(),
//                 cvc: $("#cvv").val(),
//                 expMonth: $("#cc-exp-month").val(),
//                 expYear: $("#cc-exp-year").val()
//             }
//         }, simplifyResponseHandler);
//     });
// });
// </script>
// <script>
// $("#card_number").on("input", function() {
//     let value = $(this).val().replace(/\D/g, "").slice(0, 16);
//     $(this).val(value.replace(/(\d{4})(?=\d)/g, "$1-"));
//     validateCardNumber(value);
// });

// $("#expiry-date").on("input", function() {
//     let value = $(this).val().replace(/\D/g, "").slice(0, 4);
//     if (value.length >= 3) {
//         $(this).val(value.slice(0, 2) + "/" + value.slice(2, 4));
//     } else {
//         $(this).val(value);
//     }
//     validateExpiryDate($(this).val());
// });

// $("#cvv").on("input", function() {
//     let value = $(this).val().replace(/\D/g, "").slice(0, 3);
//     $(this).val(value);
//     validateCVV(value);
// });

// $("#amount").on("input", function() {
//     validateAmount($(this).val());
// });

// function validateCardNumber(value) {
//     const messageElement = $("#card_number_msg");
//     if (value.length === 16) {
//         messageElement.text("Valid card number").css("color", "green");
//         $("#card_number").removeClass("invalid").addClass("valid");
//     } else {
//         messageElement.text("Invalid card number").css("color", "red");
//         $("#card_number").removeClass("valid").addClass("invalid");
//     }
// }

// function validateExpiryDate(value) {
//     const messageElement = $("#expiry_date_msg");
//     const parts = value.split("/");
//     if (parts.length === 2 &&
//         !isNaN(parts[0]) &&
//         !isNaN(parts[1]) &&
//         parts[0] <= 12) {
//         messageElement.text("Valid expiry date").css("color", "green");
//         $("#expiry-date").removeClass("invalid").addClass("valid");
//     } else {
//         messageElement.text("Invalid expiry date").css("color", "red");
//         $("#expiry-date").removeClass("valid").addClass("invalid");
//     }
// }

// function validateCVV(value) {
//     const messageElement = $("#cvv_msg");
//     if (value.length === 3) {
//         messageElement.text("Valid CVV").css("color", "green");
//         $("#cvv").removeClass("invalid").addClass("valid");
//     } else {
//         messageElement.text("Invalid CVV").css("color", "red");
//         $("#cvv").removeClass("valid").addClass("invalid");
//     }
// }

// function validateAmount(value) {
//     const messageElement = $("#submit");
//     if (!isNaN(value) && value > 0) {
//         messageElement.text("Valid amount").css("color", "green");
//         $("#amount").removeClass("invalid").addClass("valid");
//     } else {
//         messageElement.text("Invalid amount").css("color", "red");
//         $("#amount").removeClass("valid").addClass("invalid");
//     }
// }
// </script>
// -->