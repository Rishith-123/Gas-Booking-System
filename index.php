<?php
session_start();
if(isset($_SESSION['cid']))
	header("Location:consumer/");
else if(isset($_SESSION['did']))
	header("Location:distributor/");
else if(isset($_SESSION['aid']))
	header("Location:admin/");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gas Booking Portal</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
	<link rel="icon" href="fev.png" type="image/png" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

	<style>

		.carousel-cell {
			width: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
			padding:10px;
			height:400px;
		}
		.carousel-cell:before {
			display: block;
		}
		#cpyrt{
			padding-left: 30px;
			margin-top: -50px;
			color: black;
			font-size: 22px;
			font-weight: bold;
		}
		#details{
			padding-right: 30px;
			color: black;
			font-size: 22px;
			font-weight: bold;
			text-align:right;
		}
		#spam{
			background-color: black;
			height: 0.3vh;
			width: 70vw;
			position: absolute;
			left: 0;
			margin-left: 15vw;
			
		}
		

	</style>
</head>

<body>
    <nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header"><a href="index.php" style="font-weight:bold;color:#75CAEB" class="navbar-brand navbar-link"><i class="glyphicon glyphicon-fire text-info"></i>Online Gas Booking</a>
            <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav navbar-right">
                <li role="presentation" class="active"><a href="index.php" style="font-weight:bold"><i class="fa fa-home"></i> Home </a></li>
                <li role="presentation"><a href="#" data-toggle="modal" style="font-weight:bold" data-target="#signModal"><i class="glyphicon glyphicon-pencil"></i> Sign Up</a></li>
				<li role="presentation"><a href="#" data-toggle="modal" style="font-weight:bold" data-target="#loginModal"><i class="glyphicon glyphicon-user"></i> Log-In</a></li>
            </ul>
        </div>
    </div>
</nav>
    <div class="jumbotron hero">
        <div class="modal fade" role="dialog" tabindex="-1" id="signModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Sign Up</h4></div>
            <div class="modal-body">
            
			<ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#con">New Consumer</a></li>
    <li><a data-toggle="pill" href="#dis">New Distributor</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="con" class="tab-pane fade in active">
	
		<br>
      <p class='text-success'>Only valid Consumers to register on the site. Please ensure you give a correct mobile no. that mapped with your Customer ID.</p>
	  
	  
	  <form class="bootstrap-form-with-validation" onSubmit="return sub();" method="post">

        <div class="form-group">
            <label class="control-label" for="text-input">Consumer ID</label>
            <input class="form-control" type="number" name="conid" id="conid" min=1 max=999999 required />
        </div>
		<div class="form-group">
            <label class="control-label" for="text-input" >Mobile<small> (Without Country Code & Only 10 Digits.)</small></label>
            <input class="form-control" type="text" name="cmno" id="cmno" pattern="[1-9]{1}[0-9]{9}" title="At least Ten Digits" maxlength=10 required />         
		</div>
		
        <div class="form-group">
            <label class="control-label" for="password-input" >Password Input</label><small> (Must contain at least 6 or more characters)</small>
            <input class="form-control" type="password" name="pass" id="password" pattern=".{6,}" title="Six or more characters" required maxlength=16/>
        </div>
         <div class="form-group">
            <label class="control-label" for="password-input" >Confirm Password</label>
            <input class="form-control" type="password" name="cpass" id="cpass" required maxlength=16/>
			
			<script>
			var password = document.getElementById("password"), confirm_password = document.getElementById("cpass");
			function validatePassword(){
				if(password.value != confirm_password.value){
					confirm_password.setCustomValidity("Passwords Don't Match");
				}
				else {
					confirm_password.setCustomValidity('');
				}
			}

			password.onchange = validatePassword;
			confirm_password.onkeyup = validatePassword;
			</script>
			
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit" name="ncon_sub">Submit</button>
			<br>
			<p id='msg' class="text-danger"></p>
        </div>
    </form>
	
	
<script>
 function sub()
	{
		
	    var name = $("#conid").val(); 
	    var mno = $("#cmno").val(); 
	    var pass = $("#cpass").val(); 

		$.ajax({
					type: "POST",
					url: "ncon.php",
					data: "conid="+name+"&cmno="+mno+"&cpass="+pass,
					success: function(html)
						{
                            $('#msg').html(html);
							
							var chk=document.getElementById('msg').innerHTML;
							if(chk==='True')
							{
								alert('You have been successfully registered.');
								//location.href= "index.php";
								window.location.reload()
							}
						}
		});
		
		
	
		return false;
	}
</script>

    </div>
	
	
    <div id="dis" class="tab-pane fade">
	  <br>
      <p class='text-success'>After this process we will verify you.</p>
	  
	  
	  <form class="bootstrap-form-with-validation" method="post" id="new_con_form">
	  
        <div class="form-group">
            <label class="control-label" for="text-input">Distributor Name</label>
            <input class="form-control" type="text" name="dname" id="dname" maxlength=20 required />
        </div>
        <div class="form-group">
            <label class="control-label" for="textarea-input">Address </label>
            <textarea class="form-control" name="dadd" id="dadd" maxlength=100 required></textarea>
        </div>
		<div class="form-group">
			<label for="inputState">City</label>
			<select id="dcity" name="dcity" class="form-control" required>
				<option value='Chennai'>Chennai</option>
				<option value='Bangalore'>Bangalore</option>
				<option value='Hyderabad'>Hyderabad</option>
				<option value='Kochi'>Kochi</option>
			</select>
		</div>
		<div class="form-group">
			<label for="inputZip">Pin-Code</label>
			<input type="text" class="form-control" id="dpin" name="dpin" pattern=".{6,}" title="Six Digits" maxlength=6 required>
		</div>
		<div class="form-group">
            <label class="control-label" for="email-input">Email</label>
            <input class="form-control" type="email" name="demail" id="demail" maxlength=30 required />
        </div>
		<div class="form-group">
            <label class="control-label" for="text-input" >Mobile<small> (Without Country Code & Only 10 Digits.)</small></label>
            <input class="form-control" type="text" name="dmno" id="dmno" pattern="[1-9]{1}[0-9]{9}" title="At least Ten Digits" maxlength=10 required/>         
		</div>
		<div class="form-group">
			<label class="control-label" for="text-input" >Identification Proof<small> (Only PAN card accepted & It must be image and size sould be &lt;2MB)</small></label>
			<input class="form-control" type="file" name="id_img" required />
		</div>
        <div class="form-group">
            <label class="control-label" for="password-input" >Password Input</label><small> (Must contain at least 6 or more characters)</small>
            <input class="form-control" type="password" name="dpass" id="dpass" maxlength=16 pattern=".{6,}" title="Six or more characters" required/>
        </div>
         <div class="form-group">
            <label class="control-label" for="password-input" >Confirm Password</label>
            <input class="form-control" type="password" name="dcpass" id="dcpass" maxlength=16 required />
			
			<script>
			var password = document.getElementById("dpass"), confirm_password = document.getElementById("dcpass");

			function validatePassword(){
				if(password.value != confirm_password.value) {
					confirm_password.setCustomValidity("Passwords Don't Match");
				} else {
					confirm_password.setCustomValidity('');
				}
			}

			password.onchange = validatePassword;
			confirm_password.onkeyup = validatePassword;
			</script>
			
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit" name="ncon_sub">Submit</button>
			<br>
			<p id='dmsg' class="text-danger"></p>
        </div>
    </form>
	
	
<script>	
$(document).ready(function (e) {
	$("#new_con_form").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "ndis.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(html)
		    {
				$("#dmsg").html(html);
				var chk=document.getElementById('dmsgg').innerHTML;
				if(chk==='True')
				{
					alert('Your response has been registered, After verification we will notify you.');
					window.location.reload()
				}
		    } 	        
	   });
	}));
});
</script>
	  
</div>
	</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                <!--<button class="btn btn-primary" type="button">Save</button>-->
            </div>
        </div>
    </div>
</div>

        <div class="modal fade" role="dialog" tabindex="-1" id="loginModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Log-In</h4></div>
            <div class="modal-body">
                <p><b>Select your role</b></p>
            
			<ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#conLogin">Consumer</a></li>
    <li><a data-toggle="pill" href="#disLogin">Distributor</a></li>
	<li><a data-toggle="pill" href="#adminLogin">Admin</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="conLogin" class="tab-pane fade in active">
	  
	  
	  <form class="bootstrap-form-with-validation" onSubmit="return cl_sub();" method="post">
	  <br>
        <div class="form-group">
            <label class="control-label" for="text-input">Consumer ID</label>
            <input class="form-control" type="number" name="Lconid" id="Lconid" min=1 max=9999999999 required />
        </div>

        <div class="form-group">
            <label class="control-label" for="password-input" >Password Input</label><small> (Must contain at least 6 or more characters)</small>
            <input class="form-control" type="password" name="Lcpass" id="Lcpass" pattern=".{6,}" title="Six or more characters" required maxlength=16/>
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="c_login">Log-In</button>
			<a href="fg_pwd.php?con" target="_parent" class="btn btn-primary" onclick="window.open('fg_pwd.php?con','newwindow','width=400,height=350');return false;"> Forgot Password?</a>
			<br><br>
			<p class="text-danger" id='clmsg'></p>
        </div>
    </form>
	
	
		<script>
		 function cl_sub()
			{
				
				var conid = $("#Lconid").val(); 
				var cpass = $("#Lcpass").val(); 

				$.ajax({
							type: "POST",
							url: "c_log.php",
							data: "conid="+conid+"&cpass="+cpass,
							success: function(html)
								{
									$('#clmsg').html(html);
									
									var chk=document.getElementById('clmsg').innerHTML;
									
									if(chk==='True')
									{
										alert('You have been successfully logged in.');
										location.href= "consumer/";
										//window.location.reload()
									}
								}
				});
			
				return false;
			}
		</script>

    </div>
	
	    <div id="disLogin" class="tab-pane fade in">
	  
	  
	  <form class="bootstrap-form-with-validation" onSubmit="return dl_sub();" method="post">
	  <br>
        <div class="form-group">
            <label class="control-label" for="text-input">Distributor ID</label>
            <input class="form-control" type="number" name="Ldisid" id="Ldisid" min=1 max=99999 required />
        </div>

        <div class="form-group">
            <label class="control-label" for="password-input" >Password</label><small> (Must contain at least 6 or more characters)</small>
            <input class="form-control" type="password" name="Ldpass" id="Ldpass" pattern=".{6,}" title="Six or more characters" required maxlength=16/>
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="d_login">Log-In</button>
			<a href="fg_pwd.php?dis" target="_parent" class="btn btn-primary" onclick="window.open('fg_pwd.php?dis','newwindow','width=400,height=350');return false;"> Forgot Password?</a>
			<br><br>
			<p class="text-danger" id='dlmsg'></p>
        </div>
    </form>
	
	
		<script>
		 function dl_sub()
			{
				
				var disid = $("#Ldisid").val(); 
				var dispass = $("#Ldpass").val(); 

				$.ajax({
							type: "POST",
							url: "d_log.php",
							data: "disid="+disid+"&dispass="+dispass,
							success: function(html)
								{
									$('#dlmsg').html(html);
									
									var chk=document.getElementById('dlmsg').innerHTML;
									if(chk==='True')
									{
										alert('You have been successfully logged in.');
										location.href= "distributor/";
										//window.location.reload()
									}
								}
				});
			
				return false;
			}
		</script>

    </div>
	
	    <div id="adminLogin" class="tab-pane fade in">
	  
	  
	  <form class="bootstrap-form-with-validation" action='admin_log.php' method="post">
	  <br>
        <div class="form-group">
            <label class="control-label" for="text-input">Admin ID</label>
            <input class="form-control" type="text" name="Ladid" id="Ladid" min=1 max=9999999999 required />
        </div>

        <div class="form-group">
            <label class="control-label" for="password-input" >Password Input</label><small> (Must contain at least 6 or more characters)</small>
            <input class="form-control" type="password" name="Ladpass" id="Ladpass" pattern=".{6,}" title="Six or more characters" required maxlength=16/>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit" name="ad_login">Log-In</button>
			<br><br>
			<p class="text-danger" id='almsg'></p>
        </div>
    </form>
	
	
		<!-- <script>
		 function al_sub()
			{
				
				var aid = $("#Ladid").val(); 
				var apass = $("#Ladpass").val(); 

				$.ajax({
							type: "POST",
							url: "admin_log.php",
							data: "aid="+aid+"&apass="+apass,
							success: function(html)
								{
									$('#almsg').html(html);
									
									var chk=document.getElementById('almsg').innerHTML;
									if(chk==='True')
									{
										alert('You have been successfully logged in.');
										location.href= "admin/";
										
									}
								}
				});
			
				return false;
			}
		</script> -->

    </div>

  </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                <!--<button class="btn btn-primary" type="button">Save</button>-->
            </div>
        </div>
    </div>
		</div>

			<div class="carousel" data-flickity='{ "wrapAround": true, "autoPlay": true, "imagesLoaded":true }'>
                <div class="carousel-cell">

					<div class="carousel-inner" role="listbox">
						<div class="item active"><img style=" margin: 0 auto;" src="assets/img/3.jpg" alt="First Image"></div>
					</div>

                </div>

                <div class="carousel-cell">

					<div class="carousel-inner" role="listbox">
						<div class="item active"><img style=" margin: 0 auto;" src="assets/img/2.jpeg" alt="First Image"></div>
					</div>

                </div>

                <div class="carousel-cell">

					<div class="carousel-inner" role="listbox">
						<div class="item active"><img style=" margin: 0 auto;" src="assets/img/4.jpg" alt="First Image"></div>
					</div>

                </div>

                
            </div>

    </div>
    <section class="testimonials">
        <h2 style="font-weight:bold ; text-decoration:underline; color:orange" class="text-center">Safety Tips For LPG Home - Do’s & Don’ts</h2>
		<div class="container ">
				<div class="row" id='box'>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12" style="text-align:center">
								<u><h3 style="font-weight:bold; color:#28B62C"><span class="glyphicon glyphicon-ok text-success"></span> DO'S</h3></u>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-9">
								<h3>Use LPG in Ventilated Area</h3>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-9">
								<h3>Before connecting, check for LPG leakage</h3>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-9">
								<h3>Close the regulator knob once you finish cooking</h3>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-9">
								<h3>Always keep the cylinder vertical, upright during usage and storage</h3>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-9">
								<h3>Always install LPG pipeline above ground level</h3>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12" style="text-align:center">
								<u><h3 style="font-weight:bold;color:red"><span class="glyphicon glyphicon-remove text-danger"></span> DON'T</h3></u>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-9">
								<h3>Don’t place cylinders in closed areas.</h3>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-9">
								<h3>Do not use any flammable objects near or over the burner</h3>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-9">
								<h3>Do not switch on or off any lights or electrical equipment, smoke or use naked flames incase of leakage</h3>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-9">
								<h3>Do not roll the cylinder</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-md-9">
								<h3>Never store LPG in basement, cellar, elevated platforms</h3>
							</div>
						</div>
					</div>
				</div>
		</div>
    </section>
	<span id="spam"></span>
    <footer>
        <p id="details">
			<br>
			Email: gasbooking@gmail.com<br>
			Mobile: +91 1234567891
		</p> 
		<p id="cpyrt">&#169;All Rights Reserved</p>
		
	</footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</body>

</html>