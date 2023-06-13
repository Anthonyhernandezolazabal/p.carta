<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Navegación</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Navegación</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <section class="content">
            <div class="container-fluid">
                <el-card class="box-card">
                    <div class="text item">
                        <el-divider content-position="left"><b>MENÚ</b></el-divider>
                        <NavegationMenu-component></NavegationMenu-component>
                        <br>
                        <el-divider content-position="center"><b>LOGO</b></el-divider>
                        <NavegationLogo-component></NavegationLogo-component>
                    </div>
                </el-card>
            </div>
        </section>





    </div>
</template>

<script>
    export default {
        mounted() {

        },
    };

</script>
