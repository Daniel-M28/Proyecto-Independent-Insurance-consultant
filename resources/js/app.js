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
     //mapa inicio
      const coords = [39.889185, -86.043100]; // Coordenadas de la dirección
      const map = L.map('map').setView(coords, 15);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);

      L.marker(coords).addTo(map)
        .bindPopup('7399 N. Shadeland Avenue<br>#230, Indianapolis, IN 46250')
        .openPopup();
});


//Menu hamburguesa
  const toggleBtn = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  toggleBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });


  //Mapa pagina de inicio
  

  //boton lenguajes

  
// resources/js/app.js

document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".btn-lang");

    // Inicializamos Google Translate con inglés por defecto
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en', // idioma por defecto
            autoDisplay: false
        }, 'google_translate_element');
    }
    window.googleTranslateElementInit = googleTranslateElementInit;

    // Función para cambiar idioma dinámicamente
    function changeLanguage(lang) {
        const select = document.querySelector(".goog-te-combo");
        if (select) {
            select.value = lang;
            select.dispatchEvent(new Event("change"));
        }
    }

    // Listener de botones de banderas
    buttons.forEach(button => {
        button.addEventListener("click", () => {
            const lang = button.getAttribute("data-lang");
            changeLanguage(lang);
            localStorage.setItem("lang", lang); // guardamos preferencia
        });
    });

    // Al cargar, aplicamos idioma guardado o inglés por defecto
    const savedLang = localStorage.getItem("lang") || "en";
    changeLanguage(savedLang);
});