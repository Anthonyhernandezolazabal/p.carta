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
                <button type="button" @click="table = true" class="btn btn-info btn-flat mb-2 btn-sm">Sección</button>
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 mb-4" v-for="row,i in dCarta" :key="i">
                        <el-card class="box-card" style="height: 600px;overflow-y: auto">
                            <div slot="header" class="clearfix">
                                <span v-text="row.section"></span>
                                <el-button @click="confirmar(i)" style="float: right; padding: 3px 0;" type="text"><i class="el-icon-delete-solid" style="color: #F56C6C"></i></el-button>
                                <el-button @click="edelCarta(i,'edit')" style="float: right; padding: 3px 0; margin-right: 5px" type="text"><i class="el-icon-edit" style="color: #E6A23C"></i></el-button>
                            </div>
                            <div class="text item">
                                <div v-for="item,e in row.listas" :key="e">
                                    <p v-text="item.title" class="mb-0"></p>
                                    <small style="float: right;margin-top: -17px;" v-text="'S/'+item.price"></small>
                                    <small v-text="item.detalle"></small>
                                    <hr>
                                </div>
                            </div>
                        </el-card>
                    </div>

                </div>
            </div>
        </section>

        <!-- REGISTRO DE LA IMÁGEN TÍTULO Y DESCRIPCIÓN -->
        <el-dialog title="Imágen | Título | Descripción" :visible.sync="dialogVisible" width="50%">
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
                        <el-input type="text" placeholder="Título" v-model="fillRegistroImagen.iTitle" maxlength="50"
                            show-word-limit></el-input>
                    </div>
                </div>
                <el-divider content-position="left">Descripción</el-divider>
                <el-input class="mb-2" type="textarea" placeholder="Descripción"
                    v-model="fillRegistroImagen.iDescription" maxlength="100" show-word-limit>

                </el-input>


                <div class="card mb-2 bg-gradient-dark" v-bind:style="stlimg">
                    <!-- <img class="card-img-top" :src="url" alt="Dist Photo 1"> -->
                    <div class="card-img-overlay d-flex flex-column justify-content-center">
                        <h5 class="card-title text-primary text-white text-center" v-text="fillRegistroImagen.iTitle">
                        </h5>
                        <p class="card-text text-white pb-2 pt-1 text-center" v-text="fillRegistroImagen.iDescription">
                        </p>
                    </div>
                </div>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="dialogVisible = false">Cancelar</el-button>
                    <el-button type="primary" @click="saveRegistro" :disabled="loadingImgMenu02">Guardar</el-button>
                </span>

            </div>
        </el-dialog>

        <!-- REGISTRO DE LA CARTA -->
        <el-drawer title="Registrar carta" :visible.sync="table" direction="rtl" size="50%">
            <el-form :model="dynamicValidateForm" ref="dynamicValidateForm" label-width="120px" class="demo-dynamic">
                <el-card shadow="never">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div slot="header" class="clearfix">
                                <el-form ref="dynamicValidateForm" label-width="120px" class="demo-dynamic">

                                    <el-divider content-position="left">Nombre Sección</el-divider>
                                    <el-input type="text" placeholder="Sección" maxlength="50" v-model="valueSection"
                                        show-word-limit>
                                    </el-input>
                                    <el-card shadow="never" class="mb-2 mt-2"
                                        v-for="domain in dynamicValidateForm.domains" :key="domain.key">


                                        <div class="row mb-2 mt-0">
                                            <div class="col-8">
                                                <el-divider content-position="left">Título</el-divider>
                                                <el-input type="text" v-model="domain.valuetitle" placeholder="Título"
                                                    maxlength="50" show-word-limit class="mb-2"></el-input>
                                            </div>

                                            <template v-if="domain.key != 1">
                                                <div class="col-3">
                                                    <el-divider content-position="left">Precio</el-divider>
                                                    <el-input-number v-model="domain.valueprice" :min="1">
                                                    </el-input-number>
                                                </div>
                                                <div class="col-1">
                                                    <el-divider content-position="center">Eliminar</el-divider>
                                                    <el-button type="danger" icon="el-icon-delete" circle
                                                        @click="removeDomain(domain)"></el-button>
                                                </div>
                                            </template>

                                            <template v-else>

                                                <div class="col-4">
                                                    <el-divider content-position="left">Precio</el-divider>
                                                    <el-input-number v-model="domain.valueprice" :min="1">
                                                    </el-input-number>
                                                </div>

                                            </template>

                                        </div>
                                        <el-divider content-position="left">Descripción</el-divider>
                                        <el-input type="textarea" placeholder="Please input" maxlength="100"
                                            v-model="domain.valuedetalle" show-word-limit>
                                        </el-input>

                                    </el-card>

                                    <el-row class="mt-2 text-center">
                                        <el-tooltip class="item" effect="dark" content="Agregar otra sección"
                                            placement="top-start">
                                            <el-button type="primary" icon="el-icon-plus" circle @click="addDomain">
                                            </el-button>
                                        </el-tooltip>
                                        <el-tooltip class="item" effect="dark" content="Registrar"
                                            placement="top-start">
                                            <el-button type="success" icon="el-icon-check" :disabled="loadingImgMenu02"
                                                @click="submitForm(dynamicValidateForm)" circle></el-button>
                                        </el-tooltip>
                                    </el-row>

                                </el-form>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </el-card>
            </el-form>
        </el-drawer>

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
                visible: false,
                fillRegistroImagen: {
                    iTitle: '',
                    iDescription: '',
                    iImagen: ''
                },
                dCarta: [],
                url: '/img/img4-slide-2-1920x678.jpg',
                drawer: false,
                descrip: 'ttb',
                menu02: '',
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
                idImg: '',
                //CARTA
                table: false,
                valueSection: '',
                dynamicValidateForm: {
                    domains: [{
                        key: 1,
                        valuetitle: '',
                        valueprice: '',
                        valuedetalle: ''
                    }],
                },
                divShow: false,
                cont: 2, //Empieza el segundo div,
                error: 0,
            }
        },
        methods: {
            getListaMenu02() {
                this.loadingImgMenu02 = true;
                let url = 'menus/getListarMenus';
                axios
                    .get(url + '/Menu02')
                    .then((rpta) => {
                        this.loadingImgMenu02 = false;
                        if (rpta.data.length != 0) {
                            let data = JSON.parse(rpta.data[0].estructura).datajson;
                            if (data.img_title_desc.length != 0) {
                                this.fillRegistroImagen.iTitle = data.img_title_desc.title
                                this.fillRegistroImagen.iDescription = data.img_title_desc.desc
                                this.stlimg.background = '#444 url(' + data.img_title_desc.img +
                                    ') center center no-repeat fixed !important';
                                this.urlImgOld = data.img_title_desc.img
                                this.idImg = rpta.data[0].id
                            }
                            this.dCarta = data.carta
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
            getImagen(e) {
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
                    this.stlimg.background = '#444 url(' + URL.createObjectURL(e.target.files[0]) +
                        ') center center no-repeat fixed !important';
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
                /*let arr = [
                  {
                    'tipo': 'menu02',
                    'datajson':
                      [
                        {
                          'img_title_desc':
                              {
                                'img': 'ruta de la imagen',
                                'title': 'Menú',
                                'desc': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed'
                              },
                          'carta':
                          [
                            {
                              'section': 'BREAKFAST & STARTERS',
                              'listas':
                              [

                                {
                                  'title': 'Delicious Dish',
                                  'price': '$35',
                                  'detalle': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                                },

                                {
                                  'title': 'Delicious Dish',
                                  'price': '$30',
                                  'detalle': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                                },

                                {
                                  'title': 'Delicious Dish',
                                  'price': '$25',
                                  'detalle': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                                },

                              ]
                            },
                            {
                              'section': 'MAIN COURSE',
                              'listas':
                              [

                                {
                                  'title': 'Delicious Dish',
                                  'price': '$35',
                                  'detalle': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                                },

                                {
                                  'title': 'Delicious Dish',
                                  'price': '$30',
                                  'detalle': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                                },

                                {
                                  'title': 'Delicious Dish',
                                  'price': '$25',
                                  'detalle': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam.',
                                },

                              ]
                            }
                          ]
                        }
                      ]
                  }
                ]*/
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
            validarRegistros(tipo) {
                this.error = 0;
                let msm = "";

                if (tipo == 'img') {
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
                    if (this.idImg == '') {
                        if (!this.fillRegistroImagen.iImagen) {
                            msm = "¡La imágen es un campo requerido!";
                            toastr.info(msm);
                            this.error = 1;
                        }
                    }
                }
                return this.error;
            },
            //CARTA
            removeDomain(item) {
                var index = this.dynamicValidateForm.domains.indexOf(item);
                console.log("=============>",index)
                if (index !== -1) {
                    this.dynamicValidateForm.domains.splice(index, 1);
                }
            },
            addDomain() {
                this.divShow = true
                this.dynamicValidateForm.domains.push({
                    key: this.cont++,
                    valuetitle: '',
                    valueprice: '',
                    valuedetalle: ''
                });
            },
            submitForm(formName) {
                this.loadingImgMenu02 = true;
                let arrrr =
                {
                    'carta': [{
                        'section': this.valueSection,
                        'listas': []
                    }, ]
                }
                formName.domains.forEach(row => {
                    this.error = 0;
                    console.log("===",row)
                    if (!row.valuetitle) {
                        this.error = 1;
                    }
                    if (!row.valuedetalle) {
                        this.error = 1;
                    }
                    let jsoncrt = {
                        'title': row.valuetitle,
                        'price': row.valueprice,
                        'detalle': row.valuedetalle,
                    }
                    arrrr.carta[0].listas.push(jsoncrt)
                });

                if(this.error == 1){
                    toastr.error("Hay campos obligatorios.");
                }else{
                    var url = '/menus/setRegistrarSectionMenu02'
                    axios.post(url, {
                        "carta": JSON.stringify(arrrr),
                    }).then(response => {
                        this.$message({
                            message: 'Se ha registrado correctamente!.',
                            type: 'success'
                        });
                        this.getListaMenu02();
                        this.table = false
                        this.loadingImgMenu02 = false;
                        this.dynamicValidateForm.domains.splice(1);
                        this.dynamicValidateForm.domains[0].key = 1;
                        this.dynamicValidateForm.domains[0].valuetitle = ""
                        this.dynamicValidateForm.domains[0].valueprice = ""
                        this.dynamicValidateForm.domains[0].valuedetalle = ""
                        this.valueSection = ""
                    }).catch(error => {
                        toastr.error(error);
                    })
                }

            },
            confirmar(i){
                this.$confirm('¿Eliminar esta carta?', '', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancelar',
                    type: 'warning',
                    center: true
                }).then(() => {
                    this.edelCarta(i,'deleted');
                }).catch(() => {});
            },
            edelCarta(id,e){
                let url = 'menus/getEditarEliminarCarta/'+id+'/'+e;
                axios
                    .get(url)
                    .then((rpta) => {
                    if(e == "edit"){
                        console.log("::::",rpta)
                    }
                    if(e == "deleted"){
                        this.$message({
                            message: 'Se ha eliminado la carta.',
                            type: 'success'
                        });
                        this.getListaMenu02();
                    }
                })
                    .catch(function (error) {
                    toastr.error(error);
                });
            }




            // {"tipo":"Menu02","datajson":{"img_title_desc":{"img":"\/storage\/Menus\/cygx4X2JYewVnXJmdp5X8cFgWEoMOTKb7ZFYeaKL.jpg","title":"MENU","desc":"Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed."},"carta":[{"section":"COFFEE & DRINKS","listas":[{"title":"Delicious Dish","price":30,"detalle":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam."},{"title":"Delicious Dish","price":35,"detalle":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam."},{"title":"Delicious Dish","price":38,"detalle":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam."},{"title":"Delicious Dish","price":40,"detalle":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, duis sed dapibus leo nec ornare diam."}]}]}}
        }
    };

</script>
