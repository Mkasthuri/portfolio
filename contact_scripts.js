$(document).ready(function () {
    $("#sendnow").click(function () {
        var fname = $('#fname').val().trim();
        var mobile = $('#mobile').val().trim();
        var email = $('#email').val().trim();
        var info = $('textarea[name="info"]').val();
        $.ajax({
            method: "POST",
            url: "contact_action.php",
            data: {fname: fname, mobile: mobile, email:email, info: info},
            beforeSend: function () {
                $('#sendnow').hide();
                $('#subloader').show();
                $('#subloader').html('Sending...');
            },
            success: function (data) {
                //$('#msg').html(data);

                var obj = JSON.parse(data);
                $('#msg').html(obj.errors);
                var status = obj.status;
                $('#subloader').hide();
                $('#subloader').html("");
                $('#sendnow').show();
               if (status == 'success') {
                     window.location.href = 'thanks.html';
                   
                }
               

            }
        });
    });
});
