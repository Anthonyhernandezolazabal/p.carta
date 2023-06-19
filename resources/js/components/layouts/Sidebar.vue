<template>
    <div>
      <aside class="main-sidebar sidebar-dark-primary elevation-4"
        v-loading="loadingNav"
        element-loading-background="rgba(0, 0, 0, 0.4)"
      >
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link">
          <img
            :src="'/img/AdminLTELogo.png'"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: 0.8"
          />
          <span class="brand-text font-weight-light">Post Venta 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img
                :src="'/img/user2-160x160.jpg'"
                class="img-circle elevation-2"
                alt="User Image"
              />
            </div>
            <div class="info">
              <a href="#" class="d-block">Alexander Pierce</a>
            </div>
          </div>


          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-header">NAVEGACIÓN</li>
              <li class="nav-item">
                <router-link :to="'/'" target="_blank" class="nav-link">
                    <i class="nav-icon far fas fa-globe"></i>
                    <p>Sitio web</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="'/navegation'" class="nav-link">
                    <i class="nav-icon far fas fa-reorder"></i>
                    <p>Navegación</p>
                </router-link>
              </li>
              <li class="nav-item">
                  <router-link :to="'/sliders'"  class="nav-link">
                      <i class="nav-icon far fas fa-tag"></i>
                      <p>Sliders</p>
                  </router-link>
              </li>
              <li class="nav-header">MENÚS</li>
              <li class="nav-item">
                <router-link :to="'/menu01'" class="nav-link">
                  <i class="el-icon-paperclip"></i>
                  <p v-text="listMenu.menu01"></p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="'/menu02'" class="nav-link">
                  <i class="el-icon-paperclip"></i>
                  <p v-text="listMenu.menu02"></p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="'/menu03'" class="nav-link">
                  <i class="el-icon-paperclip"></i>
                  <p v-text="listMenu.menu03"></p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="'/menu04'" class="nav-link">
                  <i class="el-icon-paperclip"></i>
                  <p v-text="listMenu.menu04"></p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="'/menu05'" class="nav-link">
                  <i class="el-icon-paperclip"></i>
                  <p v-text="listMenu.menu05"></p>
                </router-link>
              </li>

              <li class="nav-header">REPORTES</li>
              <li class="nav-item">
                <a href="reportes" class="nav-link">
                  <i class="nav-icon far fa-file-powerpoint"></i>
                  <p>Reporte de Ventas</p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
    </div>
  </template>

  <script>
  export default {
    mounted() {
      this.getListaMenusSidebar();
    },
    data(){
        return {
            listMenu: {
                menu01: 'Menú 01',
                menu02: 'Menú 02',
                menu03: 'Menú 03',
                menu04: 'Menú 04',
                menu05: 'Menú 05',
            },
            loadingNav: false
        }
    },
    methods: {

        getListaMenusSidebar() {
                let url = 'navegation/sbMenu';
                axios
                    .get(url)
                    .then((rpta) => {
                        if (rpta["data"] != 0) {
                            let menu=rpta["data"];
                            this.listMenu.menu01 = menu["menu01"];
                            this.listMenu.menu02 = menu["menu02"];
                            this.listMenu.menu03 = menu["menu03"];
                            this.listMenu.menu04 = menu["menu04"];
                            this.listMenu.menu05 = menu["menu05"];
                        }

                    })
                    .catch(function (error) {
                        // toastr.error(error);
                    });
            },
    }
  };
  </script>
