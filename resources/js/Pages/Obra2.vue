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

defineProps(['obra', 'mediaEvaluaciones', 'criticas', 'saga']);
dayjs.extend(relativeTime);
dayjs.locale('es');

const media = 0;
</script>

<!--<template>
    <Head>
        <title>{{ obra[0].titulo }}</title>
        <meta name="description" content="Página de bienvenida">
    </Head>
    <div class="w-[66vw] flex flex-col items-center [&>span]:font-bold m-auto">
        <img class="w-[400px]" :src="'../posters/' + obra[0]['poster']['ruta']" :alt="obra[0].poster.alt">
        <p class="underline">
            {{ obra[0]['titulo'] }} ({{obra[0]['titulo_original']}})-{{ obra[0]['fecha'] }}
        </p>
        <p  class="block" >{{ obra[0]['sinopsis'] }}</p>
        <span v-show="obra[0]['directors'][0]">Dirección:</span>
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
            {{ parseInt(obra[0]['duracion']/60) }}h {{ parseInt(obra[0]['duracion']%60) }}min
        </p>
        <span v-show="obra[0]['actors'][0]">Reparto:</span>
        <p v-for="act in obra[0]['actors']">
            {{ act['nombre'] }}
        </p>
        <span v-show="obra[0]['festivals'][0]">Premios: </span>
        <p v-for="fest in obra[0]['festivals']">
            {{ fest['nombre'] }}({{ fest['edicion'] }})
        </p>
        <span v-show="obra[0]['generos'][0]">Generos: </span>
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
        <span v-show="criticas">Criticas: </span>
        <ul>
            <li v-for="cri in criticas">
                {{ dayjs(cri['fecha']).fromNow() }}-{{ cri['critica'] }}(Likes:{{ cri['likes'] }})
            </li>
        </ul>
        <span v-show="obra[0]['profesionals'][0]">Criticas profesionales: </span>
        <ul>
            <li v-for="pro in obra[0]['profesionals']">
                {{ pro['contenido'] }}
            </li>
        </ul>
        <span v-if="saga">Saga: {{ saga[0]['nombre'] }}</span>
    </div>
</template>-->

<template>
    <div class="container mx-auto mt-10 mb-10">
        <h1 class="text-center font-bold text-flamingo underline text-3xl">Harry Potter y el misterio del príncipe</h1>
        <!--3 apartados para poster, datos y valoraciones-->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-10">
            <!--Poster-->
            <div class="justify-center m-auto ">
                <img class="w-80" src="../../../public/posters/Harry_Potter_and_the_Half-Blood_Prince_(Harry_Potter_6).png" alt="Poster">
                <!--Puntuacion-->
                <div class="flex justify-center">
                    <div class="flex items-center mt-2 text-yellow-300 m-auto">
                        <svg aria-hidden="true" class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg aria-hidden="true" class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg aria-hidden="true" class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg aria-hidden="true" class="w-7 h-7" fill="grey" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg aria-hidden="true" class="w-7 h-7" fill="grey" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <p class="text-black">3/5 (32 votos)</p>
                    </div>
                </div>
            </div>

            <!--Datos pelicula-->
            <div class="flex justify-center ml-10 mr-10 ">
                <ul>
                    <!--Datos de la pelicula-->
                    <li class="list-disc font-bold underline text-flamingo text-xl">Obra:</li>
                    <ul>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Título: </span>Harry Potter y el misterio del príncipe (Harry Potter and the Half Blood Prince)</li>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Año: </span>2009</li>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Duración: </span>153 min</li>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">País: </span>Reino Unido</li>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Director: </span>David Yates</li>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Reparto: </span>Daniel Radcliffe, Emma Watson y Rupert Grint</li>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Productora: </span>Warner Bros</li>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Género: </span>Fantástico, aventuras y drama</li>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Sinopsis: </span>Con dieciséis años cumplidos, Harry inicia el sexto curso en Hogwarts en medio de terribles acontecimientos que asolan Inglaterra. Elegido capitán del equipo de Quidditch, los entrenamientos, los exámenes y las chicas ocupan todo su tiempo, pero la tranquilidad dura poco. A pesar de los férreos controles de seguridad que protegen la escuela, dos alumnos son brutalmente atacados. Dumbledore sabe que se acerca el momento, anunciado por la Profecía, en que Harry y Voldemort se enfrentarán a muerte. El anciano director pedirá ayuda a Harry y juntos emprenderán un peligroso viaje. Para debilitar al enemigo, el joven mago cuenta con la ayuda de un viejo libro de pociones perteneciente a un misterioso personaje que se hace llamar el Príncipe Mestizo.</li>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Saga: </span>Harry Potter</li>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Precuela: </span>Harry Potter y la Orden del Fénix</li>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Secuela: </span>Harry Potter y las reliquias de la Muerte: parte 1</li>
                    </ul>
                    <!--Festivales y premios-->
                    <li class="list-disc font-bold underline text-flamingo text-xl mt-2">Festival:</li>
                    <ul>
                        <li class="list-disc ml-5"><span class="font-semibold underline text-lg">Premios Oscar: </span>Mejor película</li>
                    </ul>
                </ul>
            </div>
        </div>

        <!--Críticas-->
        <div class="grid grid-cols-1 pl-10 mt-10 mb-10 pb-5 justify-center bg-flamingo text-white rounded">
            <li class="list-disc font-bold underline text-black text-xl mt-5">Críticas profesionales:</li>
            <ul>
                <li class="list-disc ml-5">El Mundo: Merece la pena (18/05/2023)</li>
            </ul>
            <li class="list-disc font-bold underline text-black text-xl mt-3">Críticas de nuestros usuarios:</li>
            <ul>
                <li class="list-disc ml-5">Irene: Es mi película favorita (18/05/2023)
                    <!--Mano abajo-->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-5 mr-5 inline-block">
                        <path d="M18.905 12.75a1.25 1.25 0 01-2.5 0v-7.5a1.25 1.25 0 112.5 0v7.5zM8.905 17v1.3c0 .268-.14.526-.395.607A2 2 0 015.905 17c0-.995.182-1.948.514-2.826.204-.54-.166-1.174-.744-1.174h-2.52c-1.242 0-2.26-1.01-2.146-2.247.193-2.08.652-4.082 1.341-5.974C2.752 3.678 3.833 3 5.005 3h3.192a3 3 0 011.342.317l2.733 1.366A3 3 0 0013.613 5h1.292v7h-.963c-.684 0-1.258.482-1.612 1.068a4.012 4.012 0 01-2.165 1.73c-.433.143-.854.386-1.012.814-.16.432-.248.9-.248 1.388z" />
                    </svg>
                    <!--Mano arriba-->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 inline-block">
                        <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z" />
                    </svg>
                </li>
                <li class="list-disc ml-5">Tomás: Un rollo no la recomiendo (14/05/2023)
                    <!--Mano abajo-->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-5 mr-5 inline-block">
                        <path d="M18.905 12.75a1.25 1.25 0 01-2.5 0v-7.5a1.25 1.25 0 112.5 0v7.5zM8.905 17v1.3c0 .268-.14.526-.395.607A2 2 0 015.905 17c0-.995.182-1.948.514-2.826.204-.54-.166-1.174-.744-1.174h-2.52c-1.242 0-2.26-1.01-2.146-2.247.193-2.08.652-4.082 1.341-5.974C2.752 3.678 3.833 3 5.005 3h3.192a3 3 0 011.342.317l2.733 1.366A3 3 0 0013.613 5h1.292v7h-.963c-.684 0-1.258.482-1.612 1.068a4.012 4.012 0 01-2.165 1.73c-.433.143-.854.386-1.012.814-.16.432-.248.9-.248 1.388z" />
                    </svg>
                    <!--Mano arriba-->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 inline-block">
                        <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z" />
                    </svg>
                </li>
                <li class="list-disc ml-5">Alejandro: Para pasar la tarde (10/05/2023)
                    <!--Mano abajo-->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-5 mr-5 inline-block">
                        <path d="M18.905 12.75a1.25 1.25 0 01-2.5 0v-7.5a1.25 1.25 0 112.5 0v7.5zM8.905 17v1.3c0 .268-.14.526-.395.607A2 2 0 015.905 17c0-.995.182-1.948.514-2.826.204-.54-.166-1.174-.744-1.174h-2.52c-1.242 0-2.26-1.01-2.146-2.247.193-2.08.652-4.082 1.341-5.974C2.752 3.678 3.833 3 5.005 3h3.192a3 3 0 011.342.317l2.733 1.366A3 3 0 0013.613 5h1.292v7h-.963c-.684 0-1.258.482-1.612 1.068a4.012 4.012 0 01-2.165 1.73c-.433.143-.854.386-1.012.814-.16.432-.248.9-.248 1.388z" />
                    </svg>
                    <!--Mano arriba-->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 inline-block">
                        <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z" />
                    </svg>
                </li>
                <li class="list-disc ml-5">Leire: Entretenida (21/05/2023)
                    <!--Mano abajo-->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-5 mr-5 inline-block">
                        <path d="M18.905 12.75a1.25 1.25 0 01-2.5 0v-7.5a1.25 1.25 0 112.5 0v7.5zM8.905 17v1.3c0 .268-.14.526-.395.607A2 2 0 015.905 17c0-.995.182-1.948.514-2.826.204-.54-.166-1.174-.744-1.174h-2.52c-1.242 0-2.26-1.01-2.146-2.247.193-2.08.652-4.082 1.341-5.974C2.752 3.678 3.833 3 5.005 3h3.192a3 3 0 011.342.317l2.733 1.366A3 3 0 0013.613 5h1.292v7h-.963c-.684 0-1.258.482-1.612 1.068a4.012 4.012 0 01-2.165 1.73c-.433.143-.854.386-1.012.814-.16.432-.248.9-.248 1.388z" />
                    </svg>
                    <!--Mano arriba-->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 inline-block">
                        <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z" />
                    </svg>
                </li>
            </ul>
        </div>

        <!--1 apartado para el trailer-->
        <div class="grid grid-cols-1">
            <!--Trailer-->
            <div class="flex justify-center">
                <iframe width="1300" height="600" src="https://www.youtube.com/embed/NaM7nKvX4Es" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</template>
