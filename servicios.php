<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Papelería UTEM</title>  <link rel="icon" href="img/logo-removebg-preview.ico" type="image/x-icon">  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
 body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
  color: #f1f1f1;
  padding-top: 90px;
}

/* ---- CARRUSEL PROFESIONAL ---- */
.carrusel-img {
  height: 350px;
  width: 100%;
  object-fit: cover;
  filter: brightness(0.55) contrast(1.2) saturate(1.1);
  border-radius: 15px;
  transition: filter 0.3s ease-in-out;
}

.carousel-item:hover .carrusel-img {
  filter: brightness(0.70) contrast(1.3);
}

.carousel-caption h5 {
  font-size: 2rem;
  font-weight: bold;
  text-shadow: 0 0 10px rgba(0,0,0,0.8);
}

.carousel-caption p {
  font-size: 1.1rem;
  text-shadow: 0 0 10px rgba(0,0,0,0.8);
}

/* ---- PRODUCTOS ---- */
#productos {
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(4, 1fr); /* 4 tarjetas por fila */
  gap: 30px;
  padding: 30px;
}

.product-card {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 20px;
  padding: 20px;
  text-align: center;
  backdrop-filter: blur(10px);
  box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 0 25px rgba(0, 255, 255, 0.3);
}

.product-card img {
  width: 100%;
  aspect-ratio: 4/3;      /* Ajusta la proporción deseada */
  object-fit: cover;      
  border-radius: 12px;
  margin-bottom: 15px;
  background: #111;
  display: block;
}

.product-card h3 {
  color: #00e5ff;
  font-size: 1.4rem;
  margin-bottom: 5px;
}

.product-card p {
  color: #80deea;
  font-size: 1rem;
  margin-bottom: 12px;
}

.product-card input {
  width: 70px;
  text-align: center;
  border-radius: 8px;
  border: 1px solid #00e5ff;
  background: #0d1b2a;
  color: #fff;
  margin-bottom: 12px;
}

.product-card .btn {
  background: linear-gradient(45deg, #00e5ff, #00bcd4);
  color: #000;
  font-weight: bold;
  border: none;
  border-radius: 10px;
  padding: 10px 20px;
  transition: background 0.3s ease;
}

.product-card .btn:hover {
  background: linear-gradient(45deg, #00bcd4, #00acc1);
}

#impresiones-btn {
  grid-column: span 4;
  background: linear-gradient(135deg, #ff4081, #f50057);
  color: #fff;
  font-size: 1.2rem;
  font-weight: bold;
  padding: 16px;
  border: none;
  border-radius: 16px;
  text-align: center;
  cursor: pointer;
  display: block;
  text-decoration: none;
  margin-top: 10px;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

#impresiones-btn:hover {
  transform: scale(1.03);
  box-shadow: 0 0 20px rgba(255, 64, 129, 0.5);
}

/* --- RESPONSIVE --- */
@media (max-width: 1024px) {
  #productos {
    grid-template-columns: repeat(2, 1fr); /* 2 por fila en tablet */
  }
}

@media (max-width: 600px) {
  #productos {
    grid-template-columns: 1fr; /* 1 por fila en móvil */
  }
}

  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<!-- ===================== CARRUSEL PROFESIONAL ====================== -->
<div class="container mb-5">
  <div id="ofertasCarousel" class="carousel slide" data-bs-ride="carousel">

    <!-- Indicadores -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#ofertasCarousel" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#ofertasCarousel" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#ofertasCarousel" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">

      <!-- Imagen 1 -->
      <div class="carousel-item active">
        <img src="img/papeleria-escuela-accesorios_1101-373.avif" class="d-block w-100 carrusel-img" alt="Oferta 1">
        <div class="carousel-caption d-none d-md-block">
          <h5>Grandes Rebajas</h5>
          <p>Aprovecha las mejores ofertas de temporada.</p>
        </div>
      </div>

      <!-- Imagen 2 -->
      <div class="carousel-item">
        <img src="img/Portadas-Blog-Super-Papelera.webp" class="d-block w-100 carrusel-img" alt="Oferta 2">
        <div class="carousel-caption d-none d-md-block">
          <h5>Nuevos Productos</h5>
          <p>Todo lo que necesitas para tu estudio o trabajo.</p>
        </div>
      </div>

      <!-- Imagen 3 -->
      <div class="carousel-item">
        <img src="img/julio-regalado-2022-papeleria.jpg" class="d-block w-100 carrusel-img" alt="Oferta 3">
        <div class="carousel-caption d-none d-md-block">
          <h5>Promociones Únicas</h5>
          <p>Descuentos que no puedes dejar pasar.</p>
        </div>
      </div>

    </div>

    <!-- Controles -->
    <button class="carousel-control-prev" type="button" data-bs-target="#ofertasCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#ofertasCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>

  </div>
</div>
<!-- ===================== FIN CARRUSEL PROFESIONAL ====================== -->


<div class="container">
  <section id="productos">

    <!-- Producto: Lápices -->
    <div class="product-card">
      <img src="img/lapiz.jpg" alt="Lápiz">
      <h3>Lápices</h3>
      <p>$10 c/u</p>
      <input type="number" min="1" value="1" id="qty-lapiz">
      <button class="btn" onclick="addToCart('Lápices', 10, document.getElementById('qty-lapiz').value)">Añadir al carrito</button>
    </div>

    <!-- Producto: Cuadernos -->
    <div class="product-card">
      <img src="img/cuadernos.jpg" alt="Cuaderno">
      <h3>Cuadernos</h3>
      <p>$30 c/u</p>
      <input type="number" min="1" value="1" id="qty-cuaderno">
      <button class="btn" onclick="addToCart('Cuadernos', 30, document.getElementById('qty-cuaderno').value)">Añadir al carrito</button>
    </div>

    <!-- Producto: Plumones -->
    <div class="product-card">
      <img src="img/plumones.jpg" alt="Plumones">
      <h3>Plumones</h3>
      <p>$75 c/u</p>
      <input type="number" min="1" value="1" id="qty-pluma">
      <button class="btn" onclick="addToCart('Plumones', 75, document.getElementById('qty-pluma').value)">Añadir al carrito</button>
    </div>

    <!-- Producto: Lapiceras -->
    <div class="product-card">
      <img src="img/lapicera.webp" alt="Lapicera">
      <h3>Lapiceras</h3>
      <p>$40 c/u</p>
      <input type="number" min="1" value="1" id="qty-lapicera">
      <button class="btn" onclick="addToCart('Lapiceras', 40, document.getElementById('qty-lapicera').value)">Añadir al carrito</button>

      
    </div>
    <!-- ================== FILA 2 ================== -->

    <!-- Producto: Tijeras -->
    <div class="product-card">
      <img src="img/tijeras.jpg" alt="Tijeras">
      <h3>Tijeras</h3>
      <p>$25 c/u</p>
      <input type="number" min="1" value="1" id="qty-tijeras">
      <button class="btn" onclick="addToCart('Tijeras', 25, document.getElementById('qty-tijeras').value)">Añadir al carrito</button>
    </div>

    <!-- Producto: Regla -->
    <div class="product-card">
      <img src="img/reglas.jpg" alt="Regla">
      <h3>Reglas</h3>
      <p>$15 c/u</p>
      <input type="number" min="1" value="1" id="qty-regla">
      <button class="btn" onclick="addToCart('Reglas', 15, document.getElementById('qty-regla').value)">Añadir al carrito</button>
    </div>

    <!-- Producto: Borradores -->
    <div class="product-card">
      <img src="img/borrados.jpg" alt="Borrador">
      <h3>Borradores</h3>
      <p>$8 c/u</p>
      <input type="number" min="1" value="1" id="qty-borrador">
      <button class="btn" onclick="addToCart('Borradores', 8, document.getElementById('qty-borrador').value)">Añadir al carrito</button>
    </div>

    <!-- Producto: Sacapuntas -->
    <div class="product-card">
      <img src="img/sacapuntas.webp" alt="Sacapuntas">
      <h3>Sacapuntas</h3>
      <p>$12 c/u</p>
      <input type="number" min="1" value="1" id="qty-sacapuntas">
      <button class="btn" onclick="addToCart('Sacapuntas', 12, document.getElementById('qty-sacapuntas').value)">Añadir al carrito</button>
    </div>


    <!-- ================== FILA 3 ================== -->

    <!-- Producto: Carpetas -->
    <div class="product-card">
      <img src="img/carpetas.jpg" alt="Carpeta">
      <h3>Carpetas</h3>
      <p>$20 c/u</p>
      <input type="number" min="1" value="1" id="qty-carpeta">
      <button class="btn" onclick="addToCart('Carpetas', 20, document.getElementById('qty-carpeta').value)">Añadir al carrito</button>
    </div>

    <!-- Producto: Pegamento -->
    <div class="product-card">
      <img src="img/pegamento.avif" alt="Pegamento">
      <h3>Pegamento</h3>
      <p>$18 c/u</p>
      <input type="number" min="1" value="1" id="qty-pegamento">
      <button class="btn" onclick="addToCart('Pegamento', 18, document.getElementById('qty-pegamento').value)">Añadir al carrito</button>
    </div>

    <!-- Producto: Clips -->
    <div class="product-card">
      <img src="img/clips.jpg" alt="Clips">
      <h3>Clips</h3>
      <p>$5 por paquete</p>
      <input type="number" min="1" value="1" id="qty-clips">
      <button class="btn" onclick="addToCart('Clips', 5, document.getElementById('qty-clips').value)">Añadir al carrito</button>
    </div>

    <!-- Producto: Hojas Blancas -->
    <div class="product-card">
      <img src="img/hojas_blancas.jpg" alt="Hojas blancas">
      <h3>Hojas Blancas</h3>
      <p>$60 paquete</p>
      <input type="number" min="1" value="1" id="qty-hojas">
      <button class="btn" onclick="addToCart('Hojas Blancas', 60, document.getElementById('qty-hojas').value)">Añadir al carrito</button>
    </div>

  

  </section>
</div>
<footer class="footer">
  <div class="footer-container">
    <div class="footer-about">
      <h3>Papelería UTEM</h3>
      <p>Tu mejor opción en material de papelería e impresiones. Calidad y rapidez en cada servicio.</p>
    </div>

    <div class="footer-links">
      <h4>Enlaces Rápidos</h4>
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="servicios.php">Servicios</a></li>
        <li><a href="horarios.php">Horarios</a></li>
        <li><a href="contacto.php">Contacto</a></li>
      </ul>
    </div>

    <div class="footer-social">
      <h4>Síguenos</h4>
      <div class="social-icons">
        <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="#" target="_blank"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; <?= date('Y') ?> Papelería UTEM. Todos los derechos reservados.</p>
  </div>
</footer>

<style>
.footer {
  background: linear-gradient(90deg, #0f2027, #203a43, #2c5364);
  color: #fff;
  padding: 40px 20px 20px 20px;
  font-family: Arial, sans-serif;
}

.footer-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 30px;
  max-width: 1200px;
  margin: auto;
}

.footer-about h3 {
  font-size: 1.6rem;
  color: #00e5ff;
  margin-bottom: 10px;
}

.footer-about p {
  line-height: 1.6;
  max-width: 300px;
}

.footer-links h4,
.footer-social h4 {
  font-size: 1.2rem;
  margin-bottom: 10px;
  color: #00e5ff;
}

.footer-links ul {
  list-style: none;
  padding: 0;
}

.footer-links ul li {
  margin-bottom: 8px;
}

.footer-links ul li a {
  color: #fff;
  text-decoration: none;
  transition: color 0.3s;
}

.footer-links ul li a:hover {
  color: #00bcd4;
}

.footer-social .social-icons {
  display: flex;
  gap: 15px;
}

.footer-social .social-icons a {
  color: #fff;
  font-size: 1.4rem;
  transition: color 0.3s;
}

.footer-social .social-icons a:hover {
  color: #00bcd4;
}

.footer-bottom {
  text-align: center;
  margin-top: 20px;
  font-size: 0.9rem;
  color: #ccc;
}

/* Responsive */
@media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .footer-about p {
    max-width: 100%;
  }

  .footer-links ul {
    display: inline-block;
  }
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script>
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  function addToCart(product, price, quantity) {
    quantity = parseInt(quantity);
    if (quantity <= 0) return;

    let item = cart.find(i => i.product === product);
    if (item) {
      item.quantity += quantity;
    } else {
      cart.push({ product, price, quantity });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
