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

            <div class="alert alert-dark" role="alert" style="text-align:center">
                <p><u>Match Details:</u></p>
                <pre>Date           : <br>Time           : <br>Venue          : <br>Venue Address  : <br>Cost           : <br>Slots Remaining: <br></pre>
            </div>

            <div class="row">
            <div class="col col-sm-8" style="padding-bottom:30px">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="contact">Mobile:</label>
                        <input type="number" class="form-control" id="mobile">
                    </div>
                    <div class="form-group">
                        <label for="whatsapp">Whatsapp (If Different):</label>
                        <input type="number" class="form-control" id="whatsappNo">
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
            <div class="col col-sm-3" style="margin-top:20px">
            <div class="alert alert-dark" role="alert">
                <p><u>Registered Players:</u></p>
                <table id="playerList">
                    <tr>
                        <td>Ron</td>
                        <td>Bowler Allrounder</td>
                    <tr>
                </table>
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
        var mid = "<?=$_GET['id'];?>";
        
	$(document).ready(function(){
            $(document).on("click","#register",function(){
                var name = $("#name").val();
                var mobile = $("#mobile").val();
                var speciality = $("input[name=speciality]:checked").val();
                var whatsappNo = $("#whatsappNo").val();
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
                                        alert(errMsg);
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
						
						$.each(data.results, function(i, vl){
							
							html += '<p><u>Match Details:</u></p>';
                                                                '<pre>Date                                       : <br>Time           : <br>Venue          : <br>Venue Address  : <br>Cost           : <br>Slots Remaining: <br></pre>';
						});
						$("#matchList").html(html);
					}
				}
			});
		}
                
                
	</script>
  </body>
</html>