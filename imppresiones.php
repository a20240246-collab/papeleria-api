<?php
session_start();

$msg = '';

// ======================= CONEXIÓN MYSQL =======================
$host = "localhost";
$dbname = "papeleria_utem";
$user = "root"; // cambia si usas otro
$password = ""; // tu contraseña

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("❌ Error al conectar: " . $e->getMessage());
}

// ======================= CARPETA PARA GUARDAR PDFs =======================
$uploadDir = __DIR__ . '/uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// ======================= SUBIR PDF =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf'])) {

    $archivo = $_FILES['pdf'];

    // Validar que sea PDF
    if ($archivo['type'] !== 'application/pdf') {
        $msg = "❌ Solo se permiten archivos PDF.";
    } else {

        $nombrePdf = uniqid() . "_" . basename($archivo['name']);
        $rutaDestino = $uploadDir . $nombrePdf;

        if ($archivo['error'] === UPLOAD_ERR_OK) {

            if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {

                // ⚠️ puedes cambiar esto por sesión si quieres
                $usuario_id = $_SESSION['usuario_id'] ?? 1;

                // INSERT seguro con PDO
                $stmt = $conn->prepare("
                    INSERT INTO archivos_impresion (nombre_archivo, ruta_archivo, usuario_id)
                    VALUES (:nombre, :ruta, :usuario)
                ");

                $res = $stmt->execute([
                    ":nombre" => $nombrePdf,
                    ":ruta" => $rutaDestino,
                    ":usuario" => $usuario_id
                ]);

                $msg = $res
                    ? "✅ PDF subido y guardado correctamente"
                    : "❌ Error al guardar en la base de datos";

            } else {
                $msg = "❌ Error al mover el archivo.";
            }

        } else {
            $msg = "❌ Error al subir el archivo.";
        }
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>  <link rel="icon" href="img/logo-removebg-preview.ico" type="image/x-icon">  
  <meta charset="UTF-8">
  <title>Subir PDF - Papelería UTEM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #f1f1f1;
      padding-top: 90px;
    }

    h2 {
      text-align: center;
      font-weight: bold;
      margin-bottom: 50px;
      font-size: 2.5rem;
      color: #00e5ff;
      text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
    }

    .card {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 30px;
      text-align: center;
      backdrop-filter: blur(10px);
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      color: #fff;
      max-width: 500px;
      margin: auto;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 0 25px rgba(0, 255, 255, 0.3);
    }

    .form-label, input.form-control, button.btn {
      color: #fff;
    }

    input.form-control {
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.2);
      border-radius: 12px;
      color: #fff;
    }

    input.form-control:focus {
      background: rgba(255,255,255,0.15);
      border-color: #00e5ff;
      color: #fff;
      box-shadow: 0 0 10px rgba(0, 229, 255, 0.5);
    }

    button.btn-primary {
      background: #00e5ff;
      color: #0f2027;
      border: none;
      border-radius: 12px;
      font-weight: bold;
      transition: 0.3s;
    }

    button.btn-primary:hover {
      background: #00b8cc;
      color: #fff;
    }

    .alert {
      border-radius: 12px;
      backdrop-filter: blur(10px);
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container py-5">
  <h2>Subir PDF</h2>

  <?php if ($msg): ?>
      <div class="alert alert-info"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>

  <div class="card">
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3 text-start">
        <label for="pdf" class="form-label">Selecciona un archivo PDF</label>
        <input type="file" name="pdf" id="pdf" accept="application/pdf" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Subir PDF</button>
    </form>
  </div>
</div>

</body>
</html>

