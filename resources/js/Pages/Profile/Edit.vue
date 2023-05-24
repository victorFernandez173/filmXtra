<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import LayoutPrincipal from "@/Layouts/LayoutPrincipal.vue";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<!--Pagina para editar: datos, password y borrar cuenta de usuario-->
<!--Incluye 3 sfc: datos, password y borrado-->
<template>
    <Head>
        <title>Editar perfil</title>
        <meta name="description" content="Pagina de edición de perfil">
    </Head>
    <LayoutPrincipal>
        <!--Contenedor completo con el fondo-->
        <div class="py-12 bg-cover bg-[url('images/posters-fondo.png')]">
            <h1 class="titulo font-semibold underline text-5xl text-center text-flamingo">Página de cuenta</h1>
            <!--Contenedor superior con varias columnas-->
            <div class="pt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-0">
                <!--Contenedor actualizacion perfil-->
                <div class="justify-center m-auto">
                    <div class="perfil p-8 bg-white shadow rounded-lg">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-xl"
                        />
                    </div>
                </div>

                <!--Contenedor actualizacion perfil-->
                <div class="justify-center m-auto">
                    <div class="contrasenia p-8 bg-white shadow rounded-lg">
                        <UpdatePasswordForm class="max-w-xl" />
                    </div>
                </div>
            </div>

            <!--Contenedor inferior una columna para el borrar cuenta-->
            <div class="py-12 grid grid-cols-1">
                <div class="justify-center m-auto">
                    <div class="p-8 bg-white shadow rounded-lg">
                        <DeleteUserForm class="max-w-xl" />
                    </div>
                </div>
            </div>
        </div>
    </LayoutPrincipal>
</template>

<style>
/******** Ordenador ********/
@media screen and (min-width: 992px) {
    .perfil {
        margin-left: 20rem;
    }

    .contrasenia {
        margin-right: 20rem;
    }
}

/******** Movil ********/
@media screen and (max-width: 768px) {
    .titulo {
        font-size: 2.25rem;
    }

    .contrasenia {
        margin-top: 3rem;
    }
}
</style>
