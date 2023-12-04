
$(document).ready(function () {

    $('#certificate').on('keyup', function () {
       
        let certValue = $(this).val();

      
        if (certValue) {
            $.ajax({
                type: "POST",
                url: "search_number.php",
                data: {
                    certValue : certValue
                },
                dataType: "text",
                success: function (response) {
                    $("#searchMessage").text(response);
                }
            })
        } 
            
      
    });
});

