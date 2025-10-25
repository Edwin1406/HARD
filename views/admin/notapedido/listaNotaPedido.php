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
                        <th class="fs-6" style="min-width: 93px;"> Nota Pedido</th>
                        <th class="fs-6" style="min-width: 93px;"> Importación</th>
                        <th class="fs-6" style="min-width: 93px;"> Fecha</th>


                        <th class="fs-6" style="min-width: 100px;">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($notasPedidos as $notaItem): ?>
                        <tr>
                            <td><?= $notaItem->Codigo_Nota_Pedido ?></td>
                            <td><?= $notaItem->Codigo_Importacion ?></td>
                            <td><?= $notaItem->Fecha_Nota_Pedido ?></td>

                            <td>

                                <div class="d-flex gap-1">
                                    <a href="/admin/pruebas/crearPruebas?id=<?= $notaItem->Codigo_Nota_Pedido ?>" class="btn btn-primary btn-sm"><i class="bi bi-box-arrow-in-right"></i> </a>
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




<script>
    
    document.addEventListener("DOMContentLoaded", function() {
        const dataTable = new simpleDatatables.DataTable("#table1", {
            scrollX: true,
            columnDefs: [{
                    width: "110px",
                    targets: [6, 7, 8]
                } 
            ]
        });
    });

</script>

