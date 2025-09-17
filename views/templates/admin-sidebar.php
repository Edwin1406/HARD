<footer>
    <div class="container-fluid  text-white py-4">
        <div class="row">
            <div class="col-12 col-md-6">
                <p class="mb-0 fs-5">2025 &copy; <strong>Proyecto en Desarrollo</strong></p>
            </div>
            <div class="col-12 col-md-6 text-md-end">
                <p class="mb-0 fs-5">Actualmente <span class="text-warning">en construcción</span>. 
                    <a href="#" class="text-white text-decoration-none fw-bold">Más detalles</a>
                </p>
            </div>
        </div>
    </div>
</footer>




<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- <script src="/assets/vendors/apexcharts/apexcharts.js"></script>
<script src="/assets/js/pages/dashboard.js"></script> -->
<?php
$currentPath = $_SERVER['REQUEST_URI'];
if (strpos($currentPath, '/admin/index') !== false || strpos($currentPath, '/admin/graficas/graficasConsumoGeneral') !== false || strpos($currentPath, '/admin/graficas/graficasDoblado') !== false) {
    echo '<script src="/assets/vendors/apexcharts/apexcharts.js"></script>';
    echo '<script src="/assets/js/pages/dashboard.js"></script>';
}
?>


<script src="/assets/js/main.js"></script>
 <script src="/assets/vendors/choices.js/choices.min.js"></script>
</body>

</html>