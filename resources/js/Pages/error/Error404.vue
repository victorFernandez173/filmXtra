<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps([ 'status', 'message'])
</script>

<template>
    <Head>
        <title>Error 404</title>
        <meta name="filter" content="Página de error 404">
    </Head>
    <div class="contenedor grid h-screen place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8 bg-cover bg-[url('gif/error-fondo.gif')]">
        <div class="text-center color-fondo-letras rounded pt-5 pb-10 pl-10 pr-10">
            <!--<p class="texto-404 text-base font-semibold">Error {{ status }}</p>-->
            <img src="/images/logo-error.png" class="m-auto w-60 mb-10" alt="Logo Error 404">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">{{ message }}</h1>
            <p class="mt-5 mb-12 text-2xl leading-7 text-gray-800">Pero si vuelves al inicio, en FilmXtra encontrarás todo lo que necesitas.</p>
            <img src="/gif/error-gif.gif" class="m-auto mt-7 w-80" alt="Gif error cine">
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <Link :href="route('/')" class="hover:text-flamingo hover:bg-black bg-flamingo rounded-md px-3.5 py-2.5 text-sm font-semibold text-white">Ir a inicio &rarr;</Link>
            </div>
            <img src="/images/logo.png" class="m-auto w-60 mt-10" alt="Logo FilmXtra">
        </div>
    </div>
</template>

<style>
.color-fondo-letras {
    background-color: rgba(255, 255, 255, 0.4);
}

.contenedor {
    padding-top: 40px;
}
</style>
