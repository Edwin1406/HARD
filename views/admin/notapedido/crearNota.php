<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?php echo $titulo ?> </h3>
                <p class="text-subtitle text-muted">Ingrese la secuencia de la Nota de Pedido</p>
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





    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="/admin/notaPedido/crearNota" onsubmit="return bloquearBoton(this)">
                                <div class="row">

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Codigo_Nota_Pedido">Nota de pedido N°</label>
                                            <input type="number" id="Codigo_Nota_Pedido" class="form-control"
                                                placeholder="Nota de pedido N°" name="Codigo_Nota_Pedido">
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Numero_Nota_Pedido"></label>
                                            <input type="number" id="Numero_Nota_Pedido" class="form-control"
                                                placeholder="# Pedido" name="Numero_Nota_Pedido">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Codigo_Importacion"></label>
                                            <input type="text" id="Codigo_Importacion" class="form-control"
                                                placeholder="# Importación" name="Codigo_Importacion">
                                        </div>
                                    </div>

                                    <!-- fecha -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Fecha_Nota_Pedido">Fecha</label>
                                            <input type="date" id="Fecha_Nota_Pedido" class="form-control"
                                                name="Fecha_Nota_Pedido" value="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <section id="basic-vertical-layouts">
                                            <div class="row match-height">
                                                <div class="col-md-4 col-12">
                                                    <div class="card" style="background-color: #dacdcdff;">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form class="form form-vertical">
                                                                    <div class="form-body">
                                                                        <div class="row">

                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="Codigo_Importador">Importador</label>
                                                                                    <div class="position-relative">

                                                                                        <select id="Codigo_Importador" class="choices form-control" name="Codigo_Importador">
                                                                                            <option value="" disabled selected>Seleccione un importador</option>
                                                                                            <?php foreach ($importadores as $importador): ?>
                                                                                                <option value="<?php echo s($importador->Nombre_Importador); ?>"><?php echo s($importador->Nombre_Importador); ?></option>
                                                                                            <?php endforeach; ?>
                                                                                        </select>

                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <script>
                                                                                document.addEventListener("DOMContentLoaded", function() {
                                                                                    const importador = document.getElementById("Codigo_Importador");
                                                                                    const remitente = document.getElementById("Remitir_Nota_Pedido");

                                                                                    importador.addEventListener("change", function() {
                                                                                        remitente.value = importador.value;
                                                                                    });
                                                                                });
                                                                            </script>



                                                                            <!-- <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="email-id-vertical">Email</label>
                                                                                    <input type="email" id="email-id-vertical"
                                                                                        class="form-control" name="email-id"
                                                                                        placeholder="Email">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="contact-info-vertical">Mobile</label>
                                                                                    <input type="number" id="contact-info-vertical"
                                                                                        class="form-control" name="contact"
                                                                                        placeholder="Mobile">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="password-vertical">Password</label>
                                                                                    <input type="password" id="password-vertical"
                                                                                        class="form-control" name="contact"
                                                                                        placeholder="Password">
                                                                                </div>
                                                                            </div> -->

                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="card" style="background-color: #dacdcdff;">

                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form class="form form-vertical">
                                                                    <div class="form-body">
                                                                        <div class="row">

                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="Codigo_Exportador">Exportador</label>
                                                                                    <div class="position-relative">
                                                                                        <select id="Codigo_Exportador" class="choices form-control" name="Codigo_Exportador">
                                                                                            <option value="" disabled selected>Seleccione un exportador</option>
                                                                                            <?php foreach ($exportadores as $exportador): ?>
                                                                                                <option value="<?php echo s($exportador->id); ?>"><?php echo s($exportador->Nombre_Exportador); ?></option>
                                                                                            <?php endforeach; ?>
                                                                                        </select>    
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- <div class="col-12">

                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="email-id-icon">Email</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" class="form-control"
                                                                                            placeholder="Email" id="email-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-envelope"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="mobile-id-icon">Mobile</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" class="form-control"
                                                                                            placeholder="Mobile" id="mobile-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-phone"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="password-id-icon">Password</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="password" class="form-control"
                                                                                            placeholder="Password" id="password-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-lock"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div> -->
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="card" style="background-color: #dacdcdff;">

                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form class="form form-vertical">
                                                                    <div class="form-body">
                                                                        <div class="row">


                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="Remitir_Nota_Pedido">Remitir Doc a</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" class="form-control"
                                                                                            placeholder="Remitir Doc a"
                                                                                            id="Remitir_Nota_Pedido" name="Remitir_Nota_Pedido">

                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-12">

                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="Pais_Nota_Pedido">Pais/origen</label>
                                                                                    <div class="position-relative">

                                                                                        <select id="Pais_Nota_Pedido" class="choices form-control" name="Pais_Nota_Pedido">
                                                                                            <option value="" disabled selected>Seleccione un país</option>
                                                                                            <?php foreach ($pais as $paises): ?>
                                                                                                <option value="<?php echo s($paises->Pais_Origen); ?>"><?php echo s($paises->Pais_Origen); ?></option>
                                                                                            <?php endforeach; ?>
                                                                                        </select>


                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="Forma_Pago_Nota_Pedido">Forma de pago</label>
                                                                                    <div class="position-relative">

                                                                                        <select class="form-select" id="Forma_Pago_Nota_Pedido" name="Forma_Pago_Nota_Pedido">
                                                                                            <option value="" disabled selected>Seleccione una forma de pago</option>
                                                                                            <option value="Contado">Contado</option>
                                                                                            <option value="Crédito">Crédito</option>
                                                                                            <option value="Transferencia">Transferencia</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="Moneda_Nota_Pedido">Moneda</label>
                                                                                    <div class="position-relative">
                                                                                        <select class="form-select" id="Moneda_Nota_Pedido" name="Moneda_Nota_Pedido">
                                                                                            <option value="">Seleccionar moneda</option>
                                                                                            <option value="USD">USD</option>
                                                                                            <option value="EUR">EUR</option>
                                                                                            <option value="GBP">GBP</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" id="btnRegistrar" class="btn btn-primary me-1 mb-1">Registrar</button>
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
</div>

  <section class="section">
        <div class="card">
            <div class="card-header">
                Tabla de registros de Notas de Pedido
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th class="fs-6" style="min-width: 90px;">Id</th>
                            <th class="fs-6" style="min-width: 93px;">Codigo Nota Pedido</th>
                            <th class="fs-6" style="min-width: 100px;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($notasPedidos as $notaItem): ?>
                            <tr>
                                <td><?= $notaItem->id ?></td>
                                <td><?= $notaItem->Codigo_Nota_Pedido ?></td>
                                <td>

                                    <div class="d-flex gap-1">
                                        <a href="/admin/pruebas/aaa?id=<?= $notaItem->Codigo_Nota_Pedido ?>" class="btn btn-primary btn-sm">Jalar Codigo_Nota_Pedido </a>
                                        <!-- <form action="/admin/eliminarPruebas" method="POST">
                                            <input type="hidden" name="id" value="<?= $notaItem->id ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form> -->
                                    </div>

                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>






<script>
    function bloquearBoton(form) {
        const btn = form.querySelector('#btnRegistrar');
        btn.disabled = true; // Deshabilita el botón
        btn.innerText = "Registrando..."; // Cambia el texto (opcional)
        return true; // Permite que el formulario se envíe
    }
</script>