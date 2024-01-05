<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</script>
<script type="text/javascript">

$(document).ready(function () {
    $("#register-email").on('input', function () {
        var emailValue = $(this).val();

        // Kiểm tra email khi người dùng nhập liệu
        $.post("funLogin.php", { email: emailValue, action: "check_email" }, function (data) {
            if (data === "invalid") {
                $("#nhacloitrung").html("Email đã tồn tại").css("color", "red");
            } 
            else {
                $("#nhacloitrung").html("").css("color", "green");
            }

        //     if (!isValidEmail(emailValue)) {
        //     $("#nhacloitrung").html("Email không hợp lệ").css("color", "red");
        // } else {
        //     $("#nhacloitrung").html(""); // Xóa thông báo nếu email hợp lệ
        // }
        });
    });
});


function isValidEmail(email) {
    // Sử dụng biểu thức chính quy để kiểm tra định dạng email
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}


function submitLoginData() {
    var data = {
        email: $("#login-email").val(),
        password: $("#login-password").val(),
        action: $("#login-action").val(),
    };
    console.log(data); // In các giá trị để kiểm tra
    $.ajax({
        url: 'funLogin.php',
        type: 'post',
        data: data,
        success:function(response){
            // alert(response);
            if(response == "Đăng nhập thành công"){
                window.location.reload();
            }
        }
    });
}

  function submitRegisterData() {
    $(document).ready(function(){
    var data = {
      name: $("#register-name").val(),
      email: $("#register-email").val(),
      password: $("#register-password").val(),
      action: $("#register-action").val(),
    };
    // if (!isValidEmail(email)) {
    //     $("#nhacloitrung").html("Email không hợp lệ").css("color", "red");
    //     return;
    // }
    $.ajax({
        url: 'funLogin.php',
        type: 'post',
        data: data,
        success:function(response){
          alert(response);
          if (response == "Email đăng ký đã tồn tại") {
                $("#nhacloitrung").html("Email đã tồn tại").css("color", "red");
            } else if (response == "Đăng kí thành công") {
                window.location.href = 'login.php';
            }
        }
      });
    });

  }
      
      
  


</script>
