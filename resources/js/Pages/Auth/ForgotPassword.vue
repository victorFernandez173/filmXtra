<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head>
        <title>Password olvidado</title>
        <meta name="description" content="Página de password olvidado">
    </Head>
    <section class="h-[100vh] bg-cover bg-[url('/images/posters-fondo.png')]">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <Link :href="route('/')" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <img class="w-60 mr-2" src="/images/logo-blanco.png" alt="Logo FlimXtra">
            </Link>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-xl">
                        ¿Has olvidado tu contraseña?
                    </h1>
                    <h3 class="text-xl font-normal leading-tight tracking-tight text-gray-900 md:text-lg">
                        Introduce tu email y te enviaremos un link para reiniciar la contraseña.
                    </h3>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                        <div>
                            <InputLabel for="email" value="Correo electrónico" class="block mb-2 text-sm font-medium text-gray-900" />
                            <TextInput
                                id="email"
                                type="email"
                                placeholder="nombre@correo.com"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-flamingo focus:border-flamingo block w-full p-2.5"
                                v-model="form.email"
                                autofocus
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.email"/>
                        </div>
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Enviar email
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
