<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Horarios - Papelería UTEM</title>  <link rel="icon" href="img/logo-removebg-preview.ico" type="image/x-icon">  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #1e3c72, #2a5298);
      padding-top: 90px;
      color: #fff;
    }
    h2 {
      text-align: center;
      font-weight: bold;
      margin-bottom: 50px;
      font-size: 2.5rem;
      text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
    }
    .card {
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.2);
      border-radius: 16px;
      padding: 30px;
      text-align: center;
      backdrop-filter: blur(8px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      transition: transform 0.3s ease;
    }
    .card:hover {
      transform: translateY(-6px);
    }
    .card i {
      font-size: 2.5rem;
      color: #00e5ff;
      margin-bottom: 15px;
    }
    .card h4 {
      font-weight: bold;
      color: #fff;
    }
    .card p {
      font-size: 1.1rem;
      color: #cfd8dc;
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
  <h2>Horarios de Atención</h2>
  <div class="row justify-content-center g-4">

    <div class="col-md-4">
      <div class="card">
        <i class="fas fa-calendar-alt"></i>
        <h4>Lunes - Viernes</h4>
        <p>9:00 AM - 4:00 PM</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <i class="fas fa-clock"></i>
        <h4>Sábados</h4>
        <p>Cerrado</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <i class="fas fa-hourglass-half"></i>
        <h4>Domingos</h4>
        <p>Cerrado</p>
      </div>
    </div>

  </div>
</div>

</body>
</html>