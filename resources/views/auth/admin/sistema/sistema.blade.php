@extends('layouts.dashboard')
@push('style')
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
@endpush
@section('content')
    <div class="content-body">
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
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                            class="mdi mdi-close"></i></span>
                </button>
                <span style="">
                    {{ session()->get('msgSuccess') }}
                </span>
            </div>
        @endif
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3 page-titles">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Tabela de Sistemas</h4>
                    </div>
                </div>
                <a href="{{ route('auth.get.dashboard.sistema.inserir') }}">
                    <button type="submit" class="btn btn-primary pl-3 pr-3 text-white">Novo</button>
                </a>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>CNPJ</th>
                                            <th>Email</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sistemas as $sis)
                                            <tr data-id="{{ $sis->id }}">
                                                <td>
                                                    {{ $sis->id }}
                                                </td>
                                                <td>
                                                    {{ $sis->sistema_razao_social }}
                                                </td>
                                                <td>
                                                    {{ $sis->sistema_cnpj }}
                                                </td>
                                                <td>
                                                    {{ $sis->sistema_email }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <form action="{{ route('auth.get.dashboard.sistema.atualizar') }}"
                                                            method="get">
                                                            <input type="hidden" value="{{ $sis->id }}"
                                                                name="id">
                                                            <button class="btn">
                                                                <i class="ti-pencil" style="color: black"></i>
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
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3 page-titles">
                <div class="col-sm-6 p-md-0">
                </div>
                <button type="submit" data-toggle="modal" data-target="#arquivadoModal"
                    class="btn btn-primary pl-3 pr-3 text-white">Arquivados</button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="arquivadoModal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Arquivados</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tableArquivados" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Razão Social</th>
                                <th>CNPJ</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sistemasDeletado as $sis)
                                <tr data-id="{{ $sis->id }}">
                                    <td>
                                        {{ $sis->id }}
                                    </td>
                                    <td>
                                        {{ $sis->sistema_razao_social }}
                                    </td>
                                    <td>
                                        {{ $sis->sistema_cnpj }}
                                    </td>
                                    <td>
                                        {{ $sis->sistema_email }}
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <form
                                                action="{{ route('auth.post.dashboard.gerenciamento.usuario.restaurar') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $sis->id }}" name="id">
                                                <button class="btn">
                                                    <i class="ti-reload" style="color: black"></i>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Url = window.location.origin;
        $(".btnremove").on("click", function() {
            let formDelete = $('#formDelete'); // Form de Delete

            // Capturando ID e passando para URL
            const id = $(this).parents('tr').data('id');

            const routeDelete = Url + "/gerenciamento/usuario/" + id + "/delete";
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
