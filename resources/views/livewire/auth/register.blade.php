<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $role = '';
    public string $instruments = '';
    public string $bio = '';
    public bool $is_producer = false;
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['nullable', 'string', 'max:255'],
            'instruments' => ['nullable', 'string', 'max:1000'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'is_producer' => ['boolean'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Full name')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Papel do usuário -->
        <flux:input
            wire:model="role"
            :label="__('Qual é o seu papel? (músico, produtor, etc.)')"
            type="text"
            placeholder="Músico, produtor, beatmaker..."
        />

        <!-- Instrumentos -->
        <flux:input
            wire:model="instruments"
            :label="__('Instrumentos que você toca')"
            type="text"
            placeholder="Guitarra, teclado, bateria..."
        />

        <!-- Descrição pessoal -->
        <flux:textarea
            wire:model="bio"
            :label="__('Sobre você')"
            placeholder="Fale um pouco sobre sua carreira ou estilo..."
        />

        <!-- É produtor? -->
        <div class="flex items-center gap-2 mt-2">
            <input type="checkbox" wire:model="is_producer" id="is_producer"
                   class="rounded text-blue-600 dark:bg-zinc-800 dark:border-zinc-700">
            <label for="is_producer" class="text-sm text-zinc-700 dark:text-zinc-300">
                Sou produtor musical
            </label>
        </div>

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password')"
            viewable
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirm password')"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
