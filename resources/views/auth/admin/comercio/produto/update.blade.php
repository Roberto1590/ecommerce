@extends('auth.admin.base')
@push('style')
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">
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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Comercio / Produtos /</span> Inserir
                </h4>
            </div>
        </div>
        <a href="{{ route('auth.index.dashboard.comercio.produtos') }}">
            <button type="button" class="btn btn-primary">
                <i class='bx bx-arrow-back'></i>&nbsp; Voltar
            </button>
        </a>
    </div>
    <div class="nav-align-top mb-4">
        <div class="row">
            <div class="col-8">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">

                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-dados_prod"
                            aria-controls="navs-pills-justified-dados_prod" aria-selected="true">
                            <i class="tf-icons bx bx-user"></i>
                            Dados do Produto
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link tab_especificacao " role="tab"
                            data-bs-toggle="tab" data-bs-target="#navs-pills-justified-especificacao"
                            aria-controls="navs-pills-justified-especificacao" aria-selected="true">
                            <i class="tf-icons bx bx-user"></i>
                            Especificações
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link disabled" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-estoque" aria-controls="navs-pills-justified-estoque"
                            aria-selected="false">
                            <i class="tf-icons bx bx-user"></i>
                            Estoque
                        </button>
                    </li>

                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="navs-pills-justified-dados_prod" role="tabpanel">
                <form id="formInserir" action="{{ route('auth.post.dashboard.gerenciamento.usuarios') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <h5 class="">Dados do Produto</h5>
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="../../{{ config('constants.produtos.path_sem_foto') }}" alt="Foto Produto"
                            class="d-block rounded" height="100" width="100" id="uploadFoto" />

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
                    <div class="row mt-4">
                        <div class="mb-3 col-md-6">
                            <label for="nome" class="form-label">Codigo</label>
                            <input class="form-control" maxlength="50" type="text" id="codigo" name="codigo"
                                placeholder="Codigo" autofocus value="{{ old('codigo') }}" />
                            @error('codigo')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="nome" class="form-label">* Nome</label>
                            <input class="form-control" maxlength="254" type="text" id="nome" name="nome"
                                placeholder="Codigo" required autofocus value="{{ old('nome') }}" />
                            @error('nome')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="descricao" class="form-label">* Descrição</label>
                            <textarea id="descricao" required name="descricao" class="form-control">{{ old('descricao') }}</textarea>
                            @error('descricao')
                                <span class="error">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-2 d-flex justify-content-end">
                        <button type="button" disabled class="btn btn-primary prox_espc me-2">Proximo</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="navs-pills-justified-especificacao" role="tabpanel">
                <div class="row">
                    <h5 class="">Especificações do Produto</h5>
                    <div class="mb-3 col-md-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select id="categoria" required name="categoria" class="select2 form-select">
                            <option value="">Selecione a Categoria</option>
                            @foreach ($categorias as $cat)
                                <option {{ old('categoria') == $cat->id ? 'selected' : '' }} value="{{ $cat->id }}">
                                    {{ $cat->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="marca" class="form-label">Marca</label>
                        <select id="marca" required name="marca" class="select2 form-select">
                            <option value="">Selecione a Categoria</option>
                            @foreach ($marcas as $mrc)
                                <option {{ old('marca') == $mrc->id ? 'selected' : '' }} value="{{ $mrc->id }}">
                                    {{ $mrc->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('marca')
                            <span class="error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="navs-pills-justified-estoque" role="tabpanel">
                aaa
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#nome').on('input', function() {
            $('#descricao').on('input', function() {
                $('.prox_espc').prop('disabled', $(this).val().length < 5);
            });
        });
        $('.prox_espc').on('click', function() {
            $('.tab_especificacao').removeClass('disabled')
            $('.tab_especificacao').click()
        })
    </script>
@endpush
