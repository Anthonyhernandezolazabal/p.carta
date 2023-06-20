<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 v-text="menu02"></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" v-text="menu02"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <button type="button" @click="dialogVisible = true" class="btn btn-info btn-flat mb-2 btn-sm">Imágen</button>
                <button type="button" class="btn btn-info btn-flat mb-2 btn-sm">Sección</button>
                <el-card shadow="hover">
                    <el-table :data="tableData" style="width: 100%">
                        <el-table-column type="expand">
                            <template slot-scope="props">
                                <p>{{ props.row.title }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>{{ props.row.price }}</small>
                                    <br> <small>{{ props.row.description }}</small></p>
                                <hr>
                                <p>{{ props.row.title }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>{{ props.row.price }}</small>
                                    <br> <small>{{ props.row.description }}</small></p>
                                <hr>
                                <p>{{ props.row.title }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>{{ props.row.price }}</small>
                                    <br> <small>{{ props.row.description }}</small></p>
                                <hr>
                                <p>{{ props.row.title }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>{{ props.row.price }}</small>
                                    <br> <small>{{ props.row.description }}</small></p>
                            </template>
                        </el-table-column>
                        <el-table-column label="Sección" prop="nameSection">
                        </el-table-column>
                        <el-table-column label="status" prop="status">
                        </el-table-column>
                    </el-table>
                </el-card>
            </div>
        </section>


        <el-dialog
          title="Imágen | Título | Descripción"
          :visible.sync="dialogVisible"
          width="50%"
          >
          <div v-loading="loadingImgMenu02">
              <div class="row">
                <div class="col-4">
                  <el-divider content-position="left">Subir Imágen</el-divider>
                  <div class="custom-file">
                      <input type="file" @change="getImagen" class="custom-file-input">
                      <label class="custom-file-label" for="customFile">Subir archivo</label>
                    </div>
                </div>
                <div class="col-8">
                  <el-divider content-position="left">Título</el-divider>
                  <el-input type="text" placeholder="Título" v-model="fillRegistroImagen.iTitle" maxlength="50" show-word-limit></el-input>
                </div>
              </div>
              <el-divider content-position="left">Descripción</el-divider>
              <el-input
                class="mb-2"
                type="textarea"
                placeholder="Descripción"
                v-model="fillRegistroImagen.iDescription"
                maxlength="100"
                show-word-limit
              >

              </el-input>


            <div class="card mb-2 bg-gradient-dark" v-bind:style="stlimg">
              <!-- <img class="card-img-top" :src="url" alt="Dist Photo 1"> -->
              <div class="card-img-overlay d-flex flex-column justify-content-center">
                <h5 class="card-title text-primary text-white text-center" v-text="fillRegistroImagen.iTitle"></h5>
                <p class="card-text text-white pb-2 pt-1 text-center" v-text="fillRegistroImagen.iDescription"></p>
              </div>
            </div>
            <span slot="footer" class="dialog-footer">
              <el-button @click="dialogVisible = false">Cancelar</el-button>
              <el-button type="primary" @click="saveRegistro" :disabled="loadingImgMenu02">Guardar</el-button>
            </span>

          </div>
        </el-dialog>



    </div>
</template>

<script>
    export default {
      mounted() {
          this.miMenuName();
          this.getListaMenu02();
      },
      data() {
          return {
              fillRegistroImagen: {
                iTitle: '',
                iDescription: '',
                iImagen: ''
              },
              url: '/img/img4-slide-2-1920x678.jpg',
              drawer: false,
              descrip: 'ttb',
              menu02: '',
              tableData: [{
                      status: 'Activo',
                      nameSection: 'BREAKFAST & STARTERS',
                      title: 'Delicious Dish',
                      description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                      price: 'S/35',
                  },
                  {
                      status: 'Activo',
                      nameSection: 'BREAKFAST & STARTERS',
                      title: 'Delicious Dish',
                      description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                      price: 'S/25',
                  },
                  {
                      status: 'Activo',
                      nameSection: 'BREAKFAST & STARTERS',
                      title: 'Delicious Dish',
                      description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                      price: 'S/15',
                  }
              ],
              dialogVisible: false,
              loadingImagen: false,
              stlimg: {
                background: '#444 url(/img/img4-slide-2-1920x678.jpg) center center no-repeat fixed !important',
                backgroundSize: 'cover',
                height: '300px',
              },
              loadingsaveImagen: false,
              loadingImgMenu02: false,
              form: new FormData,
              urlImgOld: '',
              idImg:''
          }
      },
      methods: {
        getListaMenu02(){
          this.loadingImgMenu02 = true;
          let url = 'menus/getListarMenus';
          axios
              .get(url+'/Menu02')
              .then((rpta) => {
                  this.loadingImgMenu02 = false;
                  if(rpta.data.length != 0){
                      let datos = JSON.parse(rpta.data[0].estructura).datajson.img_title_desc
                      this.fillRegistroImagen.iTitle = datos.title
                      this.fillRegistroImagen.iDescription = datos.desc
                      this.stlimg.background = '#444 url('+datos.img+') center center no-repeat fixed !important';
                      this.urlImgOld = datos.img
                      this.idImg = rpta.data[0].id
                  }
              })
              .catch(function (error) {
                  toastr.error(error);
          });
        },
        miMenuName() {
            let url = 'navegation/sbMenu';
            axios
                .get(url)
                .then((rpta) => {
                    (rpta["data"] != 0) ? (this.menu02 = rpta["data"]["menu02"]) : this.menu02 = 'Menú 02'
                })
                .catch(function (error) {
                    toastr.error(error);
                });
        },
        getImagen(e){
            this.loadingImagen = true;
            const isIMG = e.target.files[0].type;
            const isLt2M = e.target.files[0].size;
            if (isIMG != 'image/jpeg' && isIMG != 'image/png' && isIMG != 'image/gif') {
                this.$message.error('La imagen debe estar en formato JPG, PNG o GIF!');
                this.loadingImagen = false;
            } else if (isLt2M > 4000000) {
                this.$message.error('La imagen excede los 4MB!');
                this.loadingImagen = false;
            } else {
                this.loadingImagen = false;
                this.fillRegistroImagen.iImagen = e.target.files[0];
                this.stlimg.background = '#444 url('+URL.createObjectURL(e.target.files[0])+') center center no-repeat fixed !important';
            }
            return isIMG && isLt2M;
        },
        saveRegistro() {
                this.loadingImgMenu02 = true;
                if (this.validarRegistros('img')) {
                    this.loadingImgMenu02 = false;
                    return;
                }
                this.form.append('iTitle', this.fillRegistroImagen.iTitle)
                this.form.append('iDescription', this.fillRegistroImagen.iDescription)
                this.form.append('iImagen', this.fillRegistroImagen.iImagen)
                this.form.append('urlImgOld', this.urlImgOld)
                this.form.append('id', this.idImg)
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                // let arr = [
                //   {
                //     'tipo': 'menu02',
                //     'datajson':
                //       [
                //         {
                //           'img_title_desc':
                //               {
                //                 'img': 'ruta de la imagen',
                //                 'title': 'Menú',
                //                 'desc': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed'
                //               },
                //           'carta':
                //           [
                //             {
                //               'section': 'BREAKFAST & STARTERS',
                //               'listas':
                //               [

                //                 {
                //                   'title': 'Delicious Dish',
                //                   'price': '$35',
                //                   'detalle': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                //                 },

                //                 {
                //                   'title': 'Delicious Dish',
                //                   'price': '$30',
                //                   'detalle': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                //                 },

                //                 {
                //                   'title': 'Delicious Dish',
                //                   'price': '$25',
                //                   'detalle': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                //                 },

                //               ]
                //             },
                //             {
                //               'section': 'MAIN COURSE',
                //               'listas':
                //               [

                //                 {
                //                   'title': 'Delicious Dish',
                //                   'price': '$35',
                //                   'detalle': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                //                 },

                //                 {
                //                   'title': 'Delicious Dish',
                //                   'price': '$30',
                //                   'detalle': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                //                 },

                //                 {
                //                   'title': 'Delicious Dish',
                //                   'price': '$25',
                //                   'detalle': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                //                 },

                //               ]
                //             }
                //           ]
                //         }
                //       ]
                //   }
                // ]
                var url = '/menus/setRegistrarImagenMenu02'
                axios.post(url, this.form, config).then(response => {
                    this.loadingImgMenu02 = false;
                    this.$message({
                        message: 'Se ha registrado correctamente!.',
                        type: 'success'
                    });
                    this.getListaMenu02();
                    this.dialogVisible = false
                }).catch(error => {
                   toastr.error(error);
                })
        },
        validarRegistros(tipo){
              this.error = 0;
              let msm = "";

              if(tipo == 'img'){
                if (!this.fillRegistroImagen.iTitle) {
                    msm = "¡Ingrese un título!";
                    toastr.info(msm);
                    this.error = 1;
                }
                if (!this.fillRegistroImagen.iDescription) {
                    msm = "¡Ingrese descripción!";
                    toastr.info(msm);
                    this.error = 1;
                }
                if(this.idImg == ''){
                    if (!this.fillRegistroImagen.iImagen) {
                        msm = "¡La imágen es un campo requerido!";
                        toastr.info(msm);
                        this.error = 1;
                    }
                }
              }
              return this.error;
          },
      }
    };
</script>
