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
import {Head, Link, useForm} from "@inertiajs/vue3";
import Estrellitas from "../Components/Estrellitas.vue";
import Swal from "sweetalert2";
import SelectRango from "../Components/SelectRango.vue";
import InputError from "../Components/InputError.vue";
import Paginacion from "../Components/Paginacion.vue";

defineProps(['obra', 'mediaEvaluaciones', 'profesionales', 'criticas']);
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

// Coloreado de los likes
function procesarGustadas($usuario, $gustadas) {
    let objetoGustadas = Object.values($gustadas['gustadaPor']);
    let gustadaPorArray = []
    for (const user_id in objetoGustadas) {
        let valor = Object.values(objetoGustadas[user_id]);
        gustadaPorArray.push(valor[0]);
    }
    return gustadaPorArray.includes($usuario['id']);
}

// Formularios
const form = useForm({
    notaEvaluacion: '',
    critica: ''
});
</script>

<template>
    <Head>
        <title>Valoraciones: {{ obra[0].titulo }}</title>
        <meta name="description" content="Página de bienvenida">
    </Head>
    <div class="container mx-auto mt-10 mb-10">
        <h1 class="text-center font-bold text-flamingo underline text-3xl">{{ obra[0].titulo }}</h1>
        <!--2 bloque para poster, criticas profesionales & usuarios-->
        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-4 mt-10">
            <!--Poster-->
            <div>
                <div class="w-full flex justify-center flex-wrap items-center">
                    <img :src="'../posters/' + obra[0]['poster']['ruta']" :alt="obra[0].poster.alt">
                    <Estrellitas class="w-full" :mediaEvaluaciones="mediaEvaluaciones" :obra="obra"/>
                    <p class="text-black text-center pt-4"> &nbsp;&nbsp; {{ mediaEvaluaciones }}/10
                        ({{ obra[0]['evaluaciones'].length }} votos)</p>
                </div>
                <!--Boton para llevarte a la pagina de datos de la película-->
                <div class="m-auto mb-10 w-3/4">
                    <Link :href="route('obra', encodeURIComponent(obra[0]['titulo']))" as="button"
                          class="w-full text-white bg-flamingo hover:text-black focus:bg-flamingo focus:ring-flamingo focus:border-flamingo focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 mt-10 text-center">
                        &larr; Ficha {{ obra[0]['titulo'] }}
                    </Link>
                </div>
            </div>

            <!--Criticas-->
            <div class="criticas-profesionales rounded mx-5 lg:mr-0 col-span-3 bg-flamingo px-8 lg:px-20 pb-5">
                <!--Titulo profesionales-->
                <ul>
                    <li class="list-disc font-bold underline text-black text-xl mt-5 pt-3 text-white">Críticas
                        profesionales:
                    </li>
                </ul>
                <ul v-for="(p, i) in profesionales">
                    <!--Críticas profesionales-->
                    <li v-if="i < 5" class="list-disc ml-5"><span class="font-semibold"><a
                        class="underline hover:text-white" :href="p['web']" target="_blank"
                        href="">{{ p['medio'] }}</a>:</span> {{ p['contenido'] }} <span
                        class="italic">{{ p['autor'] }}</span>
                        <span v-if="p['fecha']"> ({{ dayjs(p['fecha']).fromNow() }})</span>
                    </li>
                </ul>
                <!--Titulo usuarios-->
                <ul>
                    <li class="list-disc font-bold underline text-black text-xl mt-3 text-white">Críticas de nuestros
                        usuarios:
                    </li>
                </ul>
                <ul v-for="(cri, i) in criticas['data']">
                    <!--Críticas usuarios-->
                    <li class="list-disc ml-5"><span
                        class="underline font-semibold">{{ cri['usuario'][0]['name'] }}</span>: {{ cri['critica'] }}
                        ({{ dayjs(cri['fecha']).fromNow() }}) - Likes: {{ cri['likes'] }}

                        <!--Mano arriba-->
                        <Link v-if="$page.props.auth.user" class="inline-block" as="button" method="post"
                              :href="route('darLike')"
                              :data="{ user_id: $page.props.auth.user['id'], critica_id: cri['id_critica'] }"
                              preserveScroll>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 :fill=" procesarGustadas($page.props.auth.user, $page.props.criticas['data'][i]) ? 'black' : 'white'"
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
                <div class="flex justify-center mt-5">
                    <Paginacion :obras="criticas"></Paginacion>
                </div>
            </div>
            <!-- Sección formularios container-->
            <div class="col-span-1 lg:col-span-4 mt-5 bg-flamingo rounded container">
                <div v-if="$page.props.auth.user" class="grid grid-cols-1 md:grid-cols-12 lg:grid-cols-12 p-1">
                    <!-- Formulario evas -->
                    <div
                        class="col-span-1 md:col-span-3 lg:col-span-2 flex justify-center flex-wrap content-start border border-[2px] border-solid border-black rounded p-1">
                        <div class="w-full text-center">
                            <label class="font-bold">Evaluar: </label>
                        </div>
                        <div class="w-full">
                            <SelectRango class="w-2/5 sm:w-1/4 md:w-3/4 text-center" :limite="11" @emision="(e) => form.notaEvaluacion = e" >Nota
                            </SelectRango>
                        </div>
                        <div class="w-full text-center">
                            <p class="text-yellow-300 w-2/5 sm:w-1/4 md:w-3/4 text-center m-auto" >{{$page.props.errors['evaluacion']}}</p>
                        </div>
                        <div class="w-full text-center">
                            <Link
                                as="button" method="post"
                                :href="route('evaluar')"
                                :data="{ user_id: $page.props.auth.user['id'], obra_id: obra[0]['id'], evaluacion: form.notaEvaluacion }"
                                class="w-2/5 sm:w-1/4 md:w-3/4 text-black bg-white hover:text-white hover:bg-black focus:bg-flamingo focus:ring-flamingo focus:border-flamingo focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 my-2 text-center" preserveScroll>
                                Evaluar {{ obra[0]['titulo'] }} &rarr;
                            </Link>
                        </div>
                    </div>
                    <!-- Formulario críticas -->
                    <div class="col-span-1 md:col-span-9 lg:col-span-10 border border-[2px] border-solid border-black rounded p-1 lg:ml-1 flex justify-center flex-wrap">
                        <label class="w-full text-center font-bold">Reseña {{obra[0]['titulo']}} <span :class="[form.critica.length > 5000 ? 'text-yellow-300  font-extrabold' : 'text-black']">({{ form.critica.length }}/5000 caracteres){{form.critica.length > 5000 ? ' Máximo de caracteres sobrepasado' : ''}}</span></label>
                        <form class="w-11/12">
                            <textarea class="w-full h-[200px] m-1" v-model="form.critica"></textarea>
                        </form>
                        <InputError class="mt-2" :message="form.errors.critica"/>
                        <Button class="w-2/5 text-black bg-white hover:text-white hover:bg-black focus:bg-flamingo focus:ring-flamingo focus:border-flamingo focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 my-2 text-center">Reseñar {{obra[0]['titulo']}} &rarr;</Button>
                    </div>
                </div>
                <div v-else class="grid grid-cols-1 md:grid-cols-12 lg:grid-cols-12 p-1">
                    PARA PODER EVALUAR O PONER NOTAS TIENES QUE ESTAR LOGUEADO/REGISTRADO
                </div>
            </div>
        </div>

    </div>
</template>

