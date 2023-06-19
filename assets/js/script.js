validarToken();
traerProductos();
validarSiHayRegistros();
listarProductos();
function validarToken(){
    var token = localStorage.getItem("token");
    if(token == null){
        window.location.href = "index";
    }
}
function traerProductos(){
    productosNuevos = $.ajax({
        type: "GET",
        url: "traer-registros.php",
        dataType: 'json',
        async: false,
        success: function (response) {
            return response;
        }
    })
}
function validarSiHayRegistros(){
    if(productosNuevos.responseJSON.length > 0){
        document.getElementById('mensaje').style.display = 'none';
    }
}
function listarProductos(){
    var productos = productosNuevos.responseJSON;
    for (let i = 0; i < productos.length; i++) {
        document.getElementById('productos').insertRow(-1).innerHTML = 
        '<td>'+productos[i].id+
        '</td><td>'+productos[i].nInven+
        '</td><td>'+productos[i].codigo+
        '</td><td>'+productos[i].denominacion+
        '</td><td>'+productos[i].marca+
        '</td><td>'+productos[i].modelo+
        '</td><td>'+productos[i].tipo+
        '</td><td>'+productos[i].color+
        '</td><td>'+productos[i].serie+
        '</td><td>'+productos[i].estado+
        '</td><td id="fechaRegistro">'+productos[i].fecha+
        '</td><td>S/'+productos[i].valor+
        '</td><td>'+productos[i].observacion+
        '</td><td class="icons"><i data-bs-toggle="modal" data-bs-target="#editar" onclick="abrirModalEditarProducto('+productos[i].id+')" class="bx bx-pencil"></i><i data-bs-toggle="modal" data-bs-target="#eliminar" onclick="abrirModalEliminarProducto('+productos[i].id+')" class="bx bx-trash"></i>'+
        '</td></td>';
    }
    var fecha = document.querySelectorAll('#fechaRegistro');
    for (let i = 0; i < fecha.length; i++) {
        var fechaRegistro = fecha[i].innerHTML;
        var fechaFormateada = fechaRegistro.split('-');
        fecha[i].innerHTML = fechaFormateada[2] + '-' + fechaFormateada[1] + '-' + fechaFormateada[0];
    }
    
}
function agregarProducto(){
    var nInven = document.getElementById('nInven').value;
    var codigo = document.getElementById('codigo').value;
    var denominacion = document.getElementById('denominacion').value;
    var marca = document.getElementById('marca').value;
    var modelo = document.getElementById('modelo').value;
    var tipo = document.getElementById('tipo').value;
    var color = document.getElementById('color').value;
    var serie = document.getElementById('serie').value;
    var estado = document.getElementById('estado').value;
    var fecha = document.getElementById('fecha').value;
    var valor = document.getElementById('valor').value;
    var observacion = document.getElementById('observacion').value;
    $.ajax({
        type: "POST",
        url: "agregarRegistro.php",
        dataType: 'json',
        data: {
            nInven: nInven,
            codigo: codigo,
            denominacion: denominacion,
            marca: marca,
            modelo: modelo,
            tipo: tipo,
            color: color,
            serie: serie,
            estado: estado,
            fecha: fecha,
            valor: valor,
            observacion: observacion
        }
    }).done(
        function (data) {
            document.getElementById('btn-agregar').disabled = true;
            alertify.success(data.message);
            setTimeout(function(){location.reload()}, 1000);
        }
    )
}
function abrirModalEditarProducto(id){
    $.ajax({
        type: "POST",
        url: "obtenerRegistroId.php",
        dataType: 'json',
        data: {
            id: id
        }
    }).done(
        function (data) {
            document.getElementById('nInvenb').value = data.nInven;
            document.getElementById('codigob').value = data.codigo;
            document.getElementById('denominacionb').value = data.denominacion;
            document.getElementById('marcab').value = data.marca;
            document.getElementById('modelob').value = data.modelo;
            document.getElementById('tipob').value = data.tipo;
            document.getElementById('colorb').value = data.color;
            document.getElementById('serieb').value = data.serie;
            document.getElementById('estadob').value = data.estado;
            document.getElementById('fechab').value = data.fecha;
            document.getElementById('valorb').value = data.valor;
            document.getElementById('observacionb').value = data.observacion;
            document.getElementById('btn-actualizar').onclick = function(){editarProducto(data.id)};
        }
    )
}
function editarProducto(id){
    $.ajax({
        type: "POST",
        url: "actualizarRegistro.php",
        dataType: 'json',
        data: {
            id: id,
            nInven: document.getElementById('nInvenb').value,
            codigo: document.getElementById('codigob').value,
            denominacion: document.getElementById('denominacionb').value,
            marca: document.getElementById('marcab').value,
            modelo: document.getElementById('modelob').value,
            tipo: document.getElementById('tipob').value,
            color: document.getElementById('colorb').value,
            serie: document.getElementById('serieb').value,
            estado: document.getElementById('estadob').value,
            fecha: document.getElementById('fechab').value,
            valor: document.getElementById('valorb').value,
            observacion: document.getElementById('observacionb').value
        }
    }).done(
        function (data) {
            document.getElementById('btn-actualizar').disabled = true;
            alertify.success(data.message);
            setTimeout(function(){location.reload()}, 1000);
        }
    )
}
function abrirModalEliminarProducto(id){
    $.ajax({
        type: "POST",
        url: "modalEliminarRegistro.php",
        dataType: 'json',
        data: {
            id: id
        }
    }).done(
        function (data) {
            document.getElementById('codigoRegistro').innerHTML = data.nInven;
            document.getElementById('btn-eliminar').onclick = function(){eliminarProducto(data.id)};
        }
    )
}
function eliminarProducto(id){
    $.ajax({
        type: "POST",
        url: "eliminarRegistro.php",
        dataType: 'json',
        data: {
            id: id
        }
    }).done(
        function (data) {
            console.log(data);
            document.getElementById('btn-eliminar').disabled = true;
            alertify.success(data.message);
            setTimeout(function(){location.reload()}, 1000);
        }
    )
}
function exportarExcel(){
    var tabla = document.getElementById("tabla");
    var fecha = new Date();
    var dia = fecha.getDate() < 10 ? '0' + fecha.getDate() : fecha.getDate();
    var mes = fecha.getMonth() < 10 ? '0' + fecha.getMonth() : fecha.getMonth();
    var anio = fecha.getFullYear();
    var filename = 'Reporte'+ ' ' + dia + '-' + mes + '-' + anio + '.xls';
    var html = tabla.outerHTML;
    var blob = new Blob(['\ufeff', html], {
        type: 'application/vnd.ms-excel',
    })

    var a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = filename;
    a.click();
}