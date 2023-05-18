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
    console.log('HOLAAAAAAAAAAAAAAA');
    form.post(route('verification.send'));
    console.log('222222222222222222');
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<!--<template>
    <Head>
        <title>Verificación de email</title>
        <meta name="description" content="Página de verificación de email">
    </Head>

    <div class="mb-4 text-sm text-gray-600">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
        we just emailed to you? If you didn't receive the email, we will gladly send you another.
    </div>

    <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
        A new verification link has been sent to the email address you provided during registration.
    </div>

    <form @submit.prevent="submit">
        <div class="mt-4 flex items-center justify-between">
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            <PrimaryButton :class="{ 'opacity-25': form.processing }">
                Reenviar verification de email
            </PrimaryButton>

            <Link
                :href="route('logout')"
                method="post"
                as="button"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >Log Out
            </Link
            >
        </div>
    </form>
</template>-->

<template>
    <Head>
        <title>Verificación de email</title>
        <meta name="description" content="Página de verificación de email">
    </Head>
    <section class="bg-cover bg-[url('images/posters-fondo.png')]">
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
                        ¡Gracias por registrarte en nuestra web! Antes de empezar, ¿podrías verificar su correo electónico haciendo clic en el enlace? Si no recibiste ningún correo electrónico, con gusto le enviaremos otro.
                    </h3>
                    <form @submit.prevent="submit">
                        <div class="mt-4 flex items-center justify-between">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Reenviar correo
                            </PrimaryButton>

                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >Cerrar sesión
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
