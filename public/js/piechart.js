$(document).ready(function() {
    renderChart($("#chart-line"));
 })
 
 function renderChart(ctx) {
     var lang = new Chart(ctx, {
         type: 'pie',
         data: {
             labels: ["Spring", "Summer", "Fall", ],
             datasets: [{
                 data: [10, 1700, 800, 200],
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
 };

 var ctx = document.getElementById('chart-line2');
 var program = new Chart(ctx, {
    type: 'doughnut',
     data: {
         labels: ["Sad", "Swt", "istic", "surprise"],
         datasets: [{
             data: [100, 900, 300, 80],
             backgroundColor: ["rgba(255, 20, 0, 0.5)", "rgba(100, 255, 90, 0.5)", "rgba(200, 50, 255, 0.5)", "rgba(0, 100, 255, 0.5)"]
         }]
     },
     options: {
         title: {
             display: true,
             text: 'language'
         }
     }
 });

 var ctx = document.getElementById('chart-line3');
 var database = new Chart(ctx, {
    type: 'doughnut',
     data: {
         labels: ["ad", "weet", "sad", "surpplies"],
         datasets: [{
             data: [1, 900, 300, 1200],
             backgroundColor: ["rgba(255, 0, 0, 0.5)", "rgba(100, 255, 0, 0.5)", "rgba(200, 50, 255, 0.5)", "rgba(0, 100, 255, 0.5)"]
         }]
     },
     options: {
         title: {
             display: true,
             text: 'language'
         }
     }
 });

 var ctx = document.getElementById('chart-line4');
var dying = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Sad", "Sweet", "sadistic", "surprise"],
        datasets: [{
            data: [100, 900, 300, 1200],
            backgroundColor: ["rgba(255, 0, 0, 0.5)", "rgba(100, 255, 0, 0.5)", "rgba(200, 50, 255, 0.5)", "rgba(0, 100, 255, 0.5)"]
        }]
    },
    options: {
        title: {
            display: true,
            text: 'language'
        }
    }
});