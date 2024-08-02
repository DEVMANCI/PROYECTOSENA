<?php
/**
 * Script para visualizar el catálogo de la tienda
 * Autor: Carlos Andrés Romero
 * 
 */
require_once '../config/config.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, descripcion, precio FROM mujer WHERE activo=1"); //Sentencias preparadas
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
/**
 * phpinfo();
 * session_destroy();
 * 
 */
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title><?= TITLE; ?></title>
    <link rel="stylesheet" href="css/mujer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100">
    <?php include '../layout/menu.php'; ?>

  
    </head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Mujer</h2>
            <ul>
                <li><input type="checkbox"> Tops y Bodies</li>
                <li><input type="checkbox"> Camisetas</li>
                <li><input type="checkbox"> Vestidos</li>
                <li><input type="checkbox"> Shorts</li>
                <li><input type="checkbox"> Pantalones</li>
                <li><input type="checkbox"> Buzos</li>
                <li><input type="checkbox"> Faldas</li>
                <li><input type="checkbox"> Joggers</li>
                <li><input type="checkbox"> Camisas</li>
                <li><input type="checkbox"> Jeans</li>
                <li><input type="checkbox"> Chaquetas</li>
                <li><input type="checkbox"> Pines</li>
                <li><input type="checkbox"> Bolsas</li>
            </ul>
            <h2>Color</h2>
            <ul class="color-options">
                <li class="color-blue"></li>
                <li class="color-grey"></li>
                <li class="color-beige"></li>
                <li class="color-black"></li>
                <li class="color-light-blue"></li>
                <li class="color-pink"></li>
                <li class="color-brown"></li>
                <li class="color-white"></li>
                <li class="color-yellow"></li>
                <li class="color-dark-blue"></li>
            </ul>
            <h2>Talla</h2>
            <ul>
            <li><input type="checkbox"> S</li>
                <li><input type="checkbox"> M</li>
                <li><input type="checkbox"> L</li>
                <li><input type="checkbox"> XL</li>
            </ul>

        </aside>
        <main class="product-list">
            <div class="product">
                <img src="images/imgmujer/1.png" alt="Vestido 1">
                <p>Vestido Amarillo</p>
                <p>$79.000</p>
                <button class="add-to-cart" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">Agregar al carrito</button>
                <!-- <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>"
                                            class="btn btn-sm btn-outline-primary">Detalles</a>
                                    </div>
                                    <button class="btn btn-sm btn-secondary btn-outline" type="button"
                                        onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">Agregar</button>
                                </div>
                            </div> -->
            </div> 
            <div class="product">
                <img src="images/imgmujer/2.png" alt="Vestido 2">
                <p>Chaqueta Negra</p>
                <p>$79.000</p>
                <button class="add-to-cart">Agregar al carrito</button>
            
            </div>
            <div class="product">
                <img src="images/imgmujer/3.png" alt="Vestido 3">
                <p>Chaqueta Azul</p>
                <p>$79.000</p>
                <button class="add-to-cart">Agregar al carrito</button>
            </div>

            <div class="product">
                <img src="images/imgmujer/4.png" alt="Vestido 4">
                <p>top negro</p>
                <p>$79.000</p>
                <button class="add-to-cart">Agregar al carrito</button>
            </div>

        </main>
    </div>
</body>

    <!-- Contenido -->
    <!-- <main class="flex-shrink-0">
        <div class="album py-5 bg-body-tertiary flex-shrink-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    <?php foreach ($resultado as $row) { ?>
                    <div class="col mb-2">
                        <div class="card shadow-sm h-100">
                            <?php
                                $id = $row['id'];
                                $imagen = "images/productos/" . $id . "/principal.jpg";
                                if (!file_exists($imagen)) {
                                    $imagen = "images/no-photo.jpg";
                                }
                                ?>
                            <a
                                href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>"><img
                                    src="<?php echo $imagen; ?>" class="card-img-top"></a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                                <p class="card-text"><b>$</b><?php echo number_format($row['precio'], 2, ',', ','); ?>
                                </p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>"
                                            class="btn btn-sm btn-outline-primary">Detalles</a>
                                    </div>
                                    <button class="btn btn-sm btn-secondary btn-outline" type="button"
                                        onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">Agregar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>  -->

    <script>
    function addProducto(id, token) {
        let url = 'clases/carrito.php'
        let formData = new FormData()
        formData.append('id', id)
        formData.append('token', token)
        fetch(url, {
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
            .then(data => {
                if (data.ok) {
                    let elemento = document.getElementById('num_cart')
                    elemento.innerHTML = data.numero
                }
            })
    }
    </script>
    <?php include '../layout/footer.php'; ?>