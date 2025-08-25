import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Mobile sidebar toggle
document.addEventListener('click', (e) => {
  const openBtn  = e.target.closest('[data-open-sidebar]');
  const closeBtn = e.target.closest('[data-close-sidebar]');
  const aside = document.querySelector('#mobileSidebar');
  if (openBtn && aside) aside.showModal?.();
  if (closeBtn && aside) aside.close?.();
});

// Chart.js (optional if you prefer CDN in the view)
import Chart from 'chart.js/auto';
window.Chart = Chart;
// Default Chart.js look (dark)
Chart.defaults.color = 'rgb(226 232 240)'; // slate-200
Chart.defaults.borderColor = `rgb(${getComputedStyle(document.documentElement).getPropertyValue('--chart-grid')})`;
