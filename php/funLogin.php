<?php
 session_start();
 ob_start();
$conn = mysqli_connect("localhost", "root", "", "dacs2");


if (isset($_POST["action"])) {
    if ($_POST["action"] == "register") {
        register();
    } else if ($_POST["action"] == "check_email") {
        checkEmail();
    } else if ($_POST["action"] == "login") {
        login();
        
    }
}

// CHECK EMAIL
function checkEmail() {
    global $conn;
    $email = $_POST["email"];

    $user = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    if (mysqli_num_rows($user) > 0) {
        echo "invalid";
    } else {
        echo "valid";
    }
}

// REGISTER
function register() {
    global $conn;

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (empty($name) || empty($email) || empty($password)) {
        echo "Vui lòng điền đủ thông tin!";
        exit;
    }

    $user = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    if (mysqli_num_rows($user) > 0) {
        echo "Email đăng ký đã tồn tại";
        exit;
    }

    $query = mysqli_query($conn, "INSERT INTO user (email, name_user, password) VALUES ('$email', '$name', '$password')");
    echo "Đăng kí thành công";
}

// LOGIN
function login() {
 

  global $conn;

  $email = $_POST["email"];
  $password = $_POST["password"];

  $user = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

  if (mysqli_num_rows($user) > 0) {
    $row = mysqli_fetch_assoc($user);

    // Sử dụng password_verify để kiểm tra mật khẩu
    if (password_verify($password, $row['password'])) {
      echo "Đăng nhập thành công";
      $_SESSION["login"] = true;
      $_SESSION['id_user'] = $row['id_user'];
      $_SESSION['name_user'] = $row['name_user'];
      
      $_SESSION['role'] = $row['role'];
      // Chuyển hướng dựa trên vai trò
      if ($_SESSION['role']  == 1) {
        header('location: ../admin/index.php');
      } else {
        header("Location: ../php/index.php"); 
        $user_id = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 'guest';
    if (isset($_COOKIE['cart_' . $user_id])) {
        $cartJson = $_COOKIE['cart_' . $user_id];

        // Đọc thông tin giỏ hàng từ cookie
        $cart = json_decode($cartJson, true);

        // Lưu thông tin giỏ hàng vào session
        $_SESSION['cart'] = $cart;
    }
      }
      exit;
    } else {
      echo "Mật khẩu không chính xác";
    //   var_dump($password, $row['password']); // In giá trị để kiểm tra
      exit;
    }
  } else {
    echo "Email không tồn tại";
    exit;
  }
}

?>



