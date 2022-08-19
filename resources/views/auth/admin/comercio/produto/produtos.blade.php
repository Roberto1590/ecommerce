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
                <span class="text-muted fw-light">Comercio /</span> Produtos
            </h4>
        </div>
        <div>

            <a href="{{ route('auth.index.dashboard.comercio.produtos.inserir') }}">
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
                        <th>Categoria</th>
                        <th>Marca</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($produto as $prod)
                        <tr data-id="{{ $prod->id }}">
                            <td>
                                <strong>
                                    {{ $prod->id }}
                                </strong>
                            </td>
                            <td>
                                {{ $prod->nome }}
                            </td>
                            <td>
                                {{ $prod->categoria->nome }}
                            </td>
                            <td>
                                {{ $prod->marca->nome }}
                            </td>
                            <td>
                                {{ $prod->valor }}
                            </td>
                            <td class="d-flex gap-3">
                                <a
                                    href="{{ route('auth.index.dashboard.comercio.produtos.atualizar') }}?id={{ $prod->id }}">
                                    <i class='bx bx-edit fs-4 text-gray'></i>
                                </a>
                                <form id="formDelete"
                                    action="{{ route('auth.delete.dashboard.comercio.produtos') }}?id={{ $prod->id }}"
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
                                <th>#</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Marca</th>
                                <th>Valor</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($produtoDeletado as $prod)
                                <tr data-id="{{ $prod->id }}">
                                    <td>
                                        <strong>
                                            {{ $prod->id }}
                                        </strong>
                                    </td>
                                    <td>
                                        {{ $prod->nome }}
                                    </td>
                                    <td>
                                        {{ $prod->categoria->nome }}
                                    </td>
                                    <td>
                                        {{ $prod->marca->nome }}
                                    </td>
                                    <td>
                                        {{ $prod->valor }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <form id="formRestore"
                                                action="{{ route('auth.restore.dashboard.comercio.produtos') }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" value="{{ $prod->id }}" name="id">
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
                        "{{ route('auth.restore.dashboard.comercio.produtos') }}?id=" +
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
                "{{ route('auth.delete.dashboard.comercio.produtos') }}?id=" + id;
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
                    formDelete.action = "{{ route('auth.delete.dashboard.comercio.produtos') }}?id=" +
                        id; // Passando URL para action do form
                    formDelete.submit();
                }
            })
        });
    </script>
@endpush
