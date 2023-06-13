<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- $request->validate([
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required', 'string', ,'min:2', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'username' => $request->username,
            'role_id' => 1,
            'password' => Hash::make($request->password),
        ]); -->
<!--icon retour-->
<a href="{{ route('loginChoice')}}">
                <svg class="iconRetour" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M20.25 12a.75.75 0 01-.75.75H6.31l5.47 5.47a.75.75 0 11-1.06 1.06l-6.75-6.75a.75.75 0 010-1.06l6.75-6.75a.75.75 0 111.06 1.06l-5.47 5.47H19.5a.75.75 0 01.75.75z" clip-rule="evenodd" />
                </svg>
                </a>

                <div class="pageMilieu">
<!-- logo-->

<div id="creationCompte">


        <img src="{{ asset('storage/images/logoCouleur3.svg') }}" style="width: 95px; 
        height: 147px" alt="logoCouleur3" class="logoCouleur3">
         </div>

        <!-- pseudo -->
        <div>
            <x-text-input id="username" class="block mt-1 w-full input-box-lucie" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="Pseudo" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- last_name -->
        <div class="name-input">
            <x-text-input id="last_name" class="block mt-1 w-full w-87 input-box-lucie" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" placeholder="Nom"/>
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- first_name -->
        <div class ="name-input">
            <x-text-input id="first_name" class="block mt-1 w-full w-87 input-box-lucie" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" placeholder="Prénom" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-text-input id="email" class="block mt-1 w-full input-box-lucie" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Adresse e-mail"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-text-input id="password" class="block mt-1 w-full input-box-lucie"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="Mot de passe" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-text-input id="password_confirmation" class="block mt-1 w-full input-box-lucie"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirmez le mot de passe" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="pageMilieu" id="boutonCreationCompte">
        <x-primary-button class="button-action" >
                            {{ __('Suivant') }}
                        </x-primary-button>
        </div>
               

    </form>

</div>

</x-guest-layout>