<!DOCTYPE html>
<html>
<head>
	<title>Aprende a sacar porcentaje</title>
	<?php
		include '../conexion.php';
	?>
	<meta charset="utf-8">
	<script type="text/javascript" src="calculadora.js"></script>
	<script type="text/javascript" src="imagen.js"></script>
	<script type="text/javascript" src="preguntas.js"></script>
	<script src="../jQueryLib/jquery-1.10.2.js"></script>
    <script src="../jQueryLib//jquery-ui.js"></script>
    <script src="dist/sweetalert.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
	<link rel="stylesheet" href="estilo.css">
	<script type="text/javascript">
	var cont=0;
	$(document).ready(function(){
		$('overlay').fadeIn(700);
	});
	
	function startTimer(duration, display) {

        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10),
            seconds = parseInt(timer % 60, 10);
    
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
    
            display.text("TIEMPO: " + minutes + ":" + seconds);
    
            if (--timer < 0) {
              showpopUp();
              setTimeout(function (){window.location.href = window.location.href + "&score=" + cont;},3000);
              timer = duration;
            }
            
        }, 1000);
    }

    function start(){
      $('.overlay').css("display","none");
      $('#pag').css("display","block");
      display = $('#time');
      startTimer(90, display);}
	</script>
</head>
<body onload="creaPregunta()">
<div class="overlay"> 
        <h2 style="color: #21b2a6"> Instrucciones </h2>
        <p> Resuelve los problemas de porcentajes, </br> puedes hacer uso de la calculadora</p>
        <br>
        <button style="opacity: 1;" class="button special" onclick="start()"> Jugar </button>
</div>

	<section id="pag"  style="display:none;">
		<div class="header">
	      <span>El iva</span>
	     </div>


	    <div class="wrapper zigzag">
	    	<p id="contenido" class="preguntas"></p>

			<div id="respuestas" class="respues">
			<br> <br>
			<button id="div1" onclick="verifica('div1')" class="buttonR" style="margin: .5em; width:230px;"></button>
			<br>
			<button id="div2" onclick="verifica('div2')" class="buttonR" style="margin: .5em;width:230px;" ></button>
			<br>
			<button id="div3" onclick="verifica('div3')" class="buttonR" style="margin: .5em;width:230px;"></button>
			</div>



			<div id="calculadora">
				<input type="text" id="caja1" disabled="disabled" style="width: 210px; "/>				
				<br />
				<input type="button" class="botonC" onclick="borrar();" value="CE" style="font-size:1em;  padding: .5em; width: 105px;"/>
				<input type="button" class="botonC" onclick="borrar1();" value="C" style="font-size:1em;padding: .5em;width: 105px;"/>
				<br />

				<input type="button" class="botonC" onclick="siete();"
					value="7" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<input type="button" class="botonC" onclick="ocho();"
					value="8" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<input type="button" class="botonC" onclick="nueve();"
					value="9" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<input type="button" class="botonC" onclick="div();"
					value="/" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<br>
				

				<input type="button" class="botonC" onclick="cuatro();"
					value="4" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<input type="button" class="botonC" onclick="cinco();"
					value="5" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<input type="button" class="botonC" onclick="seis();"
					value="6"style="font-size:.1.2em; font-weight:0px; padding: .5em" />
				<input type="button" class="botonC" onclick="mult();"
					value="*" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<br>

				<input type="button" class="botonC" onclick="uno();"
					value="1" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<input type="button" class="botonC" onclick="dos();"
					value="2" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<input type="button" class="botonC" onclick="tres();"
					value="3" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<input type="button" class="botonC" onclick="resta();"
					value="-" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<br>

				<input type="button" class="botonC" onclick="cero();"
					value="0" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<input type="button" class="botonC" onclick="punto();"
					value=". " style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<input type="button" class="botonC" onclick="igual();"
					value="=" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
				<input type="button" class="botonC" onclick="suma();"
					value="+" style="font-size:.1.2em; font-weight:0px; padding: .5em"/>
			</div>
			
   
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
	$qry = mysqli_query($con,"INSERT INTO porcentaje (name, score) 
			VALUES ('".$nombre."', ".$score.")");

	if($qry){
		echo "<script language=\"javascript\">window.location=\"../06/jugos.php?name=$nombre\"</script>";
	}

	mysqli_close($con);

} else {
    //echo "<p>No parameters</p>";
}
?>