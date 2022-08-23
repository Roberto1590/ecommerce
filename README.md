# Ecommerce

Desenvolvendo um sistema ecommerce com área administrativa

## 🚀 Começando

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local somente para fins de desenvolvimento e teste.

### 📋 Pré-requisitos

De que coisas você precisa para instalar e começar a usar o sistema?

```
Composer
PHP >= 8.0
```

### 🔧 Instalação

Passo a passo que informam o que você deve executar e começar a usar o sistema

Clonando projeto:

```
git clone https://github.com/gui1535/ecommerce.git
```

Acesse a pasta do projeto:

```
cd ecommerce
```

Atualizando Composer e gerando arquivo .env:

```
composer update
cp .env.example .env
```

Com um banco de dados criado, configure o arquivo .env, segue um exemplo abaixo:

```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=123
```

Executando migrations:

```
php artisan migrate:fresh --seed
```

Caso dê erros ao executar as migrations, faça:

```
- Acesse o arquivo 'web.php' no local 'routes/web.php'
- Comente da linha 19 até o final
- Execute novamente as migrations
- Não esqueça de tirar o comentário depois que funcionar
```

Gerando chave do projeto:

```
php artisan key:generate
```

Iniciando o projeto:

```
php artisan serve
```

## 🛠️ Construído com

Ferramentas utilizadas até este momento para o desenvolvimento do projeto

* [Laravel](https://laravel.com/) - Framework web PHP
* [Bootstrap 5](https://getbootstrap.com/) - Framework web CSS/JS
* [Jquery](https://jquery.com/) - Biblioteca Javascript
* [JqueryUI](https://jqueryui.com/) - Coleção de widgets GUI

## 📌 Versão

Projeto ainda não tem uma versão

## ✒️ Autores

Aqueles que ajudaram o projeto

* **Guilherme Araujo** - *Trabalho Inicial* - [Github](https://github.com/gui1535)


## 🎁 Expressões de gratidão

* Conte a outras pessoas sobre este projeto 📢
* Obrigado publicamente 🤓.
* etc.


---
⌨️ com ❤️ por [gui1535](https://github.com/gui1535) 😊
