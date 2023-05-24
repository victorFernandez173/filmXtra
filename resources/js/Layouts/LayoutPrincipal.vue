<script setup>
import { Link } from "@inertiajs/vue3";
import {onMounted} from "vue";
import {initFlowbite} from "flowbite";

// Para montar componentes Flowbite
onMounted(() => {
    initFlowbite();
})
</script>

<template>
    <!-- Barra de navegacion -->
    <nav class="bg-white border-gray-200  sticky top-0 z-50">
        <!-- Div con el contenido del nav -->
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <!-- Logo de la pagina -->
            <Link :href="route('/')" class="flex items-center">
                <img src="../imagenes/logo.png" class="h-14" alt="Logo FilmXtra" />
            </Link>
            <div class="flex justify-end md:order-2">
                <button type="button" data-collapse-toggle="navbar-search"  aria-controls="navbar-search" aria-expanded="false" class="lg:hidden text-gray-500  hover:bg-gray-100  focus:outline-none focus:ring-4 focus:ring-gray-200  rounded-lg text-sm p-2.5 mr-1" >
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Buscar</span>
                </button>
                <div id="navbar-search" class="relative hidden lg:block">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Icono buscar</span>
                    </div>
                    <input type="text" id="search-navbar" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Buscar...">
                </div>
            </div>
            <!-- Apartado de usuario -->
            <div class="flex items-center md:order-2">
                <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Abrir menú de usuario</span>
                    <img class="w-8 h-8 rounded-full" src="/favicon.png" alt="Foto del usuario">
                </button>
                <!-- Menu de usuario desplegable -->
                <div class="z-50 hidden  text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900">FilmXtra</span>
                        <span v-if="$page.props.auth.user" class="block text-sm  text-gray-500 truncate">{{ $page.props.auth.user.email }}</span>
                        <span v-else class="block text-sm  text-gray-500 truncate">Logueate</span>
                    </div>
                    <ul v-if="!$page.props.auth.user" class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <Link :href="route('login')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100  ">Loguearse</Link>
                        </li>
                        <li>
                            <Link :href="route('register')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Registrarse</Link>
                        </li>
                    </ul>
                    <ul v-else class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <Link href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mis valoraciones</Link>
                        </li>
                        <li>
                            <Link href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mis favoritas</Link>
                        </li>
                        <li>
                            <Link :href="route('profile.edit')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ajustes</Link>
                        </li>
                        <li>
                            <Link :href="route('logout')" method="post" as="button" class="block px-4 py-2 text-sm text-gray-700"  >Cerrar sesión</Link>
                        </li>
                    </ul>
                </div>
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Abrir menú principal</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Links -->
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 text-center" id="mobile-menu-2">
                <ul class="hover:[&>li>a]:text-flamingo flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <Link :href="route('/')" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0">Inicio</Link>
                    </li>
                    <li>
                        <Link :href="route('top')" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0">Top filmXtra</Link>
                    </li>
                    <li>
                        <Link :href="route('valoraciones')" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0 ">Valoraciones</Link>
                    </li>
                    <li>
                        <Link :href="route('profile.edit')" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0">Cuenta</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <slot>
        <!-- AQUÍ VA EL CONTENIDO QUE SE EL PASA AL LAYOUT    -->
    </slot>

    <!-- Pie de pagina -->
    <footer class="bg-black">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="flex justify-center mb-6 md:mb-0 w-full">
                    <Link :href="route('/')" class="flex items-center">
                        <img class="w-4/5 m-auto" src="/images/logo-blanco.png" alt="Logo FilmXtra" />
                    </Link>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6">
                    <div class="text-center enlaces">
                        <h2 class="mb-6 text-sm font-semibold text-white uppercase">Enlaces</h2>
                        <ul class="flex flex-col justify-around text-gray-600 font-medium hover:[&>li]:text-flamingo hover:[&>li]:no-underline">
                            <li class="mb-4">
                                <Link :href="route('/')">FilmXtra</Link>
                            </li>
                            <li class="mb-4">
                                <Link :href="route('top')">top filmXtra</Link>
                            </li>
                            <li class="mb-4">
                                <Link :href="route('valoraciones')">Valoraciones</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="#">Cuenta</Link>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center contacto">
                        <h2 class="mb-6 text-sm font-semibold text-white uppercase">Contacto</h2>
                        <ul class="text-gray-600 font-medium">
                            <li class="mb-4">
                                <p>
                                    <Link class="hover:text-flamingo" href="mailto:filmxtra.23@gmail.com" target="_blank" rel="noopener noreferrer">filmxtra.23@gmail.com</Link>
                                </p>
                            </li>
                            <li>
                                <p class="px-6">Explora un mundo de emociones y sorpresas en FilmXtra, donde encontrarás una amplia variedad de películas de todo género y época, para que puedas disfrutar de lo mejor del cine y descubrir nuevos títulos que te sorprenderán.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
            <div class="text-center sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 sm:text-center">© 2023 <Link class="hover:text-flamingo" :href="route('/')">FilmXtra<span>™</span></Link>. Todos los derechos reservados.
            </span>
                <div class="hover:[&>a]:text-flamingo flex justify-center mt-4 space-x-6 sm:margin-auto sm:mt-0">
                    <Link href="https://www.facebook.com/" class="text-gray-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        <span class="sr-only">Página de Facebook</span>
                    </Link>
                    <Link href="https://www.instagram.com/" class="text-gray-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                        <span class="sr-only">Página de Instagram</span>
                    </Link>
                    <Link href="https://twitter.com/home" class="text-gray-500 ">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                        <span class="sr-only">Página de Twitter</span>
                    </Link>
                    <Link href="https://github.com/victorFernandez173/filmXtra" class="text-gray-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                        <span class="sr-only">Cuenta de GitHub</span>
                    </Link>
                </div>
            </div>
        </div>
    </footer>
</template>
