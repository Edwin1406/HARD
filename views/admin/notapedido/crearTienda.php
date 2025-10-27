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
                            <?php foreach ($alertas as $tipo => $mensajes) : ?>
                                <?php foreach ($mensajes as $mensaje) : ?>
                                    <div class="alert alert-<?= $tipo ?> alert-dismissible fade show" role="alert">
                                        <?= $mensaje ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>



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
                                            <label for="tienda">Tienda</label>
                                            <input type="text" id="tienda" class="form-control"
                                                placeholder="Tienda" name="tienda">
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




                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" id="btnRegistrar" class="btn btn-primary me-1 mb-1">Registrar</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Limpiar</button>
                                    </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<script>
    function bloquearBoton(form) {
        const btn = form.querySelector('#btnRegistrar');
        btn.disabled = true; // Deshabilita el botón
        btn.innerText = "Registrando..."; // Cambia el texto (opcional)
        return true; // Permite que el formulario se envíe
    }
</script>