@extends('layouts.dashboard')
@push('style')
@endpush
@section('content')
    <div class="content-body">
        <div class="container-fluid">
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
            <div class="d-flex justify-content-between align-items-center mb-3 page-titles">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Inserir Sistema</h4>
                    </div>
                </div>
                <a href="{{ route('auth.get.dashboard.sistema') }}">
                    <button type="submit" class="btn btn-dark pl-3 pr-3 text-white">Voltar</button>
                </a>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-validation pt-3">
                                <form class="form-valide" action="{{ route('auth.post.dashboard.sistema.inserir') }}"
                                    method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">Razão Social *</label>
                                                <div class="input-group">
                                                    <input type="text" name="razao_social" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">Nome Fantasia *</label>
                                                <div class="input-group">
                                                    <input type="text" name="nome_fantasia" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">CNPJ *</label>
                                                <div class="input-group">
                                                    <input type="text" data-mask="00.000.000/0001-26" name="cnpj"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">Inscrição Estadual *</label>
                                                <div class="input-group">
                                                    <input type="text" name="inscricao_estadual" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">Telefone Fixo *</label>
                                                <div class="input-group">
                                                    <input type="text" data-mask="(00) 0000-0000" name="telefone_fixo"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">Telefone Movel *</label>
                                                <div class="input-group">
                                                    <input type="text" data-mask="(00) 00000-0000" name="telefone_movel"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">Email de Contato *</label>
                                                <div class="input-group">
                                                    <input type="email" name="email" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">URL do Site *</label>
                                                <div class="input-group">
                                                    <input type="text" name="url" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">CEP *</label>
                                                <div class="input-group">
                                                    <input type="text" data-mask="00000-000" name="cep"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">Endereço *</label>
                                                <div class="input-group">
                                                    <input type="text" name="endereco" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">Numero *</label>
                                                <div class="input-group">
                                                    <input type="text" name="numero" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">Cidade *</label>
                                                <div class="input-group">
                                                    <input type="text" name="cidade" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">UF *</label>
                                                <div class="input-group">
                                                    <input type="text" name="uf" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-4">
                                            <div class="form-group">
                                                <label class="text-label">Quantidade de Produtos em Destaque *</label>
                                                <div class="input-group">
                                                    <input type="text" name="qntd_prod" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
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
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins-init/jquery.validate-init.js') }}"></script>

    <script>
        $('#table').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
            }
        });
    </script>
@endpush
