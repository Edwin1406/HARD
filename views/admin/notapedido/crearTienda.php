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
                url.searchParams.delete('exito'); // Eliminar solo 'exito'
                // Mantener el parámetro 'id'
                const idNotaPedido = url.searchParams.get('id');
                if (idNotaPedido) {
                    url.searchParams.set('id', idNotaPedido);
                }
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



                            <form class="form" method="POST" action="/admin/notaPedido/crearTienda" onsubmit="return bloquearBoton(this)">

                                <input type="hidden" name="id_nota_pedido" value="<?php echo $id_nota_pedido; ?>">


                                <div class="row">

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Codigo_Nota_Pedido">Nota de pedido N°</label>
                                            <input type="number" id="Codigo_Nota_Pedido" class="form-control"
                                                placeholder="Nota de pedido N°" name="Codigo_Nota_Pedido"
                                                value="<?php echo $id_nota_pedido; ?>" readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="tienda">Tienda</label>
                                            <input type="text" id="tienda" class="form-control"
                                                placeholder="Tienda" name="tienda">
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




<section class="section">
    <div class="card">
        <div class="card-header">
            Tabla de registros de Bodegas
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th class="fs-6" style="min-width: 90px;">Id</th>
                        <th class="fs-6" style="min-width: 93px;">Nombre Bodega</th>
                        <th class="fs-6" style="min-width: 80px;">Siglas Bodega</th>
                        <th class="fs-6" style="min-width: 100px;">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($tiendaNotas as $bodegaItem): ?>
                        <tr>
                            <td><?= $bodegaItem->id ?></td>
                            <td><?= $bodegaItem->Codigo_Nota_Pedido?></td>
                            <td><?= $bodegaItem->tienda ?></td>
                            <td>

                                <div class="d-flex gap-1">
                                    <a href="/admin/bodega/editarBodega?id=<?= $bodegaItem->id ?>" class="btn btn-primary btn-sm">Editar</a>
                                    <form action="/admin/eliminarBodega" method="POST">
                                        <input type="hidden" name="id" value="<?= $bodegaItem->id ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
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