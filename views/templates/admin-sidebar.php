
<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2025 &copy; EDWIN DIAZ</p>
        </div>
        <div class="float-end">
            <p>En <span class="text-danger"></span> Desarrollo <a
                    href="">MEGASTOCK</a></p>
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