function sel_multi() {
    var i = 0;
    var n = Math.round(Math.random() * 3);
    switch (n) {
        case 1:
            return 10;
        case 2:
            return 100;
        default:
            return 1000;
    }
}
function mezclar(){
  var i,i2 = 0;
  var j;
  var n;
  var n2;
  var op = 0;
  var pos = 0;
  var para;
  for(i = 0 ; i <= 7; i++){
    n2 = Math.round(Math.random() * (90));
    for(j = 0; j < 2; j++){
      n = Math.round(Math.random() * (10-i));
      pos += n;
      pos %= 16;
      para = false;
      while(!para){
          if(!numeros[pos]){
              if(j == 0){
                  numeros[pos] = n2;
                  op = sel_multi();
                  multi[pos] = op;
                  para = true;
              }else{
                  numeros[pos] = op*n2;
                  multi[pos] = 1;
                  para = true;
              }
          }else{
              pos++;
              pos %= 16;
          }
      }
    }
  }
}
function iniciar(){
    var over= document.getElementById("over");
    var pag= document.getElementById("pagina");
    over.style.display= "none";
    pag.style.display="block";

    var tabla = '<table border="1">';
    mezclar();
    for (var i = 0; i < 2; i++){
        tabla += '<tr>';
        for(var j = 0; j < 8; j++){
            tabla += '<td class="'+numeros[celd]+'" id="'+celd+'"><a href="javascript:girar('+celd+');"><img src="img/reverso.png" width="125px" height="200px"></a></td>';
            celd++;
        }
        tabla += '</tr>'
    }
    tabla += '</table>'
    document.getElementById("juego").innerHTML = tabla;
    display = $('#time');
    startTimer(60, display);
}