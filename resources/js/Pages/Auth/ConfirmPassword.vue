<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head>
        <title>Confirmar password</title>
        <meta name="description" content="Pagina de confirmacion de password">
    </Head>
    <section class="bg-cover bg-[url('/images/posters-fondo.png')]">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <Link :href="route('/')" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <img class="w-60 mr-2" src="/images/logo-blanco.png" alt="Logo FlimXtra">
            </Link>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Confirmación de la contraseña
                    </h1>
                    <h3 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-lg">
                        Área segura. Por favor, confirme su contraseña antes de continuar.
                    </h3>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                        <div>
                            <InputLabel for="password" value="Contraseña" class="block mb-2 text-sm font-medium text-gray-900" />
                            <TextInput
                                id="password"
                                type="password"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-flamingo focus:border-flamingo block w-full p-2.5"
                                v-model="form.password"
                                autocomplete="current-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password"/>
                        </div>
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Confirmar
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
