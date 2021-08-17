<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Diana Glass Processing</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="High Quality Glass and Mirror Product" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <!-- <link rel="shortcut icon" href="../favicon.ico"> -->
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
       <!-- <link rel="stylesheet" type="text/css" href="css/style.css" /> -->
       <link rel="stylesheet" type="text/css" href="css/stylelogin.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
		
		<!-- <script src="js/jquery.mobile-1.1.0.min.js"></script> -->
		 
		<script src="js/jquery-1.8.0.min.js"></script>
		<!-- <script src="js/allvar.js"></script> -->
		<!-- <script type="text/javascript" src="js/portfolio/klass.min.js"></script>
		<script type="text/javascript" src="js/portfolio/code.photoswipe.jquery-3.0.4.min.js"></script> -->
		
<script type="text/javascript" charset="utf-8">
//var host="https://libraryrobertcom.000webhostapp.com";
var host="http://localhost/gudangceling";
//var host="http://www.dianaglassprocess.com";
//window.localStorage.removeItem("statuslogin");


if("statuslogin" in localStorage){
    window.location="admintransaksi.php";

}else if ("statusinventory" in localStorage){
    window.location="admintransaksi.php";
	
}else if ("statussales" in localStorage){
    window.location="admintransaksi.php";
	
}else if ("statussupervisor" in localStorage){
    window.location="admintransaksi.php";
	
}

	
$(document).ready(function() {
		
		//Login Function
		 $("#signin").click(function() {
				
			var a = document.getElementById('usernamelogin').value;
			var b = document.getElementById("passwordlogin").value;
			//alert(a);alert(b);
			dt={user:a,pass:b};
			$.ajax({
				type: "POST",
				url: host+'/php/login.php',
				data: dt,
				dataType: 'json',
				success:function (data, status) {
					
					jsonResult = data;
					userlogin=jsonResult[0];

					if(userlogin.username && userlogin.password) {
						if(userlogin.statususer=='manager') {
							window.localStorage.setItem("statuslogin",userlogin.username);
							var x = "Welcome, Manager "+userlogin.username;
							alert(x);
							window.location="admintransaksi.php";
						} else if (userlogin.statususer=='inventory') {
							window.localStorage.setItem("statusinventory",userlogin.username);
							var x = "Welcome, "+userlogin.username;
							alert(x);
							window.location="admintransaksi.php";
						} else if (userlogin.statususer=='sales') {
							window.localStorage.setItem("statussales",userlogin.username);
							var x = "Welcome, "+userlogin.username;
							alert(x);
							window.location="adminstok.php";
						} else if (userlogin.statususer=='supervisor') {
							window.localStorage.setItem("statussupervisor",userlogin.username);
							var x = "Welcome, "+userlogin.username;
							alert(x);
							window.location="adminstok.php";
						} else if (userlogin.statususer=='inventory_office') {
							window.localStorage.setItem("statusinventoryoffice",userlogin.username);
							var x = "Welcome, "+userlogin.username;
							alert(x);
							window.location="admintransaksi.php";
						}
						
					}else {
					    alert("Username atau Password anda Salah");
					} 
				},
				error: function(){
					alert("Username atau Password anda Salah");
					//document.getElementById("jml").innerHTML = "Sisa Stok: 0 pcs";
				}
			});
		}); 
});
			
</script>
    </head>
    <body>
        <div class="container">
            
            <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            
                                <h1>Diana Glass</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your username </label>
                                    <input id="usernamelogin" name="username" required="required" type="text" placeholder="eg. myusername"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="passwordlogin" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                               
                                <p class="signin button"> 
                  
									 <input type="button" value="Login" id="signin"/> 
								</p> 
                                <p class="change_link">
									<b>Please Login!!</b>
								</p>
                            
                        </div>
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>