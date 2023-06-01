<script setup>
import {computed} from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head>
        <title>Verificación de email</title>
        <meta name="description" content="Página de verificación de email">
    </Head>
    <section class="h-[100vh] bg-cover bg-[url('/images/posters-fondo.png')]">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <Link :href="route('/')" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <img class="w-60 mr-2" src="/images/logo-blanco.png" alt="Logo FlimXtra">
            </Link>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Verifica tu email
                    </h1>
                    <h3 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        ¡Gracias por registrarte en FilmXtra! Revisa tu correo y acepta nuestras condiciones para verificar tu cuenta. Si no recibiste ningún correo, haz click en el botón de abajo y te enviaremos otro.
                    </h3>
                    <h3 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-xl" v-if="verificationLinkSent">
                        Un nuevo email de verificación ha sido enviado a la dirección que usaste en el registro.
                    </h3>
                    <form @submit.prevent="submit">
                        <div class="mt-4 flex items-center justify-between">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Reenviar correo
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
