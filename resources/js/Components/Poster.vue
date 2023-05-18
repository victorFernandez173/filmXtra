<script setup>
import { Link } from "@inertiajs/vue3";

defineProps(['obra', 'titulo']);
</script>

<template>
    <div class="w-[80%] sm:w-full p-6">
        <Link :href="route('obra', encodeURIComponent(obra['titulo']))">
            <div class="cursor-pointer flex justify-center h-[50px] content-center -mb-[10px]">
                <h3 :class="titulo" class="hover:text-white hover:bg-flamingo hover:overflow-visible hover:z-10 py-2 hover:py-2.5 px-3 hover:px-3 hover:relative text-flamingo font-bold underline font-oswald overflow-ellipsis overflow-hidden whitespace-nowrap">{{ obra['titulo'] }}</h3>
                <h3 :class="titulo" class=" absolute font-bold underline font-oswald  whitespace-nowrap top-0 py-[8px] px-[8px] bg-flamingo text-white group-hidden opacity-0 transition-opacity duration-500 ease-out" >{{ obra['titulo'] }}</h3>
            </div>
        </Link>
        <Link :href="route('obra', encodeURIComponent(obra['titulo']))">
            <img class="hover:border-[10px] border-[10px] hover:border-flamingo border-white hover:border-solid border-solid w-full mt-0" :src="'../posters/' + obra['poster']['ruta']"
                 :alt="obra['poster']['alt']">
        </Link>
    </div>
</template>
