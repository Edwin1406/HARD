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




    <?php
    $toastId = null;
    $toastMessage = null;
    $toastClass = null;
    $paramToRemove = null;

    if (isset($_GET['exito']) && $_GET['exito'] == '1') {
        $toastId = 'toastExito';
        $toastMessage = '¡Registro creado!';
        $toastClass = 'text-bg-success';
        $paramToRemove = 'exito';
    } elseif (isset($_GET['editado']) && $_GET['editado'] == '2') {
        $toastId = 'toastEditado';
        $toastMessage = '¡Registro editado correctamente!';
        $toastClass = 'text-bg-primary';
        $paramToRemove = 'editado';
    } elseif (isset($_GET['eliminado']) && $_GET['eliminado'] == '3') {
        $toastId = 'toastEliminado';
        $toastMessage = '¡Registro eliminado correctamente!';
        $toastClass = 'text-bg-danger';
        $paramToRemove = 'eliminado';
    }
    ?>

    <?php if ($toastId) : ?>
        <!-- Toast HTML -->
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="<?php echo $toastId; ?>" class="toast align-items-center <?php echo $toastClass; ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?php echo $toastMessage; ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <!-- Toast JS -->
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                var toastEl = document.getElementById('<?php echo $toastId; ?>');
                if (toastEl) {
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                }

                const url = new URL(window.location);
                url.searchParams.delete('<?php echo $paramToRemove; ?>');
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
                            <form class="form" method="POST" action="/admin/notaPedido/CrearTienda" onsubmit="return bloquearBoton(this)">
                                <input type="hidden" name="id_nota_pedido" value="<?php echo $id_nota_pedido; ?>">
                                <div class="row">
                                  
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="tienda">Tienda</label>
                                            <input type="text" id="tienda" class="form-control" name="tienda" placeholder="Ingrese el nombre de la tienda" value="<?php echo isset($_POST['tienda']) ? htmlspecialchars($_POST['tienda']) : ''; ?>">
                                        </div>
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



    <script>
        function bloquearBoton(form) {
            const btn = form.querySelector('#btnRegistrar');
            btn.disabled = true; // Deshabilita el botón
            btn.innerText = "Registrando..."; // Cambia el texto (opcional)
            return true; // Permite que el formulario se envíe
        }
    </script>