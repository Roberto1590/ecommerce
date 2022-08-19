@extends('auth.admin.base')
@push('style')
@endpush
@section('content')
    @if (session()->has('msgSuccess'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session()->get('msgSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3 page-titles">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Gerenciamento / Usuários /</span> Inserir
                </h4>
            </div>
        </div>
        <a href="{{ route('auth.index.dashboard.gerenciamento.usuarios') }}">
            <button type="button" class="btn btn-primary">
                <i class='bx bx-arrow-back'></i>&nbsp; Voltar
            </button>
        </a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Usuário</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-account-settings-notifications.html"><i class="bx bx-bell me-1"></i>
                        Permissões</a>
                </li>
            </ul>
            <form id="formInserir" action="{{ route('auth.post.dashboard.gerenciamento.usuarios') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="card mb-4">
                    <h5 class="card-header">Dados do Usuário</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="../../{{ config('constants.usuarios.path_sem_foto') }}" alt="Avatar do Usuário"
                                class="d-block rounded" height="100" width="100" id="uploadPerfil" />

                            <div class="button-wrapper">
                                <label for="imagem" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload de foto</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="imagem" name="imagem" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" value="{{ old('imagem') }}" />
                                </label>
                                <button type="button"
                                    class="btn btn-outline-secondary reset_img_perfil account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Resetar Foto</span>
                                </button>

                                <p class="text-muted mb-0">Suporte JPG, GIF or PNG. Maximo de 1200kb</p>
                            </div>
                        </div>
                        @error('imagem')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input class="form-control" type="text" id="nome" name="nome"
                                    placeholder="Seu nome" autofocus value="{{ old('nome') }}" />
                                @error('nome')
                                    <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" type="email" name="email" id="email"
                                    placeholder="Seu email" value="{{ old('email') }}" />
                                @error('email')
                                    <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="cpf" class="form-label">CPF</label>
                                <input class="form-control" type="text" id="cpf" name="cpf"
                                    data-mask="000.000.000-00" placeholder="123.456.789-12" value="{{ old('cpf') }}" />
                                @error('cpf')
                                    <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select id="sexo" name="sexo" class="select2 form-select">
                                    <option value="">Selecione o Sexo</option>
                                    <option {{ old('sexo') == '0' ? 'selected' : '' }} value="0">
                                        Masculino</option>
                                    <option {{ old('sexo') == '1' ? 'selected' : '' }} value="1">Feminino
                                    </option>
                                </select>
                                @error('sexo')
                                    <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="telefone_comercial" class="form-label">Telefone Comercial</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">BR (+55)</span>
                                    <input data-mask="(00) 0000-0000" type="text" id="telefone_comercial"
                                        name="telefone_comercial" value="{{ old('telefone_comercial') }}"
                                        class="form-control" placeholder="(11) 1234-5678" />
                                </div>
                                @error('telefone_comercial')
                                    <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="telefone_celular" class="form-label">Telefone Celular</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">BR (+55)</span>
                                    <input data-mask="(00) 0000-0000" type="text" id="telefone_celular"
                                        name="telefone_celular" value="{{ old('telefone_celular') }}"
                                        class="form-control" placeholder="(11) 91234-5678" />
                                </div>
                                @error('telefone_celular')
                                    <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- <div class="d-flex justify-content-between align-items-center mb-3 page-titles">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Inserir Usuário</h4>
            </div>
        </div>
        <a href="{{ route('auth.index.dashboard.gerenciamento.usuarios') }}">
            <button type="submit" class="btn btn-dark pl-3 pr-3 text-white">Voltar</button>
        </a>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="custom-tab-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#dados" data-toggle="tab" class="nav-link active show">Dados</a>
                            </li>
                            <li class="nav-item">
                                <a href="#permissoes" data-toggle="tab" class="nav-link">Permissões</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="dados" class="tab-pane fade active show">
                                <div class="form-validation pt-3">
                                    <form class="form-valide"
                                        action="{{ route('auth.post.dashboard.gerenciamento.usuarios') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label for="nome" class="text-label">Nome *</label>
                                                    <div class="input-group">
                                                        <input type="text" name="nome" class="form-control"
                                                            id="nome" placeholder="Fulano de tal" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label for="email" class="text-label">Email *</label>
                                                    <div class="input-group">
                                                        <input type="email" name="email" class="form-control"
                                                            id="email" placeholder="contato@example.com" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="form-group">
                                                    <label for="telefone_celular" class="text-label">Telefone
                                                        Celular *</label>
                                                    <div class="input-group">
                                                        <input type="text" name="telefone_celular"
                                                            data-mask="(00) 00000-0000" class="form-control"
                                                            id="telefone_celular " placeholder="(11) 91234-5678" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="form-group">
                                                    <label for="telefone_comercial" class="text-label">Telefone
                                                        Comercial *</label>
                                                    <div class="input-group">
                                                        <input type="text" name="telefone_comercial"
                                                            data-mask="(00) 00000-0000" class="form-control"
                                                            id="telefone_comercial" placeholder="(11) 91234-5678" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-4">
                                                <div class="form-group">
                                                    <label for="cpf" class="text-label">CPF *</label>
                                                    <div class="input-group">
                                                        <input type="text" name="cpf" data-mask="000.000.000-00"
                                                            class="form-control" id="cpf" placeholder="000.000.000-00"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label for="senha" class="text-label">Senha *</label>
                                                    <div class="input-group">
                                                        <input type="password" name="senha" class="form-control"
                                                            id="senha" placeholder="" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <div class="form-group">
                                                    <label for="confirmar_senha" class="text-label">Confirmar
                                                        Senha
                                                        *</label>
                                                    <div class="input-group">
                                                        <input type="password" name="confirmar_senha"
                                                            class="form-control" id="confirmar_senha" placeholder=""
                                                            required>
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
    </div> --}}
@endsection
@push('script')
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins-init/jquery.validate-init.js') }}"></script>

    <script>
        function readImage() {
            if (this.files && this.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("uploadPerfil").src = e.target.result;

                };
                file.readAsDataURL(this.files[0]);
            }
        }
        $('.reset_img_perfil').on('click', function() {
            document.getElementById("uploadPerfil").src =
                '../../../{{ config('constants.usuarios.path_sem_foto') }}'
            $('#imagem').val('')
        })
        document.getElementById("imagem").addEventListener("change", readImage, false);

        $('#table').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
            }
        });
    </script>
@endpush
