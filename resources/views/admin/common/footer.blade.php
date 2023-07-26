<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/tilt.js@1.2.1/dest/tilt.jquery.min.js"></script>
<script src="{{url('/')}}/public/assets/js/custom.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $( document ).ready(function() {
    $('.status_change').change(function() {
     var status = $(this).prop('checked') == true ? 1 : 0;
     var id = $(this).attr('data');

     var url = <?php url('admin/change-user-status') ?>
     $.ajax({
      headers: {
        'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
      },
      url : "{{ url('admin/change-user-status') }}",
      data : {'status': status, 'id': id},
      type : 'GET',
      dataType : 'json',
      success : function(result){
        console.log(result);
        location.reload(); 
      }
    });

   });
    $(".notific.cust-cls").click(function(){
      $(".login-head-right").toggleClass("main");
    });
  });

  function sendMarkRequest(id = null) {
   return $.ajax("{{ route('markNotification') }}", {
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
    let request = sendMarkRequest($(this).data('id'));
    //console.log(request);
    alert($(this).data('id'));
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
 

</script>
<script>
  const xValues = ['01-2023', '02-2023', '03-2023', '04-2023', '05-2023'];
  new Chart("myChart", {
    type: "line",
    data: {
      labels: xValues,
      datasets: [{ 
        data: [400,100,200,50,150],
        borderColor: "#FB9A99",
        fill: false
      }, { 
        data: [200,300,250,100,50],
        borderColor: "#A6CEE3",
        fill: false
      }, { 
        data: [20,50,200,100,350],
        borderColor: "#B2DF8A",
        fill: false
      },{ 
        data: [100,250,200,30,80],
        borderColor: "#1F78B4",
        fill: false
      },{ 
        data: [50,80,70,30,80],
        borderColor: "#FFB703",
        fill: false
      }]
    },
    options: {
      legend: {display: false},
      scales: {
        xAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0.03)",
          }
        }],
        yAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0.03)",
          }   
        }]
      }
    }
  });


  const xValues2 = ['01-2023', '02-2023', '03-2023', '04-2023', '05-2023'];
  new Chart("myChart2", {
    type: "line",
    data: {
      labels: xValues2,
      datasets: [{ 
        data: [400,100,200,50,150],
        borderColor: "#FB9A99",
        fill: false
      }, { 
        data: [200,300,250,100,50],
        borderColor: "#A6CEE3",
        fill: false
      }, { 
        data: [20,50,200,100,350],
        borderColor: "#B2DF8A",
        fill: false
      },{ 
        data: [100,250,200,30,80],
        borderColor: "#1F78B4",
        fill: false
      },{ 
        data: [50,80,70,30,80],
        borderColor: "#FFB703",
        fill: false
      }]
    },
    options: {
      legend: {display: false},
      scales: {
        xAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0.03)",
          }
        }],
        yAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0.03)",
          }   
        }]
      }
    }
  });


  const xValues3 = ['01-2023', '02-2023', '03-2023', '04-2023', '05-2023'];
  new Chart("myChart3", {
    type: "line",
    data: {
      labels: xValues3,
      datasets: [{ 
        data: [400,100,200,50,150],
        borderColor: "#FB9A99",
        fill: false
      }, { 
        data: [200,300,250,100,50],
        borderColor: "#A6CEE3",
        fill: false
      }, { 
        data: [20,50,200,100,350],
        borderColor: "#B2DF8A",
        fill: false
      },{ 
        data: [100,250,200,30,80],
        borderColor: "#1F78B4",
        fill: false
      },{ 
        data: [50,80,70,30,80],
        borderColor: "#FFB703",
        fill: false
      }]
    },
    options: {
      legend: {display: false},
      scales: {
        xAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0.03)",
          }
        }],
        yAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0.03)",
          }   
        }]
      }
    }
  });

  new Chart("myChart4", {
    type: "pie",
    data: {
      labels: [
        '15-30',
        '31-46',
        '47-62',
        '62 and above'
        ],
      datasets: [{
        label: 'My First Dataset',
        data: [300, 50, 100, 200],
        backgroundColor: [
          '#FF692C',
          '#7C2B0A',
          '#993F1A',
          '#FF9858'
          ],
      }],
    },
    options:{
      legend: {
        align:'center',
        position: 'right',
      },
      hoverOffset: 4,
    }
  });

  new Chart("myChart5", {
    type: "pie",
    data: {
      labels: [
        'Male',
        'Female'
        ],
      datasets: [{
        label: 'My First Dataset',
        data: [300, 200],
        backgroundColor: [
          '#FF692C',
          '#993F1A'
          ],
      }],
    },
    options:{
      legend: {
        align:'center',
        position: 'right',
      },
      hoverOffset: 4,
    }
  });
</script>
</body>
</html>
