<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .highcharts-figure,
.highcharts-data-table table {
  min-width: 320px;
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

input[type="number"] {
  min-width: 50px;
}
</style>
<body>

<div id="plot">

</div>



<script src="src/highcharts.js"></script>
<script src="src/highcharts-3d.js"></script>
<script src="src/exporting.js"></script>
<script src="src/export-data.js"></script>
<script src="src/accessibility.js"></script>

<script type="text/javascript">
     var k = 1;
      var flag = 0;
           
     function DrawChart(t,file)
     {
            //creating html element to bind the created chart 
            var figure = document.createElement('figure');
            figure.className = 'highcharts-figure';
            var div = document.createElement('div');
            div.setAttribute("id", "container" + k++);
            var plot = div.id;
            figure.appendChild(div);
            var ele = document.getElementById('plot');
            ele.appendChild(figure);

  fetch(file)
  .then(response => response.text())
  .then(text => {
       var ans = text.search(";")
       console.log(ans);
      var semi,data,tool,data_a,tooltip;
      if(ans!=-1)
      {
          flag = 1;
          semi = text.split("\n").map((semi) => {return semi.split(";")});
          data = semi.map((semi) => {return [semi[0]]});
          tool = semi.map((semi)=>{return [semi[1]]});
          data_a = data.map((data)=>{return data[0].split(":")});
          tooltip = tool.map((tool)=>{return tool[0].split(",")});
      }
      else
      {
        flag = 0;
         data_a = text.split("\n").map(function (data_a) {
                return data_a.split(":");
            });
      }
      const arr = data_a.map((data_a) => ({name : String(data_a[0]), y : Number(data_a[1])}));
      if(flag==1)
      {
        for(var i = 0;i<arr.length;i++)
          {
              arr[i].tool = String(tooltip[i]);
          }
      }
      
      if(flag==1)
      {
        Highcharts.chart(plot, {
          chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            options3d: {
              enabled: true,
              alpha: 45,
              beta: 0
            }
          },
          title: {
            text: t
          },
          tooltip: {
            formatter() {
                var tt = this.point.tool.split(/,|:/);
                var tooltip = "";
                for(var i = 0;i<tt.length;i=i+2)
                {
                    tooltip = tooltip + "<b>"+tt[i]+" : </b>" + tt[i+1] + '<br>';
                }
                return tooltip;
            } 
          },
          accessibility: {
            point: {
              valueSuffix: ''
            }
          },
          plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              depth : 35,
              dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y:.0f} '
              }
            }
          },
          series: [{
            name: '',
            colorByPoint: true,
            data: arr
          }],
          point : {
            name : ''
          }

        });
      }

      else
      {
        Highcharts.chart(plot, {
          chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            options3d: {
              enabled: true,
              alpha: 45,
              beta: 0
            }
          },
          title: {
            text: t
          },
          tooltip: {
            formatter() {
              return "<b>"+this.point.name+"</b> : "+ this.y;
            } 
          },
          accessibility: {
            point: {
              valueSuffix: ''
            }
          },
          plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              depth : 35,
              dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y:.0f} '
              }
            }
          },
          series: [{
            name: '',
            colorByPoint: true,
            data: arr
          }],
          point : {
            name : ''
          }

        });
      }
        
  })
     }

</script> 
</body>
</html> 

