<!-- 
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header> -->
<?php if ($email === 'control@megaecuador.com' || $email === 'produccion@megaecuador.com' || $email === 'pruebas@megaecuador.com') { ?>
    <div class="page-heading">
        <h3>INICIO</h3>

        <!-- CERRAR SESSION  -->

        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-danger" onclick="location.href='/cerrarSesion'">Cerrar Sesión</button>
            <br>
            <!-- <p class="text-subtitle text-muted"><?php echo $email; ?></p> -->
        </div>
    </div>

  

<?php } else { ?>
    <div class="page-heading">
        <h3>Bienvenido <?php echo $nombre; ?></h3>
        <p class="text-subtitle text-muted"><?php echo $email; ?></p>
    </div>

<?php } ?>