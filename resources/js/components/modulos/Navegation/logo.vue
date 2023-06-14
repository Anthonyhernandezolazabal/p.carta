<template>
    <div>

        <div class="row">
            <div class="col-4"></div>
            <div class="col-6">
                <input type="file" @change="getFile">
            </div>
            <div class="col-2"></div>
        </div>

        <br>
        <center>
            <div v-loading="loadingLogo">
                <el-avatar :size="118" :src="srcLogo"></el-avatar>
            </div>
            <br>
            <el-button type="success" :disabled="loadingLogo" icon="el-icon-check" circle @click="addLogo"></el-button>
        </center>

    </div>
</template>

<script>
    export default {
        mounted() {
            this.getMostrarLogo();
        },
        data() {
            return {
                srcLogo: '/img/user-1-118x118.jpg',
                oLogo: '',
                idLogo: '',
                pathOld: '',
                loadingLogo: false,
                nameLogo: '',
                form: new FormData,
            }
        },
        methods: {
            getMostrarLogo(){
                let url = '/navegation/getMostrarLogo';
                axios
                    .get(url)
                    .then((rpta) => {
                        this.loadingLogo = false;
                        if (rpta["data"].length != 0) {
                            let logo = JSON.parse(rpta["data"][0]["nombre"])[0]["nombres"];
                            this.pathOld = logo.path
                            this.idLogo = rpta["data"][0].id;
                            this.srcLogo = logo["path"];
                        }

                    })
                    .catch(function (error) {
                        toastr.error(error);
                    });
            },
            getFile(e){
                this.loadingLogo = true;
                const isIMG = e.target.files[0].type;
                const isLt2M = e.target.files[0].size;
                if (isIMG != 'image/jpeg' && isIMG != 'image/png' && isIMG != 'image/gif') {
                    this.$message.error('La imagen debe estar en formato JPG, PNG o GIF!');
                    this.loadingLogo = false;
                } else if (isLt2M > 4000000) {
                    this.$message.error('La imagen excede los 4MB!');
                    this.loadingLogo = false;
                } else {
                    this.loadingLogo = false;
                    this.oLogo = e.target.files[0];
                    this.nameLogo = e.target.files[0].name;
                    this.srcLogo = URL.createObjectURL(e.target.files[0])
                }
                return isIMG && isLt2M;
            },
            addLogo(){

                this.loadingLogo = true;

                this.form.append('id', this.idLogo)
                this.form.append('path', this.oLogo)
                this.form.append('pathOld', this.pathOld)
                this.form.append('imgLogo', this.nameLogo)
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }

                var url = '/navegation/addLogo'
                axios.post(url, this.form, config)
                    .then((response) => {
                        this.loadingLogo = false;
                        this.getMostrarLogo();
                        this.$notify({
                            title: 'Registrado',
                            message: '¡Se realizaron los cambios con éxitos!',
                            position: 'bottom-right',
                            type: 'success'
                        });
                    })
                    .catch((error) => {
                        this.loadingLogo = false;
                        this.$message({
                            type: 'error',
                            message: 'Error en imágen: '+error
                        });
                });




            },
        }
    };

</script>
