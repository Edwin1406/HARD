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
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Handsontable -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable@latest/dist/handsontable.full.min.css">
  <script src="https://cdn.jsdelivr.net/npm/handsontable@latest/dist/handsontable.full.min.js"></script>

  <title>Nota / Carrito</title>
</head>
<body class="bg-light">

<div class="container py-4">
  <div class="card shadow-sm">
    <div class="card-header">
      <div class="d-flex flex-wrap align-items-center gap-3">
        <h5 class="mb-0">Ítems de Nota</h5>

        <button id="guardar-nuevas" class="btn btn-outline-primary btn-sm">
          Guardar NUEVAS filas
        </button>

        <div class="form-check d-flex align-items-center">
          <input class="form-check-input me-2" type="checkbox" id="autosave" checked>
          <label class="form-check-label" for="autosave">
            Autosave tras pegar/editar
          </label>
        </div>

        <span class="text-secondary small ms-auto">
          Tip: pega desde Excel (selecciona A1 y Ctrl/⌘+V)
        </span>
      </div>
    </div>

    <div class="card-body">
      <!-- La altura visual la controla Handsontable (height: 420) -->
      <div id="hot-min" class="border rounded bg-white"></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // ---------- Puentes PHP ----------
  const ID_NOTA = <?= json_encode($id_nota ?? ($_GET['id'] ?? null)) ?>;

  // Construimos el array de existentes SOLO para ESTA nota
  const existentes = <?php
    $idUrl = $id_nota ?? null;
    $out = [];
    if (!empty($carritoTemporal2)) {
      foreach ($carritoTemporal2 as $r) {
        if ($idUrl != $r->Codigo_Nota_Pedido) continue;
        $out[] = [
          'id'                 => (int)$r->id,
          'codigo_nota_pedido' => $r->Codigo_Nota_Pedido,
          'prenda'             => $r->prenda,
          'cantidad'           => (float)$r->cantidad,
        ];
      }
    }
    echo json_encode($out, JSON_UNESCAPED_UNICODE);
  ?>;

  // ---------- Handsontable ----------
  const container = document.getElementById('hot-min');
  const hot = new Handsontable(container, {
    data: existentes.length ? existentes : [],
    colHeaders: ['id', 'codigo_nota_pedido', 'prenda', 'cantidad', 'Acciones'],
    columns: [
      { data:'id', readOnly:true },
      { data:'codigo_nota_pedido', readOnly:true, renderer:(inst,td,row,col,prop,val)=>{
          td.textContent = val ?? (ID_NOTA ?? '');
        }
      },
      { data:'prenda' },
      { data:'cantidad', type:'numeric', numericFormat:{ pattern:'0.[000]' } },
      { readOnly:true, renderer:(inst, td, row) => {
          td.innerHTML = `
            <button type="button" class="btn btn-outline-danger btn-sm" data-row="${row}">
              Eliminar
            </button>`;
        }
      },
    ],
    rowHeaders: true,
    stretchH: 'all',
    height: 420,
    licenseKey: 'non-commercial-and-evaluation',

    // UX tipo Excel
    filters: true,
    dropdownMenu: true,
    columnSorting: true,
    manualColumnResize: true,
    manualRowResize: true,

    // Pegado/edición
    minSpareRows: 1,
    allowInsertColumn: false,
    allowRemoveColumn: false,

    afterChange(changes, source) {
      if (!changes || source === 'loadData') return;
      normalizar();
      maybeAutosave();
    },
    afterPaste() {
      normalizar();
      maybeAutosave();
    }
  });

  function normalizar(){
    const data = hot.getSourceData();
    for (const r of data) {
      if (!r) continue;
      if (!r.codigo_nota_pedido && ID_NOTA) r.codigo_nota_pedido = ID_NOTA;
      if (typeof r.prenda === 'string') r.prenda = r.prenda.trim();
      r.cantidad = Number(r.cantidad) || 0;
    }
  }

  // ---- Guardado por fila (usa tu ruta actual crearPruebas) ----
  async function postFila(row){
    const fd = new FormData();
    fd.append('id_nota', ID_NOTA ?? row.codigo_nota_pedido ?? '');
    fd.append('prenda', row.prenda ?? '');
    fd.append('cantidad', row.cantidad ?? 0);

    const resp = await fetch('/admin/pruebas/crearPruebas', {
      method: 'POST',
      body: fd,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    });

    try {
      const json = await resp.json();
      if (json?.ok && json.id) {
        row.id = json.id;
        row.codigo_nota_pedido = ID_NOTA;
        hot.render();
      }
    } catch(e) {
      // Si el backend devuelve HTML/redirect, puedes recargar:
      // location.reload();
    }
  }

  async function guardarNuevasFilas(){
    normalizar();
    const data = hot.getSourceData();
    const nuevas = data.filter(r => r && !r.id && (r.prenda || r.cantidad));
    for (const r of nuevas) {
      await postFila(r);
    }
  }

  document.getElementById('guardar-nuevas').addEventListener('click', async ()=>{
    await guardarNuevasFilas();
    alert('Guardado completado.');
  });

  function maybeAutosave(){
    if (document.getElementById('autosave').checked) guardarNuevasFilas();
  }

  // ---- Eliminar (columna Acciones) ----
  container.addEventListener('click', async (ev) => {
    const btn = ev.target.closest('button.btn-outline-danger');
    if (!btn) return;

    const rowIndex = parseInt(btn.dataset.row, 10);
    const rowData  = hot.getSourceDataAtRow(rowIndex);

    // Si aún no tiene id, solo quítala localmente
    if (!rowData?.id) {
      hot.alter('remove_row', rowIndex, 1);
      return;
    }

    if (!confirm('¿Eliminar este registro definitivamente?')) return;

    const fd = new FormData();
    fd.append('id_nota', ID_NOTA ?? rowData.codigo_nota_pedido ?? '');
    fd.append('id', rowData.id);

    const resp = await fetch('/admin/eliminarCarrito', {
      method: 'POST',
      body: fd,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    });

    try {
      const json = await resp.json();
      if (json?.ok) {
        hot.alter('remove_row', rowIndex, 1);
      } else {
        alert('No se pudo eliminar (revisa permisos o id).');
      }
    } catch {
      // Si el backend respondió con redirect/HTML:
      // location.reload();
    }
  });
</script>
</body>
</html>








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