// resources/js/dashboardChart.js

// Import Chart.js dari node_modules
import Chart from 'chart.js/auto';

// Fungsi untuk menggambar grafik
function drawDashboardChart(labels, data) {
    const ctx = document.getElementById('usageChart');

    if (ctx) {
        new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Pemesanan',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Pemesanan'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    }
                }
            }
        });
    } else {
        console.error('Elemen canvas dengan ID "usageChart" tidak ditemukan.');
    }
}

// Ekspor fungsi ini agar bisa dipanggil dari tempat lain
window.drawDashboardChart = drawDashboardChart;

