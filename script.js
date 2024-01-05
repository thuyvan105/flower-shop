const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});



$(document).ready(function () {
    var modal = $('.modal');
    var btn = $('.btn');
    var span = $('.close');
  
    btn.click(function () {
      modal.show();
    });
  
    span.click(function () {
      modal.hide();
    });
  
    $(window).on('click', function (e) {
      if ($(e.target).is('.modal')) {
        modal.hide();
      }
    });
  });
  


// đăng kí
  function dangki() {
    var data = {
        email: $("#email").val(),
        name: $("#name_user").val(),
        psw: $("#pws").val(),
        action: $("#action").val(),
    };

    $.ajax({
        url: 'php/dataLogin.php',
        type: 'post',
        data: data,
        success: function (response) {
          alert(response);
            if (response == "email đăng kí đã tồn tại") {
                $("#nhacloitrung").html("Email đã tồn tại").css("color", "red");
            } else if (response == "đăng kí thành công") {
                window.location.href = 'php/login.php';
            }
        }
    });
}