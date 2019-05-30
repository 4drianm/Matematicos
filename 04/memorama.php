<!DOCTYPE html>
<html>
<head>
	<title>Memorama</title>
	<?php
		include '../conexion.php';
	?>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="fichasEstilo.css">
	<script src="../jQueryLib/jquery-1.10.2.js"></script>
	<script src="../jQueryLib//jquery-ui.js"></script>
	<script type="text/javascript">
		var numeros = new Array();
		var multi = new Array();
		var cel_ant = null;
		var cel_ant_id = null;
		var correctas = 0;
		var celd = 0;
	</script>
	<script type="text/javascript" src="m.js"></script>
	<script type="text/javascript">
        $(document).ready(function(){
         $('.overlay').fadeIn(700);
        });

        function showpopUp(){

          $('#timer').html(" ");
          $('.overlay2').css("display","block");
          $('.popup').html("<br><h2> ¡Respondiste "+correctas+" correctamente!</h2>");
          $('.popup').show("fade");
          $('.popup').css("display","block");
          setTimeout(function(){ window.location.href = window.location.href + "&score=" + correctas; }, 2000);
        }

		function startTimer(duration, display) {
        	var timer = duration, minutes, seconds;
        	setInterval(function () {
            	minutes = parseInt(timer / 60, 10),
            	seconds = parseInt(timer % 60, 10);
    
            	minutes = minutes < 10 ? "0" + minutes : minutes;
            	seconds = seconds < 10 ? "0" + seconds : seconds;
    
            	display.text(minutes + ":" + seconds);
    
            	if (--timer < 0) {
					showpopUp();
                	timer = duration;
            	}
        	}, 1000);
    	}

		function girar(celda){
    	if(cel_ant_id != null){
        	if((numeros[cel_ant_id] * multi[cel_ant_id]) == (numeros[celda]* multi[celda])){
            	if(multi[celda] != 1)
                	document.getElementById(celda).innerHTML = "<p>" + document.getElementById(celda).className + "<br>X<br>" + multi[celda] + "</p>";
            	else
                	document.getElementById(celda).innerHTML = "<p>" + document.getElementById(celda).className + "</p>";
            	setTimeout(function(){
                    if(multi[celda] != 1)
                        document.getElementById(celda).innerHTML = 'Muy bien!' + "<br><p>" + document.getElementById(celda).className + "<br>X<br>" + multi[celda] + "</p>"; 
                    else
                        document.getElementById(celda).innerHTML = 'Muy bien!' + "<br><p>" + document.getElementById(celda).className + "</p>";
                	
                    if(multi[cel_ant_id] != 1)
                        document.getElementById(cel_ant_id).innerHTML = 'Muy bien!' + "<br><p>" + document.getElementById(cel_ant_id).className + "<br>X<br>" + multi[cel_ant_id] + "</p>"; 
                    else
                        document.getElementById(cel_ant_id).innerHTML = 'Muy bien!' + "<br><p>" + document.getElementById(cel_ant_id).className + "</p>";
                	cel_ant_id = null;
                	cel_ant = null;
                	correctas++;
            	},500);
            	if(correctas >= 7){
					showpopUp();
            	}
        	}else{
            	if(multi[celda] != 1)
                	document.getElementById(celda).innerHTML = "<p>" + document.getElementById(celda).className + "<br>X<br>" + multi[celda] + "</p>";
            	else
                	document.getElementById(celda).innerHTML = "<p>" + document.getElementById(celda).className + "</p>";
            	setTimeout(function(){
                	document.getElementById(cel_ant_id).innerHTML = '<a href="javascript:girar('+cel_ant_id+');"><img src="img/reverso.png" width="125px" height="200px"></a>';
                	document.getElementById(celda).innerHTML = '<a href="javascript:girar('+celda+');"><img src="img/reverso.png" width="125px" height="200px"></a>';
                	cel_ant_id = null;
                	cel_ant = null;
            	}, 1500); 
        	}
    	}else{
        	cel_ant = document.getElementById(celda).className;
        	cel_ant_id = celda;
        	if(multi[celda] != 1){
        	    document.getElementById(celda).innerHTML = "<br><p>" + cel_ant +"<br>X<br>"+multi[celda] + "</p>";
        	}else{
        	    document.getElementById(celda).innerHTML = "<br><p>" + cel_ant + "</p>";
        	}
    	}
	}
	</script>
</head>
<body>
		<div id="over" class="overlay" style="display: none;"> 
        	<h2 style="color: #21b2a6"> Instrucciones </h2>
        	<p> En este memorama tendras que encontrar la respuesta de la operacion mostrada, </br> por ejemplo: 3*10 y la respuesta seria 30</p>
        	<br>
        	<button style="opacity: 1;" class="button special" onclick="iniciar()"> Jugar </button>
    	</div>

    	<section id="pagina" class="page" style="display:none;">
    		<div class="header"><span>Memorama x10 x100 x1000</span></div>	

			<div class="wrapper zigzag">
        		<div id="juego"> </div>
      		</div>

      		<div id="timer" class="time-wrapper zigzag"><span id="time">Tiempo: 00:00</span></div>
    	</section>
        <div class="overlay2"style="display:none;"> 
            <div class="popup"style="display:none;"> </div>
        </div>
</body>
</html>
<?php
// comprobar si tenemos los parametros en la URL
if (isset($_GET["name"]) && isset($_GET["score"])) {
	$nombre = $_GET["name"];
  	$score = $_GET["score"];


	$con = creaConexion();
	$qry = mysqli_query($con,"INSERT INTO memorama (name, score) 
			VALUES ('".$nombre."', ".$score.")");

	if($qry){
		echo "<script language=\"javascript\">window.location=\"../05/iva.php?name=$nombre\"</script>";
	}
	mysqli_close($con);

} else {
    //echo "<p>No parameters</p>";
}
?>