<script>
import LayoutPrincipal from "../../Layouts/LayoutPrincipal.vue";

export default {
    layout: LayoutPrincipal,
}
</script>
<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head} from '@inertiajs/vue3';

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
    <!--Contenedor completo con el fondo-->
    <div class="py-12 bg-cover bg-[url('/images/posters-fondo.png')]">
        <h1 class="font-semibold underline text-5xl text-center text-white">Página de cuenta</h1>
        <!--Contenedor superior con varias columnas-->
        <div class="pt-12 grid grid-cols-1 lg:grid-cols-2">
            <!--Contenedor actualizacion perfil-->
            <div class="m-auto">
                <div class="lg:ml-55 p-8 bg-white shadow rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>
            </div>

            <!--Contenedor actualizacion perfil-->
            <div class="justify-center m-auto">
                <div class="lg:mr-55 p-8 bg-white shadow rounded-lg mt-10 lg:mt-0">
                    <UpdatePasswordForm class="max-w-xl"/>
                </div>
            </div>
        </div>

        <!--Contenedor inferior una columna para el borrar cuenta-->
        <div class="py-12 grid grid-cols-1">
            <div class="justify-center m-auto">
                <div class="p-8 bg-white shadow rounded-lg">
                    <DeleteUserForm class="max-w-xl"/>
                </div>
            </div>
        </div>
    </div>
</template>

