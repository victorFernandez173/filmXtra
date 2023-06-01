<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectConsulta from "./SelectConsulta.vue";
import {useForm, Link} from '@inertiajs/vue3';
import SelectRangoAnno from "./SelectRangoAnno.vue";

// Formulario
const form = useForm({
    genero: '',
    pais: '',
    desde: '',
    hasta: '',
});

// Entrega del formulario
const submit = () => {
    form.get(route('top'), {preserveState: true});
};

// Props
const props = defineProps({
    generos: Object,
    paises: Object,
    pionera: [Number, Array]
})

const peliPionera = parseInt((new Date().getFullYear()).toString()) - parseInt(props.pionera[0]['fecha']) + 1;

const annoActual = (new Date().getFullYear() + 1);
</script>

<template>
    <form @submit.prevent="submit" class="m-auto flex border-solid border-flamingo border-3 p-[5px] w-4.5/5">
        <div class="m-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 hover:[&>div>select]:cursor-pointer">
            <!-- Selects-->
            <div>
                <SelectConsulta :consulta="generos" :clave="`genero`" @emision="(e) => form.genero = e">Género
                </SelectConsulta>
            </div>
            <div>
                <SelectConsulta :consulta="paises" :clave="`pais`" @emision="(e) => form.pais = e">País
                </SelectConsulta>
            </div>
            <div>
                <SelectRangoAnno :limite-inferior="peliPionera" :limite-superior="annoActual" @emision="(e) => form.desde = e">Desde
                </SelectRangoAnno>
            </div>
            <div>
                <SelectRangoAnno :limite-inferior="peliPionera" :limite-superior="annoActual" @emision="(e) => form.hasta = e">Hasta
                </SelectRangoAnno>
            </div>

            <!-- Botones -->
            <div class="m-auto w-11/12 py-[10px] px-0 flex justify-between md:col-span-2 lg:col-span-1">
                <div class="w-[48%]">
                    <PrimaryButton :disabled="form.processing" :class="{ 'opacity-25': form.processing }">FILTRA
                    </PrimaryButton>
                </div>
                <div class="w-[48%] flex m-auto">
                    <Link
                        class="w-full m-auto text-white bg-flamingo hover:text-black focus:bg-flamingo focus:ring-flamingo focus:border-flamingo focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        :href="route('top')">RESET
                    </Link>
                </div>
            </div>
        </div>
    </form>
</template>
