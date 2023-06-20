<template>
    <div v-loading="loadingListMenu01">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 v-text="menu01"></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" v-text="menu01"></li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div v-loading="loadingsaveMenu01">
                    <div class="row mb-3">
                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">
                            <el-card shadow="hover">
                                <input type="file" @change="getFile">
                                <el-divider content-position="center">Imágen</el-divider>
                                <center>
                                    <el-image style="width: auto; height: 250px"  v-loading="loadingImg" :src="url"></el-image>
                                </center>
                            </el-card>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12">
                            <el-card shadow="hover">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-border" v-model="fillRegistro.cTitulo" placeholder="Título">
                                </div>
                                <el-divider content-position="left">Descripción</el-divider>

                                <ckeditor v-model="fillRegistro.cDescription"></ckeditor>

                            </el-card>
                        </div>

                    </div>
                    <center><el-button type="primary" @click.prevent="saveRegistro" :disabled="loadingsaveMenu01">Guardar</el-button></center>
                </div>
                <br>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.miMenuName();
            this.getListaMenu01();
        },
        data() {
            return {
                fillRegistro: {
                    oImagen: '',
                    cTitulo: '',
                    cDescription: ''
                },
                menu01: '',
                url: '/img/index-3-556x382.jpg',
                urlOld: '',
                loadingImg: false,
                loadingsaveMenu01: false,
                loadingListMenu01: false,
                form: new FormData,
                error: 0,
                id:''
            }
        },
        methods: {
            miMenuName() {
                let url = 'navegation/sbMenu';
                axios
                    .get(url)
                    .then((rpta) => {
                        (rpta["data"] != 0) ? (this.menu01 = rpta["data"]["menu01"]) : this.menu01 = 'Menú 01'
                    })
                    .catch(function (error) {
                        toastr.error(error);
                    });
            },
            getListaMenu01(){
                this.loadingListMenu01 = true;
                let url = 'menus/getListarMenu01';
                axios
                    .get(url+'/Menu01')
                    .then((rpta) => {
                        this.loadingListMenu01 = false;
                        if(rpta.data.length != 0){
                            let datos = JSON.parse(rpta.data[0].estructura).datajson
                            this.fillRegistro.cTitulo = datos.titulo
                            this.fillRegistro.cDescription = datos.estructura
                            this.url = datos.img
                            this.urlOld = datos.img
                            this.id = rpta.data[0].id
                        }
                    })
                    .catch(function (error) {
                        toastr.error(error);
                });
            },
            getFile(e){
                this.loadingImg = true;
                const isIMG = e.target.files[0].type;
                const isLt2M = e.target.files[0].size;
                if (isIMG != 'image/jpeg' && isIMG != 'image/png' && isIMG != 'image/gif') {
                    this.$message.error('La imagen debe estar en formato JPG, PNG o GIF!');
                    this.loadingImg = false;
                } else if (isLt2M > 4000000) {
                    this.$message.error('La imagen excede los 4MB!');
                    this.loadingImg = false;
                } else {
                    this.loadingImg = false;
                    this.fillRegistro.oImagen = e.target.files[0];
                    this.url = URL.createObjectURL(e.target.files[0])
                }
                return isIMG && isLt2M;
            },
            saveRegistro() {
                this.loadingsaveMenu01 = true;
                if (this.validarRegistros()) {
                    this.loadingsaveMenu01 = false;
                    return;
                }
                this.form.append('cTitulo', this.fillRegistro.cTitulo)
                this.form.append('cDescription', this.fillRegistro.cDescription)
                this.form.append('oFotografia', this.fillRegistro.oImagen)
                this.form.append('oImgOld', this.urlOld)
                this.form.append('id', this.id)
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                var url = '/menus/setRegistrarMenu01'
                axios.post(url, this.form, config).then(response => {
                    this.loadingsaveMenu01 = false;
                    this.$message({
                        message: 'Se ha registrado correctamente!.',
                        type: 'success'
                    });
                    this.getListaMenu01();
                }).catch(error => {
                   toastr.error(error);
                })
            },
            validarRegistros(){
                this.error = 0;
                let msm = "";
                if(this.id == ''){
                    if (!this.fillRegistro.oImagen) {
                        msm = "¡La imágen es un campo requerido!";
                        toastr.info(msm);
                        this.error = 1;
                    }
                }
                if (!this.fillRegistro.cTitulo) {
                    msm = "¡Ingrese un título!";
                    toastr.info(msm);
                    this.error = 1;
                }
                if (!this.fillRegistro.cDescription) {
                    msm = "¡Ingrese descripción!";
                    toastr.info(msm);
                    this.error = 1;
                }


                return this.error;
            },
            limpiarCampos() {
                this.fillRegistro.cTitulo = "";
                this.fillRegistro.cDescription = "";
                this.fillRegistro.oImagen = "";
                this.url = '/img/index-3-556x382.jpg';

            },
        }
    };

</script>
