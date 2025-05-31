import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//scroll de navbar

  document.addEventListener('DOMContentLoaded', function () {
  const navbar = document.querySelector('nav');
  if (!navbar) return;

  const urlPath = window.location.pathname;
  const isLoginOrRegister = /\/(login|register)$/.test(urlPath);

  if (isLoginOrRegister) {
    navbar.classList.add('navbar-scrolled');
    return; // detener aquí: no aplicar el comportamiento por scroll
  }

  // Scroll dinámico solo para otras páginas
  window.addEventListener('scroll', function () {
    if (window.scrollY > 100) {
      navbar.classList.add('navbar-scrolled');
    } else {
      navbar.classList.remove('navbar-scrolled');
    }
  });
});

