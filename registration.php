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
        
        
         <div class="col col-sm-9" id="md">
            <div class="table-responsive">    
                <table class="table table-sm table-hover table-dark">
                    <thead id="matchList">
                        <tr>
                            <th scope="row">Date</th>
                        </tr>
                        <tr>
                            <th scope="row">Time</th>
                        </tr>
                        <tr>
                            <th scope="row">Venue</th>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                        </tr>
                        <tr>
                            <th scope="row">Cost</th>
                        </tr>
                        <tr>
                            <th scope="row">Slots Remaining</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        
            <div class="row">
         <div class="col col-sm-12" id="errMsg">  

			<div class="alert alert-success" role="alert">
				Registration Successful! Confirm your slot by paying Rs. <span id="errCost"></span> via PayTm/Tez to Abhi @ 9972083064. <a href="index.php">Click Here</a> to book another slot
			</div>
		</div>    
            <div class="col col-sm-8" style="padding-bottom:30px" id="regForm">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="contact">Mobile:</label>
                        <input type="tel" class="form-control" id="mobile">
                    </div>
                    <div class="form-group">
                        <label for="whatsapp">Whatsapp (If Different):</label>
                        <input type="tel" class="form-control" id="whatsappNo">
                    </div>
                    <label for="speciality">Speciality:</label>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="speciality" id="batsman" value="1">
                        <label class="form-check-label" for="batsman">Batsman</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="speciality" id="bowler" value="2">
                        <label class="form-check-label" for="bowler">Bowler</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="speciality" id="wicketkeeper_batsman" value="3">
                        <label class="form-check-label" for="wicketkeeper_batsman">Wicketkeeper Batsman</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="speciality" id="batsman_allrounder" value="4">
                        <label class="form-check-label" for="batsman_allrounder">Batsman Allrounder</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="speciality" id="bowler_allrounder" value="5">
                        <label class="form-check-label" for="bowler_allrounder">Bowler Allrounder</label>
                    </div>
                    <br>
                    <button class="btn btn-secondary btn-lg btn-block" id="register">Register</button>
            </div>
                <div class="col col-sm-3" style="margin-top:20px" id="usrList">
                    <div class="table-responsive">    
                        <table class="table table-sm table-hover table-dark">
                            <thead>
                                <tr>
                                    <th scope="row">Player</th>
                                    <th scope="row">Speciality</th>
                                </tr>
                            </thead>
                            <tbody id="playerList">
                            </tbody>
                        </table>
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
        var mid = "<?=$_GET['id'];?>";
        
	$(document).ready(function(){
		
			$("#errMsg").hide();
            $(document).on("click","#register",function(){
                var name = $("#name").val();
                var mobile = $("#mobile").val();
                var speciality = $("input[name=speciality]:checked").val();
                var whatsappNo = $("#whatsappNo").val();
				
				if(name == "") {
					alert("Enter Your Name!");
					$("#name").focus();
					return false;
				}
				else if(mobile == "") {
					alert("Enter Your Mobile Number!");
					$("#mobile").focus();
					return false;
				}
				else if(mobile.length != 10 || isNaN(mobile)) {
					alert("Enter Valid Mobile Number!");
					$("#mobile").focus();
					return false;
				}
				else if(!speciality) {
					alert("Select Your Speciality!");
					return false;
				}
				
                var data = {name:name,mobile:mobile,speciality:speciality,whatsappNo:whatsappNo,matchId:mid};
			$.ajax({
                            url:"apis/User/register",
                            data:data,
                            type:"POST",
                            dataType:"json",
                            success:function(data){
                                    var errCode = data.error.errCode;
                                    var errMsg = data.error.errMsg;
                                    var html = '';
                                    if(errCode == 0) {
                                        $("#errMsg").show();
                                      
										$("#regForm,#md,#usrList").hide();
                                        loadMatchDetails(mid);
                                        $("input[type=text],input[type=tel]").val("");
                                    } else {
                                        alert(errMsg);
                                    }
                                }
                            });
            });
		loadMatchDetails(mid);
	});
		function loadMatchDetails(mid) {
			$.ajax({
				url:"apis/Match/getMatches",
                                data:{id:mid},
				type:"POST",
				dataType:"json",
				success:function(data){
					var errCode = data.error.errCode;
					if(errCode == 0) {
						
					var html = '';
						$.each(data.results[0].usr, function(i, vl){
                                                    console.log(vl);
                                                    html += '<tr><td>' + vl.uname + '</td><td>' + vl.speciality + '</td><tr>';
                                                });
						$("#playerList").html(html);
						
                                                html = '';
						$.each(data.results, function(i, vl){
							$("#errCost").text(vl.cost);
							html += '<tr><th scope="row">Date</th><th scope="row">' + vl.matchDt + '</th></tr>';
                                                        html += '<tr><th scope="row">Time</th><th scope="row">' + vl.matchTm + '</th></tr>';
                                                        html += '<tr><th scope="row">Venue</th><th scope="row">' + vl.venueNm + '</th></tr>';
                                                        html += '<tr><th scope="row">Address</th><th scope="row">' + (vl.address1 ? vl.address1 + ', ' : '')  + (vl.address2 ? vl.address2 + ', ' : '') + (vl.city ? vl.city + ', ' : '') + vl.state + '</th></tr>';
                                                        html += '<tr><th scope="row">Cost</th><th scope="row">' + vl.cost + '</th></tr>';
                                                        html += '<tr><th scope="row">Slots Remaining</th><th scope="row">' + vl.slotsAvail + '/' + vl.slotsAlotted + '</th></tr>';
						});
						$("#matchList").html(html);
					}
				}
			});
		}
                
                
	</script>
  </body>
</html>