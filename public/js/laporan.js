"use strict";



var ctx = document.getElementById("myChart2").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: _ydata,
    datasets: [{
      label: _label,
      data: _xdata,
      borderWidth: 2,
      backgroundColor: '#6777ef',
      borderColor: '#6777ef',
      borderWidth: 2.5,
      pointBackgroundColor: '#ffffff',
      pointRadius: 4
    }]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
        }
      }]
    },
  }
});

var ctx = document.getElementById("myChart3").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: _ymonthsFinished,
    datasets: [{
      label: _labelFinished,
      data: _xmonthCountFinished,
      borderWidth: 2,
      backgroundColor: '#6777ef',
      borderColor: '#6777ef',
      borderWidth: 2.5,
      pointBackgroundColor: '#ffffff',
      pointRadius: 4
    }]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
        }
      }]
    },
  }
});

// var ctx = document.getElementById("myChart3").getContext('2d');
// var myChart = new Chart(ctx, {
//   type: 'doughnut',
//   data: {
//     datasets: [{
//       data: [
//         80,
//         50,
//         40,
//         30,
//         20,
//       ],
//       backgroundColor: [
//         '#191d21',
//         '#63ed7a',
//         '#ffa426',
//         '#fc544b',
//         '#6777ef',
//       ],
//       label: 'Dataset 1'
//     }],
//     labels: [
//       'Black',
//       'Green',
//       'Yellow',
//       'Red',
//       'Blue'
//     ],
//   },
//   options: {
//     responsive: true,
//     legend: {
//       position: 'bottom',
//     },
//   }
// });

// var ctx = document.getElementById("myChart4").getContext('2d');
// var myChart = new Chart(ctx, {
//   type: 'pie',
//   data: {
//     datasets: [{
//       data: [
//         80,
//         50,
//         40,
//         30,
//         100,
//       ],
//       backgroundColor: [
//         '#191d21',
//         '#63ed7a',
//         '#ffa426',
//         '#fc544b',
//         '#6777ef',
//       ],
//       label: 'Dataset 1'
//     }],
//     labels: [
//       'Black',
//       'Green',
//       'Yellow',
//       'Red',
//       'Blue'
//     ],
//   },
//   options: {
//     responsive: true,
//     legend: {
//       position: 'bottom',
//     },
//   }
// });