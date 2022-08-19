@extends('auth.admin.base')
@push('style')
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
@endpush
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                <span class="text-muted fw-light">Comercio /</span> Marcas
            </h4>
        </div>
        <button type="button" data-bs-toggle="modal" data-bs-target="#newModal"
            class="btn btn-primary pl-3 pr-3 text-white">Novo</button>
    </div>

    <div class="card">
        <div class="table-responsive table_usuarios text-nowrap p-3">
            <table id="table" class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Meta Link</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marcas as $marc)
                        <tr data-id="{{ $marc->id }}">
                            <td>
                                {{ $marc->id }}
                            </td>
                            <td>
                                {{ $marc->nome }}
                            </td>
                            <td>
                                {{ $marc->meta_link }}
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btnEdit">
                                        <i class='bx bx-edit fs-4 text-gray'></i>
                                    </button>
                                    <form id="formDelete" action="{{ route('auth.delete.dashboard.comercio.marcas') }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" value="{{ $marc->id }}" name="id">
                                        <button type="button" class="btn btnremove">
                                            <i class='bx bx-trash fs-4'></i>
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

    <div class="d-flex justify-content-between align-items-center mb-3 page-titles">
        <div class="col-sm-6 p-md-0">
        </div>
        <button type="button" data-bs-toggle="modal" data-bs-target="#arquivadoModal" class="btn btn-primary mt-3">
            <i class='bx bx-archive'></i>&nbsp; Arquivados
        </button>
    </div>

    <div class="modal fade" id="arquivadoModal">
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
                                <th>Meta Link</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marcasDeletado as $marc)
                                <tr data-id="{{ $marc->id }}">
                                    <td>
                                        {{ $marc->id }}
                                    </td>
                                    <td>
                                        {{ $marc->nome }}
                                    </td>
                                    <td>
                                        {{ $marc->meta_link }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <form id="formRestore"
                                                action="{{ route('auth.restore.dashboard.comercio.marcas') }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" value="{{ $marc->id }}" name="id">
                                                <button type="button" class="btn btnRestore">
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

    <div class="modal fade" id="newModal">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Nova Marca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-valide" action="{{ route('auth.post.dashboard.comercio.marcas') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nome">Nome</label>
                            <input id="nome" type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="meta_link">Meta Link</label>
                            <input id="meta_link" type="text" name="meta_link" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div></div>
                            <button class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditModal">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Editar Marca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('auth.put.dashboard.comercio.marcas') }}" method="post">
                        @method('put')
                        @csrf
                        <input type="hidden" id="idEdit" name="id">
                        <div class="form-group">
                            <label for="nomeEdit">Nome</label>
                            <input id="nomeEdit" type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="meta_linkEdit">Meta Link</label>
                            <input id="meta_linkEdit" type="text" name="meta_link" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div></div>
                            <button class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins-init/jquery.validate-init.js') }}"></script>
    <script>
        const Url = window.location.origin;
        $('.btnEdit').on('click', function() {
            let id = $(this).parents('tr').data('id');
            // URL
            let urlCompleta = Url + '/dashboard/comercio/marcas/' + id + '/get';

            // AJAX
            $.get(urlCompleta, function(data) {
                $('#idEdit').val(data.id);
                $('#nomeEdit').val(data.nome);
                $('#meta_linkEdit').val(data.meta_link);
                $('#EditModal').modal('show');
            });
        });

        $(".btnremove").on("click", function() {
            let formDelete = $('#formDelete'); // Form de Delete

            // Capturando ID e passando para URL
            const id = $(this).parents('tr').data('id');

            const routeDelete = Url + "/gerenciamento/comercio/marca/" + id + "/delete";
            Swal.fire({
                title: 'Deseja Deletar?',
                position: 'top',
                showCancelButton: true,
                confirmButtonColor: '#4085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    formDelete.action = routeDelete; // Passando URL para action do form
                    formDelete.submit();
                }
            })
        });

        $(".btnRestore").on("click", function() {
            let formRestore = $('#formRestore'); // Form de Delete

            // Capturando ID e passando para URL
            const id = $(this).parents('tr').data('id');

            const routeDelete = Url + "/gerenciamento/comercio/marca/" + id + "/restore";
            Swal.fire({
                title: 'Deseja Restaurar?',
                position: 'top',
                showCancelButton: true,
                confirmButtonColor: '#4085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, restaurar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    formRestore.action = routeDelete; // Passando URL para action do form
                    formRestore.submit();
                }
            })
        });
    </script>
    <script>
        $('#table').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
            }
        });
        $('#tableArquivados').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
            }
        });
    </script>
@endpush
