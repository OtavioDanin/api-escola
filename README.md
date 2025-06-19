# Microsserviço de Gerenciamento de Alunos

<img src="https://laravel.com/img/logomark.min.svg" width="100" alt="Laravel">

Microsserviço desenvolvido em Laravel para gerenciamento de cadastros de alunos, com API RESTful protegida por autenticação JWT.

## 📋 Visão Geral

Este projeto consiste em um microsserviço para gerenciamento de cadastros de alunos, desenvolvido com Laravel (última versão estável). O serviço oferece endpoints RESTful protegidos por autenticação via token JWT, com validações específicas para cada operação.

## ✨ Funcionalidades

- ✅ Cadastro de alunos com validação robusta
- ✅ Atualização de cadastros com validação específica
- ✅ Consulta de alunos (lista e individual)
- ✅ Controle de status de alunos
- 🔐 Autenticação via JWT (JSON Web Tokens)
- 🛡️ Middlewares de validação e autenticação
- 🏷️ Controle de acesso por perfis de usuário

## 🔧 Tecnologias Utilizadas

- **Laravel** (Última versão estável)
- **Firebase JWT** para autenticação
- **MySQL** (Banco de dados relacional)
- **Eloquent ORM** (Mapeamento objeto-relacional)
- **PHP 8.1+**

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