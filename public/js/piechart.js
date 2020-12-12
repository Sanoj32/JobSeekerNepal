$(document).ready(function() {
    renderChart($("#chart-line"));
 })

 function renderChart(ctx) {
     var lang = new Chart(ctx, {
         type: chartType,
         data: {
             labels: languageNames,
             datasets: [{
                 data: languageCounts,
                 backgroundColor: [ "rgba(100, 255, 0, 0.5)", "rgba(200, 50, 255, 0.5)", "rgba(0, 100, 255, 0.5)", "rgba(255, 0, 0, 0.5)", "rgba(66, 7, 7, 0.5)", "rgba(66, 245, 218,0.5)"]
                }]
         },
        //  "rgba(255, 0, 0, 0.5)",
         options: {
            maintainAspectRatio: false,
             title: {
                 display: false,
                 text: 'Programming language'
             },
         scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend:{
                 display: index
             }
         },
     });
 };

 var ctx = document.getElementById('chart-line2');
 var program = new Chart(ctx, {
    type: chartType,
     data: {
         labels: frameworkNames,
         datasets: [{
             data: frameworkCounts,
             backgroundColor: [ "rgba(100, 255, 0, 0.5)", "rgba(200, 50, 255, 0.5)", "rgba(0, 100, 255, 0.5)", "rgba(255, 0, 0, 0.5)", "rgba(66, 7, 7, 0.5)","rgba(252, 240, 5, 0.5)","rgba(66, 245, 218,0.5)","rgba(0, 0, 0,0.5)"]
         }]
     },
     options: {
        maintainAspectRatio: false,
         title: {
             display: false,
             text: 'Framework/library'
         },
         scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend:{
            display: index
        }
     }
 });

 var ctx = document.getElementById('chart-line3');
 var database = new Chart(ctx, {
    type: chartType,
     data: {
         labels: databaseNames,
         datasets: [{
             data: databaseCounts,
             backgroundColor: [ "rgba(100, 255, 0, 0.5)", "rgba(200, 50, 255, 0.5)", "rgba(0, 100, 255, 0.5)", "rgba(255, 0, 0, 0.5)", "rgba(66, 7, 7, 0.5)"]         }]
     },
     options: {
        maintainAspectRatio: false,
         title: {
             display: false,
             text: 'language'
         },
         scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend:{
            display: index
        }
     }
 });

 var ctx = document.getElementById('chart-line4');
var dying = new Chart(ctx, {
    type: chartType,
    data: {
        labels: websiteNames ,
        datasets: [{
            data: websiteCounts,
            backgroundColor: [ "rgba(100, 255, 0, 0.5)" ,"rgba(255, 0, 0, 0.5)", "rgba(200, 50, 255, 0.5)", "rgba(0, 100, 255, 0.5)","rgba(66, 7, 7, 0.5)","rgba(252, 240, 5, 0.5)" ]
        }]
    },
    options: {
        maintainAspectRatio: false,
        title: {
            display: false,
            text: 'language'
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend:{
            display: index
        }
    }
});
// what