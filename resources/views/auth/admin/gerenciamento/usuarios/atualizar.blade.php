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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Gerenciamento / Usuários /</span> Atualizar
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
            <form id="formAtualizar" action="{{ route('auth.put.dashboard.gerenciamento.usuarios') }}" method="POST"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" name="id" value="{{ $usuario->usuario->id }}">
                <input type="hidden" name="contato_id" value="{{ $usuario->id }}">
                <div class="card mb-4">
                    <h5 class="card-header">Dados do Usuário</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="../../{{ $usuario->usuario->path_perfil ? $usuario->usuario->path_perfil : config('constants.usuarios.path_sem_foto') }}"
                                alt="Avatar do Usuário" class="d-block rounded" height="100" width="100"
                                id="uploadPerfil" />
                            <div class="button-wrapper">
                                <label for="imagem" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload de foto</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" value="{{ $usuario->usuario->path_perfil }}" id="imagem"
                                        name="imagem" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                </label>
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
                                    placeholder="Seu nome" required=true autofocus
                                    value="{{ old('nome') ?? $usuario->usuario->name }}" />
                                @error('nome')
                                    <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" type="email" name="email" id="email"
                                    placeholder="Seu email" required=true
                                    value="{{ old('email') ?? $usuario->usuario->email }}" />
                                @error('email')
                                    <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="cpf" class="form-label">CPF</label>
                                <input class="form-control" type="text" id="cpf" name="cpf"
                                    data-mask="000.000.000-00" disabled required=true placeholder="123.456.789-12"
                                    value="{{ old('cpf') ?? $usuario->cpf }}" />
                                @error('cpf')
                                    <span class="error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select {{ old('nome') }} id="sexo" required=true name="sexo"
                                    class="select2 form-select">
                                    @if ($usuario->sexo == 1)
                                        <option value="">Selecione o Sexo</option>
                                        <option {{ old('sexo') == '0' ? 'selected' : '' }} value="0">
                                            Masculino</option>
                                        <option {{ old('sexo') == '1' ? 'selected' : '' }} selected value="1">
                                            Feminino
                                        </option>
                                    @endif
                                    @if ($usuario->sexo == 0)
                                        <option value="">Selecione o Sexo</option>
                                        <option {{ old('sexo') == '0' ? 'selected' : '' }}selected value="0">
                                            Masculino</option>
                                        <option {{ old('sexo') == '1' ? 'selected' : '' }} value="1">Feminino
                                        </option>
                                    @endif
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
                                    <input required=true data-mask="(00) 0000-0000" type="text"
                                        id="telefone_comercial" name="telefone_comercial"
                                        value="{{ old('nome') ?? $usuario->telefone_comercial }}" class="form-control"
                                        placeholder="(11) 1234-5678" />
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
                                    <input required=true data-mask="(00) 0000-0000" type="text" id="telefone_celular"
                                        name="telefone_celular" value="{{ old('nome') ?? $usuario->telefone_celular }}"
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
                            <button type="submit" id="btn-submit" class="btn btn-primary me-2">Salvar</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#formAtualizar').on('submit', function() {
            $('#formAtualizar').find('input[required=true]').each(function() {
                // alert($(this).val())
                if (!$(this).val()) {
                    return false;
                } else {
                    $('#btn-submit').prop('disabled', true);
                    $('#btn-submit').text('Enviando...');
                    $('#btn-submit').prepend(
                        `<span id="load-button" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> `
                    );
                }
            });
        });

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
                '../../../{{ config('constants.usuarios.path_sem_foto') }}';
            $('#imagem').val('null')
        })
        document.getElementById("imagem").addEventListener("change", readImage, false);
    </script>
@endpush
