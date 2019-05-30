<!DOCTYPE html>

<html>
<head>
	<title>¿Cómo va la sucesión?</title>
	<?php
		include '../conexion.php';
	?>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="fichasEstilo.css"/>
	<script src="../jQueryLib/jquery-1.10.2.js"></script>
    <script src="../jQueryLib//jquery-ui.js"></script>
    <script type="text/javascript">
    	var a=0, b=0, c=0, cont=0, buenas=0;
    	
    	$(document).ready(function(){
		  $('.overlay').fadeIn(700);
          generaNum();
		});
		function showpopUp(){
		  $('#timer').html(" ");
		  $('.overlay2').css("display","block");
		  $('.popup').html("<br><h2> ¡Respondiste "+buenas+" correctamente!</h2>");
		  $('.popup').show("fade");
		  $('.popup').css("display","block");
		  setTimeout(function(){ window.location.href = window.location.href + "&score=" + buenas; }, 3000);
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
        function start(){
          $('.overlay').css("display","none");
          $('#page').css("display","block");
          display = $('#time');
          startTimer(30, display);
        }
        function generaNum(){
           
            var opcion=Math.floor(( Math.random() * 20 ));
            c= (Math.random()*1).toFixed(3);
            if(opcion%2==0){
                do{
                    a= (Math.random()*1).toFixed(3);
                    b= (Math.random()*1).toFixed(3);
                } while(!(c<a && c>b)); 
                $('#numMenor').html(b);
                $('#numMayor').html(a);
            }
            else {
                do{
                    a= (Math.random()*1).toFixed(3);
                    b= (Math.random()*1).toFixed(3);
                } while(!(c>a && c<b));
                $('#numMenor').html(a);
                $('#numMayor').html(b);
            }
            $("#cifra1").html(a);
            $("#cifra2").html(b);
            $("#cifra0").html(c);
            

        }
        $(function() {
        $( '.casilla' ).draggable({
          revert: "invalid",
          scroll: false,
          snap: ".droppable", 
          snapMode: "inner",
          opacity: 0.85, 
          scroll: false,
          snapTolerance: 30,
        });
        $( ".droppable" ).droppable({
            accept: function(d){ 
              if(d.text() == $(this).text()) { return true;} 
              // else if(d.text() == $(this).text() && d.attr('class')=="tg-yw4l renglon1" && $(this).attr('tg-yw4l renglon1')=="renglon1") {return true;} 
            },
            drop: function( event, ui ) {
              //$(this).droppable('disable');                
                cont++;
                if(cont==2){
                    cont=0;
                    buenas++;
                    $(".casilla").css("position","relative");
                     $(".casilla").css("top","0em");
                     $(".casilla").css("left","0em");
                     $(".casilla").css("display","none");
                     $('.casilla').show("fade");
                    generaNum();

                }
              }
              //disabled:true;
              
        });
    });
    </script>
</head>
<body>
	<div class="overlay" style="display: none;"> 
        <h2 style="color: #21b2a6"> Instrucciones </h2>
        <p> Arrastra los números de las casillas azules <br>a las casillas verdes de manera que los <br>números queden ordenados de menor a mayor</p>
        <p>Tienes 30 segundos para resolver tantas como puedas</p>
        <br>       
        <button style="opacity: 1;" class="button special" onclick="start()"> Jugar </button>
    </div>
    
    <div id="page" style="display: none;">
      <div class="header">
      <span>¿Cómo va la sucesión?</span>
      </div>
      
      <section class="wrapper zigzag" style="padding-top:2em;"> 
	       <div id="ZONE">
            <div id="Zone1">
              <div class="casilla" id="cifra1"></div>
              <div class="casilla" id="cifra2"> </div>
            </div>
            <div class="dropzone">
                <div class="droppable" id="numMenor" style="background-color:#99ff33;color:transparent;"></div>
                <div class="droppable" id="cifra0"></div>
                <div class="droppable" id="numMayor" style="background-color:#99ff33;color:transparent;"></div>
            </div>
         </div> 
      </section>
    
      <div id="timer" class="time-wrapper zigzag"><span id="time">TIEMPO: 00:00</span></div>
    </div>

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
	$qry = mysqli_query($con,"INSERT INTO mayormenor (name, score) 
			VALUES ('".$nombre."', ".$score.")");

	if($qry){
		echo "<script language=\"javascript\">window.location=\"../03/rompecabezas.php?name=".$nombre."\"</script>";
	}else{
		echo "producto no agregado".$con->error;
	}

	mysqli_close($con);

} else {
    //echo "<p>No parameters</p>";
}
?>