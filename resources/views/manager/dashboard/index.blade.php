@extends('layouts.manager')
@section('container')
    <main class="content">
      <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Dashboard</h1>
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="card flex-fill w-100">
              <div class="card-header">
                <h5 class="card-title">Ticket Diagram in {{ date('F') }}</h5>
              </div>
              <div class="card-body">
                @if ($label)
                <div class="chart">
                  <canvas id="chartjs-line"></canvas>
                </div>
                @else
                <div class="text-center">
                  <i class="align-middle mb-2" data-feather="alert-circle"></i>
                  <h5>Data is still empty</h5>
                </div>
                @endif 
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <div class="card flex-fill w-100">
              <div class="card-header">
                <h5 class="card-title">Ticket Status Diagram</h5>
              </div>
              <div class="card-body">
                @if ($label2)
                <div class="chart">
                  <canvas id="chartjs-dashboard-pie"></canvas>
                </div>
                @else
                <div class="text-center">
                  <i class="align-middle mb-2" data-feather="alert-circle"></i>
                  <h5>Data is still empty</h5>
                </div>
                @endif 
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script>
      var label =  {{ Js::from($label) }};
      var total =  {{ Js::from($total) }};

      document.addEventListener("DOMContentLoaded", function() {
        // Line chart
        new Chart(document.getElementById("chartjs-line"), {
          type: "line",
          data: {
            labels: label,
            datasets: [{
              label: "Total",
              fill: true,
              backgroundColor: "transparent",
              borderColor: window.theme.primary,
              data: total
            }]
          },
          options: {
            maintainAspectRatio: false,
            legend: {
              display: false
            },
            tooltips: {
              intersect: false
            },
            hover: {
              intersect: true
            },
            plugins: {
              filler: {
                propagate: false
              }
            },
            scales: {
              xAxes: [{
                reverse: true,
                gridLines: {
                  color: "rgba(0,0,0,0.05)"
                }
              }],
              yAxes: [{
                ticks: {
                  stepSize: 500
                },
                display: true,
                borderDash: [5, 5],
                gridLines: {
                  color: "rgba(0,0,0,0)",
                  fontColor: "#fff"
                }
              }]
            }
          }
        });
      });
    </script>
    <script>
      var label2 =  {{ Js::from($label2) }};
      var total2 =  {{ Js::from($total2) }};

      document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
          type: "pie",
          data: {
            labels: label2,
            datasets: [{
              data: total2,
              backgroundColor: [
                window.theme.secondary,
                window.theme.primary,
                window.theme.warning,
                window.theme.danger,
                window.theme.info,
                window.theme.success,
              ],
              borderWidth: 5
            }]
          },
          options: {
            responsive: !window.MSInputMethodContext,
            maintainAspectRatio: false,
            legend: {
              display: true,
              position: 'right'
            },
            cutoutPercentage: 60
          }
        });
      });
    </script>
@endsection