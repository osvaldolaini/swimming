import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

//Graficos
import Chart from 'chart.js/auto';

window.Alpine = Alpine;

Alpine.plugin(focus);
window.Chart = Chart;

Alpine.start();
