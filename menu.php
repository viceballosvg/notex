<nav class="navbar bg-primary border-bottom border-body navbar-expand-lg mb-5" data-bs-theme="dark">
<div class="container-fluid">
    <a class="navbar-brand"><i class="fa-solid fa-screwdriver-wrench"></i> Herramientas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link<?php if(isset($activo) && $activo=='tareas') echo ' active'; ?>" aria-current="page" href="./">Tareas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php if(isset($activo) && $activo=='grupos') echo ' active'; ?>" href="grupos.php">Grupos</a>
        </li>
      </ul>
    </div>
      <form class="d-flex" role="search" method="post" action="./">
        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" name="q"
        <?php
        if(isset($_POST['q'])){
          $q=filter_var($_POST['q'], FILTER_SANITIZE_STRING);
          echo ' value="'.$q.'"';
          }
        ?>
        >
        <button class="btn btn-info" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
  </div>
</nav>