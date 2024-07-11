// HEADER HAMBURGER MENU
var navELement = document.querySelector('.navbar');
var hamburgerElement = document.querySelector('.hamburger');
var navLinksElement = document.querySelectorAll('.nav__item');

hamburgerElement.addEventListener('click', () => {
  navELement.classList.toggle('nav--open');
  hamburgerElement.classList.toggle('hamburger--open');
});

navLinksElement.forEach((link) => {
  link.addEventListener('click', () => {
    navELement.classList.remove('nav--open');
    hamburgerElement.classList.remove('hamburger--open');
  });
  // JavaScript for dropdown animation
  document.addEventListener('DOMContentLoaded', function () {
    const profile = document.querySelector('.profile');
    const dropdown = document.querySelector('.profile__dropdown');
    const profileli = document.querySelector('.profile-li');
    const settingsli = document.querySelector('.settings-li');
    const logoutli = document.querySelector('.logout-li');

    // profileli.addEventListener('click', function () {
    //   window.location.replace("/User/profile.php");
    // });
    // settingsli.addEventListener('click', function () {
    //   window.location.replace("/User/setting.php");
    // });
    // logoutli.addEventListener('click', function () {
    //   window.location.replace("/Admin/Author/logout.php");
    // });

    profile.addEventListener('mouseenter', function () {
      dropdown.style.display = 'block';
    });

    profile.addEventListener('mouseleave', function () {
      dropdown.style.display = 'none';
    });
  });

});
