<?php
require "header.php";
?>

<link rel='stylesheet' type='text/css' media='screen' href='../css/contact.css'>
    <body>
    <section id="section-wrapper" style="margin-top: 80px; background-color: white; top: 0;">
        <div class="box-wrapper" style="background: black;">
            <div class="info-wrap" style="background: #272829;">
                <h2 class="info-title">Thông tin liên hệ</h2>
                <h3 class="info-sub-title">Điền vào thông tin và vấn đề của bạn, chúng tôi sẽ trả lời bạn trong vòng 24h.</h3>
                <ul class="info-details">
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span>Số điện thoại:</span> <a>́*********</a>
                    </li>
                    <li>
                        <i class="fas fa-paper-plane"></i>
                        <span>Email:</span> <a>info@hana.com</a>
                    </li>
                    <li>
                        <i class="fas fa-globe"></i>
                        <span>Website:</span> <a href="#">hana.com</a>
                    </li>
                </ul>
                <ul class="social-icons">
                    <li><a href="#"><i class="bx bxl-facebook"></i></a></li>
                    <li><a href="#"><i class="bx bxl-twitter"></i></a></li>
                    <li><i class="bx bxl-instagram-alt"></i></a></li>
                </ul>
            </div>

            <div class="form-wrap" >
                <form action="#" method="POST">
                    <h2 class="form-title">Gửi tin nhắn cho chúng tôi</h2>
                    <div class="form-fields">
                        <div class="form-group">
                            <input type="text" class="fname" placeholder="Họ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="lname" placeholder="Tên">
                        </div>
                        <div class="form-group">
                            <input type="email" class="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="number" class="phone" placeholder="Số điện thoại">
                        </div>
                        <div class="form-group">
                            <textarea name="message" id="" placeholder="Vấn đề của bạn"></textarea>
                        </div>
                    </div>
                    <input type="submit" value="Gửi ngay" class="submit-button">
                </form>
            </div>
        </div>
    </section>
    <body>

    <!-- FOOTER -->
    <?php require_once 'footer.php';
        ?>

