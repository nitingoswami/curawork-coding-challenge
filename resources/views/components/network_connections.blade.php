
<div class="row justify-content-center mt-5">
  <div class="col-12">
    <div class="card shadow  text-white bg-dark network-connection">
      <div class="card-header">Coding Challenge - Network connections</div>
      <div class="card-body">
        <div class="btn-group w-100 mb-3" role="group" aria-label="Basic radio toggle button group">
          <!-- <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked> -->
          <label class="btn btn-outline-primary " for="btnradio1" id="get_suggestions_btn"  ><a data-tab="suggestion" data-href="{{url('suggestions')}}" style="color:white;text-decoration:none;" class="datatabs">Suggestions ({{$suggestionData}})</a></label>

          <!-- <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"> -->
          <label class="btn btn-outline-primary" for="btnradio2" id="get_sent_requests_btn"><a data-tab="sendrequest" data-href="{{url('sent')}}" style="color:white;text-decoration:none;" class="datatabs">Sent Requests ({{$sentData}})</a></label>

          <!-- <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off"> -->
          <label class="btn btn-outline-primary" for="btnradio3" id="get_received_requests_btn"><a data-tab="receivedrequest" data-href="{{url('received')}}" style="color:white;text-decoration:none;" class="datatabs">Received
            Requests({{$requestsData}})</a></label>

          <!-- <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off"> -->
          <label class="btn btn-outline-primary" for="btnradio4" id="get_connections_btn"><a data-tab="connections" data-href="{{url('connection')}}" style="color:white;text-decoration:none;" class="datatabs">Connections ({{$connectionData}})</a></label>
        </div>
        <hr>
        <div id="content" class="none">
         
        </div>

        <!-- {{-- Remove this when you start working, just to show you the different components --}} -->
        {{-- Remove this when you start working, just to show you the different components --}}

        <div id="skeleton" class="d-none">
          @for ($i = 0; $i < 10; $i++)
            <x-skeleton />
          @endfor
        </div>
        <!-- <span class="fw-bold">"Load more"-Button</span> -->
        <div class="d-flex justify-content-center mt-2 py-3 {{-- d-none --}}" id="load_more_btn_parent">
          <button class="btn btn-primary" onclick="infinteLoadMore()" id="load_more_btn">Load more</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    
<script type="text/javascript">
  var currentTab  =  'suggestion';
  var currURL = '';

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  function handleTabClickActive (args) {
    console.log(args)
    $("#"+args[0]).addClass("active");
    $("#"+args[1]).removeClass("active");
    $("#"+args[2]).removeClass("active");
    $("#"+args[3]).removeClass("active");
  }
   
  $(".datatabs").click(function(e)
  {
    e.preventDefault();
      var pageURL = $(this).attr("data-href");
      currURL   = pageURL;
      currentTab  =  $(this).attr("data-tab");
      // alert(currentTab);
      if(currentTab == 'suggestion'){
        handleTabClickActive([
          'get_suggestions_btn', 
          'get_sent_requests_btn', 
          'get_received_requests_btn',
          'get_connections_btn'])
      }

      else if(currentTab == 'sendrequest'){
        handleTabClickActive([
          'get_sent_requests_btn', 
          'get_suggestions_btn', 
          'get_received_requests_btn',
          'get_connections_btn'])
      }

      else if(currentTab == 'receivedrequest'){
        handleTabClickActive([
          'get_received_requests_btn',
          'get_suggestions_btn', 
          'get_sent_requests_btn', 
          'get_connections_btn'])
      }
      
      else if(currentTab == 'connections'){
        handleTabClickActive([
          'get_connections_btn',
          'get_suggestions_btn', 
          'get_sent_requests_btn', 
          'get_received_requests_btn',
        ])
      }

      $.ajax({
        url: pageURL,
        method: 'get',
        data: {
            
        },
        success: function(result){
          console.log(result);
          $('#content').show();
          $('#content').html(result.html);
        }});
  });
  
  var Suggpage = 1;
  var sentpage = 1;
  var reqpage =  1;
  var connpage = 1;

  function infinteLoadMore(page) 
  {
      
      if(currentTab == 'suggestion'){
      Suggpage++;
      var  url = currURL+ "?page=" + Suggpage;
      
      }else if(currentTab == 'sendrequest'){
      sentpage++;
      var  url = currURL+ "?page=" + sentpage;
      }
      else if(currentTab == 'receivedrequest'){
      reqpage++;
      var  url = currURL+ "?page=" + reqpage;
      }
      else if(currentTab == 'connections'){
      connpage++;
      var  url = currURL+ "?page=" + connpage;
      }
      
      //  alert(currentTab);
        $.ajax({
                url: url,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    //$('.auto-load').show();
                }
            })
            .done(function (response) {
                if (response.length == 0) {
                  //  alert("We don't have more data to display :(");
                    return;
                }
                
                $("#content").append(response.html);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
          }
  // function to connect
  function connect(id){
      $.ajax({
            url: '/connect/'+id,
            datatype: "html",
            type: "get",
            
            beforeSend: function () {
                //$('.auto-load').show();
            }
          })
          .done(function (response) {
                                  
              $("#sugg-"+id).remove();
          })
          .fail(function (jqXHR, ajaxOptions, thrownError) {
              console.log('Server error occured');
          });
  }

  // function to withdraw
  function withdraw(id){
    $.ajax({
            url: '/withdraw/'+id,
            datatype: "html",
            type: "get",
            
            beforeSend: function () {
                //$('.auto-load').show();
            }
        })
        .done(function (response) {
                                
            $("#req-"+id).remove();
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });

  }

  // function to accept
  function accept(id){
    $.ajax({
          url: '/accept/'+id,
          datatype: "html",
          type: "get",
          
          beforeSend: function () {
              //$('.auto-load').show();
          }
      })
      .done(function (response) {
                            
          $("#req-"+id).remove();
      })
      .fail(function (jqXHR, ajaxOptions, thrownError) {
          console.log('Server error occured');
      });
  }

  // function to remove
  function remove(id){
    $.ajax({
          url: '/remove/'+id,
          datatype: "html",
          type: "get",
          
          beforeSend: function () {
              //$('.auto-load').show();
          }
        })
        .done(function (response) {
                              
            $("#con-"+id).remove();
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });
  }

   // function to common connection
   function common(id){
    $.ajax({
          url: '/common/'+id,
          datatype: "html",
          type: "get",
          
          beforeSend: function () {
              //$('.auto-load').show();
          }
        })
        .done(function (response) {
                              
            $("#con-"+id).common();
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });
  }
</script>
