<?php

?>
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

<figure class="highcharts-figure">
  <div id="container"></div>
</figure>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript" src="data.json">
 
</script>

<script type="text/javascript">



var input = 
  [
    {
    "Salary": 470,
    "Year": "2011"
  }, 
  {
    "Salary": 440,
    "Year": "2012"
  }, 
  {
    "Salary": 485,
    "Year": "2013"
  }, 
  {
    "Salary": 479,
    "Year": "2014"
  }, 
  {
    "Salary": 482,
    "Year": "2015"
  }, 
  {
    "Salary": 463,
    "Year": "2016"
  }
];
console.log(input);
  const data = input.map((o) => ({name: Number(o.Year), y: Number(o.Salary)}))
  console.log(data);
  Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Sample Piechart from php database'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: '',
    colorByPoint: true,
    data: data
  }]
});
</script>