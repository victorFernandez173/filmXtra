<script setup>
import {ref} from "vue";
const emit = defineEmits(['emision']);

const valorSelect = ref('');
emit('emision', valorSelect);

const props = defineProps({
    limiteInferior : Number,
    limiteSuperior : Number
});
</script>

<template>
    <div class="m-auto w-11/12 py-[10px] px-0">
        <select v-model="valorSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-base focus:ring-red-400 focus:border-red-400 block w-full p-2.5">
            <option disabled value=""><slot></slot></option>
            <option v-for="n in limiteInferior">{{ limiteSuperior - n }}</option>
        </select>
    </div>
</template>

