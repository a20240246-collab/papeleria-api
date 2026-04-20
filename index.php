<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ======================= CONEXIÓN MYSQL =======================
    $host = "localhost";
    $dbname = "papeleria_utem";
    $user = "root";        // cambia si usas otro usuario
    $password = "";        // tu contraseña de MySQL

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("❌ Error de conexión: " . $e->getMessage());
    }

    // ======================= OBTENER DATO =======================
    $numero_control = $_POST['numero_control'];

    // ======================= BUSCAR USUARIO =======================
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE numero_control = :nc");
    $stmt->execute([":nc" => $numero_control]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userData) {
        // Usuario existe
        $_SESSION['usuario_id'] = $userData['id'];
        header("Location: servicios.php");
        exit();

    } else {
        // ======================= INSERTAR USUARIO =======================
        $stmt = $conn->prepare("INSERT INTO usuarios (numero_control) VALUES (:nc)");
        $stmt->execute([":nc" => $numero_control]);

        $lastId = $conn->lastInsertId();

        if ($lastId) {
            $_SESSION['usuario_id'] = $lastId;

            echo "<script>
                    alert('Usuario registrado y logueado.');
                    window.location.href='servicios.php';
                  </script>";
            exit();
        } else {
            echo "❌ Error al registrar usuario";
        }
    }

    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/logo-removebg-preview.ico" type="image/x-icon">  
  <title>Acceso - Papelería UTEM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-box {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
      width: 100%;
      max-width: 400px;
      color: #fff;
    }

    .login-box h1 {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 10px;
      color: #00e5ff;
    }

    .login-box h3 {
      text-align: center;
      font-size: 1.2rem;
      margin-bottom: 30px;
      color: #80deea;
    }

    .login-box input {
      background: #0d1b2a;
      border: 1px solid #00e5ff;
      color: #fff;
      border-radius: 8px;
      padding: 10px;
      margin-bottom: 20px;
      width: 100%;
    }

    .login-box button {
      background: linear-gradient(45deg, #00e5ff, #00bcd4);
      color: #000;
      font-weight: bold;
      border: none;
      border-radius: 10px;
      padding: 12px;
      width: 100%;
      transition: background 0.3s ease;
    }

    .login-box button:hover {
      background: linear-gradient(45deg, #00bcd4, #00acc1);
    }

    .alert {
      background-color: #ff5252;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px;
      margin-bottom: 20px;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="login-box">
  <h1>Papelería UTEM</h1>
  <h3>Accede con tu número de control</h3>

  <?php if ($mensaje): ?>
    <div class="alert"><?= htmlspecialchars($mensaje) ?></div>
  <?php endif; ?>

  <form method="POST">
    <input type="text" name="numero_control" placeholder="Número de Control" required>
    <button type="submit">Ingresar</button>
  </form>
</div>

</body>
</html>