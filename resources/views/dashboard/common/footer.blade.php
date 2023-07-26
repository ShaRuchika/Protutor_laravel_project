<!-- Footer -->
<footer class="site-footer">
 <div class="container-fluid">
  <div class="row">
    <?php $Footerdata =  DB::select('SELECT desc2, email, contact, desc1 FROM `footer` where id=1;'); ?>
     <div class="col-xl-4">
        <p>+{{$Footerdata[0]->contact}} <span><a style="color: black;" href="mailto:{{$Footerdata[0]->email}}">{{$Footerdata[0]->email}}</a></span></p>
      </div>
    <div class="col-xl-4">
      <p class="text-center">{{$Footerdata[0]->desc1}}</p>
    </div>
    <div class="col-xl-4">
      <p class="text-end">{{$Footerdata[0]->desc2}}</p>
    </div>
  </div>
</div>
</footer>
<!-- Footer -->

</div>  
  


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/tilt.js@1.2.1/dest/tilt.jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="{{url('/')}}/public/assets/dashboard_assets/js/custom.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">


 $(".notific-bell").click(function(){
  $(".notific-bar").toggleClass("main");
});

 function sendMarkRequest(id = null) {
   return $.ajax("{{ route('markNotification_user') }}", {
     method: 'POST',
     data: {
       _token: '{{ csrf_token() }}',
       id
     },
     success : function(result){

      $("#notific_count").html(result);
      //console.log(result);
    }
  });
 }

 $(function() {
   $('.mark-as-read').click(function() {

    //alert($(this).data('id'));
    let request = sendMarkRequest($(this).data('id'));
    //console.log(request);
    request.done(() => {
     $(this).parents('div.inner').remove();
    });

  });

   $('#mark-all').click(function() {
     let request = sendMarkRequest('all');
     request.done(() => {
       $('div.inner').remove();
     })
   });

 });

    // chart-2 Bar chart
 var ctx2 = document.getElementById('myChart2').getContext('2d');
 var gradient = ctx2.createLinearGradient(0, 0, 0, 400);
 gradient.addColorStop(0, 'rgba(251, 133, 0, 1)');   
 gradient.addColorStop(1, 'rgba(255, 183, 3, 1)');
 var myChart2 = new Chart(ctx2, {
  type: 'bar',
  fillOpacity: 1,
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [
    {
      label: "",
      backgroundColor: gradient,
      borderColor: "none",
      pointBorderColor: "#CFEECE",
      borderWidth:0,
      pointRadius: 4,
      pointHoverRadius: 4,
      pointBackgroundColor: "#FFF",
      data: [500, 1000, 500, 1000, 500, 1000, 500, 1000, 500, 1000, 500, 1000]
    }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    bezierCurve: false,
    elements: {
      line: {
        tension: 0
      }
    },
    scales: {
      xAxes: [{
        gridLines: {color: "rgba(0, 0, 0, 0)"},
        categoryPercentage: 3 / 10
      }],
      yAxes: [{
        ticks: {beginAtZero: true},
        gridLines: {color: "rgba(0, 148, 68, 0.2)"}
      }]
    },

    tooltips: {
      custom: function(tooltip) {
        if (!tooltip) return;
            // disable displaying the color box;
        tooltip.displayColors = false;
      },
      callbacks: {
            // use label callback to return the desired label
        label: function(tooltipItem, data) {
          return "$" + tooltipItem.yLabel;
        },
            // remove title
        title: function(tooltipItem, data) {
          return;
        }
      },
      backgroundColor: "#FFF",
      borderColor: "rgba(0, 0, 0, 0.09)",
      borderWidth: 1,
      bodyFontColor:"rgba(0, 0, 0, 1)",
      bodyAlign: 'center',
      bodyFontSize: 14,
      bodyFontStyle: 500
    },
    legend: {
      align:'end',
      labels:{
        boxWidth: 12,
        fontColor: "#A4A7B0"
      }
    }
  }
});
// chart-2 Bar chart
</script>
</body>
</html>
