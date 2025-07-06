document.addEventListener('DOMContentLoaded', function () {
    // Chart.js
    const ctx = document.getElementById('visitsChart').getContext('2d');

    // Weekly data
    const weeklyData = {
        labels: ['Pon', 'Uto', 'Sri', 'Čet', 'Pet', 'Sub', 'Ned'],
        datasets: [{
            label: 'Broj pregleda',
            data: [120, 190, 150, 200, 170, 250, 300],
            fill: true,
            borderColor: '#4361ee',
            backgroundColor: 'rgba(67, 97, 238, 0.1)',
            tension: 0.3,
            pointRadius: 5,
            pointBackgroundColor: '#4361ee',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointHoverRadius: 7,
            pointHoverBackgroundColor: '#4361ee',
            pointHoverBorderColor: '#fff',
            pointHoverBorderWidth: 2
        }]
    };

    // Monthly data
    const monthlyData = {
        labels: ['1', '5', '10', '15', '20', '25', '30'],
        datasets: [{
            label: 'Broj pregleda',
            data: [500, 800, 1200, 1000, 1500, 1800, 2000],
            fill: true,
            borderColor: '#4361ee',
            backgroundColor: 'rgba(67, 97, 238, 0.1)',
            tension: 0.3,
            pointRadius: 5,
            pointBackgroundColor: '#4361ee',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointHoverRadius: 7,
            pointHoverBackgroundColor: '#4361ee',
            pointHoverBorderColor: '#fff',
            pointHoverBorderWidth: 2
        }]
    };

    // Chart configuration
    const chartConfig = {
        type: 'line',
        data: weeklyData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        stepSize: 50,
                        font: {
                            size: 12
                        },
                        color: '#6c757d'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        },
                        color: '#6c757d'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    padding: 10,
                    titleFont: {
                        size: 14
                    },
                    bodyFont: {
                        size: 14
                    },
                    displayColors: false,
                    callbacks: {
                        label: function (context) {
                            return `Pregledi: ${context.raw}`;
                        }
                    }
                }
            },
            interaction: {
                mode: 'index',
                intersect: false
            },
            elements: {
                line: {
                    borderWidth: 3
                }
            }
        }
    };

    // Create chart
    const visitsChart = new Chart(ctx, chartConfig);

    // Period toggle buttons
    const periodButtons = document.querySelectorAll('[data-period]');
    periodButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Remove active class from all buttons
            periodButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            // Update chart data based on period
            const period = this.getAttribute('data-period');
            if (period === 'week') {
                visitsChart.data = weeklyData;
            } else if (period === 'month') {
                visitsChart.data = monthlyData;
            }

            visitsChart.update();
        });
    });
});
