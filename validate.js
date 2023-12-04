function validateForm(event) {

    event.preventDefault();
    clearErrors();

    let isValid = true;

    // Name
    const name = document.getElementById('name').value;
    if (name.trim() == '') {
        displayError("name-error", "Learner name is required.");
        isValid = false;
    }

    // Validate Certificate Number
    const certificateNumber = document.getElementById('certificate').value;
    if(certificateNumber.trim() == '') {
        displayError("cert-error", "Certificate Number is required.");
        isValid = false;
    } 

    // Validate Certificate Number
    const achievDate = document.getElementById('date').value;
    if(achievDate.trim() == '') {
        displayError("date-error", "Achievement date is required.");
        isValid = false;
    }
     
    if(isValid) {
        document.getElementById('cert-form').submit();
        
    }
}


function validateAdminForm(e) {
    e.preventDefault();
    clearErrors();

    let isValid = true;

    //Student Name
    const name = document.getElementById('student-name').value;
    if (name.trim() == '') {
        displayError("student-error", "Student name is required.");
        isValid = false;
    }

    // Validate Certificate Number
    const certificateNumber = document.getElementById('admin-cert-number').value;
    if(certificateNumber.trim() == '') {
        displayError("admin-cert-error", "Certificate Number is required.");
        isValid = false;
    }

    if(isValid) {
        document.getElementById('ad-cert-form').submit();
        // alert('submit');
    }

    
}

// Valdiate Login Form 
function validateLogin(event) {
    
    event.preventDefault();
    clearErrors();

    let isValid = true;

    // Username 
    const username = document.getElementById('username').value;
    if(username.trim() == "") {
        displayError("username-error", "Username name is required.");
        isValid = false;
    }

    // Password
    const password = document.getElementById('ad-password').value;
    if(password.trim() == "") {
        displayError("password-error", "Password is required.");
        isValid = false;
    }

    if(isValid) {
        document.getElementById('login-form').submit();
    }

}


function displayError(id, message) {
        const error = document.getElementById(id);
        error.textContent = message;
    }

    function  clearErrors() {
        const error = document.querySelectorAll(".error");
        error.forEach((element) => {
            element.textContent = '';
        })
    }


