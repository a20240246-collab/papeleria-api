<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$pages = [
  'Servicios' => 'servicios.php',
  'Horarios'  => 'horarios.php',
  'Contacto'  => 'contacto.php'
];
?>
<nav class="navbar">
    <link rel="icon" href="img/logo-removebg-preview.ico" type="image/x-icon">  
  <div class="navbar-left">
    <a href="index.php" class="logo">
      <img src="img/ChatGPT_Image_18_nov_2025__11_41_19-removebg-preview.png" alt="Papelería UTEM" class="logo-img">
      <span class="logo-text">Papeleria</span>
    </a>
  </div>

  <button class="menu-toggle">&#9776;</button>

  <ul class="nav-links">
    <?php foreach ($pages as $name => $file): ?>
      <?php if ($currentPage !== $file): ?>
        <li><a href="<?= $file ?>"><?= $name ?></a></li>
      <?php endif; ?>
    <?php endforeach; ?>
    <li><a href="imppresiones.php" class="btn-impresiones"><i class="fas fa-print"></i> Impresiones</a></li>
    <li>
      <a href="carrito.php" class="cart-btn">
        <i class="fas fa-shopping-cart fa-lg"></i>
        <span class="cart-count" id="cart-count">0</span>
      </a>
    </li>
  </ul>
</nav>

<style>
/* Navbar */
.navbar {
  background: linear-gradient(90deg, #0f2027, #203a43, #2c5364);
  padding: 10px 24px;
  position: fixed;
  top: 0;
  width: 100%;
  height: 80px; /* Mantiene el tamaño original */
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  z-index: 1000;
  color: #fff;
}

/* MOVER “Papeleria” A LA DERECHA + COLOR AZUL UTEM */
.logo-text {
  margin-left: 140px; /* Ajustable: 100–160 según lo necesites */
  color: #00e5ff;     /* Azul UTEM */
  font-weight: bold;
  font-size: 1.5rem;
}

.navbar-left {
  display: flex;
  align-items: center;
  gap: 15px;
}

/* Logo */
.logo {
  display: flex;
  align-items: center;
  text-decoration: none;
}

.logo-img {
  height: 50px;       /* tamaño real */
  width: auto;
  margin-right: 10px;
  transform: scale(3.2); /* LOGO ENORME */
  transform-origin: left center;
}

/* Botón Impresiones */
.btn-impresiones {
  display: flex;
  align-items: center;
  background: #00bcd4;
  color: #fff;
  padding: 6px 12px;
  border-radius: 5px;
  text-decoration: none;
  font-weight: 500;
  transition: background 0.3s;
}

.btn-impresiones i {
  margin-right: 5px;
}

.btn-impresiones:hover {
  background: #00e5ff;
}

/* Menu toggle */
.menu-toggle {
  font-size: 2rem;
  color: #00e5ff;
  border: none;
  background: none;
  cursor: pointer;
  display: block;
}

/* Links */
.nav-links {
  list-style: none;
  padding: 0;
  margin: 0;
  display: none;
  flex-direction: column;
  background: #1c2b3a;
  position: absolute;
  top: 70px;
  right: 20px;
  border-radius: 10px;
  min-width: 180px;
  box-shadow: 0 6px 12px rgba(0,0,0,0.3);
  z-index: 100;
}

.nav-links li a {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 18px;
  color: #fff;
  text-decoration: none;
  font-weight: 500;
  transition: background 0.3s;
}

.nav-links li a:hover {
  background: #00bcd4;
}

.cart-btn {
  color: #fff;
  position: relative;
  text-decoration: none;
}

.cart-count {
  position: absolute;
  top: -8px;
  right: -10px;
  background: #ff4081;
  color: #fff;
  font-size: 0.75rem;
  padding: 2px 6px;
  border-radius: 50%;
}

.nav-links.show {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

/* Responsive */
@media (min-width: 768px) {
  .nav-links {
    display: flex !important;
    flex-direction: row;
    position: static;
    background: none;
    box-shadow: none;
    border-radius: 0;
    margin-left: 20px;
    gap: 15px;
  }

  .nav-links li a {
    padding: 10px 15px;
  }

  .menu-toggle {
    display: none;
  }

  .navbar-left {
    gap: 25px;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const toggleButton = document.querySelector('.menu-toggle');
  const navLinks = document.querySelector('.nav-links');

  toggleButton.addEventListener('click', () => {
    navLinks.classList.toggle('show');
  });

  function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    const cartElement = document.getElementById('cart-count');
    if (cartElement) cartElement.textContent = count;
  }

  updateCartCount();

  window.addToCart = function(product, price) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let existing = cart.find(item => item.product === product);
    if (existing) {
      existing.quantity += 1;
    } else {
      cart.push({ product, price, quantity: 1 });
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
  };
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
