$(document).ready(function() {
    var ctx = $("#chart-line");
    var myLineChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Spring", "Summer", "Fall", "Winter"],
            datasets: [{
                data: [1200, 1700, 800, 200],
                backgroundColor: ["rgba(255, 0, 0, 0.5)", "rgba(100, 255, 0, 0.5)", "rgba(200, 50, 255, 0.5)", "rgba(0, 100, 255, 0.5)"]
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Weather'
            }
        }
    });
});