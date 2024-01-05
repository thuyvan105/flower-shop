let menu = document.querySelector ('#menu-icons');
let navbar = document.querySelector ('.navbar');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('active');
};

window.onscroll = () => {
    menu.classList.remove('bx-x');
    navbar.classList.remove('active');

}


$(".cardd").click(function () {
    $(".cardd").removeClass("active");
    $(this).addClass("active");
  });