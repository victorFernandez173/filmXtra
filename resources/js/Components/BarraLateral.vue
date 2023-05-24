<script setup>
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <!-- Seccion columna izquierda -->
    <section class="w-[4/12] text-xs sm:text-base sm:[&>ul>li]:pr-3 bg-flamingo p-4 pb-8 hover:[&>ul>li]:text-white [&>ul>li]:overflow-ellipsis [&>ul>li]:overflow-hidden">
        <!-- Genero -->
        <h5 class="py-4 font-bold underline">Género</h5>
        <ul>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'acción', barraLateral: 'genero' }">Acción</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'aventuras', barraLateral: 'genero' }">Aventuras</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'biográfico', barraLateral: 'genero' }">Biográfico</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'bélico', barraLateral: 'genero' }">Bélico</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'ciencia ficción', barraLateral: 'genero' }">Ciencia ficción</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'cine mudo', barraLateral: 'genero' }">Cine Mudo</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'cine negro', barraLateral: 'genero' }">Cine Negro</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'comedia', barraLateral: 'genero' }">Comedia</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'cortometraje', barraLateral: 'genero' }">Cortometraje</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'crimen', barraLateral: 'genero' }">Crimen</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'deportiva', barraLateral: 'genero' }">Deportiva</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'documental', barraLateral: 'genero' }">Documental</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'drama', barraLateral: 'genero' }">Drama</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'fantástico', barraLateral: 'genero' }">Fantástico</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'historica', barraLateral: 'genero' }">Histórica</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'infantil', barraLateral: 'genero' }">Infantil</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'intriga', barraLateral: 'genero' }">Intriga</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'musical', barraLateral: 'genero' }">Musical</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'policiaca', barraLateral: 'genero' }">Policiaca</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'propagandístico', barraLateral: 'genero' }">Propagandístico</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'película de culto', barraLateral: 'genero' }">Película de culto</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'road movie', barraLateral: 'genero' }">Road Movie</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'romance', barraLateral: 'genero' }">Romance</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'terror', barraLateral: 'genero' }">Terror</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'thriller', barraLateral: 'genero' }">Thriller</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ genero : 'western', barraLateral: 'genero' }">Western</Link>
            </li>
        </ul>

        <!-- Decada -->
        <h5 class="py-4 font-bold underline">Década</h5>
        <ul>
            <li>
                <Link :href="route('obras')" :data="{ desde : '2010', hasta : '2019', barraLateral: 'decada' }">2010s</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ desde : '2000', hasta : '2009', barraLateral: 'decada' }">2000s</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ desde : '1990', hasta : '1999', barraLateral: 'decada' }">90s</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ desde : '1980', hasta : '1989', barraLateral: 'decada' }">80s</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ desde : '1970', hasta : '1979', barraLateral: 'decada' }">70s</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ desde : '1960', hasta : '1969', barraLateral: 'decada' }">60s</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ desde : '1950', hasta : '1959', barraLateral: 'decada' }">50s</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ desde : '1940', hasta : '1949', barraLateral: 'decada' }">40s</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ desde : '1930', hasta : '1939', barraLateral: 'decada' }">30s</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ desde : '1920', hasta : '1929', barraLateral: 'decada' }">20s</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ desde : '1900', hasta : '1910', barraLateral: 'decada' }">00s</Link>
            </li>
        </ul>

        <!-- Pais -->
        <h5 class="py-4 font-bold underline">País</h5>
        <ul>
            <li>
                <Link :href="route('obras')" :data="{ pais : 'Alemania', barraLateral: 'pais' }">Alemania</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ pais : 'Australia', barraLateral: 'pais' }">Australia</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ pais : 'España', barraLateral: 'pais' }">España</Link>
            </li>
            <li>
                <div id="tio">
                  <Link :href="route('obras')" :data="{ pais : 'Estados Unidos de America', barraLateral: 'pais' }">Estados Unidos de América</Link>
                </div>

            </li>
            <li>
                <Link :href="route('obras')" :data="{ pais : 'Francia', barraLateral: 'pais' }">Francia</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ pais : 'Italia', barraLateral: 'pais' }">Italia</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ pais : 'Japón', barraLateral: 'pais' }">Japón</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ pais : 'Nueva Zelanda', barraLateral: 'pais' }">Nueva Zelanda</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ pais : 'Reino Unido', barraLateral: 'pais' }">Reino Unido</Link>
            </li>
            <li>
                <Link :href="route('obras')" :data="{ pais : 'USSR', barraLateral: 'pais' }">USSR</Link>
            </li>
        </ul>
    </section>
</template>
