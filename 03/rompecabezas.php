<!DOCTYPE html>
<html lang="es">
	<head>
	<title>Rompecabezas</title>
		<?php
		include '../conexion.php';
	?>
		<link rel="stylesheet" type="text/css" href="rompecabezasimg.css">
		<link rel="stylesheet" href="../jQueryLib/jquery-ui.css">
		<script src="../jQueryLib/jquery-1.10.2.js"></script>
    	<script src="../jQueryLib//jquery-ui.js"></script>
    	<link rel="stylesheet" href="../jQueryLib/jquery-ui.structure.css">
    	<script type="text/javascript">
    		var buenas = 0, ej1=0, ej2=0, ej3=0, ej4=0;
    		var resultemme = new Array(4);
    		var resultflecha = new Array(4);
    		$(document).ready(function(){
		  		$('.overlay').fadeIn(700);
          		
			});
		function showpopUp(){
		  $('#timer').html(" ");
		  $('.overlay2').css("display","block");
		  $('.popup').html("<br><h2> ¡Respondiste "+buenas+" correctamente!</h2>");
		  $('.popup').show("fade");
		  $('.popup').css("display","block");
		  setTimeout(function(){ window.location.href = window.location.href + "&score=" + buenas; }, 3000);
		}	 
    		function start () {
    			generaRandom();
    			$('.overlay').css("display","none");
          		$('.pagina').css("display","block");
          		display = $('#time');
          		startTimer(30, display);
    			
    		}
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
	                  timer = duration;
	                }
	            }, 1000);
	        }
    		function generaRandom () {
    			var resultzone = new Array(4);
    			resultzone[0] = document.getElementById("resultUno");
        		resultzone[1] = document.getElementById("resultDos");
        		resultzone[2] = document.getElementById("resultTres");
        		resultzone[3] = document.getElementById("resultCuatro");

        		var emmezone = new Array(4);
    			emmezone[0] = document.getElementById("emmeUno");
        		emmezone[1] = document.getElementById("emmeDos");
        		emmezone[2] = document.getElementById("emmeTres");
        		emmezone[3] = document.getElementById("emmeCuatro");

        		var flechazone = new Array(4);
        		flechazone[0] = document.getElementById("flechaUno");
        		flechazone[1] = document.getElementById("flechaDos");
        		flechazone[2] = document.getElementById("flechaTres");
        		flechazone[3] = document.getElementById("flechaCuatro");

        		var arreglo = new Array(8);
        		var emme = new Array(4);
        		var flecha = new Array(4);
        		for (var i=0; i<8; i++)
        			arreglo[i] = (Math.random()*(1000)).toFixed(2);

            	var operacion = function sumarest() { return Math.round(Math.random()); }
            	var signo = function signosumaresta (num) {if (num) return "+"; else return "-";}
            	var index = 0;
            	for  (var i=0; i<7; i+=2){
            		var oper = operacion();
            		var sig = signo(parseInt(oper));
            		var resultado = 0 ;
            		if (sig == "+")resultado = parseFloat(arreglo[i]) + parseFloat(arreglo[i+1]);
            		else resultado = parseFloat(arreglo[i]) - parseFloat(arreglo[i+1]);
            		resultzone[index].appendChild(document.createTextNode(resultado.toFixed(2)));
            		emmezone[index].appendChild(document.createTextNode(arreglo[i]));
            		emme[index] = arreglo[i];
            		resultemme[index] = arreglo[i];
            		if (sig == "+") {
            			flechazone[index].appendChild(document.createTextNode("+ "+arreglo[i+1]));
            			flecha[index] = "+ "+arreglo[i+1];
            			resultflecha[index] = "+ "+arreglo[i+1];
            		}
            		else {
            			flechazone[index].appendChild(document.createTextNode("- "+arreglo[i+1]));
            			flecha[index] = "- "+arreglo[i+1];
            			resultflecha[index] = "- "+arreglo[i+1];
            		}
            		index++;
            	}
            	shuffle(emme);
            	shuffle(flecha);
            	var emmeDrag = new Array(4);
    			emmeDrag[0] = document.getElementById("drag1");
        		emmeDrag[1] = document.getElementById("drag2");
        		emmeDrag[2] = document.getElementById("drag3");
        		emmeDrag[3] = document.getElementById("drag4");

        		var flechaDrag = new Array(4);
        		flechaDrag[0] = document.getElementById("drag5");
        		flechaDrag[1] = document.getElementById("drag6");
        		flechaDrag[2] = document.getElementById("drag7");
        		flechaDrag[3] = document.getElementById("drag8");
            	for (i=0; i<4; i++){
            		emmeDrag[i].appendChild(document.createTextNode(emme[i]));
            		flechaDrag[i].appendChild(document.createTextNode(flecha[i]));
            	}
    		}
    		function shuffle(a) {
		        var j, x, i;
		        for (i = a.length; i; i -= 1) {
		            j = Math.floor(Math.random() * i);
		            x = a[i - 1];
		            a[i - 1] = a[j];
		            a[j] = x;
		        }
		    }
    		$(function() {
		        $(".emme").draggable({ 
		            revert: "invalid",
		            scroll: false,
		            
		        });
		        $(".flecha").draggable({ 
		            revert: "invalid",
		            scroll: false
		        });
		        $("#emmeUno").droppable({
		            accept: function(d){ if(d.text() == resultemme[0]){return true;} },
		            drop:   
                        function(d) { 
                            ej1++;
                            if(ej1==2){
                                buenas += 1;
                                ej1=0;
                            }
                        }
		        });
		        $("#emmeDos").droppable({
		            accept: function(d){ if(d.text() == resultemme[1]){return true;} },
		            drop:   function(d) { $(this).droppable('disable');buenas += 1; }
		        });
		        $("#emmeTres").droppable({
		            accept: function(d){ if(d.text() == resultemme[2]){return true;} },
		            drop:   function(d) { $(this).droppable('disable');buenas += 1; }
		        });
		        $("#emmeCuatro").droppable({
		            accept: function(d){ if(d.text() == resultemme[3]){return true;} },
		            drop:   function(d) { $(this).droppable('disable');buenas += 1; }
		        });
		        $("#flechaUno").droppable({
		            accept: function(d){ if(d.text() == resultflecha[0]){return true;} },
		            drop:   function(d) { $(this).droppable('disable');buenas += 1; }
		        });
		        $("#flechaDos").droppable({
		            accept: function(d){ if(d.text() == resultflecha[1]){return true;} },
		            drop:   function(d) { $(this).droppable('disable');buenas += 1; }
		        });
		        $("#flechaTres").droppable({
		            accept: function(d){ if(d.text() == resultflecha[2]){return true;} },
		            drop:   function(d) { $(this).droppable('disable');buenas += 1; }
		        });
		        $("#flechaCuatro").droppable({
		            accept: function(d){ if(d.text() == resultflecha[3]){return true;} },
		            drop:   function(d) { $(this).droppable('disable');buenas += 1; }
		        });
		    });

    	</script>
		<meta charset="UTF-8">
	</head>

	<body >
		<div class="overlay" style="display: none;"> 
	        <h2 style="color: #21b2a6"> Instrucciones </h2>
	        <p>De las piezas verdes que están en la parte de abajo, elije las que integran correctamente cada rompecabezas </p>
	        
	        <br>       
	        <button style="opacity: 1;" class="button special" onclick="start()"> Jugar </button>
    	</div>
    	
      	
      	<section class="pagina" style="display:none;">
      		<div class="header">
     	 <span>Rompecabezas Matemático</span>
      	</div>	
      		<div class="wrapper zigzag">
			<div class="container">
				<div class="dropzone">
					<br>
					<div class="resultzone" style="
						background: url(resultNaranja.png) no-repeat top center;
						background-size: 80%;
		                -moz-background-size: 100%;" id="resultUno">
		            </div>
					<div class="emmezone" style="
						background: url(emmeVerde.png) no-repeat top center;
						background-size: 100%;
		                -moz-background-size: 100%;" id="emmeUno">
		            </div>
		            <div class="flechazone" style="
						background: url(flecha.png) no-repeat top center;
						background-size: 100%;
		                -moz-background-size: 100%;" id="flechaUno">
		            </div>
				</div>
				<div class="dropzone">
					<br>
					<div class="resultzone" style="
						background: url(resultMorado.png) no-repeat top center;
						background-size: 80%;
		                -moz-background-size: 100%;" id="resultDos">
		            </div>
					<div class="emmezone" style="
						background: url(emmeAzul.png) no-repeat top center;
						background-size: 100%;
		                -moz-background-size: 100%;" id="emmeDos">
		            </div>
		            <div class="flechazone" style="
						background: url(flechaNaranja.png) no-repeat top center;
						background-size: 100%;
		                -moz-background-size: 100%;" id="flechaDos">
		            </div>
				</div>
				<div class="dropzone">
					<br>
					<div class="resultzone" style="
						background: url(resultAzul.png) no-repeat top center;
						background-size: 80%;
		                -moz-background-size: 100%;" id="resultTres">
		            </div>
					<div class="emmezone" style="
						background: url(emmeVerde.png) no-repeat top center;
						background-size: 100%;
		                -moz-background-size: 100%;" id="emmeTres">
		            </div>
		            <div class="flechazone" style="
						background: url(flechaRosa.png) no-repeat top center;
						background-size: 100%;
		                -moz-background-size: 100%;" id="flechaTres">
		            </div>
				</div>
				<div class="dropzone">
					<br>
					<div class="resultzone" style="
						background: url(resultAzul.png) no-repeat top center;
						background-size: 80%;
		                -moz-background-size: 100%;" id="resultCuatro">
		            </div>
					<div class="emmezone" style="
						background: url(emme.png) no-repeat top center;
						background-size: 100%;
		                -moz-background-size: 100%;" id="emmeCuatro">
		            </div>
		            <div class="flechazone" style="
						background: url(flechaRosa.png) no-repeat top center;
						background-size: 100%;
		                -moz-background-size: 100%;" id="flechaCuatro">
		            </div>			
				</div>
				<div class="emme" id="drag1"></div>
				<div class="emme" id="drag2"></div>
				<div class="emme" id="drag3"></div>
				<div class="emme" id="drag4"></div>
				<div class="flecha" id="drag5"></div>
				<div class="flecha" id="drag6"></div>
				<div class="flecha" id="drag7"></div>
				<div class="flecha" id="drag8"></div>
			</div>
			</div>
			<div id="timer" class="time-wrapper zigzag"><span id="time">TIEMPO: 00:00</span></div>
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
	$qry = mysqli_query($con,"INSERT INTO figuras (name, score) 
			VALUES ('".$nombre."', ".$score.")");

	if($qry){
		echo "<script language=\"javascript\">window.location=\"../04/memorama.php?name=".$nombre."\"</script>";
	}else{
		echo "error".$con->error;
	}

	mysqli_close($con);

} else {
    //echo "<p>No parameters</p>";
}
?>