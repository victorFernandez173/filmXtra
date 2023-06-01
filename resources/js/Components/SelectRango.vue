<script setup>
import {ref} from "vue";
const emit = defineEmits(['emision']);

const valorSelect = ref(props.valor);
emit('emision', valorSelect);

const props = defineProps({
    limite : Number,
    valor : String
});
</script>

<template>
    <div class="m-auto w-11/12 py-[10px] px-0">
        <select v-model="valorSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-base focus:ring-red-400 focus:border-red-400 block w-full p-2.5">
            <option disabled>{{valor}}</option>
            <option v-for="n in limite">{{ limite - n }}</option>
        </select>
    </div>
</template>

