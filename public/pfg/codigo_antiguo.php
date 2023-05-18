<!-- ESTILO NORMAL POR SI PRESCINDIMOS DE USAR COMPONENTE POSTER
        <div class="flex text-center">
            <span v-for="secuela in secuelaPrecuela">
                <span>{{ secuela['secuela']['orden'] > obra[0]['secuela']['orden'] ? 'Secuela' : 'Precuela' }}</span>
                 <Link :href="route('obra', encodeURIComponent(secuela['titulo']))">
                     <img class="border-solid border-3 border-white hover:border-3 hover:border-flamingo hover:border-solid w-[200px] m-auto" :src="'../posters/' + secuela['poster']['ruta']" :alt="secuela.poster.alt">
                 </Link>
            </span>
        </div> -->



<!--/**
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
