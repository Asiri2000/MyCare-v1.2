function validateStep1() {
    let firstName = document.getElementById("Fname").value;
    let lastName = document.getElementById("Lname").value;
    let email = document.getElementById("email").value;
    let phoneNumber = document.getElementById("phoneNumber").value;
    let password = document.getElementById("1stpassword").value;
    let rePassword = document.getElementById("rePassword").value;

    let isValid = true;

    // Validate phone number
    if (!/^\d{10}$/.test(phoneNumber)) {
        document.getElementById("phone-error").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("phone-error").style.display = "none";
    }

    // Validate password length
    if (password.length < 8) {
        document.getElementById("password-length-error").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("password-length-error").style.display = "none";
    }

    // Validate password match
    if (password !== rePassword) {
        document.getElementById("password-match-error").style.display = "block";
        isValid = false;
    } else {
        document.getElementById("password-match-error").style.display = "none";
    }

    return isValid;
}

function showStep2() {
    if (validateStep1()) {
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "block";
    }
}

function validateform() {
    // Add validation for the second step if needed
    return true;
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('nextButton').addEventListener('click', function () {
        showStep2();
    });
    document.getElementById('registerForm').addEventListener('submit', validateform);
});
//USERNAME Availabilty check

function checkUsername() {
    var username = $('#Username').val();
    $.ajax({
        type: 'POST',
        url: 'checkUsername.php',
        data: { username: username },
        dataType: 'json',
        success: function (response) {

            if (username === '') {
                $('#username-match-error').hide();
                $('#username-match-ok').hide();
            }
            else {
                if (response.available) {
                    $('#username-match-error').hide();
                    $('#username-match-ok').show();
                } else {
                    $('#username-match-error').show();
                    $('#username-match-ok').hide();
                }
            }
        }
    });
}

$(document).ready(function () {
    $('#username-match-error').hide();
    $('#username-match-ok').hide();
    $('#Username').on('keyup', function () {
        checkUsername();
    });
});

//email availability check

function checkEmail() {
    var email = $('#email').val();
    
    if (email === '') {
        $('#email-match-error').hide();
        $('#email-match-ok').hide();
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'checkEmail.php',
        data: { email: email },
        dataType: 'json',
        success: function(response) {
            if (response.available) {
                $('#email-match-error').hide();
                $('#email-match-ok').show();
            } else {
                $('#email-match-error').show();
                $('#email-match-ok').hide();
            }
        }
    });
}

$(document).ready(function() {
    $('#email-match-error').hide();
    $('#email-match-ok').hide();
    $('#email').on('keyup', function() {
        checkEmail();
    });
});

//logging 
