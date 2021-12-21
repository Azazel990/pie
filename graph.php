<?php
date_default_timezone_set("Asia/Kolkata");
?>
    <?php 
     $data=array();            
     $file = fopen("04-10-2021.csv","r");
     $m=0;
     while(! feof($file))
       {
         $data[$m]=fgetcsv($file);
         $m++;
       }   
     ?>

     <?php 
         if(count($data)>0) { 
            ?>
        <div class="chart2">
            <div id="chart2Container" style="height: 370px; width: 100%;"></div>
        </div>
        <?php  
         }
         else { echo "No temperature data found for $currentdate"; }
     ?>   

         <?php 
         if(count($data)>0) {  ?>
        <div class="chart3">
            <div id="chart3Container" style="height: 370px; width: 100%;"></div>
        </div>
        <?php  
         }
         else { echo "No humidity data found for $currentdate"; }
         ?>
          
<script src="canvasjs.min.js"></script> 
<script>
  window.onload = function(){    
      var chart2 = new CanvasJS.Chart("chart2Container", {
        animationEnabled: true,
        zoomEnabled: true,
        exportEnabled: true,
        theme: "dark",
        backgroundColor: "transparent",
        axisX:{
          title: "Time",
        },
        axisY:{
          includeZero: false,
          title: "Temperature (°C)"
        },
        data: [{
          type: "line",
          dataPoints: [
        <?php
            $size=sizeof($data);
            for($i=0;$i<$size-1;$i++){

              echo "{ y :".$data[$i][2].", label: '".date("H:i",strtotime($data[$i][1]))."'},";
            }
            echo "{ y :".$data[$size-1][2].", label: '".date("H:i",strtotime($data[$size-1][1]))."'}";
            ?>
          ]
        }]
        });
        chart2.render();
        
        var chart3 = new CanvasJS.Chart("chart3Container", {
        animationEnabled: true,
        zoomEnabled: true,
        exportEnabled: true,
        theme: "dark",
        backgroundColor: "transparent",
        axisX:{
          title: "Time",
        },
        axisY:{
          includeZero: false,
          title: "Humidity (%)"
        },
        data: [{
          type: "line",
          dataPoints: [
        <?php
            $size=sizeof($data);
            for($i=0;$i<$size-1;$i++){

              echo "{ y :".$data[$i][3].", label: '".date("H:i",strtotime($data[$i][1]))."'},";
            }
            echo "{ y :".$data[$size-1][3].", label: '".date("H:i",strtotime($data[$size-1][1]))."'}";
            ?>
          ]
        }]
        });
        chart3.render();

  };
  </script>   