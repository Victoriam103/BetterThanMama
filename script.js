const menuBtn = document.querySelector('.menu-btn');
const menuContainer = document.querySelector('.menu-container');

menuBtn.addEventListener('click', function() {
  menuContainer.classList.toggle('active');
});

document.addEventListener("click", (event) => {
  const isClickInsideMenu = menuContainer.contains(event.target);
  const isClickInsideMenuBtn = menuBtn.contains(event.target);
  const isMenuOpen = menuContainer.classList.contains("active");

  if (!isClickInsideMenu && !isClickInsideMenuBtn && isMenuOpen) {
    menuContainer.classList.remove("active");
  }
});

