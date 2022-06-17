@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        {{ __('Update product') }}: {{ $product->name }}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('update.product', ['id' => $product->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <a class="btn btn-secondary" href="{{ route('product.list') }}"><i class="fa-solid fa-reply"></i></a>
                            <input type="hidden" name="id" id="id" value="{{ $product->id }}">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Type of product') }}</label>

                                <div class="col-md-6">
                                    <select id="type" class="form-control form-select @error('type') is-invalid @enderror" name="type" required autocomplete="type" autofocus>
                                        @foreach($types as $type)
                                            @if($type->id === $product->type_id)
                                                <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                            @else
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="stock" class="col-md-4 col-form-label text-md-end">{{ __('Stock') }}</label>

                                <div class="col-md-6">
                                    <input id="stock" type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ $product->stock }}" required autocomplete="stock" autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ $product->description }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-4">
                                    <input type="file" class="form-control" id="product-img">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
