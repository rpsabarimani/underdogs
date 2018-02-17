<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Underdogs</title>
    <style>
        * {
            margin:0;
            padding:0;
        }
        body
        {
            background-image: url("grass.jpg");
            background-repeat: no-repeat;
            background-position: fixed;
            background-size:cover;
            color: white;
            font-family: courier;
            font-size: 125%;
        }
    </style>
  </head>
  <body>
    <div class="container-fluid">
            
            <div class="text-center">
                <img src="underdogs_logo.jpeg" class="rounded" alt="Logo" width="150" height="150" style="margin:10px">
            </div>    
            <div class="row" id="matchList">
            <div class="col col-sm-4">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Match Date,Day & Time</div>
                <div class="card-body">
                    <h6 class="card-title">Venue Name</h6>
                    <h5 class="card-title">Match Format</h5>
                <div class="card-title">Cost</div>
                <p class="card-text" style="font-size:75%">Slots Available: </p>
                </div>
                <div class="card-header" style="margin:0 auto"><button type="button" class="btn btn-secondary" style="margin:0 auto,width:150px">Book Slot</button></div>
            </div>
        </div>
        <div class="col col-sm-4">
            <div class="card text-white bg-dark mb-3 col">
                <div class="card-header">17 Feb,Saturday 7:30AM</div>
                <div class="card-body">
                    <h6 class="card-title">@: Veloct</h6>
                    <h5 class="card-title">T20</h5>
                <div class="card-title">&#8377; 500</div>
                <p class="card-text" style="font-size:75%">Slots Available: 10/24</p>
                </div>
                <div class="card-header" style="margin:0 auto"><button type="button" class="btn btn-secondary" style="margin:0 auto;width:150px">Book Slot</button></div>
            </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS --><script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
	$(document).ready(function(){
            $(document).on("click",".matchBtn",function(){
                var mid = $(this).data("id");
                window.location.assign("registration.php?id="+mid);
            });
		loadMatchDetails();
	});
		function loadMatchDetails() {
			$.ajax({
				url:"apis/Match/getMatches",
				type:"POST",
				dataType:"json",
				success:function(data){
					var errCode = data.error.errCode;
					var html = '';
					if(errCode == 0) {
						
						$.each(data.results, function(i, vl){
							
							html += '<div class="col col-sm-4">';
								html += '<div class="card text-white bg-dark mb-3 col">';
									html += '<div class="card-header">' + vl.matchDt + ' ' + vl.matchTm + '</div>';
									html += '<div class="card-body">';
										html += '<h6 class="card-title">@: ' + vl.venueNm + '</h6>';
										html += '<h5 class="card-title">' + vl.matchFormat + '</h5>';
									html += '<div class="card-title">&#8377; ' + vl.cost + '</div>';
									html += '<p class="card-text" style="font-size:75%">Slots Available: ' + vl.slotsAvail + '/' + vl.slotsAlotted + '</p>';
									html += '</div>';
									html += '<div class="card-header matchBtn" data-id="' + vl.mid + '" style="margin:0 auto"><button type="button" class="btn btn-secondary" style="margin:0 auto;width:150px">Book Slot</button></div>';
								html += '</div>';
							html += '</div>';
						});
						$("#matchList").html(html);
					}
				}
			});
		}
	</script>
  </body>
</html>