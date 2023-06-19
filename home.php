<!DOCTYPE html>
<html lang="en">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<?php 
    include 'components/head.php';
    include 'bd.php';
?>
<body>
    <?php include 'components/menu.php';?>
    <section class="max-container home">
        <div id="mensaje" class="alert alert-danger" role="alert">
            No hay registros en el inventario
        </div>
        <div class="box-table">
            <table class="table table-striped table-bordered" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">N° de inv Interno</th>
                        <th scope="col">Código patrimonial</th>
                        <th scope="col">Denominación</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Color</th>
                        <th scope="col">Serie / Dimensiones</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha de adquisición</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody id="productos">
                </tbody>
            </table>
        </div>
        <button onclick="exportarExcel()" type="button" class="btn btn-warning">Exportar Excel <img class="excel" src="assets/img/excel.png" alt=""></button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregar">Agregar Registro</button>

        <div class="modal fade" id="agregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Registro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text">N° Inven Interno</span>
                        <input id="nInven" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Código Patrimonial</span>
                        <input id="codigo" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Denominación</span>
                        <input id="denominacion" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Marca</span>
                        <input id="marca" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Modelo</span>
                        <input id="modelo" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Tipo</span>
                        <input id="tipo" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Color</span>
                        <input id="color" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Serie / Dimensiones</span>
                        <input id="serie" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Estado</span>
                        <select class="form-control" id="estado">
                            <option disabled selected value="">Seleccione</option>
                            <option value="Bueno">Bueno</option>
                            <option value="Regular">Regular</option>
                            <option value="Malo">Malo</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Fecha de Adquisición</span>
                        <input id="fecha" type="date" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Valor S/</span>
                        <input id="valor" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Observaciones</span>
                        <input id="observacion" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btn-agregar" onclick="agregarProducto()" type="button" class="btn btn-success">Guardar</button>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Registro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text">N° Inven Interno</span>
                        <input id="nInvenb" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Código Patrimonial</span>
                        <input id="codigob" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Denominación</span>
                        <input id="denominacionb" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Marca</span>
                        <input id="marcab" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Modelo</span>
                        <input id="modelob" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Tipo</span>
                        <input id="tipob" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Color</span>
                        <input id="colorb" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Serie / Dimensiones</span>
                        <input id="serieb" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Estado</span>
                        <select class="form-control" id="estadob">
                            <option disabled selected value="">Seleccione</option>
                            <option value="Bueno">Bueno</option>
                            <option value="Regular">Regular</option>
                            <option value="Malo">Malo</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Fecha de Adquisición</span>
                        <input id="fechab" type="date" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Valor S/</span>
                        <input id="valorb" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Observaciones</span>
                        <input id="observacionb" type="text" class="form-control" placeholder="Escriba aquí">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btn-actualizar" type="button" class="btn btn-success">Actualizar</button>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="eliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar Registro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro que desea eliminar el registro con N° de inventario <b><span id="codigoRegistro"></span></b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btn-eliminar" type="button" class="btn btn-success">Eliminar</button>
                </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'components/footer.php';?>
    <script src="assets/js/script.js?2.4"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="assets/js/buscador.js?1.4"></script>
</body>
</html>