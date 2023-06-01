<script setup>
defineProps(['obra']);
</script>

<template>
        <!--Trailer-->
        <div v-if="obra[0]['trailer']" class="mt-16 flex justify-center flex-wrap ">
            <!-- Titulo de la seccion -->
            <h3 class="w-full text-center text-flamingo font-bold underline text-2xl mb-4">Trailer de {{ obra[0]['titulo'] }}</h3>
            <iframe
                class="w-[100vw] h-auto aspect-video"
                :src="obra[0]['trailer']['trailers']"
                    title="YouTube video player"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
        </div>
</template>
