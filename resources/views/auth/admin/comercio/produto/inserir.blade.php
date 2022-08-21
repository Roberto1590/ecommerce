@extends('auth.admin.base')
@push('style')
    {{-- <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}"> --}}
    {{-- <link rel='stylesheet' href='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'>
    <link rel='stylesheet' href='https://unpkg.com/filepond/dist/filepond.min.css'> --}}
    <link rel="stylesheet" href="{{ asset('plugins/filepond/css/filepond-plugin-image-preview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/filepond/css/filepond.min.css') }}">
    <style>
        /* Wizard */
        .wizard a:hover {
            text-decoration: none;
        }

        .wizard .audible {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .wizard .steps>ul {
            list-style: none;
            padding-left: 0;
            display: -webkit-box;
            display: flex;
            -webkit-box-pack: justify;
            justify-content: space-between;
            margin-bottom: 0;
        }

        .wizard .steps>ul li {
            width: 270px;
            max-width: calc(25% - 6px);
        }

        .wizard .steps>ul li a {
            display: flex;
            justify-content: center;
            align-items: center;
            /* width: 100%;
                                    height: 100%; */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            background-color: rgba(153, 155, 163, 0.1);
            padding: 20px 35px;
        }

        @media (max-width: 767px) {
            .wizard .steps>ul li a {
                padding: 15px 10px;
            }
        }

        .media {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        @media (max-width: 767px) {
            .wizard .steps>ul li a .media {
                display: block;
            }
        }

        .bd-wizard-step-icon {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wizard .steps>ul li .bd-wizard-step-icon {
            width: 34px;
            height: 34px;
            border-radius: 4px;
            background-color: #e1e1e1;
            font-size: 14px;
            line-height: 34px;
            text-align: center;
            color: #4a2950;
            margin-right: 11px;
        }

        @media (max-width: 767px) {
            .wizard .steps>ul li .bd-wizard-step-icon {
                margin: 0 auto;
            }
        }

        .wizard .steps>ul li .bd-wizard-step-title {
            line-height: 1;
            font-size: 18px;
            font-weight: bold;
            color: #000000;
        }

        @media (max-width: 767px) {
            .wizard .steps>ul li .bd-wizard-step-title {
                display: none;
            }
        }

        .wizard .steps>ul li .bd-wizard-step-subtitle {
            line-height: 1;
            font-size: 14px;
            color: #c8c8c8;
        }

        @media (max-width: 767px) {
            .wizard .steps>ul li .bd-wizard-step-subtitle {
                display: none;
            }
        }

        .wizard .steps>ul li.current .bd-wizard-step-icon,
        .wizard .steps>ul li.done .bd-wizard-step-icon {
            background-color: #696cff;
            color: #fff;
        }

        .wizard .steps>ul li.current a {
            background-color: #fff;
        }

        .wizard .content {
            padding: 30px 35px 20px 35px;
            background-color: #fff;
        }

        @media (max-width: 767px) {
            .wizard .content {
                padding-left: 20px;
                padding-right: 20px;
                min-height: auto;
            }
        }

        .wizard .content .title {
            display: none;
        }

        .wizard .content .content-wrapper {
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .wizard .content .section-heading {
            font-weight: bold;
            color: #030303;
            margin-bottom: 22px;
        }

        .wizard .content p {
            font-size: 16px;
            color: #030303;
        }

        .wizard .actions {
            padding: 0 35px;
            background-color: #fff;
        }

        @media (max-width: 767px) {
            .wizard .actions {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        .wizard .actions>ul {
            list-style: none;
            padding-left: 0;
            /* display: -webkit-box; */
            display: flex;
            /* -webkit-box-pack: end; */
            justify-content: flex-end;
            /* max-width: 700px; */
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 15px;
            border-bottom: 1px solid #f5f5f4;
        }

        .wizard .actions li a {
            display: inline-block;
            border-radius: 6px;
            /* background-color: #696cff; */
            padding: 10px 25px;
            /* color: #fff; */
            font-style: 15px;
            font-weight: bold;
        }

        .wizard .actions li.disabled {
            display: none;
        }

        .wizard .actions li:not(.disabled)+li,
        .wizard .actions li:not(:first-child):last-child {
            margin-left: 15px;
        }
    </style>
@endpush
@section('content')
    @if (session()->has('msgSuccess'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session()->get('msgSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
    <div class="container">
        <form id="wizard" action="" method="POST">
            @csrf
            <h3>
                <div class="media">
                    <div class="bd-wizard-step-icon">
                        <i class='bx bx-package'></i>
                    </div>
                    <div class="media-body">
                        <div class="bd-wizard-step-title mt-3">Dados Produto</div>
                    </div>
                </div>
            </h3>
            <section>
                <h4 class="section-heading">Insira os dados do produto</h4>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nome" class="form-label">Codigo</label>
                        <input class="form-control" maxlength="50" type="text" id="codigo" name="codigo"
                            placeholder="Codigo" autofocus value="{{ old('codigo') }}" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nome" class="form-label">* Nome</label>
                        <input class="form-control" maxlength="254" type="text" id="nome" name="nome"
                            placeholder="Nome" required autofocus value="{{ old('nome') }}" />
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="descricao" class="form-label">* Descrição</label>
                        <textarea id="descricao" required name="descricao" class="form-control">{{ old('descricao') }}</textarea>
                    </div>
                </div>
            </section>
            <h3>
                <div class="media">
                    <div class="bd-wizard-step-icon">
                        <i class='bx bx-images'></i>
                    </div>
                    <div class="media-body">
                        <div class="bd-wizard-step-title mt-3">Imagens</div>
                    </div>
                </div>
            </h3>
            <section>
                <h4 class="section-heading">Insira as imagens do produto</h4>
                <p class="fs-6">Máximo de Imagens: <span class="text-warning">10</span></p>
                <div class="row">
                    <input type="file" id="filepond" class="filepond" name="imagem[]" multiple data-max-file-size="3MB"
                        data-max-files="10" />
                </div>
            </section>
            <h3>
                <div class="media">
                    <div class="bd-wizard-step-icon">
                        <i class='bx bx-help-circle'></i>
                    </div>
                    <div class="media-body">
                        <div class="bd-wizard-step-title mt-3">Especificações</div>
                    </div>
                </div>
            </h3>
            <section>
                <h4 class="section-heading">Insira as especificações do produto</h4>
                <div class="row mb-2">
                    <div class="mb-3 col-md-3">
                        <label for="categoria" class="form-label">* Categoria</label>
                        <select id="categoria" name="categoria" class="select2 form-select">
                            <option>Selecione a Categoria</option>
                            @foreach ($categorias as $cat)
                                <option {{ old('categoria') == $cat->id ? 'selected' : '' }} value="{{ $cat->id }}">
                                    {{ $cat->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="marca" class="form-label">* Marca</label>
                        <select id="marca" name="marca" class="select2 form-select">
                            <option>Selecione a Marca</option>
                            @foreach ($marcas as $mrc)
                                <option {{ old('marca') == $mrc->id ? 'selected' : '' }} value="{{ $mrc->id }}">
                                    {{ $mrc->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="preco_custo" class="form-label">* Preço de Custo</label>
                        <input class="form-control" maxlength="254" type="text" id="preco_custo" name="preco_custo"
                            placeholder="Preço de Custo" required value="{{ old('preco_custo') }}" />
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="preco_venda" class="form-label">* Preço de Venda</label>
                        <input class="form-control" maxlength="254" type="text" id="preco_venda" name="preco_venda"
                            placeholder="Preço de Venda" required value="{{ old('preco_venda') }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label for="peso" class="form-label">Peso</label>
                        <div class="input-group">
                            <input class="form-control" name="peso" type="number" min="0" maxlength="30"
                                value="{{ old('peso') }}" id="peso">
                            <select id="peso_tipo" name="peso_tipo" class="select2 form-select">
                                {{-- <option>Selecione o Pre</option> --}}
                                @foreach ($pesos as $pes)
                                    <option {{ old('peso_tipo') == $pes->sigla ? 'selected' : '' }}
                                        value="{{ $pes->sigla }}">
                                        {{ $pes->peso }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="altura" class="form-label">Altura</label>
                        <div class="input-group">
                            <input class="form-control" name="altura" type="number" min="0" maxlength="30"
                                value="{{ old('altura') }}" id="altura">
                            <select id="altura_tipo" name="altura_tipo" class="select2 form-select">
                                @foreach ($medidas as $med)
                                    <option {{ old('altura_tipo') == $med->sigla ? 'selected' : '' }}
                                        value="{{ $med->sigla }}">
                                        {{ $med->medida }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="largura" class="form-label">Largura</label>
                        <div class="input-group">
                            <input class="form-control" name="largura" type="number" min="0" maxlength="30"
                                value="{{ old('largura') }}" id="largura">
                            <select id="largura_tipo" name="largura_tipo" class="select2 form-select">
                                @foreach ($medidas as $med)
                                    <option {{ old('largura_tipo') == $med->sigla ? 'selected' : '' }}
                                        value="{{ $med->sigla }}">
                                        {{ $med->medida }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="comprimento" class="form-label">Comprimento</label>
                        <div class="input-group">
                            <input class="form-control" name="comprimento" type="number" min="0" maxlength="30"
                                value="{{ old('comprimento') }}" id="comprimento">
                            <select id="comprimento_tipo" name="comprimento_tipo" class="select2 form-select">
                                @foreach ($medidas as $med)
                                    <option {{ old('comprimento_tipo') == $med->sigla ? 'selected' : '' }}
                                        value="{{ $med->sigla }}">
                                        {{ $med->medida }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" checked type="checkbox" name="destaque" id="destaque">
                            <label class="form-check-label" for="destaque">
                                Destaque
                            </label>
                        </div>
                    </div>
                </div>
            </section>
            <h3>
                <div class="media">
                    <div class="bd-wizard-step-icon">
                        <i class='bx bxs-shopping-bag-alt'></i>
                    </div>
                    <div class="media-body">
                        <div class="bd-wizard-step-title mt-3">Estoque</div>
                    </div>
                </div>
            </h3>
            <section>
                <h4 class="section-heading">Insira os dados para o controle do estoque</h4>
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="quantidade" class="form-label">* Quantidade</label>
                        <input class="form-control" maxlength="100" type="number" min="0" id="quantidade"
                            name="quantidade" placeholder="Quantidade" required value="{{ old('quantidade') }}" />
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="minimo" class="form-label">* Quantidade Minima</label>
                        <input class="form-control" maxlength="100" type="number" min="0" id="minimo"
                            name="minimo" placeholder="Quantidade Minima" required value="{{ old('minimo') }}" />
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="maximo" class="form-label">* Quantidade Maxima</label>
                        <input class="form-control" maxlength="100" type="number" min="0" id="maximo"
                            name="maximo" placeholder="Quantidade Maxima" required value="{{ old('maximo') }}" />
                    </div>
                    <div class="mb-3 col-md-12">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" checked type="checkbox" name="notificar" id="notificar">
                            <label class="form-check-label" for="notificar">
                                Notificar-me
                            </label>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="{{ asset('plugins/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('plugins/filepond/js/filepond.min.js') }}"></script>
    <script src="{{ asset('plugins/filepond/js/filepond-plugin-image-preview.min.js') }}"></script>
    <script>
        //Wizard Init
        $("#wizard").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "none",
            titleTemplate: '#title#'
        });

        $("a[href='#previous']").addClass('btn btn-secondary')
        $("a[href='#next']").addClass('btn btn-primary')
        $("a[href='#finish']").addClass('btn btn-success')

        // We want to preview images, so we need to register the Image Preview plugin
        FilePond.registerPlugin(
            FilePondPluginImagePreview,

        );
        $('#preco_custo').mask('#.##0.00', {
            reverse: true
        });
        $('#preco_venda').mask('#.##0.00', {
            reverse: true
        });
        // Select the file input and use create() to turn it into a pond
        FilePond.create(
            document.getElementById('filepond')
        );
    </script>
@endpush
