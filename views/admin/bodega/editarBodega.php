<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?php echo $titulo ?> </h3>
                <p class="text-subtitle text-muted">Actualizar los datos de la Bodega</p>
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
    <?php if (isset($_GET['editado']) && $_GET['editado'] == '2') : ?>
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                // Mostrar el toast
                var toastEl = document.getElementById('toastExito');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();

                // Quitar el parámetro ?editado=2 de la URL sin recargar
                const url = new URL(window.location);
                url.searchParams.delete('editado');
                window.history.replaceState({}, document.title, url.toString());
            });
        </script>
    <?php endif; ?>

    <section class="section">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="/admin/bodega/tablaBodega">Tabla de registros de Bodegas</a>
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
                        <h4 class="card-title">EDITAR BODEGA EXISTENTE</h4>
                        <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="/admin/bodega/editarBodega?id=<?php echo $bodega->id;?>" onsubmit="return bloquearBoton(this)">
                                <div class="row">


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="Nombre_Bodega">Nombre Bodega</label>
                                            <input type="text" id="Nombre_Bodega" class="form-control"
                                                placeholder="Nombre Bodega" name="Nombre_Bodega" value="<?php echo $bodega->Nombre_Bodega; ?>">
                                        </div>
                                    </div>                                  


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="Sigla_Bodega">Siglas Bodega</label>
                                            <input type="text" id="Sigla_Bodega" class="form-control"
                                                placeholder="Siglas Bodega" name="Sigla_Bodega" value="<?php echo $bodega->Sigla_Bodega; ?>">
                                        </div>
                                    </div>


                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" id="btnRegistrar" class="btn btn-primary me-1 mb-1">Actualizar</button>
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





<script>
function bloquearBoton(form) {
  const btn = form.querySelector('#btnRegistrar');
  btn.disabled = true; // Deshabilita el botón
  btn.innerText = "Registrando..."; // Cambia el texto (opcional)
  return true; // Permite que el formulario se envíe
}
</script>

