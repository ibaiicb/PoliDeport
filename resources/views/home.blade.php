@extends('layouts.welcome')

@section('content')
    @if(session('success'))
        <script>
            $(window).on('load', function() {
                toastr.success("El usuario ha sido modificado y guardado correctamente.", "Usuario modificado", {closeButton: 'true', positionClass: 'toast-bottom-left', preventDuplicates: 'true', showMethod: 'slideDown', hideMethod: 'slideUp', timeOut: 2500});
            });
        </script>
    @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if(Auth::user()->roles()->first()->name === 'Super Admin' || Auth::user()->roles()->first()->name === 'Admin')
                        {{ __('User List') }}
                    @else
                        {{ __('Prueba') }}
                    @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="flex flex-row-reverse mb-3">
                        @can('create admin')
                            <form method="GET" action="{{ route('show.create.user', ['role' => 'admin']) }}">
                                <button type="submit" class="button-create">{{ __('Create Admin') }}</button>
                            </form>
                        @endcan
                        @can('create client')
                            <form method="GET" action="{{ route('show.create.user', ['role' => 'client']) }}">
                                <button type="submit" class="button-create">{{ __('Create Client') }}</button>
                            </form>
                        @endcan
                    </div>
                    @can('read client')
                        <table class="table table-responsive table-striped table-hover">
                            <thead>
                                <tr>
                                    <td>{{ __('Name') }}</td>
                                    <td>{{ __('UserName') }}</td>
                                    <td>{{ __('Address') }}</td>
                                    <td>{{ __('Email') }}</td>
                                    <td>{{ __('Actions') }}</td>
                                    <td>{{ __('Role') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <form method="POST">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->roles()->first()->name }}</td>
                                            <td>
                                                <div class="actions">
                                                    @if($user->roles()->first()->name === 'Client')
                                                        @if($user->trashed() == '1')
                                                            @can('restore client')
                                                                <div class="restore-user">
                                                                    <button type="button" onclick="showAlertRestore({{ $user }})"><i class="fa-solid fa-user-plus"></i></button>
                                                                </div>
                                                            @endcan
                                                            @can('delete client')
                                                                <div class="delete-user">
                                                                    <button type="button" onclick="showAlertDelete({{ $user }})"><i class="fa-solid fa-user-minus"></i></button>
                                                                </div>
                                                            @endcan
                                                        @else
                                                            @can('show client')
                                                                <div class="show-user">
                                                                    <a href="{{ route('show.user', ['id' => $user->id]) }}"><i class="fa-solid fa-eye"></i></a>
                                                                </div>
                                                            @endcan
                                                            @can('soft-delete client')
                                                                <div class="soft-delete-user">
                                                                    <button type="button" onclick="showAlertSoftDelete({{ $user }})"><i class="fa-solid fa-trash-can"></i></button>
                                                                </div>
                                                            @endcan
                                                        @endif
                                                    @elseif($user->roles()->first()->name === 'Admin')
                                                        @if($user->trashed() == '1')
                                                            @can('restore admin')
                                                                <div class="restore-user">
                                                                    <button type="button" onclick="showAlertRestore({{ $user }})"><i class="fa-solid fa-user-plus"></i></button>
                                                                </div>
                                                            @endcan
                                                            @can('delete admin')
                                                                <div class="delete-user">
                                                                    <button type="button" onclick="showAlertDelete({{ $user }})"><i class="fa-solid fa-user-minus"></i></button>
                                                                </div>
                                                            @endcan
                                                        @else
                                                            @can('show admin')
                                                                <div class="show-user">
                                                                    <a href="{{ route('show.user', ['id' => $user->id]) }}"><i class="fa-solid fa-eye"></i></a>
                                                                </div>
                                                            @endcan
                                                            @can('update admin')
                                                                <div class="update-user">
                                                                    <a href="{{ route('show.update.user', ['id' => $user->id]) }}"><i class="fa-solid fa-user-pen"></i></a>
                                                                </div>
                                                            @endcan
                                                            @can('soft-delete admin')
                                                                <div class="soft-delete-user">
                                                                    <button type="button" onclick="showAlertSoftDelete({{ $user }})"><i class="fa-solid fa-trash-can"></i></button>
                                                                </div>
                                                            @endcan
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endcan
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('homeViewScripts')
    <script>
        function showAlertSoftDelete(user) {
            Swal.fire({
                title: '¿Seguro que quieres dar de baja al usuario: '+user['username']+'?',
                text: 'Sólo el Super Administrador podrá deshacer los cambios',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Seguro'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    let idUser = user['id'];

                    $.ajax({
                        url:'/softdelete/user',
                        data:{id: idUser},
                        type:'POST',
                        success: function (response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        },
                        error:function(x,xs,xt){
                            //nos dara el error si es que hay alguno
                            window.open(JSON.stringify(x));
                            console.log(xs);
                            console.log(xt);
                            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                        }
                    });
                }
            });
        }

        function showAlertDelete(user) {
            Swal.fire({
                title: '¿Seguro que quieres eliminar al usuario: '+user['username']+'?',
                text: 'No habrá vuelta atrás',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Seguro'
            }).then((result) => {
                if (result.isConfirmed) {
                    alert('se manda ajax con datos');
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            });
        }

        function showAlertRestore(user) {
            Swal.fire({
                title: '¿Seguro que quieres restaurar al usuario: '+user['username']+'?',
                text: 'El usuario será dado de alta',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Seguro'
            }).then((result) => {
                if (result.isConfirmed) {
                    alert('se manda ajax con datos');
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            });
        }
    </script>
@endpush
