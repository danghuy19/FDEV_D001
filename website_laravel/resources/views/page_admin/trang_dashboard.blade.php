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
      
      <select name="" id="chon_nam">
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
        <option value="2019">2019</option>
      </select>

      <figure class="highcharts-figure">
        <div id="test_chart"></div>
        <p class="highcharts-description">
          Basic line chart showing trends in a dataset. This chart includes the
          <code>series-label</code> module, which adds a label to each line for
          enhanced readability.
        </p>
      </figure>

      <script>
        var data_chart  = [];

        var options = {
            chart: {
                renderTo: 'test_chart',
                type: 'spline'
            },
            series: [{}]
        };
        
        // var url =  "http://url-to-your-remote-server/jsonp.php?callback=?";
        // $.getJSON(url,  function(data) {
        //     options.series[0].data = data;
        //     var chart = new Highcharts.Chart(options);
        // });

        $.get('/analytics-doanh-thu/2016')
          .then((result) => {
            //console.log(data);
            data_chart = result.data
            data_chart = JSON.parse(data_chart);
            //console.log()

            options.series = [
              {
                  name: 'Doanh thu',
                  data: data_chart
              }
            ];
            var chart = new Highcharts.Chart(options);
          })
          // .catch((err) => {
          //   console.log(err);
          // })

        $('#chon_nam').change((event) => {
          //console.log(event.target.value);
          $.get('/analytics-doanh-thu/' + event.target.value)
          .then((result) => {
            //console.log(data);
            data_chart = result.data
            data_chart = JSON.parse(data_chart);
            //console.log()

            options.series = [
              {
                  name: 'Doanh thu',
                  data: data_chart
              }
            ];
            var chart = new Highcharts.Chart(options);
          })
        })

        

        
      </script>
    </section>
</section>
<!--main content end-->
@endsection