@extends('templates.template_admin')

@section('main-content')
    <!--main content start-->
<section id="main-content">
    <section class="wrapper">
      {{-- <style>
        .highcharts-figure,
        .highcharts-data-table table {
          min-width: 360px;
          max-width: 800px;
          margin: 1em auto;
        }

        .highcharts-data-table table {
          font-family: Verdana, sans-serif;
          border-collapse: collapse;
          border: 1px solid #ebebeb;
          margin: 10px auto;
          text-align: center;
          width: 100%;
          max-width: 500px;
        }

        .highcharts-data-table caption {
          padding: 1em 0;
          font-size: 1.2em;
          color: #555;
        }

        .highcharts-data-table th {
          font-weight: 600;
          padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
          padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
          background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
          background: #f1f7ff;
        }
      </style> --}}

      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/series-label.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>
      <script src="https://code.highcharts.com/modules/export-data.js"></script>
      <script src="https://code.highcharts.com/modules/accessibility.js"></script>
      
      <figure class="highcharts-figure">
        <div id="test_chart"></div>
        <p class="highcharts-description">
          Basic line chart showing trends in a dataset. This chart includes the
          <code>series-label</code> module, which adds a label to each line for
          enhanced readability.
        </p>
      </figure>

      <script>
        Highcharts.chart('test_chart', {

        title: {
          text: 'Doanh thu 2022'
        },

        subtitle: {
          text: 'Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>'
        },

        yAxis: {
          title: {
            text: 'Number of Employees'
          }
        },

        xAxis: {
          accessibility: {
            rangeDescription: 'Range: 2010 to 2020'
          }
        },

        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle'
        },

        plotOptions: {
          series: {
            label: {
              connectorAllowed: false
            },
            pointStart: 1
          }
        },

        series: [{
          name: 'Installation & Developers',
          data: {{$chuoi_data}}
        }],

        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }

        });
      </script>
    </section>
</section>
<!--main content end-->
@endsection