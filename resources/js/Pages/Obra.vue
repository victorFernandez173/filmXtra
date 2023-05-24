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
import {Head, Link} from "@inertiajs/vue3";
import Poster from "../Components/Poster.vue";
/* Sweetalert2 */
import Swal from "sweetalert2";

const props = defineProps({
    obra: Object,
    mediaEvaluaciones: Number,
    criticas: Object,
    saga: [Object, String],
    secuelaPrecuela: Object,
    profesionales: Object
})

// Funcion para ordenar array por clave interna
const ordenarAnidado = (p1, p2 = null, sentido = 'asc') => (e1, e2) => {
    const a = p2 ? e1[p1][p2] : e1[p1],
        b = p2 ? e2[p1][p2] : e2[p1],
        ordenarPor = sentido === "asc" ? 1 : -1
    return (a < b) ? -ordenarPor : (a > b) ? ordenarPor : 0;
}

// Si hay secuelas, se genera un array con el objeto y despues se ordena dicho array
const secuelasOrdenadas = props.secuelaPrecuela !== null ? props.secuelaPrecuela.sort(ordenarAnidado("secuela", "orden", "desc")) : null;

// Configuración fechas relativas dayjs
dayjs.extend(relativeTime);
dayjs.locale('es');

// Funciones alert
function alertaDarLike() {
    Swal.fire({
        title: 'UPSSS!',
        text: `Registrate/logueate para dar like`,
        imageUrl: '../images/dealWithIt.gif',
        imageWidth: 400,
        imageAlt: 'ocupate de arreglarlo',
        confirmButtonColor: '#e37f81'
    });
}

//Funciones para procesar listados de nombres
function procesarEnumeracion(listado) {
    let enumeracionConComas = ' ';
    for (let a = 0; a < listado.length; a++) {
        //Procesamos el nombre del actor
        let nombre = procesarNombre(listado[a]['nombre']);
        //Lo añadimos
        enumeracionConComas += nombre;
        //Añadimos punto o coma
        if (a < listado.length - 1) {
            enumeracionConComas += ', ';
        } else {
            enumeracionConComas += '.';
        }
    }
    return enumeracionConComas;
}

function procesarNombre(nombre) {
    // Primero el nombre
    let nombreProcesado = nombre.substring(nombre.indexOf(',') + 2, nombre.length);
    // Despues el apellido
    nombreProcesado += ' ' + nombre.substring(0, nombre.indexOf(','));
    return nombreProcesado;
}

// Procesado de listas de nombres
// Obtenemos los listados de actores y directores
const actores = props.obra[0]['actors'];
const directores = props.obra[0]['directors'];
const actoresProcesados = procesarEnumeracion(actores);
const directoresProcesados = procesarEnumeracion(directores);

// Obtenemos y procesamos los géneros praa añadirles comas y puntos
function procesarGeneros(generos) {
    const generosProcesados = [];
    for (let i = 0; i < generos.length; i++) {
        generosProcesados.push(generos[i]['genero']);
    }
    let generosString = generosProcesados.join(', ');
    return generosString.substring(0, generosString.length) + '.';
}

const generos = props.obra[0]['generos'];
const generosProcesados = procesarGeneros(generos);

// Coloreado de los likes
function procesarGustadas($usuario, $gustadas){
   let objetoGustadas = Object.values($gustadas['gustadaPor']);
    let gustadaPorArray = []
    for (const user_id in objetoGustadas){
        let valor = Object.values(objetoGustadas[user_id]);
        gustadaPorArray.push(valor[0]);
    }
    return gustadaPorArray.includes($usuario['id']);
}
</script>

<template>
    <Head>
        <title>{{ obra[0].titulo }}</title>
        <meta name="description" content="Página de bienvenida">
    </Head>
    <div class="container mx-auto mt-10 mb-10">
        <h1 class="text-center font-bold text-flamingo underline text-3xl px-8">{{ obra[0]['titulo'] }}</h1>
        <!--3 apartados para poster, datos y valoraciones-->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-10">
            <!--Poster-->
            <div class="flex justify-start flex-col m-auto h-[100%] w-[90%]">
                <img :src="'../posters/' + obra[0]['poster']['ruta']" :alt="obra[0].poster.alt">
                <!--Puntuacion-->
                <div class="flex justify-center mt-2">
                    <div class="flex items-center mt-2 text-yellow-300 m-auto">
                        <svg aria-hidden="true" class="w-7 h-7"
                             :fill="mediaEvaluaciones >= 0.5 ? 'currentColor' : 'grey'" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-7 h-7"
                             :fill="mediaEvaluaciones >= 1.5 ? 'currentColor' : 'grey'" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-7 h-7"
                             :fill="mediaEvaluaciones >= 2.5 ? 'currentColor' : 'grey'" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-7 h-7"
                             :fill="mediaEvaluaciones >= 3.5 ? 'currentColor' : 'grey'" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-7 h-7"
                             :fill="mediaEvaluaciones >= 4.5 ? 'currentColor' : 'grey'" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-7 h-7"
                             :fill="mediaEvaluaciones >= 5.5 ? 'currentColor' : 'grey'" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-7 h-7"
                             :fill="mediaEvaluaciones >= 6.5 ? 'currentColor' : 'grey'" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-7 h-7"
                             :fill="mediaEvaluaciones >= 7.5 ? 'currentColor' : 'grey'" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-7 h-7"
                             :fill="mediaEvaluaciones >= 8.5 ? 'currentColor' : 'grey'" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-7 h-7"
                             :fill="mediaEvaluaciones >= 9.5 ? 'currentColor' : 'grey'" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <p class="text-black"> &nbsp;&nbsp; {{ mediaEvaluaciones }}/10
                            ({{ obra[0]['evaluaciones'].length }} votos)</p>
                    </div>
                </div>
            </div>

            <!--Datos pelicula-->
            <div class="flex justify-center mr-10 w-full md:-ml[150px]">
                <ul>
                    <!--Datos de la pelicula-->
                    <li class="list-disc font-bold text-flamingo text-xl"><span class="underline">Obra</span>:</li>
                    <li>
                        <ul>
                            <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Título</span>: {{
                                    obra[0]['titulo']
                                }} ({{ obra[0]['titulo_original'] }})
                            </li>
                            <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Año</span>:
                                {{ obra[0]['fecha'] }}
                            </li>
                            <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Duración</span>:
                                {{ Math.floor((parseInt(obra[0]['duracion']) / 60)) }}h
                                {{ parseInt(obra[0]['duracion']) % 60 }}min
                            </li>
                            <li class="list-disc ml-5"><span class="font-semibold underline text-lg">País</span>:
                                {{ obra[0]['pais'] }}
                            </li>
                            <li v-if="obra[0]['directors'][0]" class="list-disc ml-5"><span
                                class="font-semibold underline text-lg">Dirección</span>:<span> {{
                                    directoresProcesados
                                }}  </span></li>
                            <li v-if="obra[0]['actors'][0]" class="list-disc ml-5"><span
                                class="font-semibold underline text-lg">Reparto</span>: <span>{{
                                    actoresProcesados
                                }} </span></li>
                            <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Productora</span>:
                                {{ obra[0]['productora'] }}
                            </li>
                            <li v-if="obra[0]['generos'][0]" class="list-disc ml-5"><span
                                class="font-semibold underline text-lg">Género</span>: <span> {{
                                    generosProcesados
                                }} </span></li>
                            <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Sinopsis</span>:
                                {{ obra[0]['sinopsis'] }}
                            </li>
                            <!--Festivales y premios-->
                            <li v-if="obra[0]['festivals'][0]"
                                class="list-disc font-bold underline text-flamingo text-xl mt-2">Galardones:
                            </li>
                            <li>
                                <ul>
                                    <li v-for="fest in obra[0]['festivals']" class="list-disc ml-5"><span
                                        class="font-semibold underline text-lg">Mejor película</span>: {{
                                            fest['nombre']
                                        }}({{ fest['edicion'] }})
                                    </li>
                                </ul>
                            </li>
                            <li v-if="saga" class="list-disc font-bold text-flamingo text-xl mt-2"><span
                                class="underline">Saga</span>:
                            </li>
                            <!-- Si solo hay un poster en secuelas, flex justify-center -->
                            <div v-if="secuelasOrdenadas && secuelasOrdenadas.length <= 1" class="text-center flex justify-center">
                                <div v-for="secuela in secuelasOrdenadas" class="w-[80%] sm:w-[100%] md:w-[250px] lg">
                                <span>
                                {{
                                        obra[0]['secuela']['orden'] === 0 ? 'Inicio saga' : secuela['secuela']['orden'] === 0 ? 'Spin-off' : secuela['secuela']['orden'] > obra[0]['secuela']['orden'] ? 'Secuela' : 'Precuela'
                                    }}
                                </span>
                                    <div class="width-[100%] flex justify-center -my-[25px] md:m:0">
                                        <Poster :obra="secuela" :titulo="`text-lg hover:text-md`"/>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="text-center grid lg:grid-cols-2 justify-items-center">
                                <div v-for="secuela in secuelasOrdenadas" class="w-[80%] sm:w-[100%] md:w-[250px] lg">
                                <span>
                                {{
                                        obra[0]['secuela']['orden'] === 0 ? 'Inicio saga' : secuela['secuela']['orden'] === 0 ? 'Spin-off' : secuela['secuela']['orden'] > obra[0]['secuela']['orden'] ? 'Secuela' : 'Precuela'
                                    }}
                                </span>
                                    <div class="width-[100%] flex justify-center -my-[25px] md:m:0">
                                        <Poster :obra="secuela" :titulo="`text-lg hover:text-md`"/>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!--Contenedor criticas-->
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-10 mb-15 justify-center bg-flamingo text-white rounded lg:divide-x md:divide-x divide-y">
            <!--Criticas-->
            <div class="pl-10">
                <!--Titulo-->
                <ul>
                    <li v-if="profesionales" class="list-disc font-bold text-black text-xl mt-5">Críticas
                        profesionales:
                    </li>
                </ul>
                <ul>
                    <!--Primera critica profesional-->
                    <li v-for="p in profesionales" class="list-disc ml-5"><span class="font-semibold"><a
                        class="underline hover:text-black" :href="p['web']" target="_blank"
                        href="">{{ p['medio'] }}</a>:</span> {{ p['contenido'] }} <span
                        class="italic">{{ p['autor'] }}</span>
                        <span v-if="p['fecha']"> ({{ dayjs(p['fecha']).fromNow() }})</span>
                    </li>
                </ul>
                <!--Titulo-->
                <ul>
                    <li class="list-disc font-bold text-black text-xl mt-3">Críticas de nuestros usuarios:</li>
                </ul>
                <ul>
                    <!--Primera critica-->
                    <li v-for="(cri, i) in criticas" class="list-disc ml-5"><span
                        class="underline font-semibold">{{ cri['usuario'][0]['name'] }}</span>: {{ cri['critica'] }}
                        ({{ dayjs(cri['fecha']).fromNow() }}) - Likes: {{ cri['likes'] }}

                        <!--Mano arriba-->
                        <Link v-if="$page.props.auth.user" class="inline-block" as="button" method="post"
                              :href="route('darLike')"
                              :data="{ user_id: $page.props.auth.user['id'], critica_id: cri['id_critica'] }"
                              preserveScroll>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" :fill=" procesarGustadas($page.props.auth.user, $page.props.criticas[i]) ? 'black' : 'white'"
                                 class="w-5 h-5 inline-block hover:fill-yellow-300">
                                <path
                                    d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z"/>
                            </svg>
                        </Link>
                        <svg v-else @click="alertaDarLike" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="white"
                             class="w-5 h-5 inline-block hover:fill-yellow-300">
                            <path
                                d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z"/>
                        </svg>
                    </li>
                </ul>
                <!--Boton para ver mas valoraciones-->
                <button v-if="criticas[0]"
                        class="my-5 m-auto text-flamingo bg-white hover:text-black focus:bg-white focus:ring-flamingo focus:text-flamingo focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5">
                    Ver más valoraciones &rarr;
                </button>
                <p v-if="!criticas[0]" class="py-3">Sin críticas de usuarios todavía. Participa, pon la tuya.</p>
            </div>

            <!--Botones para votar y formulario para escribir-->
            <div>
                <!--Titulo-->
                <h3 class="font-bold underline text-black text-xl mt-5 pl-5 text-center">¿Quieres valorar esta
                    película?</h3>
                <!--Formulario para escribir-->
                <form>
                    <div class="w-[70%] m-auto mt-4 mb-4 rounded-lg bg-gray-300">
                        <div class="px-4 py-2 bg-gray-300 rounded-t-lg">
                            <!--Parte de escribir-->
                            <label for="comment" class="sr-only">Tu comentario</label>
                            <textarea id="comment" rows="4"
                                      class="w-full px-0 text-sm text-gray-900 bg-gray-300 border-0 focus:ring-red-400 focus:border-red-400"
                                      placeholder="Escribe tu valoración..." required></textarea>
                            <!--Parte de nota-->
                            <select name="nota"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-base focus:ring-red-400 focus:border-red-400 block w-full p-2.5">
                                <option disabled value="">Nota</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                        <!--Boton enviar valoracion-->
                        <div class="flex items-center justify-between px-3 py-2 border-t">
                            <button type="submit"
                                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-flamingo rounded-lg focus:ring-4 focus:ring-flamingo hover:bg-flamingo hover:text-black">
                                Enviar valoración
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <!--1 apartado para el trailer-->
        <div class="grid grid-cols-1 pt-10">
            <!--Trailer-->
            <div class="flex justify-center">
                <!--                <iframe width="1300" height="600" src="https://www.youtube.com/embed/NaM7nKvX4Es"
                                        title="YouTube video player"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>-->
            </div>
        </div>
    </div>
</template>
