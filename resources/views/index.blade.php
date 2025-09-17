<!DOCTYPE html>
<html lang="es" class="h-full bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#3F51B5" class="mx-auto h-14 w-14">
      <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
    </svg>
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white">Iniciar Sesión</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form action="{{ route('login.perform') }}" method="POST" class="space-y-6">
      @csrf
      
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-100">Correo electrónico</label>
        <div class="mt-2">
          <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6 @error('email') ring-2 ring-red-500 @enderror" />
          @error('email')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-100">Contraseña</label>
        </div>
        <div class="mt-2">
          <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6 @error('password') ring-2 ring-red-500 @enderror" />
          @error('password')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>
      </div>

      {{-- Errores generales --}}
      @if($errors->any())
          <div class="p-3 rounded-md bg-red-500/10 border border-red-500/20">
              @foreach($errors->all() as $err)
                  <div class="text-sm text-red-400">• {{ $err }}</div>
              @endforeach
          </div>
      @endif

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Entrar</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>
