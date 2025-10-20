// resources/js/app.js

import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Scroll dinámico navbar
document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.querySelector('nav');
    if (!navbar) return;

    const urlPath = window.location.pathname;
    const isLoginOrRegister = /\/(login|register)$/.test(urlPath);

    if (isLoginOrRegister) {
        navbar.classList.add('navbar-scrolled');
        return;
    }

    window.addEventListener('scroll', function () {
        if (window.scrollY > 100) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });

    // Mapa página de inicio
    const coords = [39.889185, -86.043100];
    const map = L.map('map').setView(coords, 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    L.marker(coords).addTo(map)
        .bindPopup('7399 N. Shadeland Avenue<br>#230, Indianapolis, IN 46250')
        .openPopup();
});

// Menu hamburguesa
const toggleBtn = document.getElementById('menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');
if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
}

// Botones de idiomas (Google Translate)
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".btn-lang");

    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            autoDisplay: false
        }, 'google_translate_element');
    }
    window.googleTranslateElementInit = googleTranslateElementInit;

    function changeLanguage(lang) {
        const select = document.querySelector(".goog-te-combo");
        if (select) {
            select.value = lang;
            select.dispatchEvent(new Event("change"));
        }
    }

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            const lang = button.getAttribute("data-lang");
            changeLanguage(lang);
            localStorage.setItem("lang", lang);
        });
    });

    const savedLang = localStorage.getItem("lang") || "en";
    changeLanguage(savedLang);
});
