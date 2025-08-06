
  const toggle = document.getElementById('menu-toggle');
  const navLinks = document.querySelector('.nav-links');

  toggle.addEventListener('click', () => {
    navLinks.classList.toggle('show');
  });

const leftBtn = document.querySelector(".carrossel-btn.left");
const rightBtn = document.querySelector(".carrossel-btn.right");
const carrossel = document.getElementById("carrosselCards");

leftBtn.addEventListener("click", () => {
  carrossel.scrollBy({
    left: -300,
    behavior: "smooth"
  });
});

rightBtn.addEventListener("click", () => {
  carrossel.scrollBy({
    left: 300,
    behavior: "smooth"
  });
});