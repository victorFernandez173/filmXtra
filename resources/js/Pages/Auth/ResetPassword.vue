<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, useForm, Link} from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head>
        <title>Resetear password</title>
        <meta name="description" content="Página para resetear password">
    </Head>

    <section class="h-[100vh] bg-cover bg-[url('/images/posters-fondo.png')]">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <Link :href="route('/')" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <img class="w-60 mr-2" src="/images/logo-blanco.png" alt="Logo FlimXtra">
            </Link>
            <div class="w-full p-6 bg-white rounded-lg shadow md:mt-0 sm:max-w-md sm:p-8">
                <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Cambiar contraseña
                </h2>
                <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo electrónico</InputLabel>
                        <TextInput id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-flamingo focus:border-flamingo block w-full p-2.5" placeholder="nombre@correo.com" v-model="form.email" />
                        <InputError class="mt-2" :message="form.errors.email"/>
                    </div>
                    <div>
                        <InputLabel for="password" class="block mb-2 text-sm font-medium text-gray-900">Nueva contraseña</InputLabel>
                        <TextInput type="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-flamingo focus:border-flamingo block w-full p-2.5"  v-model="form.password" />
                        <InputError class="mt-2" :message="form.errors.password"/>
                    </div>
                    <div>
                        <InputLabel for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Confirmar nueva contraseña</InputLabel>
                        <TextInput type="confirm-password"  id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-flamingo focus:border-flamingo block w-full p-2.5" v-model="form.password_confirmation" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                    </div>
                    <div>
                        <PrimaryButton type="submit" class="w-full text-white bg-flamingo hover:text-black focus:bg-flamingo focus:ring-flamingo focus:border-flamingo focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">Resetear contraseña</PrimaryButton>
                    </div>
                    <p class="text-sm font-light text-gray-500">
                        ¿Ya tienes cuenta?
                        <Link :href="route('login')" class="font-medium text-primary-600 hover:underline">¡Inicia sesión aquí!</Link>
                    </p>
                </form>
            </div>
        </div>
    </section>
</template>
