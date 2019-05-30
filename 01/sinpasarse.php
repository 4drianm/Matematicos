<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sin Pasarse</title>
    <?php
	    include '../conexion.php';
  	?>
    <link rel="stylesheet" href="fichasEstilo.css"/>
    <script type="text/javascript" src="funcionesFichas.js"></script>
    <script src="../jQueryLib/jquery-1.10.2.js"></script>
    <script src="../jQueryLib//jquery-ui.js"></script>
    <script>
    var buenas=0;
    var r1=0, r2=0, r3=0, r4=0, r5=0;
    
    $(document).ready(function(){
     $('.overlay').fadeIn(700);
    });

    function showpopUp(){

      $('#timer').html(" ");
      $('.overlay2').css("display","block");
      $('.popup').html("<br><h2> ¡Respondiste "+buenas+" correctamente!</h2>");
      $('.popup').show("fade");
      $('.popup').css("display","block");
      setTimeout(function(){ window.location.href = window.location.href + "&score=" + buenas; }, 2000);
    }
    $(function() {
        $( '.caja' ).draggable({
          revert: "invalid",
          scroll: false,
          snap: ".respuesta", 
          snapMode: "inner",
          opacity: 0.85, 
          scroll: false,
          snapTolerance: 20,
        });
        $( ".respuesta" ).droppable({
            accept: function(d){ 
              if(d.text() == $(this).text()) {
                $(this).css("padding","0px");
                return true;
              } 
              // else if(d.text() == $(this).text() && d.attr('class')=="tg-yw4l renglon1" && $(this).attr('tg-yw4l renglon1')=="renglon1") {return true;} 
            },
            drop: function( event, ui ) {
              var flag= true;
                if($(this).attr('class')=="respuesta renglon0 ui-droppable")
                  r1++;
                else if($(this).attr('class')=="respuesta renglon1 ui-droppable")
                  r2++;
                else if($(this).attr('class')=="respuesta renglon2 ui-droppable")
                  r3++;
                else if($(this).attr('class')=="respuesta renglon3 ui-droppable")
                  r4++;
                else if($(this).attr('class')=="respuesta renglon4 ui-droppable")
                  r5++;
              if(r1==6){
              $("#checkmark0").css("display", "block");
                buenas+=1;
                r1=0;
                
              }
              if(r2==6){
                $("#checkmark1").css("display", "block");
                buenas+=1;
                r2=0;
                
              }
              if(r3==6){
                $("#checkmark2").css("display", "block");
                buenas+=1;
                r3=0;
                
              }
              if(r4==6){
                $("#checkmark3").css("display", "block");
                buenas+=1;
                r4=0;
                
              }
              if(r5==6){
                $("#checkmark4").css("display", "block");
                buenas+=1;
                r5=0;
                
              }
                $(this).droppable('disable');
                if(buenas==5){
                  showpopUp();
                }
              }
        });
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
    </script>
  </head>
  <body >
    <div class="overlay" style="display: none;"> 
        <h2 style="color: #21b2a6"> Instrucciones </h2>
       <p> Arrastra las cifras permitidas (casillas verdes)<br> a las casillas azules para formar el número que más se<br> apróxima al número de la primera columna.</p>
        <br>
        <button style="opacity: 1;" class="button special" onclick="start()"> Jugar </button>
    </div>

    <div id="page" style="display: none;">
      <div class="header">
      <span>SIN PASARSE</span>
      </div>
      <div class="wrapper zigzag" style="padding-top:2em;">        
        <div id="ZONE">
          <table id="tabla" class="tg" style="font-size:25px;">
            <tr >
              <th class="tg-yw4l" style="width: 150px; ">  NÚMERO </th>
              <th class="tg-yw4l" style="width: 280px;"> CIFRAS PERMITIDAS </th>
              <th class="tg-yw4l" >  NÚMERO MENOR QUE MÁS SE APROXIMA </th>
            </tr>
          </table >
        </div>
        </div>
      </div>
    
      <div id="timer" class="time-wrapper zigzag"><span id="time">TIEMPO: 00:00</span></div>
    </div>
    <div class="overlay2"style="display:none;"> 
      <div class="popup"style="display:none;"> </div>
    </div>
    <script type="text/javascript">
    

      tabla=document.getElementById("tabla");
      for (var i=0; i<5; i++){
        var n= Math.floor(( Math.random() * 500000 ) + 500000 );
        var tRow = document.createElement("tr");
        var tData = document.createElement("td");
        var textotData = document.createTextNode(n);
        
        tRow.setAttribute("class","r"+i);
        
          tData.setAttribute("class", "tg-yw4l renglon"+i)
    			tData.appendChild(textotData);
    			tRow.appendChild(tData);
    			tabla.appendChild(tRow);
          caja(tabla,tRow,n);
        
      }
    </script>
  </body>
</html>
<?php
// comprobar si tenemos los parametros en la URL
  if (isset($_GET["name"]) && isset($_GET["score"])) {
    $nombre = $_GET["name"];
  	$score = $_GET["score"];

	  $con = creaConexion();
	  $qry = mysqli_query($con,"INSERT INTO sinpasar (name, score) 
			  VALUES ('".$nombre."', ".$score.")");

  if($qry){
		echo "<script language=\"javascript\">window.location.href=\"../02/sucesion.php?name=".$nombre."\";</script>";
  }
	mysqli_close($con);

} else {
    //echo "<p>No parameters</p>";
}
?>