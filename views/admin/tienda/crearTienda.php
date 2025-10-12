<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?php echo $titulo ?> </h3>
                <p class="text-subtitle text-muted">Ingrese los datos de la Tienda</p>
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
                <li class="nav-item"></li>
                <a class="nav-link active" href="/admin/bodega/crearTienda">Crear Tienda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/bodega/tablaTienda">Tiendas</a>
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
                        <h4 class="card-title">REGISTRAR NUEVA BODEGA</h4>
                        <?php include_once __DIR__ . '/../../templates/alertas.php'  ?>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="/admin/bodega/crearTienda" onsubmit="return bloquearBoton(this)">
                                <div class="row">


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Codigo_Tienda">Codigo_Tienda</label>
                                            <input type="number" id="Codigo_Tienda" class="form-control"
                                                placeholder="Codigo_Tienda" name="Codigo_Tienda">
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Nombre_Tienda">Nombre_Tienda</label>
                                            <input type="text" id="Nombre_Tienda" class="form-control"
                                                placeholder="Nombre_Tienda" name="Nombre_Tienda">
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Nombre_Tienda">Nombre_Tienda</label>
                                            <input type="text" id="Nombre_Tienda" class="form-control"
                                                placeholder="Nombre_Tienda" name="Nombre_Tienda">
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Direccion_Tienda">Direccion_Tienda</label>
                                            <input type="text" id="Direccion_Tienda" class="form-control"
                                                placeholder="Direccion_Tienda" name="Direccion_Tienda">
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Telefono_Tienda">Telefono_Tienda</label>
                                            <input type="number" id="Telefono_Tienda" class="form-control"
                                                placeholder="Telefono_Tienda" name="Telefono_Tienda">
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Telefono1_Tienda">Telefono1_Tienda</label>
                                            <input type="number" id="Telefono1_Tienda" class="form-control"
                                                placeholder="Telefono1_Tienda" name="Telefono1_Tienda">
                                        </div>
                                    </div>



                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Fax_Tienda">Fax_Tienda</label>
                                            <input type="text" id="Fax_Tienda" class="form-control"
                                                placeholder="Fax_Tienda" name="Fax_Tienda">
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Email_Tienda">Email_Tienda</label>
                                            <input type="text" id="Email_Tienda" class="form-control"
                                                placeholder="Email_Tienda" name="Email_Tienda">
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Ciudad_Tienda">Ciudad_Tienda</label>
                                            <input type="text" id="Ciudad_Tienda" class="form-control"
                                                placeholder="Ciudad_Tienda" name="Ciudad_Tienda">
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Pais_Tienda">Pais_Tienda</label>
                                            <input type="text" id="Pais_Tienda" class="form-control"
                                                placeholder="Pais_Tienda" name="Pais_Tienda">
                                        </div>
                                    </div>



                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Contacto_Tienda">Contacto_Tienda</label>
                                            <input type="text" id="Contacto_Tienda" class="form-control"
                                                placeholder="Contacto_Tienda" name="Contacto_Tienda">
                                        </div>
                                    </div>



                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Tipo_Tienda">Tipo_Tienda</label>
                                            <input type="text" id="Tipo_Tienda" class="form-control"
                                                placeholder="Tipo_Tienda" name="Tipo_Tienda">
                                        </div>
                                    </div>


                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="Foto_Tienda">Foto_Tienda</label>
                                            <input type="text" id="Foto_Tienda" class="form-control"
                                                placeholder="Foto_Tienda" name="Foto_Tienda">
                                        </div>
                                    </div>

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





<script>
    function bloquearBoton(form) {
        const btn = form.querySelector('#btnRegistrar');
        btn.disabled = true; // Deshabilita el botón
        btn.innerText = "Registrando..."; // Cambia el texto (opcional)
        return true; // Permite que el formulario se envíe
    }
</script>