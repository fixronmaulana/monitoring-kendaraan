// resources/js/app.js

import './bootstrap'; // Ini biasanya sudah ada

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Import file JavaScript untuk grafik dashboard
import './dashboardChart'; // <-- Tambahkan baris ini

