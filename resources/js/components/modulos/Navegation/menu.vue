<template>
    <div>


        <table class="table table-striped">
            <tbody v-loading="loadingMenu">
                <tr>
                    <td>
                        <el-input type="text" placeholder="Menú 01" v-model="fillAddMenu.menu01" maxlength="15"
                            show-word-limit></el-input>
                    </td>
                    <td>
                        <el-input type="text" placeholder="Menú 02" v-model="fillAddMenu.menu02" maxlength="15"
                            show-word-limit></el-input>
                    </td>
                    <td>
                        <el-input type="text" placeholder="Menú 03" v-model="fillAddMenu.menu03" maxlength="15"
                            show-word-limit></el-input>
                    </td>
                    <td>
                        <el-input type="text" placeholder="Menú 04" v-model="fillAddMenu.menu04" maxlength="15"
                            show-word-limit></el-input>
                    </td>
                    <td>
                        <el-input type="text" placeholder="Menú 05" v-model="fillAddMenu.menu05" maxlength="15"
                            show-word-limit></el-input>
                    </td>
                    <td class="project-actions text-right">
                        <button class="btn btn-info btn-sm mt-1" type="button" @click="addMenus()">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                    </td>

                </tr>

            </tbody>
        </table>


    </div>
</template>

<script>
    export default {
        mounted() {
            this.getListaMenu();
        },
        data() {
            return {
                fillAddMenu: {
                    menu01: 'MENÚ 01',
                    menu02: 'MENÚ 02',
                    menu03: 'MENÚ 03',
                    menu04: 'MENÚ 04',
                    menu05: 'MENÚ 05',
                },
                idMenu: '',
                loadingMenu: true,
                error: 0,

            }
        },
        methods: {
            getListaMenu() {
                let url = 'navegation/getListaMenus';
                axios
                    .get(url)
                    .then((rpta) => {
                        this.loadingMenu = false;
                        if (rpta["data"].length != 0) {
                            let rp = JSON.parse(rpta["data"][0]["nombre"])[0]["nombres"];
                            this.idMenu = rpta["data"][0].id;
                            this.fillAddMenu.menu01 = rp["menu01"];
                            this.fillAddMenu.menu02 = rp["menu02"];
                            this.fillAddMenu.menu03 = rp["menu03"];
                            this.fillAddMenu.menu04 = rp["menu04"];
                            this.fillAddMenu.menu05 = rp["menu05"];
                        }
                    })
                    .catch(function (error) {
                        toastr.error(error);
                    });
            },

            addMenus() {
                this.loadingMenu = true;
                if (this.validarRegistros()) {
                    this.loadingMenu = false;
                    return;
                }

                let jsonAdd = [
                    {
                        'tipo': 'menu',
                        'nombres': this.fillAddMenu
                    }
                ];

                var url = "/navegation/addMenus"
                axios.post(url, {
                    "id": this.idMenu,
                    "nombre": JSON.stringify(jsonAdd),
                    "tipo": 'menu',
                    "estado": 1
                }).then(response => {
                    this.loadingMenu = false;
                    this.$message({
                        showClose: true,
                        message: '¡Se realizaron los cambios con éxitos!',
                        type: 'success'
                    });
                    this.getListaMenu();
                }).catch(error => {
                    alert(error)
                })


            },

            validarRegistros(){
                this.error = 0;
                let msm = "";
                if (!this.fillAddMenu.menu01) {
                    msm = "¡Hay campos obligatorios!";
                    this.alertmodal(msm)
                    this.error = 1;
                }
                if (!this.fillAddMenu.menu02) {
                    msm = "¡Hay campos obligatorios!";
                    this.alertmodal(msm)
                    this.error = 1;
                }
                if (!this.fillAddMenu.menu03) {
                    msm = "¡Hay campos obligatorios!";
                    this.alertmodal(msm)
                    this.error = 1;
                }
                if (!this.fillAddMenu.menu04) {
                    msm = "¡Hay campos obligatorios!";
                    this.alertmodal(msm)
                    this.error = 1;
                }
                if (!this.fillAddMenu.menu05) {
                    msm = "¡Hay campos obligatorios!";
                    this.alertmodal(msm)
                    this.error = 1;
                }


                return this.error;
            },

            alertmodal(msm){
                this.$notify({
                    title: 'Oops!',
                    message: msm,
                    position: 'top-left',
                    type: 'warning'
                });
            },
        }
    };

</script>
