<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card col-md-12">
                <div class="card-body">
                    <form method="POST" action="{{ route('store.usuario') }}" class="row g-3 needs-validation"
                        novalidate>
                        @csrf
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="validationCustom01" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message  }}
                                </div>
                                @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">RFC</label>
                            <input type="text" class="form-control @error('rfc') is-invalid @enderror" name="rfc" id="validationCustom02" value="{{ old('rfc') }}">
                            @error('rfc')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message  }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Dirección</label>
                            <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" id="validationCustom03" value="{{ old('direccion') }}">
                            @error('direccion')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message  }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Telefono</label>
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" id="validationCustom03" value="{{ old('telefono') }}">
                            @error('telefono')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message  }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Sito Web</label>
                            <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" id="validationCustom03" value="{{ old('website') }}">
                            @error('website')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message  }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
