<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>


<template>
    <Head>
        <title>Registro</title>
        <meta name="description" content="Página de registro">
    </Head>
    <div class="h-[100vh] bg-cover bg-[url('/images/posters-fondo.png')]">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <Link :href="route('/')" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <img class="w-60 mr-2" src="/images/logo-blanco.png" alt="Logo FlimXtra">
            </Link>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Crear una cuenta
                    </h1>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                        <div class="mt-4">
                            <InputLabel for="name" value="Nombre" class="block mb-2 text-sm font-medium text-gray-900" />
                            <TextInput
                                id="name"
                                type="name"
                                placeholder="Nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-flamingo focus:border-flamingo block w-full p-2.5"
                                v-model="form.name"
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.name"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="Correo electrónico" class="block mb-2 text-sm font-medium text-gray-900" />
                            <TextInput
                                id="email"
                                placeholder="nombre@correo.com"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-flamingo focus:border-flamingo block w-full p-2.5"
                                v-model="form.email"
                            />
                            <InputError class="mt-2" :message="form.errors.email"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password" value="Contraseña" class="block mb-2 text-sm font-medium text-gray-900" />
                            <TextInput
                                id="password"
                                type="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-flamingo focus:border-flamingo block w-full p-2.5"
                                v-model="form.password"
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password_confirmation" value="Confirmar contraseña" class="block mb-2 text-sm font-medium text-gray-900" />
                            <TextInput
                                id="password_confirmation"
                                type="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-flamingo focus:border-flamingo block w-full p-2.5"
                                v-model="form.password_confirmation"
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                        </div>
                        <PrimaryButton class="w-full text-white bg-flamingo hover:text-black focus:bg-flamingo focus:ring-flamingo focus:border-flamingo focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Crear cuenta
                        </PrimaryButton>
                        <p class="text-sm font-light text-gray-500">
                            ¿Ya tienes cuenta? <Link :href="route('login')" class="font-medium text-primary-600 hover:underline">¡Inicia sesión aquí!</Link>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
