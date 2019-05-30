var j=0;
var n1= new Array();
var numMenor= new Array();


function caja(tabla, tRow,n){
  var tData = document.createElement("td");

  numDes= descomponer(n);
    for (var i = 0; i <= 5; i++) {
    var div= document.createElement("div");
    do{
      n1[i]= Math.floor(( Math.random() * 9 ) + 0);
    } while(n1[i]>=numDes[0])
    var textotData = document.createTextNode(n1[i]);

    tData.setAttribute("class", "tg-yw4l");
    div.setAttribute("class", "caja renglon"+j);
    div.setAttribute("id","draggable"+i);

    //Añade cifras a las cajas de la columna de CIFRAS PERMITIDAS
    div.appendChild(textotData);
    tData.appendChild(div);
    tRow.appendChild(tData);
    
  }
  cifrasOrdenadas= ordena(n1);
  agregaCifras(tRow, cifrasOrdenadas, j);
  j++;

}
function agregaCifras(tRow, c, k){
  var tData2= document.createElement("td");
  var divVerif= document.createElement("div");
  tData2.style.paddingLeft="5%";
  for (var i = 0; i <= 5; i++) {
    var divresp= document.createElement("div");
    
    tData2.setAttribute("class", "tg-yw4l");

    divresp.setAttribute("class", "respuesta renglon"+k);
    divresp.setAttribute("id","droppable"+i);
    var textNode= document.createTextNode(c[i]);
    divresp.appendChild(textNode);
    tData2.appendChild(divresp);
    tRow.appendChild(tData2);
}
  divVerif.setAttribute("class", "checkmark");
  divVerif.setAttribute("id", "checkmark"+k)
  divVerif.style.display="none";
  tData2.appendChild(divVerif);
}


function descomponer(num){
  var numArr= new Array();
  var i=0,unidad=100000;
  for(i=0; i<=5; i++){
    numArr[i]= Math.floor(num/unidad);
    num= num % unidad;
    unidad/=10;
  }
  return numArr;
}

function ordena(num){
  var aux;
  for(var i=0; i<num.length; i++){
    aux= i;
    for(var j=i+1; j<=num.length; j++){
      if(num[j]>num[aux]){
        aux=j;
      }
    }
    var a=num[i];
    num[i]=num[aux];
    num[aux]=a;
  }
  return num;
}
