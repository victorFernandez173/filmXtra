<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";
export default {
    layout: LayoutPrincipal,
}
</script>

<script setup>
import dayjs from "dayjs";
import es from "dayjs/locale/es";
import relativeTime from 'dayjs/plugin/relativeTime';
import { Head } from "@inertiajs/vue3";
import Poster from "../Components/Poster.vue";

// Obtenemos los props
const props = defineProps({
    obra: Object,
    mediaEvaluaciones: String,
    criticas: Object,
    saga: Object,
    secuelaPrecuela: Object,
    profesionales: Object
})

// Funcion para ordenar array por clave interna
const nestedSort = (prop1, prop2 = null, direction = 'asc') => (e1, e2) => {
    const a = prop2 ? e1[prop1][prop2] : e1[prop1],
        b = prop2 ? e2[prop1][prop2] : e2[prop1],
        sortOrder = direction === "asc" ? 1 : -1
    return (a < b) ? -sortOrder : (a > b) ? sortOrder : 0;
}

// Si hay secuelas, se genera un array con el objeto y despues se ordena dicho array
const secuelasOrdenadas = props.secuelaPrecuela != null ? props.secuelaPrecuela.sort(nestedSort("secuela", "orden", "desc")) : null;

// Configuración fechas relativas dayjs
dayjs.extend(relativeTime);
dayjs.locale('es');
</script>

<template>
    <Head>
        <title>{{ obra[0].titulo }}</title>
        <meta name="description" content="Página de bienvenida">
    </Head>
    <div class="w-[66vw] flex flex-col items-center [&>span]:font-bold m-auto text-center">
        <img class="w-[400px]" :src="'../posters/' + obra[0]['poster']['ruta']" :alt="obra[0].poster.alt">
        <p class="underline">
            {{ obra[0]['titulo'] }} ({{obra[0]['titulo_original']}})-{{ obra[0]['fecha'] }}
        </p>
        <p  class="block" >{{ obra[0]['sinopsis'] }}</p>
        <span v-if="obra[0]['directors'][0]">Dirección:</span>
        <p v-for="dir in obra[0]['directors']">
            {{ dir['nombre'] }}
        </p>
        <span>País:</span>
        <p>
            {{ obra[0]['pais'] }}
        </p>
        <span>Productora:</span>
        <p>
            {{ obra[0]['productora'] }}
        </p>
        <span>Duracion:</span>
        <p>
            {{ Math.floor((parseInt(obra[0]['duracion'])/60)) }}h {{ parseInt(obra[0]['duracion'])%60 }}min
        </p>
        <span v-if="obra[0]['actors'][0]">Reparto:</span>
        <p v-for="act in obra[0]['actors']">
            {{ act['nombre'] }}
        </p>
        <span v-if="obra[0]['festivals'][0]">Premios: </span>
        <p v-for="fest in obra[0]['festivals']">
            {{ fest['nombre'] }}({{ fest['edicion'] }})
        </p>
        <span v-if="obra[0]['generos'][0]">Generos: </span>
        <ul>
            <li v-for="gen in obra[0]['generos']">
                {{ gen['genero'] }}
            </li>
        </ul>
        <span>Evaluaciones: </span>
        <ul>
            <li>
                {{ parseFloat(mediaEvaluaciones) }}
            </li>
        </ul>
        <span v-if="criticas[0]">Criticas: </span>
        <ul>
            <li v-for="cri in criticas">
                {{ dayjs(cri['fecha']).fromNow() }}-{{ cri['critica'] }}(Likes:{{ cri['likes'] }})[{{cri['usuario'][0]['nombre']}} {{cri['usuario'][0]['apellido']}}]
            </li>
        </ul>
        <span v-if="profesionales">Criticas profesionales: </span>
        <ul>
            <li v-for="pro in profesionales">
                {{ pro['contenido'] }}({{ pro['autor'] }})[{{ pro['medio'] }}-
                <a class="hover:text-red-600 text-flamingo underline" :href="pro['web']" target="_blank">{{ pro['web'] }}</a>]
            </li>
        </ul>
        <span v-if="saga">Saga: {{ saga[0]['nombre'] }}</span>
        <div class="flex text-center">
            <div v-for="secuela in secuelasOrdenadas" class="w-[300px]">
                <span>
                    {{ obra[0]['secuela']['orden'] === 0 ? 'Inicio saga' : secuela['secuela']['orden'] === 0 ? 'Spin-off' : secuela['secuela']['orden'] > obra[0]['secuela']['orden'] ? 'Secuela' : 'Precuela' }}
                </span>
                 <Poster :obra="secuela" :titulo="`text-lg hover:text-md`" />
            </div>
        </div>
    </div>
</template>
