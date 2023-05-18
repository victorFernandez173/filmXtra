<script setup>
import cabecera from './Header.vue';

import peliculas from './Peliculas.vue';
import valoraciones from './Valoraciones.vue';
import pieDePagina from './Footer.vue';
import contacto from './Contacto.vue';
import cuenta from './Cuenta.vue';

</script>

<script>
export default {

    name: 'Principal',
    components: {
        peliculas,
        valoraciones,
        contacto,
        cuenta
    },
    data () {
        return {
            seleccionado: 'noHaCambiado',
            elegido: 'peliculas'
        };
    },
    methods: {
        componentePinchado(value) {
            this.elegido = value;
        }
    }
}
</script>

<template>
    <body>
        <cabecera :links="['Inicio', 'Películas', 'Valoraciones', 'Contacto', 'Cuenta']" @click="pinchar(e)" />
        <!-- <div class="flex justify-between">
            <a @click="componentePinchado('peliculas')" >Peliculas</a>
            <a @click="componentePinchado('valoraciones')" >Valoraciones</a>
            <a @click="componentePinchado('contacto')" >Contacto</a>
            <a @click="componentePinchado('cuenta')" >Cuenta</a>
        </div> -->
        <hr class="border-black">
        <div class="flex">
            <p class="w-40 h-96 bg-lime-500">BARRA LATERAL</p>
            <!-- <peliculas v-if=" seleccionado === 'peliculas'" />
            <valoraciones v-else-if=" seleccionado === 'valoraciones'" />
            <contacto v-else-if=" seleccionado === 'contacto'" />
            <cuenta v-else-if=" seleccionado === 'cuenta'" />
            <input v-model="seleccionado" /> -->
            <keep-alive>
                <component class="w-full h-96" :is="elegido"></component>
            </keep-alive>
        </div>
        <hr class="border-black">
        <div>
            <pieDePagina/>
        </div>
    </body>
</template>

<style>
</style>
