

let anual = 2000;
let mensual = 1;
let abecedario = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","U","V","W","X","Y","Z"];
let tamano=1;
let meses =['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo','Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']

function mostrarMeses(ano){
    row_anos.style.display= 'none'
    row_meses.style.visibility = 'visible'
    anual = ano
}


function cargarComprobantes(mes){
    mensual= mes
    location.replace(`/reporte/${anual}/${mensual}`)
}

$('#btn_retorn_anos').click(()=>{
    anual =2000;
    mensual = 1;
    row_meses.style.visibility = 'hidden'
    row_anos.style.display= ''
})


function handleFile(e) {
    paso1.innerHTML = ''
    paso2.innerHTML = ''
    paso3.innerHTML = ''
    paso4.innerHTML = ''
    var files = e.target.files, f = files[0];
    var reader = new FileReader();
    document.getElementById('tabla_cargada').innerHTML = 'Cargando...'
    reader.onload = function(e) {
      var data = new Uint8Array(e.target.result);
      var workbook = XLSX.read(data, {type: 'array'});
      var htmlstr = XLSX.write(workbook,{sheet: workbook.Workbook.Sheets[0].name, type:'binary',bookType:'html'});
      document.getElementById('tabla_cargada').innerHTML = htmlstr
      tabla_cargada.getElementsByTagName('table')[0].classList.add('table')
      tabla_cargada.getElementsByTagName('table')[0].classList.add('table-bordered')
      tabla_cargada.getElementsByTagName('tr')[2].classList.add('bg-dark')
      tabla_cargada.getElementsByTagName('tr')[2].classList.add('blanco')
      tabla_cargada.getElementsByTagName('tr')[2].innerHTML = tabla_cargada.getElementsByTagName('tr')[2].innerHTML + '<td>Aporte</td><td>Ahorro</td><td>Estado</td>'
      TR = tabla_cargada.getElementsByTagName('tr')[3];


        filas = tabla_cargada.getElementsByTagName('tr')
        for (var i = 0; i < filas.length; i++) {
            html = filas[i].innerHTML
            clase= (i>2)? `class="table-success"`:'';
            c_clase = (i>2)? `Normal`:'';
            tamano++
            if(i != 2)
                tabla_cargada.getElementsByTagName('tr')[i].innerHTML = `<td style="background-color:#ff9924">${i+1}</td>` + html +`<td></td><td></td><td ${clase}>${c_clase}</td>`
            else
                tabla_cargada.getElementsByTagName('tr')[i].innerHTML = `<td style="background-color:#ff9924">${i+1}</td>` + html
        }

        TD = TR.getElementsByTagName('td')
        cadena = `<tr style="background-color:#ff9924"><td>`
        for (var i = 0; i < TD.length-1; i++) {
            cadena+=`<td>${abecedario[i]}</td>`         
        }
        cadena+=`</tr>`

        var cuerpo_tabla = document.getElementsByTagName('tbody')[0].innerHTML
        document.getElementsByTagName('tbody')[0].innerHTML = cadena+cuerpo_tabla
        div_pasos.style.display ='block'
    };
    reader.readAsArrayBuffer(f);
}


function cargarNuevos(){
    (document.getElementById('barra')).style.visibility = 'visible'
    tabla = document.getElementsByTagName('tbody')[0]
    filas = tabla.getElementsByTagName('tr')
    var elementos = new Array()
    for (var i = 4; i < filas.length; i++) {
        nombre = filas[i].getElementsByTagName('td')[1].innerHTML 
        proceso = filas[i].getElementsByTagName('td')[2].innerHTML 
        cedula = filas[i].getElementsByTagName('td')[3].innerHTML 
        elementos.push({nombre: nombre, proceso : proceso, cedula:cedula})       
    }
    envio = {elementos : elementos};
    ruta = '/aportantes/todos';
    (document.getElementById('porcentaje')).style.width = '10%'
    $.ajax({
		method: "POST",
        url: ruta,
        contentType: "application/json; charset=utf-8",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data : JSON.stringify(envio),
	}).done((datos) => {
        paso1.innerHTML = datos;
        (document.getElementById('porcentaje')).style.width = '30%'
        cargarTodos()
	}).fail((jqXHR, textStatus)=>{
		console.log(jqXHR)
	})
}

function cargarTodos(){

    tabla = document.getElementsByTagName('tbody')[0]
    filas = tabla.getElementsByTagName('tr')
    var elementos = new Array()
    for (var i = 4; i < filas.length; i++) {
        cedula = filas[i].getElementsByTagName('td')[3].innerHTML 
        elementos.push(cedula)       
    }
    envio = {cedulas : elementos}
    ruta = '/aportantes/no_hoja';
    (document.getElementById('porcentaje')).style.width = '40%';
    $.ajax({
		method: "POST",
        url: ruta,
        contentType: "application/json; charset=utf-8",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data : JSON.stringify(envio),
	}).done((datos) => {
        tabla = document.getElementsByTagName('tbody')[0]
        cadena=``
        for (var i = 0; i < datos.length; i++) {
            cadena+=`<tr>
                        <td style="background-color:#ff9924" >${tamano++}</td>
                        <td>${datos[i].nombre}</td>
                        <td>${datos[i].proceso}</td>
                        <td>${datos[i].cedula}</td>
                        <td>0</td>
                        <td></td><td></td>
                        <td class="table-danger">Sobregiro</td>
                    </tr>`
        }
        tabla.innerHTML = tabla.innerHTML + cadena;
        paso2.innerHTML = 'COMPLETADO';
        (document.getElementById('porcentaje')).style.width = '55%'
        diferenciarCostos()
	}).fail((jqXHR, textStatus)=>{
		console.log(jqXHR)
	})
}


function diferenciarCostos(){
    filas = document.getElementsByTagName('tr')
    var elementos = new Array()
    for (var i = 4; i < filas.length; i++) {
        cedula = filas[i].getElementsByTagName('td')[3].innerHTML 
        elementos.push(cedula)       
    }
    envio = {cedulas : elementos}
    ruta = '/aportantes/diferenciacion';
    (document.getElementById('porcentaje')).style.width = '60%' ;
    $.ajax({
		method: "POST",
        url: ruta,
        contentType: "application/json; charset=utf-8",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data : JSON.stringify(envio),
	}).done((datos) => {
        conteo=4
        for(var i=0; i < datos.length; i++){
            var valor = filas[conteo].getElementsByTagName('td')[4].innerHTML           
            filas[conteo].getElementsByTagName('td')[6].innerHTML = 0
            if(datos[i].tipo == 'APORTANTE'){
                filas[conteo].classList.add('fondo-aportante')
                filas[conteo].getElementsByTagName('td')[5].innerHTML = valor
            }
            if(datos[i].tipo == 'SOCIO'){
                filas[conteo].classList.add('fondo-socio')
                filas[conteo].getElementsByTagName('td')[5].innerHTML = valor/2
                filas[conteo].getElementsByTagName('td')[6].innerHTML = valor/2
            }
            conteo++
        }

        document.getElementById('porcentaje').style.width = '100%'
        paso3.innerHTML = 'COMPLETADO'
    }).fail((jqXHR, textStatus)=>{
		console.log(jqXHR)
	})
}

function guardarAportes(){
    filas = document.getElementsByTagName('tr')
    var elementos = new Array()
    for (var i = 4; i < filas.length; i++) {
        cedula = filas[i].getElementsByTagName('td')[3].innerHTML 
        valor = filas[i].getElementsByTagName('td')[4].innerHTML 
        aporte=filas[i].getElementsByTagName('td')[5].innerHTML
        ahorro=filas[i].getElementsByTagName('td')[6].innerHTML
        elementos.push({cedula: cedula, valor: Number(valor), aporte:Number(aporte), ahorro:Number(ahorro)})       
    }

    mesYAno = location.pathname;
    mesYAno= mesYAno.split('/')

    envio = {elementos : elementos, anual : mesYAno[2], mensual:mesYAno[3]}

    ruta = '/aportantes/guardar'
    
    document.getElementById('porcentaje').style.width = '30%'
    $.ajax({
		method: "POST",
        url: ruta,
        contentType: "application/json; charset=utf-8",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data : JSON.stringify(envio),
	}).done((datos) => {
        document.getElementById('porcentaje').style.width = '100%'
        location.reload()
    }).fail((jqXHR, textStatus)=>{
		console.log(jqXHR)
    })
}

function seleccionTodos(){
    filas =document.getElementsByClassName('check_fila')
    for (let i = 0; i < filas.length; i++) {
        document.getElementsByClassName('check_fila')[i].setAttribute('checked', true)
    }
}

var Array_archivos = new Array();

var tableToExcel = (function() {
	
    var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }

    return async function(table, name, conteo) { 
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
        Array_archivos.push({ nombre : name, archivo: base64(format(template, ctx))})
        document.getElementById('porcentaje').style.width = conteo +'%'
    }
})()


function descargarExcels(){
    (document.getElementById('barra')).style.visibility = 'visible'
    var favorite = [];
    $.each($("input[name='filas_aportantes']:checked"), function(){     
        cedulas = $(this).attr('id')
        cedulas= cedulas.split('_')       
        favorite.push(cedulas[1]);
    });
    mesYAno = location.pathname;
    mesYAno= mesYAno.split('/')
    envio = {cedulas : favorite , anual : mesYAno[2], mensual:mesYAno[3]}
    ruta = '/aportantes/detalles'
    document.getElementById('porcentaje').style.width = 10 +'%'
    $.ajax({
		method: "POST",
        url: ruta,
        contentType: "application/json; charset=utf-8",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data : JSON.stringify(envio),
	}).done((datos) => {
        document.getElementById('porcentaje').style.width = 30 +'%'
        var cadena= ``
        listados = new Array()
        for(var i=0 ; i < datos.length; i++){
            listados.push({codigo: `tabla_${datos[i].aportante.cedula}`, nombre : datos[i].aportante.nombre})
            cadena+=`<table id="tabla_${datos[i].aportante.cedula}">
                        <tr><td><b>Nombre</b></td> <td>${datos[i].aportante.nombre}</td></tr>
                        <tr><td><b>Proceso</b></td> <td>${datos[i].aportante.proceso}</td></tr>
                        <tr><td><b>Cédula</b></td> <td>${datos[i].aportante.cedula}</td></tr>
                        <tr><td></td><td></td></tr>
                        <tr>
                            <td><b>Año</b></td> <td><b>Mes</b></td><td><b>Valor</b></td><td><b>Aporte</b></td><td><b>Ahorro</b></td><td><b>Estado</b></td>
                        </tr>`
                        var suma_val=0;
                        var suma_aporte=0;
                        var suma_ahorro =0;
                        for(var j=0; j < datos[i].aportaciones.length; j++){
                            apor= datos[i].aportaciones[j]
                            cadena+=`<tr>
                                        <td>${apor.anual}</td>
                                        <td>${meses[apor.mensual-1]}</td>
                                        <td>${apor.valor}</td>
                                        <td>${apor.aporte}</td>
                                        <td>${apor.ahorro}</td>
                                        <td>${apor.estado}</td>
                                    </tr>`
                            suma_val+= Number(apor.valor)
                            suma_aporte+=Number(apor.aporte)
                            suma_ahorro+= Number(apor.ahorro)
                        }
                        cadena+=`<tr>
                                    <td colspan="2" style="text-align:right"><b>Totales</b></td>
                                    <td  style="text-align:right" >${suma_val.toFixed(2)}</td>
                                    <td  style="text-align:right" >${suma_aporte.toFixed(2)}</td>
                                    <td  style="text-align:right" >${suma_ahorro.toFixed(2)}</td>
                                </tr>`
                        
            cadena+=`</table>`
        }
        document.getElementById('tablas_ocultas').innerHTML = cadena;
        document.getElementById('porcentaje').style.width = 50 +'%'

        var conteo = 50
        var pasos = 30 / datos.length
        
       
        listados.forEach(element => {
            tableToExcel(element.codigo, element.nombre, conteo)
            conteo += pasos
        });

        guardarZip(Array_archivos);

    }).fail((jqXHR, textStatus)=>{
		console.log(jqXHR)
    })
}


function guardarZip(archivos){
    var zip = new JSZip();
    conteo= 80
    pasos = 15/ archivos.length
    archivos.forEach(elemento => {
        zip.file(elemento.nombre + '.xls', elemento.archivo, {base64: true});
        document.getElementById('porcentaje').style.width = conteo +'%'
        conteo+= pasos;
    });
    zip.generateAsync({type:"blob"})
        .then(function(content) {
            // Force down of the Zip file
            saveAs(content, "seguimiento.zip");
            document.getElementById('porcentaje').style.width = 100 +'%'
        });
}

function buscador(elemento, tabla) {
	filter = elemento.toUpperCase();
	table = document.getElementById(tabla);
	tr = table.getElementsByClassName('fila_v');
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName('td')
		var conteo = 0;
		for (var j = 0 ;  j < td.length ; j++) {
			txtValue = td[j].textContent || td.innerText;
			if(txtValue != undefined){
				if (txtValue.toUpperCase().indexOf(filter) > -1)	conteo ++;	
			}
					
		}
		if(conteo > 0) tr[i].style.display = ""; else tr[i].style.display = "none";	
	}
}


function cambiarTipo(id){
    var socio = `op_soc_${id}`
    socio = document.getElementById(socio).selected

    var apore = `op_apo_${id}`
    apore = document.getElementById(apore).selected

    eleccion = socio ? 'SOCIO' : 'APORTANTE'

    ruta = '/cambio_tipo'
    envio = {id:id, tipo: eleccion}
    
    $.ajax({
		method: "POST",
        url: ruta,
        contentType: "application/json; charset=utf-8",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data : JSON.stringify(envio),
	}).done((datos) => {

    })
}

function cargarModal(modal , url, elemento, identidad){
	$.ajax({
		method: "GET",
		url: url
	}).done((datos) => {	
		mostrarDatosModal(elemento, identidad, datos)	
		abrirModal(modal, elemento)
	})
}

function mostrarDatosModal(elemento, identidad, datos){
	try {
		document.getElementById(elemento).reset()
	} catch (error) {
		
	}
	
	switch(identidad) { 
		case 'aportante':
            datos = datos.datos
            txt_nom_apor.value= datos.nombre
            txt_ced_apor.value = datos.cedula
            txt_sue_apor.value = datos.sueldo
            break;
        default:
            break;
    }
}

function abrirModal(modal){
	var modal = document.getElementById(modal);
	modal.style.display = "block";
	var cerrar = modal.getElementsByClassName('close')[0]
	cerrar.onclick = ()=>{ 
		modal.style.display = "none";
	}
	window.onclick = (event)=> {
		if (event.target == modal) 	modal.style.display = "none";		
	}
}

function eliminarReg(codigo, ruta){
	swal({
		title: 'Atención',   text: `¿ Desea eliminar al aportante ?`,
		icon: "warning",     buttons: ['Cancelar', 'Aceptar'], 	dangerMode: true,
	}).then((willDelete) => {
		if (willDelete) {
			var envio={codigo:codigo}

			$.ajax({
				method: "POST",
				url: ruta,
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: envio
			}).done((datos) => {

				swal(`El aportante ha sido eliminado`).then((value) => {
					document.getElementsByTagName('body')[0].innerHTML= 'Recargando...'
					location.reload() 
				});
			}).fail((xhr, textStatus)=>{
				document.getElementsByTagName('body')[0].innerHTML= xhr.responseText
			})
		} 
	})  
}


function eliminarRegistro(){
    var link = location.pathname;
    link = link.split('/')
    envio = {anual : link[2], mensual: link[3]}
    ruta = '/eliminar-registro-mensual'
    $.ajax({
        method: "POST",
        url: ruta,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: envio
    }).done((datos) => {
        document.getElementsByTagName('body')[0].innerHTML = 'Recargando...'
        location.reload();
    })
}