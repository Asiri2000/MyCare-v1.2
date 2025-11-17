
function validatePasswordLength() {
    let password = document.getElementById("password").value;
    if (password.length < 8) {
        document.getElementById("password-length-error").style.display = "block";
        return false;
    } else {
        document.getElementById("password-length-error").style.display = "none";
        return true;
    }
}

// Function to validate password match
function validatePasswordMatch() {
    let password = document.getElementById("password").value;
    let rePassword = document.getElementById("re-password").value;
    if (password !== rePassword) {
        document.getElementById("password-match-error").style.display = "block";
        return false;
    } else {
        document.getElementById("password-match-error").style.display = "none";
        return true;
    }
}

// Function to handle form submission
function validateResetForm() {
    let isPasswordValid = validatePasswordLength() && validatePasswordMatch();
    return isPasswordValid;
}

// Event listener for form submission
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('resetPasswordForm').addEventListener('submit', function (event) {
        if (!validateResetForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});
