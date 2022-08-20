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
            <div class="col-4">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">

                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                            aria-selected="true">
                            <i class="tf-icons bx bx-user"></i>
                            Dados do Produto
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                            aria-selected="false">
                            <i class="tf-icons bx bx-user"></i>
                            Estoque
                        </button>
                    </li>

                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                <form id="formInserir" action="{{ route('auth.post.dashboard.gerenciamento.usuarios') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-4">
                        <h5 class="card-header">Dados do Produto</h5>
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="../../{{ config('constants.produtos.path_sem_foto') }}" alt="Foto Produto"
                                    class="d-block rounded" height="100" width="100" id="uploadFoto" />

                                <div class="button-wrapper">
                                    <label for="imagem" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload de foto</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="imagem" name="imagem" class="account-file-input"
                                            hidden accept="image/png, image/jpeg" value="{{ old('imagem') }}" />
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
                                        data-mask="000.000.000-00" placeholder="123.456.789-12"
                                        value="{{ old('cpf') }}" />
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
            <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                <p>
                    Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                    cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
                    cheesecake fruitcake.
                </p>
                <p class="mb-0">
                    Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
                    cotton candy liquorice caramels.
                </p>
            </div>
            <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                <p>
                    Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
                    cupcake gummi bears cake chocolate.
                </p>
                <p class="mb-0">
                    Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
                    roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
                    jelly-o tart brownie jelly.
                </p>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
