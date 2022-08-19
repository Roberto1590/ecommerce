@extends('auth.admin.base')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <style>
        .swal2-popup,
        .swal2-modal,
        .swal2-show {
            z-index: 3000;
        }
    </style>
@endpush
@section('content')
    @if (session()->has('msgSuccess'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <span class="text-success">
                {{ session()->get('msgSuccess') }}
            </span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3 page-titles">

        <div class="welcome-text">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Gerenciamento /</span> Usuários
            </h4>
        </div>
        <div>
            {{-- <button type="button" id="atualizaTable" class="btn btn-primary" style="margin-right: 20px;">
                <i class='bx bx-refresh'></i>&nbsp; Atualizar
            </button> --}}

            <a href="{{ route('auth.index.dashboard.gerenciamento.usuarios.inserir') }}">
                {{-- <button type="submit" class="btn btn-primary pl-3 pr-3 text-white">Novo</button> --}}
                <button type="button" class="btn btn-primary">
                    <span class="bx bx-message-alt-add"></span>&nbsp; Novo
                </button>
            </a>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive table_usuarios text-nowrap p-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Sexo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($usuario as $usu)
                        <tr data-id="{{ $usu->usuario->id }}">
                            <td>
                                <strong>
                                    {{ $usu->usuario->id }}
                                </strong>
                            </td>
                            <td>
                                {{ $usu->usuario->name }}
                            </td>
                            <td>
                                {{ $usu->usuario->email }}
                            </td>
                            <td>
                                {{ $usu->cpf }}
                            </td>
                            <td>
                                @if ($usu->sexo)
                                    <span class="badge bg-label-info me-1">Masculino</span>
                                @else
                                    <span class="badge bg-label-danger me-1">Feminino</span>
                                @endif
                            </td>
                            <td class="d-flex gap-3">
                                <a
                                    href="{{ route('auth.index.dashboard.gerenciamento.usuarios.atualizar') }}?id={{ $usu->usuario->id }}">
                                    <i class='bx bx-edit fs-4 text-gray'></i>
                                </a>
                                <form id="formDelete"
                                    action="{{ route('auth.delete.dashboard.gerenciamento.usuarios') }}?id={{ $usu->usuario->id }}"
                                    method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="button" class="btn p-0 btnremove">
                                        <i class='bx bx-trash fs-4'></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3 page-titles">
        <div class="col-sm-6 p-md-0">
        </div>
        {{-- <button type="submit" data-bs-toggle="modal" data-bs-target="#arquivadoModal"
            class="btn btn-primary pl-3 pr-3 text-white ">Arquivados</button> --}}
        <button type="button" data-bs-toggle="modal" data-bs-target="#arquivadoModal" class="btn btn-primary mt-3">
            <i class='bx bx-archive'></i>&nbsp; Arquivados
        </button>
    </div>

    <div class="modal fade" data-backdrop="satic" id="arquivadoModal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Arquivados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="tableArquivados" class="table table-hover" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuariosDeletado as $usu)
                                <tr data-id="{{ $usu->id }}">
                                    <td>
                                        <strong>
                                            {{ $usu->id }}
                                        </strong>
                                    </td>
                                    <td>
                                        {{ $usu->name }}
                                    </td>
                                    <td>
                                        {{ $usu->email }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <form id="formRestore"
                                                action="{{ route('auth.restore.dashboard.gerenciamento.usuarios') }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" value="{{ $usu->id }}" name="id">
                                                <button type="button" class="btn btnarquivado">
                                                    <i class='bx bx-reset fs-4'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('assets/vendor/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script>
        $('.table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
            }
        });

        $('.btnarquivado').on('click', function() {
            let formRestore = $('#formRestore'); // Form de Delete
            const Url = window.location.origin;
            // Capturando ID e passando para URL
            const id = $(this).parents('tr').data('id');
            // alert(id)
            Swal.fire({
                title: 'Deseja Restaurar?',
                position: 'top',
                showCancelButton: true,
                confirmButtonColor: '#4085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, restaurar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.value) {
                    formRestore.action =
                        "{{ route('auth.restore.dashboard.gerenciamento.usuarios') }}?id=" +
                        id; // Passando URL para action do form
                    formRestore.submit();
                }
            })
        });

        $(".btnremove").on("click", function() {
            let formDelete = $('#formDelete'); // Form de Delete
            const Url = window.location.origin;
            // Capturando ID e passando para URL
            const id = $(this).parents('tr').data('id');
            // alert(id)
            const routeDelete =
                "{{ route('auth.delete.dashboard.gerenciamento.usuarios') }}?id=" + id;
            Swal.fire({
                title: 'Deseja Deletar?',
                position: 'top',
                showCancelButton: true,
                confirmButtonColor: '#4085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.value) {
                    formDelete.action = "{{ route('auth.delete.dashboard.gerenciamento.usuarios') }}?id=" +
                        id; // Passando URL para action do form
                    formDelete.submit();
                }
            })
        });
    </script>
@endpush
