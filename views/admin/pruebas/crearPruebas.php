<!-- <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header> -->

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?php echo $titulo ?> </h3>
                <p class="text-subtitle text-muted">Ingrese los datos de prueba</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a><?php echo $nombre; ?></a></li>
                        <!--  cerrar sesión -->
                        <li class="breadcrumb-item"><a href="/cerrarSesion">Cerrar Sesión</a></li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="toastExito" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ¡Registro guardado exitosamente!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php if (isset($_GET['exito']) && $_GET['exito'] == '1') : ?>
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                // Mostrar el toast
                var toastEl = document.getElementById('toastExito');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();

                // Quitar el parámetro ?exito=1 de la URL sin recargar
                const url = new URL(window.location);
                url.searchParams.delete('exito');
                window.history.replaceState({}, document.title, url.toString());
            });
        </script>
    <?php endif; ?>

    <section class="section">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="">Tabla pruebas</a>
                </li>
            </ul>
        </div>
    </section>


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">REGISTRO DE PRUEBAS</h4>
                        <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>


                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="/admin/pruebas/crearPruebas" enctype="multipart/form-data" onsubmit="return bloquearBoton(this)">
                                <div class="row">



                                    <!-- 
                                    <div class="col-md-6 col-12">
                                        <label for="tipo_clasificacion">Escoja la clasificación</label>
                                        <div class="form-group">
                                            <select class="form-select" name="tipo_clasificacion" id="tipo_clasificacion">
                                                <option value="CONTROLABLE">CONTROLABLE</option>
                                                <option value="NO_CONTROLABLE">NO CONTROLABLE</option>
                                            </select>
                                        </div>
                                    </div> -->


                                    <!-- quiero tomar el nombre del usuario y si es corruugador solo me parezcan del corrgador-->


                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="casos">CASOS</label>
                                            <select id="casos" class="choices form-control" name="casos">
                                                <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione un caso</option>

                                                <!-- CONTROLABLES -->
                                                <option value="APROBACION DE COLOR">APROBACION DE COLOR</option>
                                                <option value="CAMBIO DE MEDIDA">CAMBIO DE MEDIDA</option>
                                                <option value="COMBADO">COMBADO</option>
                                                <option value="CUADRE">CUADRE</option>
                                                <option value="CUADRE SIERRA">CUADRE SIERRA</option>
                                                <option value="DAÑO CLICHE">DAÑO CLICHE</option>
                                                <option value="DERRAME DE TINTA">DERRAME DE TINTA</option>
                                                <option value="DESPEGADO">DESPEGADO</option>
                                                <option value="DISEÑO MAQUINA">DISEÑO MAQUINA</option>
                                                <option value="EMPALME">EMPALME</option>
                                                <option value="ERROR MEDIDA">ERROR MEDIDA</option>
                                                <option value="EXCESO DE GOMA">EXCESO DE GOMA</option>
                                                <option value="FALTA DE TINTA">FALTA DE TINTA</option>
                                                <option value="FRENO">FRENO</option>
                                                <option value="GALLETEADO">GALLETEADO</option>
                                                <option value="HUMEDO">HUMEDO</option>
                                                <option value="MAL DOBLADO CEJA">MAL DOBLADO CEJA</option>
                                                <option value="MALTRATO OPERADOR MONTACARGAS">MALTRATO OPERADOR MONTACARGAS</option>
                                                <option value="MALTRATO TRANSPORTACIÓN">MALTRATO TRANSPORTACIÓN</option>
                                                <option value="PH">PH</option>
                                                <option value="PRESION">PRESION</option>
                                                <option value="PRE PRINTER">PRE PRINTER</option>
                                                <option value="RECUBRIMIENTO">RECUBRIMIENTO</option>
                                                <option value="SF">SF</option>
                                                <option value="TONALIDAD TINTAS">TONALIDAD TINTAS</option>
                                                <option value="VISCOSIDAD">VISCOSIDAD</option>

                                                <!-- NO CONTROLABLES -->
                                                <option value="CAMBIO DE GRAMAJE">CAMBIO DE GRAMAJE</option>
                                                <option value="CAMBIO PEDIDO">CAMBIO PEDIDO</option>
                                                <option value="CIREL CORTADO">CIREL CORTADO</option>
                                                <option value="COMBADA">COMBADA</option>
                                                <option value="DESCUADRE DE DOBLADO">DESCUADRE DE DOBLADO</option>
                                                <option value="DESHOJE">DESHOJE</option>
                                                <option value="DIFERENCIA DE PESO">DIFERENCIA DE PESO</option>
                                                <option value="DIFERENTES ANCHOS">DIFERENTES ANCHOS</option>
                                                <option value="ELECTRICO">ELECTRICO</option>
                                                <option value="ERROR MEDIDA CORRUGADOR">ERROR MEDIDA CORRUGADOR</option>
                                                <option value="EXCEDENTES DE PLANCHA">EXCEDENTES DE PLANCHA</option>
                                                <option value="EXTRA TRIM">EXTRA TRIM</option>
                                                <option value="FILOS ROTOS">FILOS ROTOS</option>
                                                <option value="INICIO DE CORRIDA">INICIO DE CORRIDA</option>
                                                <option value="LAMINA HUMEDA">LAMINA HUMEDA</option>
                                                <option value="MECANICO">MECANICO</option>
                                                <option value="MERMA">MERMA</option>
                                                <option value="MONTAJE CLICHE PROVEEDOR">MONTAJE CLICHE PROVEEDOR</option>
                                                <option value="PEDIDOS CORTOS">PEDIDOS CORTOS</option>
                                                <option value="REFILE PEQUEÑO">REFILE PEQUEÑO</option>
                                                <option value="REFILES">REFILES</option>
                                                <option value="REGISTRO TROQUEL">REGISTRO TROQUEL</option>
                                                <option value="SUSTRATO">SUSTRATO</option>
                                                <option value="TROQUEL">TROQUEL</option>
                                                <option value="SOPLADO">SOPLADO</option>
                                                <option value="CALDERO">CALDERO</option>
                                                <option value="COMPRESOR">COMPRESOR</option>

                                            </select>

                                        </div>
                                    </div>

                                    <!-- cantidad cajas deciamles soporte  -->
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad (Kg)</label>
                                            <input type="number" id="cantidad" class="form-control"
                                                placeholder="Cantidad" name="cantidad" step="0.01">
                                        </div>
                                    </div>

                                    <!-- observaciones -->

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <input type="text" id="observaciones" class="form-control"
                                                placeholder="Observaciones" name="observaciones">
                                        </div>
                                    </div>



                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Agregar</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Limpiar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Tabla de Pruebas
            </div>

            <div class="card-body">

                <!-- Contenedor responsive -->
                <div class="table-responsive">
                    <table class="table table-striped w-100" id="table1">
                        <thead>
                            <tr>
                                <th class="fs-6" style="min-width: 90px;">ID</th>
                                <th class="fs-6" style="min-width: 90px;">id_usuario</th>
                                <th class="fs-6" style="min-width: 90px;">tipo_maquina</th>
                                <!-- <th class="fs-6" style="min-width: 90px;">tipo_clasificacion</th> -->
                                <th class="fs-6" style="min-width: 90px;">casos</th>
                                <th class="fs-6" style="min-width: 80px;">Cantidad</th>
                                <th class="fs-6" style="min-width: 100px;">Observaciones</th>
                                <th class="fs-6" style="min-width: 100px;">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($carritoTemporal as $contro): ?>
                                <tr>
                                    <td><?= $contro->id ?></td>
                                    <td><?= $contro->id_usuario ?></td>
                                    <td><?= $contro->tipo_maquina ?></td>
                                    <td><?= $contro->casos ?></td>
                                    <td><?= $contro->cantidad ?></td>
                                    <td><?= $contro->observaciones ?></td>

                                    <td>
                                        <div class="d-flex gap-1">
                                            <!-- <a href="/admin/editarConsumo?id=<?= $contro->id ?>" class="btn btn-primary btn-sm">Editar</a> -->
                                            <form action="/admin/eliminarCarrito" method="POST">
                                                <input type="hidden" name="id" value="<?= $contro->id ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td><b>Total</b></td>
                                <td><?= array_sum(array_column($carritoTemporal, 'cantidad'))  ?>(KG)</td>

                                <td colspan="5"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <form action="/admin/pruebas/registrarVenta" method="POST">
                    <!-- Fila 1 -->
                    <div class="row g-3">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" id="fecha" class="form-control"
                                    name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="consumo_papel">Consumo papel (Kg)</label>
                                <input type="number" step="0.01" id="consumo_papel"
                                    class="form-control" placeholder="Consumo papel (Kg)" name="consumo_papel" required>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="n_laminas">N° de Laminas</label>
                                <input type="number" id="n_laminas" class="form-control"
                                    placeholder="N° de Laminas" name="n_laminas">
                            </div>
                        </div>


                        <div class="col-md-3 col-12">

                            <div class="form-group">
                                <label for="metros_lineales_C">Metros Lineales C</label>
                                <input type="number" id="metros_lineales_C" class="form-control"
                                    placeholder="Metros Lineales C" name="metros_lineales_C">
                            </div>

                        </div>
                    </div>

                    <!-- Fila 2 -->
                    <div class="row g-3 mt-1">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="metros_lineales_B">Metros Lineales B</label>
                                <input type="number" id="metros_lineales_B" class="form-control"
                                    placeholder="Metros Lineales B" name="metros_lineales_B">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="metros_lineales">Metros Lineales E</label>
                                <input type="number" id="metros_lineales_E" class="form-control"
                                    placeholder="Metros Lineales E" name="metros_lineales_E">
                            </div>
                        </div>

                        <div class="col-md-3 col-12 <?php echo (trim(strtolower($email)) !== 'corrugador@megaecuador.com') ? 'd-none' : ''; ?>">
                            <div class="form-group">
                                <label for="consumo_recubrimiento">Consumo Recubrimiento (Kg)</label>
                                <input type="number" step="0.01" id="consumo_recubrimiento" class="form-control"
                                    placeholder="Consumo Recubrimiento (Kg)" name="consumo_recubrimiento">
                            </div>
                        </div>

                        <!-- NECESITO UN SELECT CON OPERADORES EN EL HTML  -->

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="operador">OPERADOR</label>
                                <select id="operador" class="choices form-control" name="operador">
                                    <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione un operador</option>

                                    <!-- CONTROLABLES -->
                                    <option value="RAFAEL ORTEGA">RAFAEL ORTEGA</option>
                                    <option value="GEOVANNY MANTILLA">GEOVANNY MANTILLA</option>
                                    <option value="WILLIAM NAULA">WILLIAM NAULA</option>
                                    <option value="MARCO TAPIA">MARCO TAPIA</option>
                                    <option value="KEVIN DELGADO">KEVIN DELGADO</option>
                                </select>

                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="n_cambios">N° de Cambios</label>
                                    <input type="number" id="n_cambios" class="form-control"
                                        placeholder="N° de Cambios" name="n_cambios">
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="turno">Turno</label>
                                    <select class="form-select" name="turno" id="turno">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-12 <?php echo (trim(strtolower($email)) !== 'corrugador@megaecuador.com') ? 'd-none' : ''; ?>">
                                <div class="form-group">
                                    <label for="consumo_almidon">Consumo Almidón (Kg)</label>
                                    <input type="number" step="0.01" id="consumo_almidon" class="form-control"
                                        placeholder="Consumo Almidón (Kg)" name="consumo_almidon">
                                </div>
                            </div>

                            <div class="col-md-3 col-12 <?php echo (trim(strtolower($email)) !== 'corrugador@megaecuador.com') ? 'd-none' : ''; ?>">
                                <div class="form-group">
                                    <label for="consumo_resina">Consumo Resina (Kg)</label>
                                    <input type="number" step="0.01" id="consumo_resina" class="form-control"
                                        placeholder="Consumo Resina (Kg)" name="consumo_resina">
                                </div>
                            </div>


                        </div>
                        <div class="row g-3 mt-1">

                            <div class="col-md-3 col-12">

                                <div class="form-group">
                                    <label for="metros_lineales">Metros Lineales</label>
                                    <input type="number" id="metros_lineales" class="form-control"
                                        placeholder="Metros Lineales" name="metros_lineales">
                                </div>
                            </div>

                        </div>




                        <!-- Botón -->
                        <div class="col-12 d-flex justify-content-end mt-3">
                            <button type="submit" id="btnRegistrar" class="btn btn-primary me-1 mb-1">Registrar Sucesos</button>
                        </div>
                </form>








            </div>
            <!-- boton de registrar -->
        </div>
    </section>

    <!-- CSS opcional para evitar que se rompa texto en celdas -->
    <style>
        #table1 th,
        #table1 td {
            white-space: nowrap;
        }
    </style>




<script>
function bloquearBoton(form) {
  const btn = form.querySelector('#btnRegistrar');
  btn.disabled = true; // Deshabilita el botón
  btn.innerText = "Registrando..."; // Cambia el texto (opcional)
  return true; // Permite que el formulario se envíe
}
</script>





</div>




