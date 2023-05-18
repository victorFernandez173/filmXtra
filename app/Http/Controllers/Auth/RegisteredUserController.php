<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Middleware;
use Inertia\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        error_log('VOY A MOSTRAR REGISTER');
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse | Response
    {

        // [Middleware::class, 'auth', 'verified'];
        //[EmailVerificationPromptController::class, '__invoke'];
        //Redirect::guest(URL::route('verification.notice'));
        //URL::route('verification.notice');

        error_log('11111111111' . $request['email']);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        error_log('22222222222'.$request);
        /*event(new Registered($request));*/
        /*$request->sendEmailVerificationNotification();*/

        /*$user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);*/

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => Hash::make($request->password)
        ]);

        // $validated = $request->validated();

        /*$user = User::create([
            'nombre' => $validated->nombre,
            'email' => $validated->email,
            'password' => Hash::make($validated->password),
        ]);*/
        
        event(new Registered($user)); //Registered es un evento que tiene un escuchador asociado

        error_log('EEEEEEEEEEEEEEEEEEEEE');
        Auth::login($user);

        /*->middleware('auth', 'verified')

        return redirect(RouteServiceProvider::HOME);*/

        /*return Inertia::render('Auth/VerifyEmail', [
            'status' => session('status'),
            'user' => $user,
        ]);*/
        return redirect('verify-email');
        /*return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);*/
    }
}
