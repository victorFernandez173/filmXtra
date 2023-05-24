<!--select titulo, ruta, alt, avg(evaluacion) nota_media from obras o join posters p on o.id = p.obra_id left join evaluaciones e on o.id = e.obra_id group by titulo, ruta, alt order by nota_media desc, titulo;-->
<!--$obras = Obra::with('poster')->where(
'pais', 'like', '%' . $pais . '%')->whereBetween('fecha', [$d, $h])->whereHas('generos', function (Builder $query) use ($genero) {
$query->where('genero', 'like', '%' . $genero . '%');
})->paginate(12)->withQueryString();-->
<!--
$obras = Obra::select('obras.titulo', 'p.ruta', 'p.alt', DB::raw('AVG(e.evaluacion) AS nota_media'))->join('posters AS p', 'obras.id', '=', 'p.obra_id')->leftJoin('evaluaciones AS e', 'obras.id', '=', 'e.obra_id')->where(
'obras.pais', 'LIKE', '%' . $pais . '%')->whereBetween('obras.fecha', [$d, $h])->whereHas('generos', function (Builder $query) use ($genero) {
$query->where('genero', 'like', '%' . $genero . '%');
})->groupBy('obras.titulo', 'p.ruta', 'p.alt')->orderBy('nota_media', 'desc')->orderBy('obras.titulo')->paginate(12)->withQueryString();-->










<!-- ESTILO NORMAL POR SI PRESCINDIMOS DE USAR COMPONENTE POSTER EN SECUELAS
        <div class="flex text-center">
            <span v-for="secuela in secuelaPrecuela">
                <span>{{ secuela['secuela']['orden'] > obra[0]['secuela']['orden'] ? 'Secuela' : 'Precuela' }}</span>
                 <Link :href="route('obra', encodeURIComponent(secuela['titulo']))">
                     <img class="border-solid border-3 border-white hover:border-3 hover:border-flamingo hover:border-solid w-[200px] m-auto" :src="'../posters/' + secuela['poster']['ruta']" :alt="secuela.poster.alt">
                 </Link>
            </span>
        </div> -->













<!--/**
    *VALIDACIÓN IN SITU DEL REGISTRO
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nombre' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }-->













<!--FORMULARIO FILTRADO SIN SFC

<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    genero: '',
    pais: '',
    desde: '',
    hasta: '',
});

const submit = () => {
    form.get(route('obras'), {preserveState : true});
};

const props = defineProps({
    generos: Object,
    paises: Object,
    pionera: Object
})

const pionera = parseInt((new Date().getFullYear()).toString()) - parseInt(props.pionera[0]['fecha']) + 1;

const annoActual = (new Date().getFullYear() + 1);
</script>

<template>
    <form @submit.prevent="submit" class="m-auto flex border-solid border-flamingo border-3 p-[5px] w-4.5/5">

<div class="m-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 hover:[&>div>select]:cursor-pointer">
    <div class="m-auto w-11/12 py-[10px] px-0">
        <select name="genero" v-model="form.genero" class="bg-gray-50 border border-gray-300 text-gray-900 text-base focus:ring-red-400 focus:border-red-400 block w-full p-2.5">
            <option disabled value="">Género</option>
            <option v-for="genero in generos">{{ genero['genero']}}</option>
        </select>
    </div>

    <div class="m-auto w-11/12 py-[10px] px-0">
        <select name="pais" id="idPais" v-model="form.pais" class="bg-gray-50 border border-gray-300 text-gray-900 text-base focus:ring-red-400 focus:border-red-400 block w-full p-2.5">
            <option disabled value="">País</option>
            <option v-for="pais in paises">{{ pais['pais']}}</option>
        </select>
    </div>

    <div class="m-auto w-11/12 py-[10px] px-0">
        <select name="desde" id="idDesde" v-model="form.desde" class="bg-gray-50 border border-gray-300 text-gray-900 text-base focus:ring-red-400 focus:border-red-400 block w-full p-2.5">
            <option disabled value="">Desde</option>
            <option v-for="n in pionera">{{ annoActual - n }}</option>
        </select>
    </div>
    <div class="m-auto w-11/12 py-[10px] px-0">
        <select name="hasta" id="idHasta" v-model="form.hasta" class="bg-gray-50 border border-gray-300 text-gray-900 text-base focus:ring-red-400 focus:border-red-400 block w-full p-2.5">
            <option disabled value="">Hasta</option>
            <option v-for="n in pionera">{{ annoActual - n }}</option>
        </select>
    </div>
    <div class="m-auto w-11/12 py-[10px] px-0 flex justify-between md:col-span-2 lg:col-span-1">
        <div class="w-[48%]">
            <PrimaryButton :disabled="form.processing" :class="{ 'opacity-25': form.processing }">FILTRA</PrimaryButton>
        </div>
        <div class="w-[48%] flex m-auto">
            <Link class="w-full m-auto text-white bg-flamingo hover:text-black focus:bg-flamingo focus:ring-flamingo focus:border-flamingo focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center"  :href="route('obras')">RESET</Link>
        </div>
    </div>
</div>
</form>-->
