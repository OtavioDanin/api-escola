# Microsserviço de Gerenciamento de Alunos

<img src="https://laravel.com/img/logomark.min.svg" width="100" alt="Laravel">

Microsserviço desenvolvido em Laravel para gerenciamento de cadastros de alunos, com API RESTful protegida por autenticação JWT.

## 📋 Visão Geral

Este é um repositório para teste da empresa Qualinfo. Consiste em um microsserviço para gerenciamento de cadastros de alunos, desenvolvido com Laravel (última versão estável). O serviço oferece endpoints RESTful protegidos por autenticação via token JWT, com validações específicas para cada operação.

## ✨ Funcionalidades

- ✅ Cadastro de alunos com validação robusta
- ✅ Atualização de cadastros com validação específica
- ✅ Consulta de alunos (lista e individual)
- ✅ Controle de status de alunos
- 🔐 Autenticação via JWT (JSON Web Tokens) - Utilizando firebase/php-jwt  
- 🛡️ Middlewares de validação e autenticação
- 🏷️ Controle de acesso por perfis de usuário(TO DO)

## API-First
O desenvolvimento desta API RESTFull foi baseado a partir da métotologia API-first em que as APIs são consideradas o componente central do processo de design de software. Em vez de começar pelo desenvolvimento de código ou pela interface do usuário ou pela lógica de negócios, o processo de desenvolvimento começa com o design da API que conectará os diferentes componentes do aplicativo, ou seja a preocupação inicial é a respeito do contrato que sua API deve respeitar. Isso garante que o sistema seja construído de forma modular e flexível desde o início.  

Na pasta doc, na raiz da aplicação, é possível encontrar os documentos que expressam o contrato inicial que a API fio desenvolvida. Encontram-se as especificações OpenAPI, bem como a collection (Postman) para teste dos endpoints da API.
-   docs/openapi.yaml - OpenAPI
-   docs/Escola-Api.postman_collection.json - Collection de endpoints da API RESTFull

## 🚀 Endpoints da API

### Autenticação
- `POST /auth` - Gera token JWT para autenticação

### Alunos
- `POST /aluno` - Cria novo cadastro de aluno
- `PUT /aluno/{idAluno}` - Atualiza cadastro existente
- `GET /aluno` - Lista todos os alunos
- `GET /aluno/{idAluno}` - Busca aluno específico

### Status
- `PUT /status/{idStatus}` - Atualiza status de aluno

## 🔒 Requisitos de Autenticação

Todos os endpoints (exceto `/auth`) requerem autenticação via token JWT no header:

Authorization: Bearer {seu_token_jwt}

## 📦 Pré-requisitos

- PHP 8.2+
- Composer
- MySQL 8+ ou MariaDB 10.3+
- Extensão PHP para JWT

## 🛠️ Instalação

1. Clone o repositório:
   ```bash
   git clone git@github.com:OtavioDanin/api-escola.git
   cd api-escola

## 🚀 Como Instalar e Rodar

Siga os passos abaixo para configurar e executar a aplicação em seu ambiente local.

### Passos de Instalação do Projeto com Docker

Certifique-se de ter instalado em sua máquina:

* Docker
* Docker Composer

1.  **Faça o build das imagens e start dos caontainer, executando:**
    ```bash
    docker network create escola_network
    docker compose up -d
    ```
3.  **Gere a Chave da Aplicação:**
    ```bash
    php artisan key:generate

2.  **Instale as Dependências do Composer:**
    ```bash
    composer install # ou composer install --no-dev -o -a para produção
    ```
3.  **Execute as Migrações e Seeds:**
    Isso criará as tabelas no banco de dados eulará com dados de exemplo (se você tiver seeders).
    ```bash
    php artisan migrate:fresh --seed
    ```
A aplicação estará disponível em `http://localhost`(porta 80), ou a porta que estiver definina docker-compose.yaml

### Passos de Instalação do Projeto manualmente (sem Docker)

Siga os passos abaixo para configurar e executar a aplicação em seu ambiente local.

### Pré-requisitos

Certifique-se de ter instalado em sua máquina:

* PHP (>= 8.2)
* Composer
* Um servidor web (Nginx ou Apache)
* Banco de dados MySQL 8+ ou MariaDB 10.3+ (configurado para a aplicação)

## ⚙️ Tecnologias Utilizadas

* **Laravel 12:** Framework PHP
* **MySQL:** Banco de dados
* **firebase/php-jwt:** Para validação e geração de token JWWT
* **laminas/laminas-validator:** Para validação segura e consistente dos Dados de entrada
* **Nginx:** Servidor WEB de alto desenpenho

## 📄 Licença

Este projeto é de código aberto e está licenciado sob a [Licença MIT](https://opensource.org/licenses/MIT) (se aplicável).
