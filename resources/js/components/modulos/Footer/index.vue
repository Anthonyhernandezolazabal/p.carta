<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pie de página</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pie de página</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <el-card class="box-card" v-loading="loadingFooter">
                    <div slot="header" class="clearfix" style="margin-top: -5px;margin-bottom: -15px;">
                      <span>Footer
                        <el-button size="small" @click="limpiar" class="mt-0 mb-2">Nuevo</el-button>
                      </span>
                    </div>
                    <div class="text item">
                                <template slot="title">
                                    Consistency <i class="header-icon el-icon-information"></i>
                                </template>
                                <div class="row">
                                    <div class="col-4" v-for="row,i in dataAll" :key="i">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th v-html="row.section"></th>
                                                    <th style="width: 100px">
                                                        <button type="button" @click="mostrarEdit(i)" class="btn btn-warning btn-sm mt-1"><i class="el-icon-edit"></i></button>
                                                        <button type="button" @click="confirmar(i)" class="btn btn-danger btn-sm mt-1"><i class="el-icon-close"></i></button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody v-for="item,e in row.listas" :key="e">
                                                <tr>
                                                    <td colspan="2" v-text="item.detalle"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                    </div>
                </el-card>

                <el-card class="box-card mt-4">
                    <div slot="header" class="clearfix" style="margin-top: -5px;margin-bottom: -15px;">
                      <span> Redes sociale | © </span>
                    </div>
                    <div class="text item">
                                <template slot="title">
                                    Consistency <i class="header-icon el-icon-information"></i>
                                </template>
                                <div class="row">
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col-4">
                                                <el-select v-model="valuei" placeholder="Select">
                                                    <el-option
                                                    v-for="item in options"
                                                    :key="item.value"
                                                    :label="item.label"
                                                    :value="item.value">
                                                    </el-option>
                                                </el-select>
                                            </div>
                                            <div class="col-8">
                                                <!-- <i class="fas fa-facebook"></i> -->
                                                <div class="input-group mb-3">
                                                    <div v-if="valuei" class="input-group-prepend">
                                                        <span class="input-group-text"><i v-bind:class="valuei"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="url" v-model="valueurl">
                                                </div>
                                            </div>
                                        </div>
                                        <el-input
                                            placeholder="©"
                                            v-model="copyrigth"
                                            clearable>
                                        </el-input>
                                        <center><el-button type="success" size="medium" class="mt-3" @click="addRC()" :disabled="loadingFooter02">Guardar</el-button></center>
                                    </div>
                                    <div class="col-7">
                                        <table class="table table-hover" v-loading="loadingFooter02">
                                            <tbody>
                                                <tr  v-for="F02,i in dataAllF02" :key="i">
                                                    <td class="text-center"><i v-bind:class="'fab '+F02.icon"></i></td>
                                                    <td><a :href="F02.url" target="_blank" v-text="F02.url"></a></td>
                                                    <td class="project-actions text-right">
                                                        <a class="btn btn-warning btn-sm" href="#">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                        </a>
                                                        <a class="btn btn-danger btn-sm" href="#">
                                                            <i class="fas fa-trash">
                                                            </i>
                                                        </a>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                    </div>

                </el-card>
            </div>
        </section>
        <el-dialog :title="titleR_E" :visible.sync="centerDialogVisibleS1" width="20%" center>


            <el-form v-loading="loadingRE" :model="dynamicValidateForm" ref="dynamicValidateForm" label-width="120px" class="demo-dynamic">
                <el-form ref="dynamicValidateForm" label-width="120px" class="demo-dynamic">
                <el-input placeholder="Título" v-model="valueSection"></el-input>
                <hr>
                <table class="table table-bordered">
                    <tbody>
                        <tr v-for="domain in dynamicValidateForm.domains" :key="domain.key">
                            <td>
                                <el-input type="text" placeholder="Texto" v-model="domain.valueDesc"></el-input>
                            </td>
                            <td style="width: 40px" v-if="domain.key == 1">
                                <button type="button" class="btn btn-primary btn-sm mt-1" @click="addDomain"><i class="el-icon-plus"></i></button>
                            </td>
                            <td style="width: 40px" v-else>
                                <button type="button" class="btn btn-danger btn-sm mt-1" @click="removeDomain(domain)"><i class="el-icon-close"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                    <center>
                    <el-button size="small" @click="centerDialogVisibleS1 = false">Cancelar</el-button>
                    <el-button type="success" size="small" :disabled="loadingFooter" @click="centerDialogVisibleS1 = false,submitForm(dynamicValidateForm)">Guardar</el-button>
                    </center>
                </el-form>
            </el-form>

        </el-dialog>

    </div>
</template>

<script>
    export default {
        mounted() {
            this.getListaFooter();
            this.getListaFooter02();
        },
        data() {
            return {
                valueSection: '',
                centerDialogVisibleS1: false,
                dynamicValidateForm: {
                    domains: [{
                        key: 1,
                        valueDesc: '',
                    }],
                },
                cont: 2,
                error: 0,
                loadingFooter: false,
                estReg: "Add",
                dataAll: [],
                idFooterEdit: "",
                titleR_E: "Nuevo registro",
                loadingRE: true,
                options:
                [
                    {value: 'fab fa-facebook',label: 'Facebook'},
                    {value: 'fab fa-twitter',label: 'Twitter'},
                    {value: 'fab fa-whatsapp',label: 'Whatsapp'},
                    {value: 'fab fa-instagram',label: 'Instagram'},
                    {value: 'fab fa-linkedin',label: 'Linkedin'},
                    {value: 'fab fa-youtube',label: 'Youtube'},
                    {value: 'fa fa-envelope',label: 'Correo Electrónico'},
                    {value: 'fab fa-google-plus',label: 'Google'},
                ],
                loadingFooter02: false,
                valuei: '',
                valueurl: '',
                copyrigth: '© 2016 Touché. All rights reserved. Designed by TemplateWire',
                dataAllF02: [],
            };
        },
        methods: {
            limpiar(){
                this.centerDialogVisibleS1 = true
                this.loadingRE = false
                this.estReg = "Add"
                this.titleR_E = "Nuevo registro";
                this.dynamicValidateForm.domains.splice(1);
                this.dynamicValidateForm.domains[0].key = 1;
                this.dynamicValidateForm.domains[0].valueDesc = ""
                this.valueSection = ""
            },
            getListaFooter() {
                this.loadingFooter = true;
                let url = 'footer/getListarFooter';
                axios
                    .get(url + '/Footer')
                    .then((rpta) => {
                        this.loadingFooter = false;
                        if (rpta.data.length != 0) {
                            let data = JSON.parse(rpta.data[0].estructura).datajson;
                            this.dataAll = data["footer"]
                            console.log("====>",this.dataAll)
                        }
                    })
                    .catch(function (error) {
                        toastr.error(error);
                    });
            },
            addDomain() {
                this.dynamicValidateForm.domains.push({
                    key: this.cont++,
                    valueDesc: '',
                });
            },
            removeDomain(item) {
                var index = this.dynamicValidateForm.domains.indexOf(item);
                if (index !== -1) {
                    this.dynamicValidateForm.domains.splice(index, 1);
                }
            },
            submitForm(formName){
                this.loadingFooter = true;
                let arrrr =
                {
                    'footer': [{
                        'section': this.valueSection,
                        'listas': []
                    }, ]
                }
                formName.domains.forEach(row => {
                    this.error = 0;
                    if (!row.valueDesc) {
                        this.error = 1;
                    }
                    if (!this.valueSection) {
                        this.error = 1;
                    }
                    let jsoncrt = {
                        'detalle': row.valueDesc,
                    }
                    arrrr.footer[0].listas.push(jsoncrt)
                });

                if(this.error == 1){
                    toastr.error("Hay campos obligatorios.");
                    this.loadingFooter = false;
                    this.centerDialogVisibleS1 = true
                }else{
                    var url = '/footer/setRegistrarFooter'
                    axios.post(url, {
                        "footer": JSON.stringify(arrrr),
                        'estado':this.estReg,
                        'idFooterEdit':this.idFooterEdit,
                    }).then(response => {
                        this.$message({
                            message: 'Se ha registrado correctamente!.',
                            type: 'success'
                        });
                        this.getListaFooter();
                        this.centerDialogVisibleS1 = false
                        this.loadingFooter = false;
                    }).catch(error => {
                        toastr.error(error);
                        this.centerDialogVisibleS1 = false
                        this.loadingFooter = false;
                    })


                }
            },
            confirmar(i){
                this.$confirm('¿Eliminar?', '', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancelar',
                    type: 'warning',
                    center: true
                }).then(() => {
                    this.edelFooter(i,'deleted');
                }).catch(() => {});
            },
            mostrarEdit(i){
                this.limpiar()
                this.loadingRE = true
                this.centerDialogVisibleS1 = true
                this.idFooterEdit = i;
                this.estReg = "edit"
                this.titleR_E = "Editar registro";
                this.edelFooter(i,'edit');
            },
            edelFooter(id,e){
                let url = 'footer/getEditarEliminarFooter/'+id+'/'+e;
                axios
                    .get(url)
                    .then((rpta) => {
                        console.log("====>",rpta)
                        if(e == "edit"){
                            this.loadingRE = false;
                            this.valueSection = rpta.data.section
                            this.dynamicValidateForm.domains[0].key = 1
                            this.dynamicValidateForm.domains[0].valueDesc = rpta.data.listas[0].detalle
                            for (let i = 1; i < rpta.data.listas.length; i++) {
                                const element = rpta.data.listas[i];
                                console.log("====>",element)
                                this.dynamicValidateForm.domains.push({
                                    key: this.cont++,
                                    valueDesc: element.detalle,
                                });
                            }
                        }
                        if(e == "deleted"){
                            this.$message({
                                message: 'Se ha eliminado la carta.',
                                type: 'success'
                            });
                            this.getListaFooter();
                        }
                })
                    .catch(function (error) {
                    toastr.error(error);
                });
            },
            addRC(){
                this.loadingFooter02 = true;
                var url = '/footer/setRegistrarFooter02'
                    axios.post(url, {
                        "icon": this.valuei.slice(3),
                        'url':this.valueurl,
                        'copy':this.copyrigth,
                    }).then(response => {
                        this.$message({
                            message: 'Se ha registrado correctamente!.',
                            type: 'success'
                        });
                        this.loadingFooter02 = false;
                        this.getListaFooter02();
                        this.valuei = "";
                        this.valueurl = "";
                    }).catch(error => {
                        toastr.error(error);
                        // this.centerDialogVisibleS1 = false
                        this.loadingFooter = false;
                    })
            },
            getListaFooter02() {
                this.loadingFooter02 = true;
                let url = 'footer/getListarFooter';
                axios
                    .get(url + '/Footer02')
                    .then((rpta) => {
                        this.loadingFooter02 = false;
                        if (rpta.data.length != 0) {
                            let data = JSON.parse(rpta.data[0].estructura).datajson;
                            this.dataAllF02 = data
                            this.copyrigth = JSON.parse(rpta.data[0].estructura).copy
                        }
                    })
                    .catch(function (error) {
                        toastr.error(error);
                    });
            },
        }
    };

</script>
