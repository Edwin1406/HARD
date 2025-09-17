
<footer>
    <div class="footer d-flex justify-content-between align-items-center mb-0 text-muted">
        <div>
            <p class="mb-0">2025 &copy; DESARROLLO</p>
        </div>
        <div class="text-end">
            <p class="mb-0">EN <span class="text-danger">PROCESO</span> 
                <a href="#" class="text-decoration-none">Más info</a>
            </p>
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