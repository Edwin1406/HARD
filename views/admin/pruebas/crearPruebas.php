<!-- <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header> -->

<!-- <div class="page-heading"> -->


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

<!-- <section class="section">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="">Tabla pruebas</a>
                </li>
            </ul>
        </div>
    </section> -->




<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <!-- <div class="card"> -->
            <div class="card-content mt-0">
                <div class="card-body">
                    <div class="alert alert-info py-2">
                        <div class="row align-items-center">

                            <div class="col-md-2 col-6">
                                <small class="text-muted">Nota de pedido N°</small><br>
                                <span class="fw-bold"><?php echo $id_nota; ?></span>
                            </div>

                            <div class="col-md-1 col-6">
                                <small class="text-muted"># Pedido</small><br>
                                <span class="fw-bold"><?php echo $informacionNota->Numero_Nota_Pedido; ?></span>
                            </div>

                            <div class="col-md-1 col-6">
                                <small class="text-muted"># Import</small><br>
                                <span class="fw-bold"><?php echo $informacionNota->Codigo_Importacion ?? '-'; ?></span>
                            </div>

                            <div class="col-md-2 col-6">
                                <small class="text-muted">Fecha</small><br>
                                <span class="fw-bold"><?php echo date("d/m/Y", strtotime($fecha)); ?></span>
                            </div>

                            <div class="col-md-3 col-12">
                                <small class="text-muted">Importador</small><br>
                                <span class="fw-bold"><?php echo $informacionNota->Codigo_Importador ?? '-'; ?></span>
                            </div>

                            <div class="col-md-3 col-12">
                                <small class="text-muted">Exportador</small><br>
                                <span class="fw-bold"><?php echo $informacionNota->Codigo_Exportador ?? '-'; ?></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
</section>


<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">

                <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="/admin/pruebas/crearPruebas" enctype="multipart/form-data" onsubmit="return bloquearBoton(this)">
                            <div class="row">
                                <div class="col-md-5 col-12">
                                    <div class="form-group">
                                        <label for="importador">Tienda</label>
                                        <select id="importador" class="choices form-control" name="importador">
                                            <option value="" disabled selected>Seleccione una tienda</option>
                                            <?php foreach ($tiendas as $tienda) : ?>
                                                <option value="<?php echo $tienda->Nombre_Tienda; ?>" <?php echo (isset($importador) && $importador === $tienda->Nombre_Tienda) ? 'selected' : ''; ?>>
                                                    <?php echo $tienda->Nombre_Tienda; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- fecha -->




                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input type="date" id="fecha" class="form-control"
                                            name="fecha" value="<?php echo $fecha; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for=""># Factura</label>
                                        <input type="number" id="nota_pedido" class="form-control"
                                            placeholder="# Factura" name="nota_pedido" step="0.01"
                                            value="<?php echo $id_nota; ?>" readonly>
                                    </div>
                                </div>

                                <!-- marca -->


                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="marca">Marca</label>
                                           <select id="importador" class="choices form-control" name="importador">
                                            <option value="" disabled selected>Seleccione una Marca</option>
                                            <?php foreach ($marca as $marcas) : ?>
                                                <option value="<?php echo $marcas->Nombre_Marca; ?>" <?php echo (isset($importador) && $importador === $marcas->Nombre_Marca) ? 'selected' : ''; ?>>
                                                    <?php echo $marcas->Nombre_Marca; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>



                                <!-- origen  -->

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="origen">Origen</label>
                                          <select id="importador" class="choices form-control" name="importador">
                                            <option value="" disabled selected>Seleccione una Pais</option>
                                            <?php foreach ($pais as $paises) : ?>
                                                <option value="<?php echo $paises->Pais_Origen; ?>" <?php echo (isset($importador) && $importador === $paises->Pais_Origen) ? 'selected' : ''; ?>>
                                                    <?php echo $paises->Pais_Origen; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                                <!-- bodega -->
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="bodega">Bodega</label>
                                            <select id="bodega" class="choices form-control" name="bodega">
                                            <option value="" disabled selected>Seleccione una Bodega</option>
                                            <?php foreach ($bodega as $bodegas) : ?>
                                                <option value="<?php echo $bodegas->Nombre_Bodega; ?>" <?php echo (isset($importador) && $importador === $bodegas->Nombre_Bodega) ? 'selected' : ''; ?>>
                                                    <?php echo $bodegas->Nombre_Bodega; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="Numero_Nota_Pedido"></label>
                                        <input type="number" id="Numero_Nota_Pedido" class="form-control"
                                            placeholder="# Pedido" name="Numero_Nota_Pedido" step="0.01" value="<?php echo $informacionNota->Numero_Nota_Pedido; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="Codigo_Importacion"></label>
                                        <input type="number" id="Codigo_Importacion" class="form-control"
                                            placeholder="# Importación" name="Codigo_Importacion" value="<?php echo $informacionNota->Codigo_Importacion; ?>" readonly step="0.01">
                                    </div>
                                </div>

                                <!-- fecha -->
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input type="date" id="fecha" class="form-control"
                                            name="fecha" value="<?php echo $fecha; ?>" required>
                                    </div>
                                </div>


                                <div class="row">
                                    <!-- importador select -->
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            <label for="importador">Tienda</label>
                                            <select id="importador" class="choices form-control" name="importador">
                                                <option value="" disabled selected>Seleccione una tienda</option>
                                                <?php foreach ($tiendas as $tienda) : ?>
                                                    <option value="<?php echo $tienda->Nombre_Tienda; ?>" <?php echo (isset($importador) && $importador === $tienda->Nombre_Tienda) ? 'selected' : ''; ?>>
                                                        <?php echo $tienda->Nombre_Tienda; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <div class="form-group">
                                            <label for="exportador">Exportador</label>
                                            <select id="exportador" class="choices form-control" name="exportador">
                                                <option value="" disabled selected>Seleccione un exportador</option>
                                                <option value="INDUSTRIAS CARTONAJES S.A">INDUSTRIAS CARTONAJES S.A</option>
                                                <option value="INDUSTRIAS CARTONAJES DEL PERU S.A.C">INDUSTRIAS CARTONAJES DEL PERU S.A.C</option>
                                                <option value="INDUSTRIAS CARTONAJES DE COLOMBIA S.A.S">INDUSTRIAS CARTONAJES DE COLOMBIA S.A.S</option>
                                                <option value="INDUSTRIAS CARTONAJES DE CHILE LTDA">INDUSTRIAS CARTONAJES DE CHILE LTDA</option>
                                                <option value="INDUSTRIAS CARTONAJES DE MEXICO S.A. DE C.V.">INDUSTRIAS CARTONAJES DE MEXICO S.A. DE C.V.</option>
                                                <option value="INDUSTRIAS CARTONAJES DE ECUADOR S.A.">INDUSTRIAS CARTONAJES DE ECUADOR S.A.</option>
                                            </select>
                                        </div>
                                    </div>


                                    <style>




                                    </style>






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
                            <th class="fs-6" style="min-width: 90px;">tipo</th>
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
                            <label for="consumo_papel">C</label>
                            <input type="number" step="0.01" id="consumo_papel"
                                class="form-control" placeholder=")" name="consumo_papel" required>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="n_laminas">N° de</label>
                            <input type="number" id="n_laminas" class="form-control"
                                placeholder="N° " name="n_laminas">
                        </div>
                    </div>


                    <div class="col-md-3 col-12">

                        <div class="form-group">
                            <label for="metros_lineales_C">Metros</label>
                            <input type="number" id="metros_lineales_C" class="form-control"
                                placeholder="Metr" name="metros_lineales_C">
                        </div>

                    </div>
                </div>

                <!-- Fila 2 -->
                <div class="row g-3 mt-1">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="metros_lineales_B">Met</label>
                            <input type="number" id="metros_lineales_B" class="form-control"
                                placeholder="Me" name="metros_lineales_B">
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="metros_lineales">met</label>
                            <input type="number" id="metros_lineales_E" class="form-control"
                                placeholder="Met" name="metros_lineales_E">
                        </div>
                    </div>

                    <div class="col-md-3 col-12 ">
                        <div class="form-group">
                            <label for="consumo_recubrimiento">Con </label>
                            <input type="number" step="0.01" id="consumo_recubrimiento" class="form-control"
                                placeholder="Co)" name="consumo_recubrimiento">
                        </div>
                    </div>

                    <!-- NECESITO UN SELECT CON OPERADORES EN EL HTML  -->

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="operador"></label>
                            <select id="operador" class="choices form-control" name="operador">
                                <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione </option>

                                <!-- CONTROLABLES -->
                                <option value="EDWIN" <?php echo (isset($operador) && $operador === 'EDWIN') ? 'selected' : ''; ?>>EDWIN</option>

                            </select>

                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="n_cambios">N° de </label>
                                <input type="number" id="n_cambios" class="form-control"
                                    placeholder="N° de " name="n_cambios">
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="turno">fd</label>
                                <select class="form-select" name="turno" id="turno">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-12 <?php echo (trim(strtolower($email)) !== 'corrugador@megaecuador.com') ? 'd-none' : ''; ?>">
                            <div class="form-group">
                                <label for="consumo_almidon"> (Kg)</label>
                                <input type="number" step="0.01" id="consumo_almidon" class="form-control"
                                    placeholder="Con)" name="consumo_almidon">
                            </div>
                        </div>

                        <div class="col-md-3 col-12 <?php echo (trim(strtolower($email)) !== 'corrugador@megaecuador.com') ? 'd-none' : ''; ?>">
                            <div class="form-group">
                                <label for="consumo_resina"> (Kg)</label>
                                <input type="number" step="0.01" id="consumo_resina" class="form-control"
                                    placeholder="Con)" name="consumo_resina">
                            </div>
                        </div>


                    </div>
                    <div class="row g-3 mt-1">

                        <div class="col-md-3 col-12">

                            <div class="form-group">
                                <label for="metros_lineales">ghgfh</label>
                                <input type="number" id="metros_lineales" class="form-control"
                                    placeholder="Me" name="metros_lineales">
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