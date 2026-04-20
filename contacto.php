<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Contacto - Papelería UTEM</title>  <link rel="icon" href="img/logo-removebg-preview.ico" type="image/x-icon">  
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
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 0 25px rgba(0, 255, 255, 0.3);
    }

    .card i {
      font-size: 2.5rem;
      margin-bottom: 15px;
    }

    .card h5 {
      font-weight: bold;
      color: #00e5ff;
    }

    .card p, .card a {
      font-size: 1rem;
      color: #cfd8dc;
      text-decoration: none;
    }

    .card a:hover {
      color: #00e5ff;
      text-decoration: underline;
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
  <h2>Contáctanos</h2>
  <div class="row justify-content-center g-4">

    <!-- Dirección -->
    <div class="col-md-4">
      <div class="card">
        <i class="fas fa-map-marker-alt text-info"></i>
        <h5>Dirección</h5>
        <p>Camino hacia las humedades S/N<br>Salagua, 28869 Manzanillo, Col.</p>
      </div>
    </div>

    <!-- Facebook -->
    <div class="col-md-4">
      <div class="card">
        <i class="fab fa-facebook text-primary"></i>
        <h5>Facebook</h5>
        <p>
          <a href="https://www.facebook.com/universidadutem/?locale=es_LA" target="_blank">
            UTEM Manzanillo
          </a>
        </p>
      </div>
    </div>

    <!-- Instagram -->
    <div class="col-md-4">
      <div class="card">
        <i class="fab fa-instagram text-danger"></i>
        <h5>Instagram</h5>
        <p>
          <a href="https://www.instagram.com/universidadutem/?hl=es" target="_blank">
            @universidadutem
          </a>
        </p>
      </div>
    </div>

  </div>
</div>

</body>
</html>