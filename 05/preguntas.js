var pci;
var psi;
function creaPregunta(){

	var porcentaje= Math.round(Math.random()*25);
	var precio = Math.round(Math.random()*3245);
	var numeroPregunta= Math.round(Math.random()*3);
	var preguntas=[]; 
	// 'S' preguntas especiales 
	//PREGUNTAS CON IVA
	preguntas[0]="\u00BFCu\u00e1l es el precio final de un"+Producto()+" que cuesta $"+precio+" s\u00ed tiene un descuento de "+porcentaje+"%?"
	preguntas[1]="Una refacci\u00f3n cuesta $"+precio+", con el iva incluido. \u00BFCu\u00e1l es el precio de la refacci\u00f3n sin el iva del " +porcentaje+"%?"
	preguntas[2]="En un almac\u00e9n hay una promoci\u00f3n de "+porcentaje+"% de descuento.\u00bfCu\u00e1l es el precio final de un"+Producto()+"con un precio de lista de $"+precio+"?"
	///* 'S' */preguntas[3]="Pep\u00e9 logr\u00f3 ahorrar $"+precio+" y con este dinero decidio comprar un"+Producto()+" con el "+porcentaje+"% \u00bfCu\u00e1nto se ahorra en el descuento?"
	//PREGUNTAS SIN IVA
	preguntas[3]="El precio de una herramienta mec\u00e1nica es de $"+precio+".00. A esta cantidad se debe agregar con 16% de iva. \u00bfCu\u00e1l es el precio de la refacci\u00f3n con el iva incluido?";
	///* 'S'*/preguntas[5]="Un producto que cuesta $"+precio+" se le tiene que agregar el 16%, pero tiene un descuento de "+porcentaje+"% Cu\u00e1nto es el costo final del producto?"
	creaP(preguntas[numeroPregunta]);	
	//Manda a crear las respuestas y manda a llamar a la funcion dependiendo la categoria de pregunta que genere random
	 if (numeroPregunta<3){
		pci= parseFloat(resultadoIVA(precio,porcentaje)).toFixed(2);
	}else if (numeroPregunta>=3) {
		psi= parseFloat(resultadoSINIVA(precio,porcentaje)).toFixed(2);
	}
	img=Math.round(Math.random()*1);
	
}

function creaP(argument){
	var p= document.createElement("br");
	var body=document.getElementById("contenido");
	var textnode=document.createTextNode(argument);
	body.appendChild(textnode);
	body.appendChild(p);
	body.appendChild(p);
}

function Producto() {
	var productos=[];

	productos[0]="a pelota ";
	productos[1]="a plancha "
	productos[2]="a televisi\u00f3n "
	productos[3]="a Pista de juguete "
	productos[4]="a Raspberry Pi 3 "
	productos[5]=" Trompo electrico "
	productos[6]="a Tablet "
	productos[7]=" Smartphone "
	productos[8]="a mesa de hockey de aire "
	productos[9]="a pistola Nerf "
	var orden = Math.round(Math.random()*9);
	return productos[orden];
}


//APARTADO DE RESPUESTAS INICIO***********************************


function resultadoIVA(precio,descuento){
	var valor=100-descuento;
	valor=valor*0.01
	
	var final = precio*valor;
	//creaRespuestaCorrecta(precio);
	creaRespuestaIVA( final,precio,precio);


	return final
}

function resultadoSINIVA(precio,descuento) {
	var valor=precio*0.01;
	valor=valor+1;
	var final=precio+valor;

	creaRespuestasSinIVA(final,precio,precio);
	
	return final;
}

function br(){
	b=document.createElement("br");
	return b;
}

function randomErroneas(precio) {
	var aleatorio = Math.round(Math.random()*12	);
	aleatorio=aleatorio*0.1;
	aleatorio= precio*aleatorio;

	return aleatorio;
}

function creaRespuestaIVA(precio,cant1,cant2) {
	var a=Math.round(Math.random()*2+1);
	var b=Math.round(Math.random()*2+1);
	var c=Math.round(Math.random()*2+1);

	while(1){
		if ((a==b)||(a==c)){
			a=Math.round(Math.random()*2+1);
		}else if ((b==a)||(b==c)){
			b=Math.round(Math.random()*2+1);
		}else if ((c==a)||(c==b)){
			c=Math.round(Math.random()*2+1);
		}else break;
	}
	var ident = document.getElementById("div"+a);
	var ident2 = document.getElementById("div"+b);
	var ident3 = document.getElementById("div"+c);
	

	// Crea la respuestas correcta
	var textnode=document.createTextNode(precio.toFixed(2));
	ident.appendChild(textnode);
	ident.appendChild(br());

	//Crea erroneas
	var textnode2=document.createTextNode(randomErroneas(cant1).toFixed(2));
	ident2.appendChild(textnode2);
	ident2.appendChild(br());

	var textnode3=document.createTextNode(randomErroneas(cant2).toFixed(2));
	ident3.appendChild(textnode3);
	ident3.appendChild(br());
}

function creaRespuestasSinIVA(precio,cant1,cant2) {
	var a=Math.round(Math.random()*2+1);
	var b=Math.round(Math.random()*2+1);
	var c=Math.round(Math.random()*2+1);

	while(1){
		if ((a==b)||(a==c)){
			a=Math.round(Math.random()*2+1);
		}else if ((b==a)||(b==c)){
			b=Math.round(Math.random()*2+1);
		}else if ((c==a)||(c==b)){
			c=Math.round(Math.random()*2+1);
		}else break;
	}
	var ident = document.getElementById("div"+a);
	var ident2 = document.getElementById("div"+b);
	var ident3 = document.getElementById("div"+c);
	
	//Crea erroneas
	var textnode2=document.createTextNode(randomErroneas(cant1).toFixed(2));
	ident2.appendChild(textnode2);
	ident2.appendChild(br());

	var textnode3=document.createTextNode(randomErroneas(cant2).toFixed(2));
	ident3.appendChild(textnode3);
	ident3.appendChild(br());

	// Crea la respuestas correcta
	var textnode=document.createTextNode(precio.toFixed(2));
	ident.appendChild(textnode);
	ident.appendChild(br());
}

// Apartado de respuestas ++++++++FIN+++++++++++

function verifica(divIdent) {
	
	var id = document.getElementById(divIdent);
	valor=parseFloat(id.innerText);
	if (valor==pci){
		cont++;
		id.style.backgroundColor= "#97E26B";
		//id.style.backgroundColor="lightgreen";
		setTimeout(function(){limpiaPantalla(divIdent);
		creaPregunta();},600);
		
	}else if (valor==psi){
		cont++;
		id.style.backgroundColor= "#97E26B";
		//id.style.backgroundColor="lightgreen";
		setTimeout(function(){limpiaPantalla(divIdent);
		creaPregunta();},600);
		
	}else {
		
		//id.style.backgroundColor="#DC143C";
		
		id.style.backgroundColor= "#bc2410";
		setTimeout(function(){limpiaPantalla(divIdent);
		creaPregunta();},600);
	}
}


function limpiaPantalla(divIdent) {
	var pregunta= document.getElementById('contenido');
	var respuesta1 = document.getElementById('div1');
	var respuesta2 = document.getElementById('div2');
	var respuesta3 = document.getElementById('div3');
	var div = document.getElementById(divIdent);
	div.style.backgroundColor="#ba4545"

	pregunta.innerHTML="";
	respuesta1.innerHTML="";
	respuesta2.innerHTML="";
	respuesta3	.innerHTML="";
}
function showpopUp(){
  $('#timer').html(" ");
  $('.overlay2').css("display","block");
  $('.popup').html("<br><h2> ¡Respondiste "+cont+" correctamente!</h2>");
  $('.popup').show("fade");
  $('.popup').css("display","block");
  setTimeout(function(){ window.location.href="../memorama/mm.html"; }, 3000);
}