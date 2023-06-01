<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps(['obra', 'titulo', 'info']);
</script>

<template>
    <div class="w-full p-2">
        <!-- Sección de títulos -->
        <Link :href="route([props.info ? 'obra':'fichaValoraciones'], encodeURIComponent(obra['titulo']))">
            <div class="cursor-pointer flex justify-center h-[35px] font-oswald ">
                <h3 :class="titulo" class="hover:text-white hover:bg-flamingo hover:overflow-visible hover:z-10 hover:py-2.5 px-3 hover:px-3 hover:relative text-flamingo font-bold underline overflow-ellipsis overflow-hidden whitespace-nowrap self-center">{{ obra['titulo'] }}</h3>
                <h3 :class="titulo" class="absolute font-bold underline  whitespace-nowrap top-0 group-hidden opacity-0 transition-opacity duration-500 ease-out" >{{ obra['titulo'] }}</h3>
            </div>
        </Link>

        <!-- Sección de imagen -->
        <Link :href="route([props.info ? 'obra':'fichaValoraciones'], encodeURIComponent(obra['titulo']))">
            <img class="hover:border-[10px] border-[10px] hover:border-flamingo border-white hover:border-solid border-solid w-full mt-0" :src="'../posters/' + [obra['ruta'] ? obra['ruta'] : obra['poster']['ruta']]"
                 :alt="obra['alt']">
        </Link>

        <!-- Sección de nota y numero de valoraciones -->
        <h3 class="font-bold text-flamingo" v-if="obra['nota_media']">{{ parseFloat(obra['nota_media']).toFixed(1) }}</h3>
        <h3 class="font-medium" v-if="obra['num_valoraciones']">({{obra['num_valoraciones']}} valoraciones)</h3>

    </div>
</template>
