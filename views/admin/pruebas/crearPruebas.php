<!-- <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header> -->

<!-- <div class="page-heading"> -->


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


<!-- <section class="section">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="">Tabla pruebas</a>
                </li>
            </ul>
        </div>
    </section> -->




<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <!-- <div class="card"> -->
            <div class="card-content mt-0">
                <div class="card-body">
                    <div class="alert alert-info py-2">
                        <div class="row align-items-center">

                            <div class="col-md-2 col-6">
                                <small class="text-muted"><b>Nota de pedido N°</b></small><br>
                                <span class="fw-bold"><?php echo $id_nota; ?></span>
                            </div>

                            <div class="col-md-1 col-6">
                                <small class="text-muted"><b># Pedido</b></small><br>
                                <span class="fw-bold"><?php echo $informacionNota->Numero_Nota_Pedido; ?></span>
                            </div>

                            <div class="col-md-1 col-6">
                                <small class="text-muted"><b># Import</b></small><br>
                                <span class="fw-bold"><?php echo $informacionNota->Codigo_Importacion ?? '-'; ?></span>
                            </div>

                            <div class="col-md-2 col-6">
                                <small class="text-muted"><b>Fecha</b></small><br>
                                <span class="fw-bold"><?php echo date("d/m/Y", strtotime($fecha)); ?></span>
                            </div>

                            <div class="col-md-3 col-12">
                                <small class="text-muted"><b>Importador</b></small><br>
                                <span class="fw-bold"><?php echo $informacionNota->Codigo_Importador ?? '-'; ?></span>
                            </div>

                            <div class="col-md-3 col-12">
                                <small class="text-muted"><b>Exportador</b></small><br>
                                <span class="fw-bold"><?php echo $informacionNota->Codigo_Exportador ?? '-'; ?></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
</section>
<?php
// Helper para “old values”
$old      = $old ?? [];
$oldVal   = function ($key, $default = '') use ($old) {
    return htmlspecialchars($old[$key] ?? $default);
};
$selIf    = function ($left, $right) {
    return ((string)$left === (string)$right) ? 'selected' : '';
};
?>

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">

                <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

                <div class="card-content">
                    <div class="card-body">
                        <form class="form"
                            method="POST"
                            action="/admin/pruebas/crearPruebas"
                            enctype="multipart/form-data"
                            onsubmit="return bloquearBoton(this)">

                            <input type="hidden" name="id_nota" value="<?= htmlspecialchars($id_nota) ?>">

                            <div class="row">

                                <!-- Tienda -->
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="Nombre_Tienda">Tienda</label>
                                        <select id="Nombre_Tienda" class="choices form-control" name="Nombre_Tienda">
                                            <option value="" disabled <?= empty($old['Nombre_Tienda']) ? 'selected' : '' ?>>
                                                Seleccione una tienda
                                            </option>
                                            <?php foreach ($tiendas as $t) : ?>
                                                <option value="<?= htmlspecialchars($t->Nombre_Tienda) ?>"
                                                    <?= $selIf(($old['Nombre_Tienda'] ?? ''), $t->Nombre_Tienda) ?>>
                                                    <?= htmlspecialchars($t->Nombre_Tienda) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Fecha -->
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="Fecha_Tienda_Nota_Pedido">Fecha</label>
                                        <input type="date"
                                            id="Fecha_Tienda_Nota_Pedido"
                                            class="form-control"
                                            name="Fecha_Tienda_Nota_Pedido"
                                            value="<?= $oldVal('Fecha_Tienda_Nota_Pedido', $fecha) ?>"
                                            required>
                                    </div>
                                </div>

                                <!-- # Factura -->
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="Factura_Nota_Pedido"># Factura</label>
                                        <input type="number"
                                            id="Factura_Nota_Pedido"
                                            class="form-control"
                                            placeholder="# Factura"
                                            name="Factura_Nota_Pedido"
                                            step="0.01"
                                            value="<?= $oldVal('Factura_Nota_Pedido') ?>">
                                    </div>
                                </div>

                                <!-- Marca (name="importador") -->
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="importador">Marca</label>
                                        <select id="importador" class="choices form-control" name="importador">
                                            <option value="" disabled <?= empty($old['importador']) ? 'selected' : '' ?>>
                                                Seleccione una Marca
                                            </option>
                                            <?php foreach ($marca as $m) : ?>
                                                <option value="<?= htmlspecialchars($m->Nombre_Marca) ?>"
                                                    <?= $selIf(($old['importador'] ?? ''), $m->Nombre_Marca) ?>>
                                                    <?= htmlspecialchars($m->Nombre_Marca) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Ciudad -->
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad</label>
                                        <select id="ciudad" class="choices form-control" name="ciudad">
                                            <option value="" disabled <?= empty($old['ciudad']) ? 'selected' : '' ?>>
                                                Seleccione
                                            </option>
                                            <?php foreach ($ciudad as $c) : ?>
                                                <option value="<?= htmlspecialchars($c->Sigla_Ciudad) ?>"
                                                    <?= $selIf(($old['ciudad'] ?? ''), $c->Sigla_Ciudad) ?>>
                                                    <?= htmlspecialchars($c->Sigla_Ciudad) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Bodega -->
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="bodega">Bodega</label>
                                            <select id="bodega" class="choices form-control" name="bodega">
                                                <option value="" disabled <?= empty($old['bodega']) ? 'selected' : '' ?>>
                                                    Seleccione
                                                </option>
                                                <?php foreach ($bodega as $b) : ?>
                                                    <option value="<?= htmlspecialchars($b->Sigla_Bodega) ?>"
                                                        <?= $selIf(($old['bodega'] ?? ''), $b->Sigla_Bodega) ?>>
                                                        <?= htmlspecialchars($b->Sigla_Bodega) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>





                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="number"
                                                id="cantidad"
                                                class="form-control"
                                                name="cantidad"
                                                step="1"
                                                value="<?= $oldVal('cantidad', '0') ?>">
                                        </div>
                                    </div>
                                </div>






                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Agregar</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Limpiar</button>
                                </div>

                            </div> <!-- /.row -->
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- CDN Handsontable -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable@latest/dist/handsontable.full.min.css">
<script src="https://cdn.jsdelivr.net/npm/handsontable@latest/dist/handsontable.full.min.js"></script>

<style>
  #hot-prendas{width:100%;height:420px;border:1px solid #cbd5e1;background:#fff}
  .toolbar{display:flex;gap:8px;align-items:center;margin:12px 0}
  .btn-lite{padding:8px 10px;border:1px solid #cbd5e1;background:#fff;border-radius:8px;cursor:pointer}
  .hint{font-size:13px;color:#475569}
</style>

<!-- Contenedor responsive -->
<div class="table-responsive">
  <div class="toolbar">
    <button id="guardar-nuevas" class="btn-lite">Guardar NUEVAS filas</button>
    <label class="hint"><input type="checkbox" id="autosave" checked> Auto-guardar al pegar</label>
    <span class="hint">Pega desde Excel: coloca el cursor en A1 y Ctrl/⌘+V</span>
  </div>
  <div id="hot-prendas"></div>
  <div class="mt-2">
    <b>Total KG:</b> <span id="total-kg">0.000</span>
  </div>
</div>

<script>
  // === Config/puentes PHP ===
  const ID_NOTA = <?= json_encode($id_nota ?? ($_GET['id'] ?? null)) ?>;

  // Lo que ya existe en BD (mostrado en el grid, no se vuelve a postear)
  const existentes = <?php
    $idUrl = $id_nota ?? null;
    $out = [];
    if (!empty($carritoTemporal2)) {
      foreach ($carritoTemporal2 as $r) {
        if ($idUrl != $r->Codigo_Nota_Pedido) continue;
        $out[] = [
          'id'                 => (int)$r->id,
          'Codigo_Nota_Pedido' => $r->Codigo_Nota_Pedido,
          'prenda'             => $r->prenda,
          'cantidad'           => (float)$r->cantidad,
        ];
      }
    }
    echo json_encode($out, JSON_UNESCAPED_UNICODE);
  ?>;

  // === Grid ===
  const cont = document.getElementById('hot-prendas');
  const hot = new Handsontable(cont, {
    data: existentes.length ? existentes : [],
    colHeaders: ['ID','Código Nota Pedido','Prenda','Cantidad (KG)'],
    columns: [
      { data:'id', readOnly:true }, // si existe, viene de BD
      { data:'Codigo_Nota_Pedido', readOnly:true, renderer:(inst,td,row,col,prop,val)=>{
          td.textContent = val ?? (ID_NOTA ?? '');
        }
      },
      { data:'prenda' },
      { data:'cantidad', type:'numeric', numericFormat:{pattern:'0.[000]'} },
    ],
    rowHeaders:true,
    stretchH:'all',
    height:420,
    licenseKey:'non-commercial-and-evaluation',
    contextMenu:true,
    dropdownMenu:true,
    filters:true,
    manualColumnResize:true,
    manualRowResize:true,
    minSpareRows: 1, // fila vacía para pegar/cargar nuevas
    afterLoadData(){ actualizarTotal(); },
    afterChange(changes, source){
      if (!changes || source==='loadData') return;
      normalizar();
      actualizarTotal();
    },
    afterPaste(){
      normalizar();
      actualizarTotal();
      if (document.getElementById('autosave').checked) {
        guardarNuevasFilas();
      }
    }
  });

  function normalizar(){
    const data = hot.getSourceData();
    for (const r of data) {
      if (!r) continue;
      if (!r.Codigo_Nota_Pedido && ID_NOTA) r.Codigo_Nota_Pedido = ID_NOTA;
      r.cantidad = Number(r.cantidad) || 0;
      if (typeof r.prenda === 'string') r.prenda = r.prenda.trim();
    }
  }

  function actualizarTotal(){
    const data = hot.getSourceData();
    let sum = 0;
    for (const r of data) {
      if (!r) continue;
      sum += Number(r.cantidad)||0;
    }
    document.getElementById('total-kg').textContent = sum.toFixed(3);
  }

  // === Guardar NUEVAS filas (sin ID) por AJAX a tu ruta actual ===
  async function postFila(row){
    const fd = new FormData();
    fd.append('id_nota', ID_NOTA ?? row.Codigo_Nota_Pedido ?? '');
    fd.append('prenda', row.prenda ?? '');
    fd.append('cantidad', row.cantidad ?? 0);

    // TIP: si usas protección CSRF, agrega el token aquí:
    // fd.append('csrf_token', '<?= $_SESSION['csrf_token'] ?? '' ?>');

    const resp = await fetch('/admin/pruebas/crearPruebas', {
      method:'POST',
      body: fd,
      headers: { 'X-Requested-With': 'XMLHttpRequest' } // para que el servidor pueda devolver JSON
    });

    let json = null;
    try { json = await resp.json(); } catch(e){ /* quizá devolvió HTML por el redirect */ }

    if (json && json.ok && json.id) {
      // Pintamos el id recién creado (evita re-postear)
      row.id = json.id;
      hot.render();
    } else {
      // Si no hubo JSON (porque tu acción hace redirect), recargamos para “hidratar” los IDs
      // Comentado por si prefieres evitar reload:
      // location.reload();
    }
  }

  async function guardarNuevasFilas(){
    normalizar();
    const data = hot.getSourceData();
    // Nuevas = sin ID y con datos mínimos
    const nuevas = data.filter(r => r && !r.id && (r.prenda || r.cantidad));
    if (!nuevas.length) return;

    // Guardar una por una (como tu acción actual) evitando spam
    for (const r of nuevas) {
      await postFila(r);
    }
  }

  document.getElementById('guardar-nuevas').addEventListener('click', async ()=>{
    await guardarNuevasFilas();
    alert('Guardado completado.');
  });
</script>












<script>
    // Si usas un plugin como Choices, inicialízalo DESPUÉS de que el HTML ya venga
    // con los <option selected> correctos.
    function bloquearBoton(form) {
        const btn = form.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
        }
        return true;
    }

    // 
</script>





<section class="section">
    <div class="card">
        <div class="card-header">
            Tabla de Pruebas
        </div>

        <div class="card-body">


            <form action="/admin/pruebas/registrarVenta" method="POST">
                <!-- Fila 1 -->
                <div class="row g-3">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" id="fecha" class="form-control"
                                name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="consumo_papel">C</label>
                            <input type="number" step="0.01" id="consumo_papel"
                                class="form-control" placeholder=")" name="consumo_papel" required>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="n_laminas">N° de</label>
                            <input type="number" id="n_laminas" class="form-control"
                                placeholder="N° " name="n_laminas">
                        </div>
                    </div>


                    <div class="col-md-3 col-12">

                        <div class="form-group">
                            <label for="metros_lineales_C">Metros</label>
                            <input type="number" id="metros_lineales_C" class="form-control"
                                placeholder="Metr" name="metros_lineales_C">
                        </div>

                    </div>
                </div>

                <!-- Fila 2 -->
                <div class="row g-3 mt-1">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="metros_lineales_B">Met</label>
                            <input type="number" id="metros_lineales_B" class="form-control"
                                placeholder="Me" name="metros_lineales_B">
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="metros_lineales">met</label>
                            <input type="number" id="metros_lineales_E" class="form-control"
                                placeholder="Met" name="metros_lineales_E">
                        </div>
                    </div>

                    <div class="col-md-3 col-12 ">
                        <div class="form-group">
                            <label for="consumo_recubrimiento">Con </label>
                            <input type="number" step="0.01" id="consumo_recubrimiento" class="form-control"
                                placeholder="Co)" name="consumo_recubrimiento">
                        </div>
                    </div>

                    <!-- NECESITO UN SELECT CON OPERADORES EN EL HTML  -->

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="operador"></label>
                            <select id="operador" class="choices form-control" name="operador">
                                <option value="" disabled <?php echo !isset($turno) ? 'selected' : ''; ?>>Seleccione </option>

                                <!-- CONTROLABLES -->
                                <option value="EDWIN" <?php echo (isset($operador) && $operador === 'EDWIN') ? 'selected' : ''; ?>>EDWIN</option>

                            </select>

                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="n_cambios">N° de </label>
                                <input type="number" id="n_cambios" class="form-control"
                                    placeholder="N° de " name="n_cambios">
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="turno">fd</label>
                                <select class="form-select" name="turno" id="turno">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-12 <?php echo (trim(strtolower($email)) !== 'corrugador@megaecuador.com') ? 'd-none' : ''; ?>">
                            <div class="form-group">
                                <label for="consumo_almidon"> (Kg)</label>
                                <input type="number" step="0.01" id="consumo_almidon" class="form-control"
                                    placeholder="Con)" name="consumo_almidon">
                            </div>
                        </div>

                        <div class="col-md-3 col-12 <?php echo (trim(strtolower($email)) !== 'corrugador@megaecuador.com') ? 'd-none' : ''; ?>">
                            <div class="form-group">
                                <label for="consumo_resina"> (Kg)</label>
                                <input type="number" step="0.01" id="consumo_resina" class="form-control"
                                    placeholder="Con)" name="consumo_resina">
                            </div>
                        </div>


                    </div>
                    <div class="row g-3 mt-1">

                        <div class="col-md-3 col-12">

                            <div class="form-group">
                                <label for="metros_lineales">ghgfh</label>
                                <input type="number" id="metros_lineales" class="form-control"
                                    placeholder="Me" name="metros_lineales">
                            </div>
                        </div>

                    </div>




                    <!-- Botón -->
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" id="btnRegistrar" class="btn btn-primary me-1 mb-1">Registrar Sucesos</button>
                    </div>
            </form>








        </div>
        <!-- boton de registrar -->
    </div>
</section>

<!-- CSS opcional para evitar que se rompa texto en celdas -->
<style>
    #table1 th,
    #table1 td {
        white-space: nowrap;
    }
</style>




<script>
    function bloquearBoton(form) {
        const btn = form.querySelector('#btnRegistrar');
        btn.disabled = true; // Deshabilita el botón
        btn.innerText = "Registrando..."; // Cambia el texto (opcional)
        return true; // Permite que el formulario se envíe
    }
</script>





</div>