<!-- 
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header> -->
<?php if ($email === 'control@megaecuador.com' || $email === 'produccion@megaecuador.com' || $email === 'pruebas@megaecuador.com') { ?>
    <div class="page-heading">
        <h3>GRAFICAS CONSUMO GENERAL DESPERDICIO</h3>

        <!-- CERRAR SESSION  -->

        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-danger" onclick="location.href='/cerrarSesion'">Cerrar Sesión</button>
            <br>
            <!-- <p class="text-subtitle text-muted"><?php echo $email; ?></p> -->
        </div>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <div class="page-content">
        <section class="row">
            <div class="col-md-12">
                <!-- Profile Statistics -->


                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Usuarios Conectados</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo $usuariosConectados; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon yellow">
                                            <i class="iconly-boldGraph"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Usuarios Desconectados</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo $usuariosDesconectados; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="modal fade" id="modalTarjetas" tabindex="-1" aria-labelledby="modalTarjetasLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTarjetasLabel">Detalle de Consumo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row" id="contenedor-tarjetas"></div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card" id="abrirModalTarjetas" style="cursor: pointer;">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">CONSUMO </h6>
                                        <h6 class="font-extrabold mb-0">GENERAL</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">NONE</h6>
                                        <h6 class="font-extrabold mb-0">00.000</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Troquel</h6>
                                        <h6 class="font-extrabold mb-0">112</h6>
                                        <button class="btn btn-primary  color:white"><a href="/admin/graficas/graficasConsumoGeneral">Ver Gráficas</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>






            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Consumo Diario por Máquina</h4>
                    </div>
                    <div class="card-body">
                        <form id="formFiltroMaquinas" class="mb-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="inputFechaInicio">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="inputFechaInicio" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="inputFechaFin">Fecha Fin</label>
                                    <input type="date" class="form-control" id="inputFechaFin" required>
                                </div>
                                <!-- FILTRAR POR TOP NECESITO UNAS OPCIONES-->



                            </div>
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </form>


                        <div id="graficoUnico" class="mt-4"></div>


                    </div>
                </div>
            </div>




            <div class="col-md-12">
                <div class="card">
                    <!-- Filtro por máquina -->
                    <div class="card-header">
                        <h4>Consumo por Máquina</h4>
                    </div>
                    <div class="card-body">
                        <form id="formFiltroConsumoGeneral" class="mb-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fechaInicioConsumo">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="fechaInicioConsumo">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fechaFinConsumo">Fecha Fin</label>
                                    <input type="date" class="form-control" id="fechaFinConsumo">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tipoMaquinaConsumo">Máquina</label>
                                    <select class="form-select" id="tipoMaquinaConsumo">
                                        <option value="">Seleccione una máquina</option>
                                        <option value="TROQUEL">Troquel</option>
                                        <option value="GUILLOTINA PAPEL">Guillotina Papel</option>
                                        <option value="GUILLOTINA LAMINA">Guillotina Lamina</option>
                                        <option value="DOBLADO">Doblado</option>
                                        <option value="CONVERTIDOR">Convertidor</option>
                                        <option value="EMPAQUE">Empaque</option>
                                        <option value="MICRO">Micro</option>
                                        <option value="CORRUGADOR">Corrugador</option>
                                        <option value="FLEXOGRAFICA">Flexografica</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </form>
                    </div>

                    <div id="graficoConsumoMaquina"></div>
                </div>
            </div>



            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Top Máquinas</h4>
                    </div> <!-- Aquí cerramos bien el card-header -->

                    <div class="card-body">
                        <form id="formFiltroTopMaquinas" class="mb-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="filtroFechaInicio">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="filtroFechaInicio" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="filtroFechaFin">Fecha Fin</label>
                                    <input type="date" class="form-control" id="filtroFechaFin" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="filtroTopMaquinas">Top</label>
                                    <select class="form-select" id="filtroTopMaquinas">
                                        <option value="5">Top 5</option>
                                        <option value="todos">Todos</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="filtroTipoMaquina">Máquina</label>
                                    <select class="form-select" id="filtroTipoMaquina">
                                        <option value="todos">Todas</option>
                                        <option value="TROQUEL">Troquel</option>
                                        <option value="GUILLOTINA PAPEL">Guillotina Papel</option>
                                        <option value="GUILLOTINA LAMINA">Guillotina Lamina</option>
                                        <option value="DOBLADO">Doblado</option>
                                        <option value="CONVERTIDOR">Convertidor</option>
                                        <option value="EMPAQUE">Empaque</option>
                                        <option value="MICRO">Micro</option>
                                        <option value="CORRUGADOR">Corrugador</option>
                                        <option value="FLEXOGRAFICA">Flexografica</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                            </div>
                        </form>

                        <div id="grafico-top-maquinas"></div>
                    </div>
                </div>
            </div>


        </section>
    </div>

<?php } else { ?>
    <div class="page-heading">
        <h3>Bienvenido <?php echo $nombre; ?></h3>
        <p class="text-subtitle text-muted"><?php echo $email; ?></p>
    </div>

<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        async function obtenerDatosAPI() {
            const url = `${location.origin}/admin/api/apiGraficasConsumoGeneral`;
            const respuesta = await fetch(url);
            const datos = await respuesta.json();
            return datos;
        }

        function filtrarDatos(datos, tipoMaquina, fechaInicio, fechaFin) {
            return datos.filter(item => {
                const fechaItem = new Date(item.created_at);

                const cumpleMaquina = tipoMaquina ? item.tipo_maquina === tipoMaquina : true;
                const cumpleFechaInicio = fechaInicio ? fechaItem >= new Date(fechaInicio) : true;
                const cumpleFechaFin = fechaFin ? fechaItem <= new Date(fechaFin) : true;

                return cumpleMaquina && cumpleFechaInicio && cumpleFechaFin;
            });
        }

        function agruparPorMes(datos) {
            const agrupado = {};

            datos.forEach(item => {
                const fecha = new Date(item.created_at);
                const claveMes = fecha.toISOString().slice(0, 7); // "YYYY-MM"

                if (!agrupado[claveMes]) {
                    agrupado[claveMes] = 0;
                }

                agrupado[claveMes] += parseFloat(item.total_general);
            });

            const clavesOrdenadas = Object.keys(agrupado).sort();

            const mesesES = ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'];

            const categorias = clavesOrdenadas.map(clave => {
                const [year, month] = clave.split("-");
                const nombreMes = mesesES[parseInt(month, 10) - 1];
                return `${nombreMes} ${year}`;
            });

            const valores = clavesOrdenadas.map(clave => agrupado[clave]);

            return {
                categorias,
                valores
            };
        }

        function renderizarGrafico(categorias, valores) {
            const options = {
                series: [{
                    name: 'Total General',
                    data: valores
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                xaxis: {
                    categories: categorias
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val.toFixed(2);
                    }
                },
                fill: {
                    opacity: 1
                },
                legend: {
                    position: 'top'
                }
            };

            const chartDiv = document.querySelector("#graficoConsumoMaquina");
            chartDiv.innerHTML = ""; // Limpiar gráfico anterior

            const chart = new ApexCharts(chartDiv, options);
            chart.render();
        }

        async function iniciar() {
            const datos = await obtenerDatosAPI();
            const {
                categorias,
                valores
            } = agruparPorMes(datos);
            renderizarGrafico(categorias, valores);
        }

        document.getElementById('formFiltroConsumoGeneral').addEventListener('submit', async function(e) {
            e.preventDefault();

            const tipoMaquina = document.getElementById('tipoMaquinaConsumo').value;
            const fechaInicio = document.getElementById('fechaInicioConsumo').value;
            const fechaFin = document.getElementById('fechaFinConsumo').value;

            const datos = await obtenerDatosAPI();
            const datosFiltrados = filtrarDatos(datos, tipoMaquina, fechaInicio, fechaFin);
            const {
                categorias,
                valores
            } = agruparPorMes(datosFiltrados);

            renderizarGrafico(categorias, valores);
        });

        iniciar(); // Ejecutar al cargar
    });
</script>