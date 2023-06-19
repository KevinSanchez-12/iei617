<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="max-container container-fluid">
    <a href="home"><img class="logoMenu" src="assets/img/logoiep.png"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home">Mi Inventario</a>
        </li>
        <li class="nav-item closeSesion">
          <a class="nav-link" onclick="eliminarLocalStorage()">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<script>
  function eliminarLocalStorage() {
      localStorage.removeItem("token");
      location.href = "index";
  }
</script>