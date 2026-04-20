<?php
session_start();

// ------------------ CONFIGURACIÓN DE LA BDD ------------------
$host = "localhost";
$dbname = "papeleria_utem";
$user = "root"; // CAMBIA si usas otro usuario
$password = ""; // TU contraseña si tienes

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}

// ------------------ VALIDAR SESIÓN ------------------
if(!isset($_SESSION['usuario_id'])){
    die("❌ No hay usuario logueado.");
}
$usuario_id = $_SESSION['usuario_id'];

// ------------------ ELIMINAR PRODUCTO ------------------
if(isset($_GET['delete_id'])){
    $id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM ventas WHERE id = :id AND usuario_id = :usuario_id");
    $stmt->execute([
        ":id" => $id,
        ":usuario_id" => $usuario_id
    ]);
    exit('ok');
}

// ------------------ GUARDAR COMPRA ------------------
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cart"])) {
    $cart = json_decode($_POST["cart"], true);

    if($cart && count($cart) > 0){
        $stmt = $conn->prepare("
            INSERT INTO ventas (descripcion, cantidad, precio, total, usuario_id)
            VALUES (:d, :c, :p, :t, :u)
        ");

        foreach($cart as $item){
            $descripcion = $item["product"];
            $cantidad    = intval($item["quantity"]);
            $precio      = floatval($item["price"]);
            $total       = $cantidad * $precio;

            $stmt->execute([
                ":d" => $descripcion,
                ":c" => $cantidad,
                ":p" => $precio,
                ":t" => $total,
                ":u" => $usuario_id
            ]);
        }

        echo "<script>
                alert('✅ Venta registrada con éxito');
                localStorage.removeItem('cart');
                window.location.href = 'carrito.php';
              </script>";
        exit();
    }
}

// ------------------ OBTENER VENTAS ------------------
$stmt = $conn->prepare("SELECT * FROM ventas WHERE usuario_id = :u");
$stmt->execute([":u" => $usuario_id]);
$ventasBD = $stmt->fetchAll(PDO::FETCH_ASSOC);

$conn = null;
?>
<!DOCTYPE html>
<html lang="es">
<head>  <link rel="icon" href="img/logo-removebg-preview.ico" type="image/x-icon">  
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Carrito de Compras</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); /* Fondo futurista azul oscuro */
    color: #fff;
    padding-top: 90px;
}

.navbar {
    background: rgba(0, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 20px;
    color: #00e5ff;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
}

.navbar .logo {
    font-weight: bold;
    font-size: 1.6rem;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
}

h2 {
    text-align: center;
    font-weight: bold;
    margin-bottom: 20px;
    font-size: 2rem;
    color: #00e5ff;
    text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.7);
}

/* Cards futuristas */
.card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(0, 255, 255, 0.2);
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    backdrop-filter: blur(10px);
    box-shadow: 0 0 25px rgba(0, 255, 255, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 30px;
}

.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 0 35px rgba(0, 255, 255, 0.4);
}

/* Tablas transparentes con estilo futurista */
.table {
    background: rgba(255, 255, 255, 0.05);
    color: #fff;
    backdrop-filter: blur(8px);
    border-radius: 12px;
}

.table th {
    background: rgba(0, 255, 255, 0.2);
    color: #00e5ff;
    text-shadow: 0 0 3px #000;
}

.table td {
    background: rgba(255, 255, 255, 0.05);
    color: #cfd8dc;
    text-shadow: 0 0 2px #000;
}

.table tbody tr:hover td {
    background: rgba(0, 255, 255, 0.15);
}

/* Botones futuristas */
.btn-success {
    background: #00e5ff;
    border: none;
    color: #0f2027;
    font-weight: bold;
    box-shadow: 0 0 10px rgba(0, 229, 255, 0.5);
}

.btn-success:hover {
    background: #00c4e0;
    box-shadow: 0 0 20px rgba(0, 229, 255, 0.7);
}

.btn-danger {
    background: #ff3d3d;
    border: none;
    color: #fff;
    font-weight: bold;
    box-shadow: 0 0 10px rgba(255, 61, 61, 0.5);
}

.btn-danger:hover {
    background: #e63232;
    box-shadow: 0 0 20px rgba(255, 61, 61, 0.7);
}

.total-div {
    font-weight: bold;
    color: #00e5ff;
    font-size: 1.1rem;
}

  body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      padding-top: 90px;
  }

  .navbar {
      background: rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(8px);
      padding: 15px 25px;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.2);
  }

  .navbar .logo {
      color: #00e5ff;
      font-size: 1.6rem;
      font-weight: bold;
  }

  .navbar a.btn {
      background: linear-gradient(45deg, #00e5ff, #00bcd4);
      color: #000;
      font-weight: bold;
      border-radius: 10px;
      padding: 8px 16px;
      border: none;
  }

  #carrito {
      max-width: 1100px;
      margin: 30px auto;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 0 25px rgba(0, 255, 255, 0.15);
      backdrop-filter: blur(10px);
  }

  h2 {
      color: #00e5ff;
      text-shadow: 0 0 8px rgba(0, 255, 255, 0.8);
  }
/* === TABLA FUTURISTA / GLASSMORPHISM === */
table {
    width: 100%;
    border-collapse: collapse;
    color: #e0f7fa;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 0 25px rgba(0, 255, 255, 0.2);
}

thead {
    background: rgba(0, 255, 255, 0.15);
    text-shadow: 0 0 8px cyan;
}

thead th {
    color: #00e5ff;
    padding: 14px;
    font-size: 1.1rem;
    letter-spacing: 1px;
    border-bottom: 1px solid rgba(0,255,255,0.3);
}

tbody tr {
    transition: background 0.3s ease, transform 0.2s ease;
}

tbody tr:hover {
    background: rgba(0, 255, 255, 0.08);
    transform: scale(1.01);
}

tbody td {
    padding: 14px;
    border-bottom: 1px solid rgba(0,255,255,0.1);
    color: #b2ebf2;
}

/* Inputs futuristas */
td input.qty {
    width: 75px;
    padding: 6px;
    text-align: center;
    border-radius: 10px;
    background: #0d1b2a;
    color: #00e5ff;
    border: 1px solid #00bcd4;
    box-shadow: 0 0 10px rgba(0,255,255,0.2);
}

/* BOTÓN ELIMINAR */
.btn-danger {
    background: linear-gradient(45deg, #ff1744, #d50000);
    border: none;
    box-shadow: 0 0 12px rgba(255,0,0,0.4);
}

.btn-danger:hover {
    box-shadow: 0 0 20px rgba(255,0,0,0.7);
}

/* TOTAL GENERAL */
.total {
    color: #00e5ff;
    font-size: 1.4rem;
    text-shadow: 0 0 10px cyan;
}
  .btn-danger {
      background: linear-gradient(45deg, #ff1744, #d50000);
      border: none;
  }

  .btn-success {
      background: linear-gradient(45deg, #00e676, #00c853);
      border: none;
      font-weight: bold;
      padding: 12px 20px;
      border-radius: 12px;
  }

  .total {
      font-size: 1.3rem;
      color: #00e5ff;
      text-shadow: 0 0 6px cyan;
  }
</style>
</head>

<body>

<nav class="navbar">
    <div class="logo">Papelería UTEM</div>
    <a href="servicios.php" class="btn">🏠 Menú</a>
</nav>

<section id="carrito" class="container">
    <h2>🛒 Carrito de Compras</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody id="cart-items">
            <?php foreach($ventasBD as $item): ?>
            <tr data-bdd-id="<?= $item['id'] ?>">
                <td><?= htmlspecialchars($item['descripcion']) ?></td>
                <td>$<?= number_format($item['precio'],2) ?></td>
                <td><input type="number" class="qty" value="<?= $item['cantidad'] ?>" disabled></td>
                <td>$<?= number_format($item['total'],2) ?></td>
                <td>
                    <button class="btn btn-danger btn-sm btn-delete-bdd">Eliminar</button> <span style="color:#00e676;">✔ Registrado</span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-end total">Total General: $<span id="total">0</span></div>

    <form method="POST" onsubmit="return enviarCarrito()">
        <input type="hidden" name="cart" id="cartInput">
        <button class="btn btn-success mt-3">Finalizar Compra</button>
    </form>
</section>

<script>
let cart = JSON.parse(localStorage.getItem("cart")) || [];

function renderCart() {
    const tbody = document.getElementById("cart-items");
    tbody.innerHTML = "";
    let total = 0;

    
    // --- Render localStorage ---
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        tbody.innerHTML += `
            <tr>
                <td>${item.product}</td>
                <td>$${item.price.toFixed(2)}</td>
                <td><input type="number" class="qty" value="${item.quantity}" onchange="updateQuantity(${index}, this.value)"></td>
                <td class="item-total">$${itemTotal.toFixed(2)}</td>
                <td><button class="btn btn-danger btn-sm" onclick="removeItem(${index})">Eliminar</button></td>
            </tr>
        `;
    });

    document.getElementById("total").textContent = total.toFixed(2);
}

function updateQuantity(index, value){
    cart[index].quantity = parseInt(value);
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
}

function removeItem(index){
    cart.splice(index,1);
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
}

function enviarCarrito(){
    if(cart.length === 0){
        alert("El carrito está vacío.");
        return false;
    }
    document.getElementById("cartInput").value = JSON.stringify(cart);
    return true;
}

document.addEventListener('click', function(e){
    if(e.target.classList.contains('btn-delete-bdd')){
        if(confirm("¿Eliminar este producto?")){
            const tr = e.target.closest('tr');
            const id = tr.getAttribute('data-bdd-id');

            fetch('?delete_id='+id)
            .then(res=>res.text())
            .then(res=>{
                tr.remove();
                renderCart();
            });
        }
    }
});

renderCart();
</script>

</body>
</html>