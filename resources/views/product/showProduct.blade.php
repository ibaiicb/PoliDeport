@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        {{ __('Show product') }}: {{ $product->name }}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a class="btn btn-secondary" href="{{ url()->previous() }}"><i class="fa-solid fa-reply"></i></a>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" required autocomplete="name" autofocus readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Type of product') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="type" name="type"
                                    @foreach($types as $type)
                                        @if($type->id === $product->type_id)
                                            value="{{ $type->name }}"
                                        @endif
                                   @endforeach
                                autocomplete="type" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="stock" class="col-md-4 col-form-label text-md-end">{{ __('Stock') }}</label>

                            <div class="col-md-6">
                                <input id="stock" type="stock" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ $product->stock }}" required autocomplete="stock" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus readonly>{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-4 product-img-container">
                                <img src="{{ $product->getMedia('product')->last()->getUrl() }}" class="product-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
