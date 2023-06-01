<!--script independiente sin "setup" para la carga del LayoutPrincipal como layout persistente-->
<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";

export default {
    layout: LayoutPrincipal,
}
</script>

<!--script estandar para lo habitual-->
<script setup>
import {Head} from "@inertiajs/vue3";
import BarraLateral from "../Components/BarraLateral.vue";
import FormularioFiltrado from "../Components/FormularioFiltrado.vue";
import Paginacion from "../Components/Paginacion.vue";
import Poster from "../Components/Poster.vue";

defineProps(['obras', 'titulo', 'filtros']);
</script>

<template>
    <Head>
        <title>Top FilmXtra</title>
        <meta name="filter" content="Página top filmXtra">
    </Head>
    <div class="flex flex-wrap">
        <!-- Barra lateral -->
        <div class="w-[20vw] md:w-[13vw] lg:w-[10vw]">
            <BarraLateral/>
        </div>
        <!-- Contenido -->
        <div class="mx-auto w-[76vw] md:w-[83vw] lg:w-[83vw]">
                <!-- Título -->
                <h1 class="w-full mt-2 font-oswald text-center text-5xl h-[10vh] text-flamingo">Top FilmXtra</h1>
                <!-- Formulario de filtrado -->
                <FormularioFiltrado :paises="$page['props']['paises']" :generos="$page['props']['generos']"
                                    :pionera="$page['props']['pionera']"  />
                <!-- Mensaje de filtrado condicionado en funcion de parámetros del formulario -->
                <p v-if="(filtros[0] !== '' || filtros[1] !== '' || filtros[2] !== '' || filtros[3] !== '')" class="w-full text-center mt-1">Filtros: &nbsp;
                    <!-- Si hay genero (filtros[0])... -->
                    {{ filtros[0] === '' ? '' : `género: ${filtros[0]}`  }}
                    <!--se añade coma, y así sucesivamente ... -->
                    {{(filtros[0] !== '' && filtros[1] !== '') ? ', &nbsp;' : ''}}
                    {{ filtros[1] === '' ? '' : ` país: ${filtros[1]}`   }}
                    {{(filtros[1] !== '' && filtros[2] !== '') ? ', &nbsp;' : ''}}
                    {{ filtros[2] === '' ? '' : ` desde: ${filtros[2]}`  }}
                    {{(filtros[3] !== '' && filtros[4] !== '') ? ', &nbsp;' : ''}}
                    {{ filtros[3] === '' ? '' : ` hasta: ${filtros[3]}`  }}
                    {{ filtros[0] !== null ?  '.' : '' }}
                </p>
                <div v-else class="w-full text-center"><p>Sin filtros</p></div>
                <!-- Seccion Principal de contenido -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 seccion-peliculas text-center w-full justify-items-center pl-8 pr-8 mt-8">
                    <!-- Cada poster es un componente -->
                    <Poster v-for="obra in obras.data" :key="obra['id']" :obra="obra" :titulo="`text-2xl hover:text-xl`" :info="true"/>
                </div>
                <!-- Componente para la paginación -->
                <div class="w-full flex mt-8 mb-2">
                    <Paginacion class="mx-auto" :obras="obras"/>
                </div>
            </div>
    </div>
</template>
