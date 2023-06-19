<template>
    <div>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 v-text="menu05"></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" v-text="menu05"></li>
              </ol>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      <section class="content">
          <div class="container-fluid">
              <!-- Default box -->
              <div class="card">
                  <div class="card-header">
                  <h3 class="card-title">Title</h3>

                  <div class="card-tools">
                      <button
                      type="button"
                      class="btn btn-tool"
                      data-card-widget="collapse"
                      title="Collapse"
                      >
                      <i class="fas fa-minus"></i>
                      </button>
                      <button
                      type="button"
                      class="btn btn-tool"
                      data-card-widget="remove"
                      title="Remove"
                      >
                      <i class="fas fa-times"></i>
                      </button>
                  </div>
                  </div>
                  <div class="card-body">Start creating your amazing application!</div>
                  <!-- /.card-body -->
                  <div class="card-footer">Footer</div>
                  <!-- /.card-footer-->
              </div>
          </div>
        <!-- /.card -->
      </section>
    </div>
  </template>

  <script>
  export default {
    mounted() {
      this.miMenuName();
    },
    data(){
        return {
            menu05: ''
        }
    },
    methods: {
        miMenuName() {
            let url = 'navegation/sbMenu';
            axios
                .get(url)
                .then((rpta) => {
                    (rpta["data"] != 0) ? (this.menu05 = rpta["data"]["menu05"]) : this.menu05 = 'Menú 05'
                })
                .catch(function (error) {
                    toastr.error(error);
                });
        },
    }
  };
  </script>
