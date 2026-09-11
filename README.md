# 📚 Biblioteca

Sistema web para gerenciamento de uma biblioteca, desenvolvido como trabalho final da disciplina de desenvolvimento com Laravel.

A aplicação permite gerenciar livros, usuários e empréstimos, além de realizar buscas e acompanhar a situação dos empréstimos.

## 🚀 Funcionalidades

* Cadastro, consulta, edição e exclusão de livros
* Cadastro, consulta, edição e exclusão de usuários
* Cadastro, consulta, edição e exclusão de empréstimos
* Controle da quantidade de exemplares disponíveis
* Registro de devoluções
* Identificação de empréstimos atrasados
* Renovação de empréstimos por mais 14 dias
* Busca de livros e usuários por nome ou ID
* Visualização do histórico de empréstimos
* Mensagens de sucesso e erro
* Interface responsiva
* Dados iniciais através de seeders

## 🛠️ Tecnologias utilizadas

* **PHP**
* **Laravel**
* **Laravel Blade**
* **Eloquent ORM**
* **MySQL**
* **Tailwind CSS**
* **Vite**
* **Node.js**
* **Git/GitHub**

## 📋 Requisitos

Antes de executar o projeto, certifique-se de possuir:

* PHP
* Composer
* Node.js e npm
* MySQL
* Git

## 📥 Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/John-Fronza/trabalho-final-laravel
```

Entre na pasta do projeto:

```bash
cd biblioteca
```

### 2. Instale as dependências do PHP

```bash
composer install
```

### 3. Instale as dependências do JavaScript

```bash
npm install
```

### 4. Configure o arquivo `.env`

Crie o arquivo `.env` a partir do exemplo:

```bash
cp .env.example .env
```

Depois, abra o `.env` e configure as informações do banco de dados.

Exemplo:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biblioteca
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 5. Gere a chave da aplicação

```bash
php artisan key:generate
```

### 6. Crie o banco de dados

No MySQL, crie um banco chamado:

```sql
CREATE DATABASE biblioteca;
```

### 7. Execute as migrations e os seeders

```bash
php artisan migrate --seed
```

Isso criará as tabelas e inserirá os dados iniciais da aplicação.

### 8. Compile os arquivos do frontend

Para gerar os arquivos de produção:

```bash
npm run build
```

Durante o desenvolvimento, também é possível utilizar:

```bash
npm run dev
```

### 9. Inicie o servidor Laravel

```bash
php artisan serve
```

A aplicação estará disponível em:

```text
http://127.0.0.1:8000
```

## 🗂️ Estrutura principal

O projeto segue a arquitetura MVC do Laravel.

```text
app/
├── Http/
│   └── Controllers/
│       ├── BuscaController.php
│       ├── EmprestimoController.php
│       ├── HomeController.php
│       ├── LivroController.php
│       └── UsuarioController.php
│
└── Models/
    ├── Emprestimo.php
    ├── Livro.php
    └── Usuario.php

database/
├── factories/
├── migrations/
└── seeders/

resources/
├── css/
├── js/
└── views/
    ├── components/
    ├── emprestimos/
    ├── includes/
    ├── livros/
    ├── usuarios/
    ├── app.blade.php
    ├── busca.blade.php
    └── home.blade.php

routes/
└── web.php
```

## 🗄️ Banco de dados

O sistema utiliza três entidades principais:

### Livros

Armazena as informações dos livros disponíveis no acervo, incluindo:

* Título
* Autor
* ISBN
* Categoria
* Ano de publicação
* Quantidade total de exemplares
* Quantidade de exemplares disponíveis
* Descrição

### Usuários

Armazena os usuários cadastrados na biblioteca:

* CPF
* Nome
* E-mail
* Telefone

### Empréstimos

Relaciona usuários e livros e registra:

* Livro emprestado
* Usuário
* Data do empréstimo
* Data prevista para devolução
* Data de devolução
* Situação do empréstimo
* Observações

## 🔄 Regras principais

* Um livro só pode ser emprestado quando houver exemplares disponíveis.
* Ao registrar um empréstimo, a quantidade de exemplares disponíveis é reduzida.
* Ao devolver um livro, a quantidade disponível é incrementada.
* Empréstimos cuja data prevista já passou são identificados como atrasados.
* Empréstimos ativos e não atrasados podem ser renovados por mais 14 dias.
* Livros e usuários que possuem empréstimos relacionados não podem ser excluídos enquanto esses relacionamentos existirem.

## 🎨 Interface

A interface foi desenvolvida utilizando Blade e Tailwind CSS.

Foram utilizados componentes Blade reutilizáveis para manter a aparência e o comportamento consistentes entre as páginas, incluindo:

* Botões
* Badges de status
* Cabeçalhos de página
* Tabelas
* Estados vazios
* Detalhes de registros
* Formulários

## 👨‍💻 Autor

Desenvolvido como trabalho acadêmico de desenvolvimento web com Laravel.

