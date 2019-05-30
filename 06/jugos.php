<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Los jugos</title>
<?php
    include '../conexion.php';
?>
<link rel="stylesheet" href="../jQueryLib/jquery-ui.css">

<script src="../jQueryLib/jquery-1.10.2.js"></script>
<script src="../jQueryLib//jquery-ui.js"></script>
<link rel="stylesheet" href="../jQueryLib/jquery-ui.structure.css">
<link rel="stylesheet" href="style.css">

<script>
  var buenas = 0;
  $(document).ready(function(){
      $('#overlay').fadeIn(700);
  });
  function showpopUp(){
    $('#timer').html(" ");
    $('.overlay2').css("display","block");
    $('.popup').html("<br><h2> ¡Respondiste "+buenas+" correctamente!</h2>");
    $('.popup').show("fade");
    $('.popup').css("display","block");
    setTimeout(function(){ window.location.href = window.location.href + "&score=" + buenas; }, 2000);
  }
  function start () {
      $('#overlay').css("display","none");
      $("#pagina").css("display", "block")
      boxGenerator();
      display = $('#time');
      startTimer(60, display);
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

  $(function() {
      
      $(".draggable").draggable({ 
          revert: "invalid",
          containment: "#containment-wrapper", 
          scroll: false, 
          snap: ".droppable", 
          snapMode: "inner", 
          cursorAt: { top: 25, left: 66 }, snapTolerance: 40,
          stop: function() { if ($(this).position().top > 300) { } }
      });
      
      $(".droppable").droppable({
          accept: function(d){ if(d.text() == $(this).text()){return true;} },
          drop:   function(d) { 
              $( this ).addClass("ui-state-highlight");
              $(this).css("background-color", "rgba(45, 232, 102, 1)");
              buenas = buenas + 1;
          }
      });
  });
  
  

  
  function rndmDenom (upTo) {
      var ranFloat = Math.random()*upTo;
      var randInt = Math.round(ranFloat);
      if (randInt < 2) {
          return 4;
      }
      return randInt;
  }
  
  function rndNum (num) {
      var ranFloat = Math.random() * num;
      if (ranFloat < 1) {
          return 1
      }
      var randInt = Math.round(ranFloat);
      if (randInt > num) { randInt = randInt - 1;}
      else if (randInt < num) { randInt = randInt + 1;}
      return randInt;
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
  
  function fraccion() {
      var contenido = {decimal: 0.1, queb: ""};
      var denom = rndmDenom (10);
      var num = rndNum (denom);
      contenido.decimal = num/denom;
      contenido.queb = num+"/"+denom+" L";
      return contenido;
  }
  
  function boxGenerator() {
      var thebody = document.getElementById("dummy");
      var overlay = document.getElementById("overlay")
      thebody.removeChild(overlay);
      
      var divIDFigura = document.getElementById("containment-wrapper");

      //Quantities generator and header filler
      var decimalArray = [];
      for (var i = 2; i <= 7; i++) {
          var headerContent = document.getElementById("column"+i);
          var contenido = fraccion();
          for (var j = 0; j <= 8; j++) {
              if (decimalArray.indexOf(contenido.decimal) == -1) {
                  decimalArray.push(contenido.decimal);
                  j = 9;
              } else {contenido = fraccion();}
          }
          headerContent.innerHTML = contenido.queb; 
      }

      // Filling content on answer cells
      for (var i = 1; i <= 6; i++) {
          for (var j = 0; j <= 3; j++) {
              var place = document.getElementById("drop"+(i + (j*6) ));
              place.innerHTML = Math.floor((decimalArray[i-1])*100)/100+" L de ";
          }
      }
      
      // Beverages
      var yourCall = ["Jugo", "Agua", "Yogurth", "Leche"];
      shuffle(yourCall);
      for (var i = 0; i <= 3; i++) {
          var drinks = document.getElementById("rowh"+i);
          drinks.innerHTML = yourCall[i];
      }
      // Filling drinks on answer cells
      console.log(yourCall);
      for (var i = 0; i <= 3; i++) {
          for (var j = 1; j <= 6; j++) {
              var place = document.getElementById("drop"+(j + (i*6)));
              place.innerHTML = place.innerHTML+yourCall[i];
          }
      }

      
      //filling draggables
      decimalArray.push(Math.random());
      decimalArray.push(Math.random());
      shuffle(decimalArray);

      for (var x = 0; x <= 7; x++) {      
          decimalArray[x] = Math.floor((decimalArray[x])*100) / 100;
      }
      
      
      shuffle(yourCall);
      for (var i = 0; i <= 3; i++) {
          var divEje = document.getElementById("draggable"+i);
          divEje.innerHTML = decimalArray[i] +" L de "+ yourCall[i];
      }
      shuffle(yourCall);
      for (var i = 4; i <= 7; i++) {
          var divEje = document.getElementById("draggable"+i);
          divEje.innerHTML = decimalArray[i] +" L de "+ yourCall[i-4];
      }
  }

</script>
</head>
<body> 
<div id="dummy">
<div id="overlay" style="display:none;">
    <h2 style="color: #21b2a6"> Instrucciones </h2>
    <p>Completa la tabla arrastrando los productos correspondientes<br> expresados en decimales, 
        si no existe esa presentación deja el espacio vacío</p>
        <p>Cuando estés listo tendrás 1 minuto para completar.</p>        
	<input id="start" class="button special"type="button" value="Comenzar" onclick="start();">
</div>
	
</div>
<section id="pagina" style="display:none;">
    <div class="head">
      <span>Los Jugos</span>
    </div>
    <div class="wrapper zigzag">
        <div id="containment-wrapper">
        <div id="draggables">
            <div id="draggable0" class="draggable ui-widget-content"></div>
            <div id="draggable1" class="draggable ui-widget-content"></div>
            <div id="draggable2" class="draggable ui-widget-content"></div>
            <div id="draggable3" class="draggable ui-widget-content"></div>
            <div id="draggable4" class="draggable ui-widget-content"></div>
            <div id="draggable5" class="draggable ui-widget-content"></div>
            <div id="draggable6" class="draggable ui-widget-content"></div>
            <div id="draggable7" class="draggable ui-widget-content"></div>    
        </div>

        <div id="dropzone">
            <div id="row1" class="row">
                <div id="column1" class="cell header" style="opacity: 0"></div>
                <div id="column2" class="cell header"></div>
                <div id="column3" class="cell header"></div>
                <div id="column4" class="cell header"></div>
                <div id="column5" class="cell header"></div>
                <div id="column6" class="cell header"></div>
                <div id="column7" class="cell header"></div>
            </div>
            <div id="row2" class="row">
                <div id="rowh0" class="cell header"></div>
                <div id="drop1" class="cell droppable ui-widget-header"></div>
                <div id="drop2" class="cell droppable ui-widget-header"></div>
                <div id="drop3" class="cell droppable ui-widget-header"></div>
                <div id="drop4" class="cell droppable ui-widget-header"></div>
                <div id="drop5" class="cell droppable ui-widget-header"></div>
                <div id="drop6" class="cell droppable ui-widget-header"></div>
            </div>
            <div id="row3" class="row">
                <div id="rowh1" class="cell header"></div>
                <div id="drop7" class="cell droppable ui-widget-header"></div>
                <div id="drop8" class="cell droppable ui-widget-header"></div>
                <div id="drop9"  class="cell droppable ui-widget-header"></div>
                <div id="drop10" class="cell droppable ui-widget-header"></div>
                <div id="drop11" class="cell droppable ui-widget-header"></div>
                <div id="drop12" class="cell droppable ui-widget-header"></div>
            </div>
            <div id="row4" class="row">
                <div id="rowh2" class="cell header"></div>
                <div id="drop13" class="cell droppable ui-widget-header"></div>
                <div id="drop14" class="cell droppable ui-widget-header"></div>
                <div id="drop15" class="cell droppable ui-widget-header"></div>
                <div id="drop16" class="cell droppable ui-widget-header"></div>
                <div id="drop17" class="cell droppable ui-widget-header"></div>
                <div id="drop18" class="cell droppable ui-widget-header"></div>
            </div>
            <div id="row5" class="row">
                <div id="rowh3" class="cell header"></div>
                <div id="drop19" class="cell droppable ui-widget-header"></div>
                <div id="drop20" class="cell droppable ui-widget-header"></div>
                <div id="drop21" class="cell droppable ui-widget-header"></div>
                <div id="drop22" class="cell droppable ui-widget-header"></div>
                <div id="drop23" class="cell droppable ui-widget-header"></div>
                <div id="drop24" class="cell droppable ui-widget-header"></div>
            </div>
        </div>
        

        </div>
    </div>
        
    <div id="timer" class="time-wrapper zigzag"><span id="time">00:00</span></div>
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
	$qry = mysqli_query($con,"INSERT INTO jugos (name, score) 
			VALUES ('".$nombre."', ".$score.")");

	if($qry){
		echo "<script language=\"javascript\">window.location=\"../index.html\"</script>";
	}

	mysqli_close($con);

} else {
    //echo "<p>No parameters</p>";
}
?>