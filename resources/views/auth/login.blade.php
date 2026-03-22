<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-sm text-accent">{{ session('status') }}</div>
    @endif

    <h2 class="text-xl font-semibold text-text-main mb-6 font-mono">&gt; Connexion</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-text-muted mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="w-full bg-bg-dark border border-gray-700 rounded-lg px-4 py-3 text-text-main placeholder-text-muted focus:outline-none focus:border-accent transition text-sm">
            @error('email')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-text-muted mb-1">Mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full bg-bg-dark border border-gray-700 rounded-lg px-4 py-3 text-text-main placeholder-text-muted focus:outline-none focus:border-accent transition text-sm">
            @error('password')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mb-6">
            <input id="remember_me" type="checkbox" name="remember"
                   class="rounded border-gray-700 bg-bg-dark text-accent focus:ring-accent focus:ring-offset-0">
            <label for="remember_me" class="ms-2 text-sm text-text-muted">Se souvenir de moi</label>
        </div>

        <button type="submit"
                class="w-full bg-accent/10 text-accent border border-accent rounded-lg px-6 py-3 font-mono text-sm hover:bg-accent/20 transition">
            Se connecter
        </button>
    </form>
</x-guest-layout>
