<script setup>
defineProps(['obra']);
</script>

<template>
    <div class="grid grid-cols-1 pt-10">
        <!--Trailer-->
        <div v-if="obra[0]['trailer']" class="flex justify-center flex-wrap">
            <!-- Titulo de la seccion -->
            <h3 class="w-full">Trailers de {{ obra[0]['titulo'] }}</h3>
            <iframe width="1300" height="600" :src="obra[0]['trailer']['trailers']"
                    title="YouTube video player"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
        </div>
    </div>
</template>
