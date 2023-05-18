<!--script independiente sin "setup" para la carga del LayoutPrincipal como layout persistente-->
<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";
export default {
    layout: LayoutPrincipal,
}
</script>

<!--script estandar para lo habitual-->
<script setup>
import { Head } from "@inertiajs/vue3";
import Carrusel from "../Components/Carrusel.vue";
import { initFlowbite } from 'flowbite'
import { onMounted } from "vue";
import Poster from "../Components/Poster.vue";

// Para montar componentes Flowbite
onMounted(() => {
    initFlowbite();
})

defineProps(['obras']);
</script>

<template>
    <!--  TODO revisar la responsividad: tamaños de fuente, anchura barra lateral...   -->
    <Head>
        <title>Inicio</title>
        <meta name="description" content="Página de bienvenida">
    </Head>
    <!--  Carrusel   -->
    <Carrusel></Carrusel>

    <!-- Seccion Principal de contenido -->
    <div class="flex w-4/5 m-auto pt-10">
        <!-- Seccion Principal de contenido -->
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 seccion-peliculas text-center w-full justify-items-center">
            <!-- Cada poster es un componente -->
            <Poster v-for="obra in obras" :key="obra['id']" :obra="obra" :titulo="`text-2xl hover:text-xl`" />
        </div>
    </div>
</template>
