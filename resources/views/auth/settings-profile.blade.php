<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configuracion de mi Cuenta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-auth-card>
                    <x-slot name="logo">
                        <img src="{{ asset('images/user.png') }}" width="100px" alt="">
                    </x-slot>
            
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
                    <form method="POST" action="{{ route('cambiarContraseña') }}" novalidate>
                        @csrf
            
                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />
            
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ Auth::user()->name }}" autofocus />
                        </div>
                        
                        <!-- RFC -->
                        <div class="mt-4">
                            <x-label for="rfc" :value="__('RFC')" />
            
                            <x-input id="rfc" class="block mt-1 w-full" type="text" name="rfc" value="{{ Auth::user()->rfc }}" />
                        </div>
            
                        <!--Dirección -->
                        <div class="mt-4">
                            <x-label for="direccion" :value="__('Dirección')" />
            
                            <x-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" value="{{ Auth::user()->direccion }}" />
                        </div>

                        <!--Dirección -->
                        <div class="mt-4">
                            <x-label for="telefono" :value="__('Telefono')" />
            
                            <x-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" value="{{ Auth::user()->telefono }}" />
                        </div>

                        <!--Dirección -->
                        <div class="mt-4">
                            <x-label for="website" :value="__('Sitio Web')" />
            
                            <x-input id="website" class="block mt-1 w-full" type="text" name="website" value="{{ Auth::user()->website }}" />
                        </div>
                        
                        <!--Dirección -->
                        <div class="mt-4">
                            <x-label for="passwordActual" :value="__('Contraseña Actual')" />
            
                            <x-input id="passwordActual" class="block mt-1 w-full" type="password" name="passwordActual" />
                        </div>
            
                        <!-- Password -->
                        <div class="mt-4">
                            <x-label for="password" :value="__('Password')" />
            
                            <x-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                         autocomplete="new-password" />
                        </div>
            
                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" />
            
                            <x-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" />
                        </div>
            
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Actualizar Datos') }}
                            </x-button>
                        </div>
                    </form>
                </x-auth-card>
            </div>
        </div>
    </div>
</x-app-layout>
