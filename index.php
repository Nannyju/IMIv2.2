<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello, world!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  </head>

  <body>

    <div class="container">
      <div class="row">

        <div class="col-6">
          <canvas id = "myChart" width="400" height="200"></canvas>
        </div>

        <div class="col-6">
          <canvas id = "myChart2" width="400" height="200"></canvas>
        </div>

      </div>


      <div class="row">
        <div class="col-3">
          <div class="row">
            <div class="col-4"><b>Temperature</b></div>
            <div class="col-8">
              <span id="lastTemperature"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-4"><b>Humidity</b></div>
            <div class="col-8">
              <span id="lastHumidity"></span>
            </div>
          </div>

          <div class="row">
            <div class="col-4"><b>Update</b></div>
            <div class="col-8">
              <span id="lastUpdate"></span>
            </div>
          </div>
        </div>
      </div>
    </div>


    

    
   

  </body>


    <script>

function showLine(chartid,data){
        var ctx = document.getElementById(chartid).getContext('2d');
        var mychart = new Chart(ctx, {
          type: 'line',
          data: {
            
              labels: data.xlabel,
              datasets: [
                {
                  label: data.label,
                  data: data.data
                }
              ]
          }

        });
      }










      function showChart(data){
        var ctx = document.getElementById('myChart').getContext('2d');

        var xlabel = [1,2,3,4,5,6,7,8,9,10];
        var data1 = [2,3,4,5,10];
        var data2 = [2,4,5,6,10];

        var mychart = new Chart(ctx, {
          type: 'line',
          data: {
            
              labels: xlabel,
              datasets: [
                {
                  label: "1st line",
                  data: data1
                },

                {
                  label: "2nd line",
                  data: data2
                }
              ]
          }

        });
      }


    
       $(()=>{
           //alert("Hello");
          let url = "https://api.thingspeak.com/channels/1479261/feeds.json?results=1";
           $.getJSON(url)
           .done(function(data){
            console.log(data);
             //console.log(data.channel.name);

             let feeds = data.feeds;
             console.log(feeds);


             $("#lastTemperature").text(feeds[0].field2 + "c");
             $("#lastHumidity").text(feeds[0].field1 + "%");
             $("#lastUpdate").text(feeds[0].created_at);



             //showChart(data);

             var data = new Object();
             data.label = "1st line";
             data.xlabel = [1,2,3,4,5,6,7,8,9,10];
             data.data = [3,8,2,4,1];
             showLine("myChart",data);



             var data2 = new Object();
             data2.label = "2nd line";
             data2.xlabel = [11,12,13,14,15];
             data2.data = [30,18,20,14,10];
             showLine("myChart2",data2);


           })
           
           .fail(function(error){
             console.log(error);

           });


       });

       

    </script>
</html>