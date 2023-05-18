<script setup>
import {Link} from "@inertiajs/vue3";

defineProps(['obras']);
</script>

<template>
    <div class="mb-2" v-if="obras.links.length > 3">
        <div class="flex flex-wrap">
            <template v-for="(link, p) in obras.links" :key="p">
                <div v-if="link.url === null && !link.active && link.label === 'pagination.previous'" class="mr-1 mb-1 px-4 py-3 leading-4 text-gray-400 rounded"
                     v-html="`<`"/>
                <Link v-else-if="link.label === 'pagination.previous' && link.url"
                      class="mr-1 mb-1 px-4 py-3 leading-4 rounded hover:bg-white text-base hover:border hover:border-flamingo hover:border-solid border border-white border-solid"
                      :class="{ 'text-white': link.active }" :href="link.url" v-html="`<`" preserve-state/>
                <Link v-else-if="link.label === 'pagination.next'"
                      class="mr-1 mb-1 px-4 py-3 leading-4 rounded hover:bg-white text-base hover:border hover:border-flamingo hover:border-solid border border-white border-solid"
                      :class="{ 'text-white': link.active }" :href="link.url" v-html="`>`" preserve-state/>
                <Link v-else
                      class="mr-1 mb-1 px-4 py-3 leading-4 rounded hover:bg-white text-base hover:border hover:border-flamingo hover:border-solid border border-white border-solid"
                      :class="{ 'text-white bg-flamingo border-flamingo border-solid border-1 hover:text-black': link.active }" :href="link.url" v-html="link.label" preserve-state/>
            </template>
        </div>
    </div>
</template>
