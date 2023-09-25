document.addEventListener("DOMContentLoaded", function () {

    const certNumber = document.getElementById('certificate');
    const stateMessage = document.getElementById('searchMessage');

    // certNumber.addEventListener('keyup', function (event) {
    //     let certValue = event.target.value;

    //     // stateMessage.textContent = 'empty';

    //     if(certValue.length == 5) {
    //         var xmlhttp = new XMLHttpRequest();
    //         xmlhttp.onreadystatechange = function() {
    //             if(this.readyState == 4 && this.status == 200) {
    //                 stateMessage.innerHTML = this.responseText;
    //             }
    //         };
    //         xmlhttp.open("GET","search_number.php?q=" + certValue, true);
    //         xmlhttp.send();
    //     } else {
           
    //      }
       
    // })

    // certNumber.addEventListener('keyup', function (event) {
    //     let certValue = event.target.value;
    
    //     // stateMessage.textContent = 'empty';
    
    //     if (certValue.length == 5) {
    //         fetch("search_number.php?q=" + certValue)
    //             .then(function (response) {
    //                 if (!response.ok) {
    //                     throw new Error("Network response was not ok");
    //                 }
    //                 return response.text(); 
    //             })
    //             .then(function (data) {
    //                 stateMessage.innerHTML = data;
    //             })
    //             .catch(function (error) {
    //                 console.error("Fetch error:", error);
    //             });
    //     } else {
    
    //     }
    // });
    

    certNumber.addEventListener('keyup', function (event) {
        let certValue = event.target.value;
    
        // stateMessage.textContent = 'empty';
    
        if (certValue.length == 5) {
            // Create an object to hold the data you want to send
            const data = {
                certValue: certValue
            };
    
            // Send a POST request using the fetch method
            fetch("search_number.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: console.log(JSON.stringify(data))
            })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text(); 
            })
            .then(function (data) {
                stateMessage.innerHTML = data;
            })
            .catch(function (error) {
                console.error("Fetch error:", error);
            });
        } else {
    
        }
    });
    

});
