<!DOCTYPE html>
<html>
  <head>
    <title><%= title %></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="javascripts/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="highchart/highcharts.js"></script>





  </head>
  <body>





  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">

        <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>


  <div class="container">

    <div id="graph_1"></div>
    <div id="graph_2"></div>




  </div>






  </body>
</html>

<script>

  $.ajaxSetup ({  
        cache: false  
    });  





  $(function () {



  //  alert(mydata[0].temp);






    $(document).ready(function () {
      Highcharts.setOptions({
        global: {
          useUTC: false
        }
      });

      $('#graph_1').highcharts({
        chart: {
          type: 'area',
          marginRight: 10,
          events: {
            load: function () {

              // set up the updating of the chart each second

              var series = this.series[0];







              setInterval(function () {


                $.getJSON('test.json', function (data) {

                  var y =  parseFloat(data.temp);
                  var x = (new Date()).getTime(); // current time

                  series.addPoint([x, y], true, true);

                },3000);







              }, 3000);
            }
          }
        },
        title: {
          text: 'Node 1'
        },
        xAxis: {
          type: 'datetime',
          tickPixelInterval: 150
        },
        yAxis: {
          title: {
            text: 'Temperture(°C)'
          }
        },

        plotOptions: {
          area: {
            fillColor: {
              linearGradient: {
                x1: 0,
                y1: 0,
                x2: 0,
                y2: 1
              },
              stops: [
                [0, Highcharts.getOptions().colors[0]],
                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
              ]
            },
            marker: {
              radius: 0
            },
            lineWidth: 1,
            states: {
              hover: {
                lineWidth: 1
              }
            },
            threshold: null
          }
        },



        tooltip: {
          formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                    Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                    Highcharts.numberFormat(this.y, 2);
          }
        },
        legend: {
          enabled: false
        },
        exporting: {
          enabled: false
        },
        series: [{
          name: 'Temperture',
          data: (function () {
            // generate an array of random data
            var data = [],
                    time = (new Date()).getTime(),
                    i;

            for (i = -300; i <= 0; i += 3) {
              data.push({
                x: time + i * 1000,
                y: 27+Math.random()*0.5
              });
            }
            return data;
          }())
        }]
      });
    });
  });



  $(document).ready(function () {
    Highcharts.setOptions({
      global: {
        useUTC: false
      }
    });

    $('#graph_2').highcharts({
      chart: {
        type: 'area',
        marginRight: 10,
        events: {
          load: function () {

            // set up the updating of the chart each second

            var series = this.series[0];







            setInterval(function () {


              $.getJSON('test.json', function (data) {
                var y =  parseFloat(data.hum);
                var x = (new Date()).getTime(); // current time

                series.addPoint([x, y], true, true);

              });







            }, 3000);
          }
        }
      },
      title: {
        text: ' '
      },
      xAxis: {
        type: 'datetime',
        tickPixelInterval: 150
      },
      yAxis: {
        title: {
          text: 'Hum'
        }
      },

      plotOptions: {
        area: {
          fillColor: {
            linearGradient: {
              x1: 0,
              y1: 0,
              x2: 0,
              y2: 1
            },
            stops: [
              [0, Highcharts.getOptions().colors[0]],
              [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
            ]
          },
          marker: {
            radius: 0
          },
          lineWidth: 1,
          states: {
            hover: {
              lineWidth: 1
            }
          },
          threshold: null
        }
      },



      tooltip: {
        formatter: function () {
          return '<b>' + this.series.name + '</b><br/>' +
                  Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                  Highcharts.numberFormat(this.y, 2);
        }
      },
      legend: {
        enabled: false
      },
      exporting: {
        enabled: false
      },
      series: [{
        name: 'Humidity(%)',
        data: (function () {
          // generate an array of random data
          var data = [],
                  time = (new Date()).getTime(),
                  i;

          for (i = -300; i <= 0; i += 3) {
            data.push({
              x: time + i * 1000,
              y: 60+Math.random()
            });
          }
          return data;
        }())
      }]
    });
  });


</script>