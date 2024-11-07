<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link rel="stylesheet" href="css/custom.css">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="payment-form">
        <img class="header_logo" src="assets/combank.png" alt="Acquiring Bank Logo">
        <h2 class="profile-name-card">COMBANK MPGS Payment Gateway</h2>

        <div id="paymentFormContainer">
            <form id="paymentForm" action="config/auth.php" method="POST">
                <div class="form-group">
                    <label>Credit Card Number: </label>
                    <input id="card_number" type="text" maxlength="20" autocomplete="off" required autofocus />
                    <span class="validation-message" id="card_number_msg"></span>
                </div>

                <div class="form-group-_inline">
                    <div class="flex space-x-4">
                        <div class="form-group w-1/2 p-4">
                            <label>Expiry Date: </label>
                            <div class="flex space-x-4">
                                <select id="cc-exp-month" class="form-group" required>
                                    <option value="">Month</option>
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">Mar</option>
                                    <option value="04">Apr</option>
                                    <option value="05">May</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Jul</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                                <select id="cc-exp-year" class="form-group" required>
                                    <option value="">Year</option>
                                    <option value="23">2023</option>
                                    <option value="24">2024</option>
                                    <option value="25">2025</option>
                                    <option value="26">2026</option>
                                    <option value="27">2027</option>
                                    <option value="28">2028</option>
                                    <option value="29">2029</option>
                                    <option value="30">2030</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group w-1/2 p-4">
                            <label>CVV: </label>
                            <input id="cvv" type="text" maxlength="4" autocomplete="off" required />
                            <span class="validation-message" id="cvv_msg"></span>
                        </div>
                    </div>
                    <span class="validation-message" id="expiry_year_msg"></span>

                    <div class="form-group">
                        <input type="submit" value="Pay Now">
                    </div>

                    <div class="logos">
                        <img src="assets/all.jpg" alt="Acquiring Bank Logo">
                        <img src="assets/card_acceptancelogo.jpg" alt="Card Acceptance Logo">
                        <img src="assets/combank.png" alt="Authentication Logo">
                    </div>
                </div>
            </form>
        </div>



        <div id="notificationMessage" class="w-full max-w-md p-4 bg-white rounded-lg  hidden">
            <div class="mb-4">
                <p class="text-center text-lg font-semibold" id="messageText"></p>
            </div>
            <div class="text-center">
                <a href="/" class="px-6 py-3 text-white font-semibold bg-gradient-to-r  from-green-500 to-blue-500 rounded-lg shadow-lg hover:from-blue-600 hover:to-purple-600 transform transition duration-300 ease-in-out hover:scale-105">
                    Return to Home
                </a>

            </div>
        </div>

    </div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/form.js"></script>
    <script type="text/javascript" src="https://www.simplify.com/commerce/v1/simplify.js"></script>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const message = urlParams.get('message');

        if (status && message) {
            $('#paymentFormContainer').hide();
            $('#notificationMessage').removeClass('hidden');
            $('#messageText').text(decodeURIComponent(message));

            if (status === 'APPROVED') {
                $('#messageText').addClass('text-green-500');
            } else {
                $('#messageText').addClass('text-red-500');
            }


            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>


</body>

</html>