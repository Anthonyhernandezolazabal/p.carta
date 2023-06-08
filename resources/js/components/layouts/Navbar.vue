<template>
  <div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"
            ><i class="fas fa-bars"></i
          ></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false" >
            <img :src="'img/user2-160x160.jpg'" class="img-circle" height="30px" />
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Administrador</span>
            <div class="dropdown-divider"></div>
            <router-link :to="'/'" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> Cerrar sesión
            </router-link>
          </div>
        </li>
      </ul>
    </nav>
  </div>
</template>
  
<script>
export default {
  mounted() {
    console.log("Componente NavBar.");
  },
};
</script>
  