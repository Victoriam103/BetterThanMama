const menuBtn = document.querySelector('.menu-btn');
const menuContainer = document.querySelector('.menu-container');

let menuOpen = false;

menuBtn.addEventListener('click', () => {
  if (!menuOpen) {
    menuBtn.classList.add('open');
    menuContainer.style.opacity = '1';
    menuContainer.style.visibility = 'visible';
    menuOpen = true;
  } else {
    menuBtn.classList.remove('open');
    menuContainer.style.opacity = '0';
    menuContainer.style.visibility = 'hidden';
    menuOpen = false;
  }
  const menuLinks = document.querySelectorAll('.menu-container ul li a');

});
const cerrarMenuBtn = document.querySelector('#cerrar-menu');

cerrarMenuBtn.addEventListener('click', () => {
  menuBtn.classList.remove('open');
  menuContainer.style.opacity = '0';
  menuContainer.style.visibility = 'hidden';
  menuOpen = false;
});