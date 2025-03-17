$(document).ready(function () {
    $("#sendnow").click(function () {
        var name = $('#name').val().trim();
        var phone = $('#phone').val().trim();
        var email = $('#email').val().trim();
        var captcha_val = $('#captcha_val').val().trim();
        var information = $('textarea[name="information"]').val();
        $.ajax({
            method: "POST",
            url: "contact_action.php",
            data: {name: name, phone: phone, email:email, captcha_val: captcha_val, information: information},
            beforeSend: function () {
                $('#sendnow').hide();
                $('#subloader').show();
                $('#subloader').html('<img src="loader.gif" height="100">');
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
                    $('#hide_form').hide();
                    $('#success').html('Thank you ' + name + ' ! Your message has been sent. We will contact you as soon as possible.. ');

                }
                $("#captcha").attr('src', 'captchaimg.php');

            }
        });
    });
});
function refreshCaptcha() {
    $("#captcha").attr('src', 'captchaimg.php');
}