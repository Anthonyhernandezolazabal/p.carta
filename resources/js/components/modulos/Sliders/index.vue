<template>
    <div v-loading="loadingAllPage">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Registro de sliders
                            <button type="button" class="btn btn-info btn-flat" @click="abrirModal">Nuevo registro</button>
                        </h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sliders</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section v-if="listaSlider.length != 0" class="content" v-loading="loadingPage">
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-6 col-xl-4" v-for="item in listaSlider" :key="item.id">
                                <div class="card mb-2 bg-gradient-dark">
                                    <img class="card-img-top imgwidth" :src="item.filename" alt="Dist Photo 1">
                                    <div class="card-img-overlay d-flex flex-column justify-content-center">
                                        <h5 class="card-title text-primary text-white text-center"  v-text="item.titulo"></h5>
                                        <p class="card-text text-white pb-2 pt-1 text-center" v-text="item.descripcion"></p>
                                        <el-row class="text-center">
                                            <el-button type="warning" icon="el-icon-edit" @click="abrirModalEdit(item.id)" circle></el-button>
                                            <el-button v-if="item.estado === 1" type="success" icon="el-icon-check" circle v-on:click="cambiarEstadoView(item.id)"></el-button>
                                            <el-button v-if="item.estado === 0" type="info" icon="el-icon-minus" circle v-on:click="cambiarEstadoView(item.id)"></el-button>
                                            <el-button type="danger" icon="el-icon-delete" circle v-on:click="delSlider(item.id, item.titulo,item.filename)"></el-button>
                                        </el-row>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <el-dialog title="Nuevo registro de slider" :visible.sync="dialogFormVisible">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                    <div class="demo-image__placeholder">
                        <label class="col-form-label" for="">Imágen</label>
                        <div class="block">
                            <br>
                            <span class="title">{{ allslider.oNameImg }}</span>
                            <el-image v-loading="loading" :src="srcAdd" style="border-radius: 10px;">
                            <div slot="placeholder" class="image-slot">
                                Loading<span class="dot">...</span>
                            </div>
                            </el-image>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12">
                    <label class="col-form-label" for="inputWarning">Título</label>
                    <el-input placeholder="Título de slider" v-model="allslider.cTitulo" clearable>
                    </el-input>
                    <p v-if="validarcampoTitulo"><code v-text="vcTitulo"></code></p>
                    <hr>
                    <label class="col-form-label" for="inputWarning">Descripción</label>
                    <el-input placeholder="Descripción de slider" v-model="allslider.cDescription " clearable>
                    </el-input>
                    <p v-if="validarcampoDescripcion"><code v-text="vcDescripcion"></code></p>
                    <hr>
                    <label class="col-md-3 col-form-label">Fotografía</label>
                    <input type="file" class="form-control"  @change="getFile">
                    <p v-if="validarcampoImg"><code v-text="vcImg"></code></p>
                </div>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="abrirModal">Cancelar</el-button>
                <el-button type="primary" @click.prevent="addSlider" :disabled="loadingsave">Guardar</el-button>
            </span>
        </el-dialog>
        <el-dialog title="Editar de slider" :visible.sync="EditdialogFormVisible">
            <div class="row" v-loading="loadingEditShow" >
                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                    <div class="demo-image__placeholder">
                        <label class="col-form-label" for="">Imágen</label>
                        <div class="block">
                            <span class="title">{{ allslider.oNameImg }}</span>
                            <el-image v-loading="loading" :src="srcEdit" id="previsualizarEdit" style="border-radius: 10px;">
                            <div slot="placeholder" class="image-slot">
                                Loading<span class="dot">...</span>
                            </div>
                            </el-image>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12">
                    <label class="col-form-label" for="inputWarning">Título</label>
                    <el-input placeholder="Título de slider" v-model="allslider.cTitulo" clearable>
                    </el-input>
                    <p v-if="validarcampoTitulo"><code v-text="vcTitulo"></code></p>
                    <hr>
                    <label class="col-form-label" for="inputWarning">Descripción</label>
                    <el-input placeholder="Descripción de slider" v-model="allslider.cDescription " clearable>
                    </el-input>
                    <p v-if="validarcampoDescripcion"><code v-text="vcDescripcion"></code></p>
                    <hr>
                    <label class="col-md-3 col-form-label">Fotografía</label>
                    <input type="file" class="form-control"  @change="getFile">
                    <p v-if="validarcampoImg"><code v-text="vcImg"></code></p>
                </div>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="abrirModalEdit">Cancelar</el-button>
                <el-button type="primary" @click.prevent="EditSlider" :disabled="loadingedit">Editar</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getListaSlider();
        },
        data() {
            return {
                listaSlider: [],
                allslider: {
                    cTitulo: '',
                    cDescription: '',
                    oFotografia: '',
                    oNameImg: '',
                },
                dialogFormVisible: false,
                EditdialogFormVisible: false,
                loading: false,
                loadingsave: false,
                loadingedit: false,
                loadingPage: false,
                loadingAllPage: true,
                loadingEditShow: false,
                validarcampoImg: false,
                validarcampoTitulo: false,
                validarcampoDescripcion: false,
                vcImg: '',
                vcTitulo: '',
                vcDescripcion: '',
                error: 0,
                form: new FormData,
                srcAdd: '/img/parallax-1-1920x850.jpg',
                srcEdit: '',
                idEdit: '',
                imgRutaOld: ''
            };
        },
        methods: {
            getListaSlider() {
                let url = 'slider/getListarSlider';
                axios
                    .get(url)
                    .then((rpta) => {
                        this.loadingAllPage = false;
                        this.listaSlider = rpta.data;
                    })
                    .catch(function (error) {
                        toastr.error(error);
                    });
            },
            getFile(e){
                const isIMG = e.target.files[0].type;
                const isLt2M = e.target.files[0].size;
                if (isIMG != 'image/jpeg' && isIMG != 'image/png' && isIMG != 'image/gif') {
                    this.$message.error('La imagen debe estar en formato JPG, PNG o GIF!');
                    this.loading = false;
                    this.loadingsave = false;
                } else if (isLt2M > 4000000) {
                    this.$message.error('La imagen excede los 4MB!');
                    this.loading = false;
                    this.loadingsave = false;
                } else {
                    //Registrar
                    if(this.dialogFormVisible){
                        this.allslider.oFotografia = e.target.files[0];
                        this.allslider.oNameImg = e.target.files[0].name;
                        this.srcAdd = URL.createObjectURL(e.target.files[0])
                    }
                    //Editar
                    if(this.EditdialogFormVisible){
                        this.allslider.oFotografia = e.target.files[0];
                        this.allslider.oNameImg = e.target.files[0].name;
                        this.srcEdit = URL.createObjectURL(e.target.files[0])
                    }
                }
                return isIMG && isLt2M;
            },
            addSlider() {
                this.loadingsave = true;
                if (this.validarRegistroCampos()) {
                    this.loadingsave = false;
                    return;
                }
                this.form.append('cTitulo', this.allslider.cTitulo)
                this.form.append('cDescription', this.allslider.cDescription)
                this.form.append('oFotografia', this.allslider.oFotografia)
                this.form.append('oNameImg', this.allslider.oNameImg)
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                var url = '/slider/setRegistrarSlider'
                axios.post(url, this.form, config).then(response => {
                    this.loadingsave = false;
                    this.getListaSlider();
                    this.$notify({
                        title: 'Registrado',
                        message: 'Se ha registrado un nuevo Slider',
                        position: 'bottom-right',
                        type: 'success'
                    });
                    this.abrirModal();
                    this.limpiarCampos();
                    this.getListaSlider();
                }).catch(error => {
                    this.loadingsave = false;
                    this.$notify({
                        title: 'Ocurrió un error',
                        message: error,
                        position: 'bottom-right',
                        type: 'error'
                    });
                })
            },
            EditSlider(){
                this.loadingedit = true;
                if (this.validarRegistroCampos()) {
                    this.loadingedit = false;
                    return;
                }
                this.form.append('cTitulo', this.allslider.cTitulo)
                this.form.append('cDescription', this.allslider.cDescription)
                this.form.append('oFotografia', this.allslider.oFotografia)
                this.form.append('oNameImg', this.allslider.oNameImg)
                this.form.append('imgOld', this.imgRutaOld)
                this.form.append('id', this.idEdit)
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                var url = '/slider/editSlider'
                axios.post(url, this.form, config).then(response => {
                    this.loadingedit = false;
                    this.getListaSlider();
                    this.$notify({
                        title: 'Editado',
                        message: '¡Se ha editado correctamente!',
                        position: 'bottom-right',
                        type: 'success'
                    });
                    this.abrirModalEdit();
                    this.limpiarCampos();
                    this.getListaSlider();
                }).catch(error => {
                    this.loadingedit = false;
                    this.$notify({
                        title: 'Ocurrió un error',
                        message: error,
                        position: 'bottom-right',
                        type: 'error'
                    });

                })
            },
            validarRegistroCampos() {
                this.error = 0;
                if(this.dialogFormVisible){
                    if (!this.allslider.oFotografia) {
                        this.validarcampoImg = true;
                        this.vcImg = "Este campo es obligatorio.";
                        this.error = 1;
                    } else {
                        this.validarcampoImg = false
                    }
                }

                if (!this.allslider.cTitulo) {
                    this.validarcampoTitulo = true;
                    this.vcTitulo = "Este campo es obligatorio.";
                    this.error = 1;
                } else {
                    this.validarcampoTitulo = false
                }

                if (!this.allslider.cDescription) {
                    this.validarcampoDescripcion = true;
                    this.vcDescripcion = "Este campo es obligatorio.";
                    this.error = 1;
                } else {
                    this.validarcampoDescripcion = false;
                }


                return this.error;
            },
            abrirModal() {
                this.dialogFormVisible = !this.dialogFormVisible;
                this.limpiarCampos();
            },
            abrirModalEdit(id) {
                this.loadingEditShow = true;
                this.loadingedit = true;
                this.EditdialogFormVisible = !this.EditdialogFormVisible;

                if(this.EditdialogFormVisible){
                    axios.get('/slider/showEditSlider/'+id).then(rpta => {
                        console.log("=====> ",rpta)
                        this.loadingEditShow = false;
                        this.loadingedit = false;
                        console.log("=====> ",rpta["data"][0])
                        this.allslider.cTitulo = rpta["data"][0]["titulo"];
                        this.allslider.cDescription = rpta["data"][0]["descripcion"];
                        this.allslider.oNameImg = rpta["data"][0]["imgname"];
                        this.srcEdit =  rpta["data"][0]["filename"]
                        this.idEdit =  rpta["data"][0]["id"]
                        this.imgRutaOld =  rpta["data"][0]["filename"]
                    }).catch(error => {
                        this.loadingEditShow = false;
                        this.loadingedit = false;
                        this.$message({
                                type: 'error',
                                message: error
                            });
                    })
                }
            },
            limpiarCampos() {
                this.allslider.cTitulo = "";
                this.allslider.cDescription = "";
                this.allslider.oFotografia = "";
                this.allslider.oNameImg = "";

                if(this.dialogFormVisible){
                    this.srcAdd = '/img/parallax-1-1920x850.jpg';
                }

            },
            delSlider(id, nom, img){
                this.$confirm('¿Desea eliminar '+nom+'?', '', {
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    type: 'warning',
                    center: true
                }).then(() => {

                    this.loadingPage = true,
                    axios.delete('/slider/delSlider/'+id)
                    .then((response) => {
                        this.loadingPage = false;
                        this.$message({
                            type: 'success',
                            message: "Slider " + nom + " eliminado."
                        });
                        this.eliminarImagen(id,img);
                        this.getListaSlider();
                    })
                    .catch((error) => {
                        this.loadingPage = false;
                        this.$message({
                            type: 'error',
                            message: error
                        });
                    });
                }).catch(() => {});
            },
            eliminarImagen(id,img){
                axios.post('/slider/delImgSlider/'+id,{'img': img})
                    .then((response) => {})
                    .catch((error) => {
                        this.$message({
                            type: 'error',
                            message: 'Error en imágen: '+error
                        });
                    });
            },
            cambiarEstadoView(id){
                this.$confirm('¿Mostrar esta imágen como principal?', '', {
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar',
                type: 'info',
                center: true
                }).then(() => {
                    this.loadingPage = true;
                    var url = "/slider/cambiarEstadoView"
                    axios.post(url,
                        {
                            "estado"        :   1,
                            "id"            :   id
                        }
                    ).then(response => {
                        if(response.data == "Actualizado"){
                            this.getListaSlider();
                            this.$message({
                                type: 'success',
                                message: 'Se realizó la actualización'
                            });
                            this.loadingPage = false;
                        }else{
                            this.$notify.error({
                                title: '¡No actualizó nada!',
                                message: response.data,
                                offset: 100
                            });
                            this.loadingPage = false;
                        }

                    }).catch(error => {
                        alert(error)
                    })

                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '¡Operación cancelada!'
                    });
                    this.loadingPage = false;
                });

            }
        }
    }

</script>
<style>
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }
    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }
    .imgwidth {
        width:auto;
        height:260.112px;
    }

</style>
