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
    } else {
        // check cerificate number availble in db
       
    }

     // validate Date
     const formDate = document.getElementById('date').value;
     if(formDate.trim() == '') {
         displayError("date-error", "Date is required.");
         isValid = false;
     }

    if(isValid) {
        document.getElementById('cert-form').submit();
        alert('submit');
    }
}



// function checkAvailable (values) {
    
    // if(values.length === 5) {

    //   const  requestData = { certificateNumber :values}

    //     fetch('verification.php', {
    //         method: "POST",
    //         body: JSON.stringify(requestData),
    //         headers: {
    //             'Content-Type' : 'application/json',
    //         }
    //     })
    //     .then(response => console.log(response.json()))
    //     .then(data => {
            
    //         if(data.exists) {
    //             displayError("cert-error", "Certificate number already exist.");
    //         } else {
    //             displayError("cert-error", "Certificate number available.");
                
    //         }
    //     })
    //     .catch(error => {
            // console.error('Error:', error);
//         });
//     } else {
//         clearErrors();
//     }
// }
document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('certificate').addEventListener('keyup', function() {

        const testNumber = "12345";
        checkAvailable(testNumber);
    })
})



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


