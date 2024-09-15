// Orders Chart
var ctx = document.getElementById('ordersChart').getContext('2d');
var ordersChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        datasets: [{
            label: 'Orders',
            data: [30, 45, 60, 40, 70, 55, 90],
            backgroundColor: 'rgba(255, 99, 71, 0.2)',
            borderColor: 'rgba(255, 99, 71, 1)',
            borderWidth: 2,
            fill: true,
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Inventory Chart
var ctx2 = document.getElementById('inventoryChart').getContext('2d');
var inventoryChart = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['Vegetables', 'Meat', 'Dairy', 'Drinks', 'Spices', 'Desserts'],
        datasets: [{
            label: 'Inventory Level',
            data: [20, 50, 30, 40, 15, 25],
            backgroundColor: [
                'rgba(255, 159, 64, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(231, 233, 237, 0.2)'
            ],
            borderColor: [
                'rgba(255, 159, 64, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(231, 233, 237, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
