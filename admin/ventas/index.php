<?php

require_once '../config/config.php';
require_once '../layout/header.php';

if (!isset($_SESSION['user_type'])) {
    header('Location: ../index.php');
    exit;
}
// echo '<script>window.location="../index.php"</script>';

if ($_SESSION['user_type'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}

$db = new Database();
$con = $db->conectar();

$sql = "SELECT id, id_transaccion, fecha, total FROM ventas WHERE activo = 1";
$resultado = $con->query($sql);
$ventas = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<main>
    <div class="container-fluid px-4">
        <h2 class="mt-3">ventas</h2>
        <a href="nuevo.php" class="btn btn-primary tn-sm">Agregar</a>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $venta) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($venta['nombre'], ENT_QUOTES); ?></td>
                        <td><?php echo $venta['precio']; ?></td>
                        <td><?php echo $venta['stock']; ?></td>
                        <td><a class="btn btn-warning btn-sm" href="edita.php?id=<?php echo $venta['id']; ?>"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalElimina" data-bs-id="<?php echo $venta['id']; ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</main>

<!-- Modal Body -->
<div class="modal fade" id="modalElimina" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Confirmar
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">¿Desea eliminar este registro?</div>
            <div class="modal-footer">
                <form action="elimina.php" method="post">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let eliminaModal = document.getElementById('modalElimina')
eliminaModal.addEventListener('show.bs.modal', function(event) {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id')
    let modalInput = eliminaModal.querySelector('.modal-footer input')
    modalInput.value = id
})
</script>

<?php require_once '../layout/footer.php'; ?>