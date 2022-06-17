@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card users-list-card">
                    <div class="card-header">
                        {{ __('User List') }}
                    </div>
                    <div class="card-body">
                        <div class="dt-buttons">
                            <a href="{{ route('generate.users.pdf') }}" class='btn btn-primary'><i class='fa-solid fa-download'></i> {{__('Export to PDF')}}</a>
                        </div>
                        {{ $dataTable->table(['class' => 'table table-responsive table-striped table-hover text-center']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <input type="hidden" id="session" value="{{ session('success') }}" />
    @endif
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush

@push('alertScripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
                        url:'{{ route('softdelete.user') }}',
                        data:{id: idUser},
                        type:'DELETE',
                        success: function (response) {
                            $('#users-table').DataTable().draw();
                            showToast('{{ __('Successfully unsubscribed user') }}');
                        },
                    })
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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    let idUser = user['id'];

                    $.ajax({
                        url: '{{ route('delete.user') }}',
                        data: {id: idUser},
                        type: 'DELETE',
                        success: function (response) {
                            $('#users-table').DataTable().draw();
                            showToast('{{ __('User deleted successfully') }}');
                        },
                    });
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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    let idUser = user['id'];

                    $.ajax({
                        url: '{{ route('restore.user') }}',
                        data: {id: idUser},
                        type: 'POST',
                        success: function (response) {
                            $('#users-table').DataTable().draw();
                            showToast('{{ __('User restored successfully') }}');
                        },
                    });
                }
            });
        }

        function showToast(message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-start',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            });

            Toast.fire({
                icon: 'success',
                title: message
            });
        }

        if (document.getElementById('session').value.trim() !== '') {
            showToast(document.getElementById('session').value.trim());
        }
    </script>
@endpush
