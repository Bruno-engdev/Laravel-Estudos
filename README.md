# 🚗 AutoPrime - Sistema de Loja de Veículos

## 👥 Desenvolvedores
**Bruno** e **Miguel**

---

## � Acesso Administrativo

A área administrativa fica em `/admin/login`. Não há credenciais padrão versionadas neste repositório por motivos de segurança.

Para criar o usuário administrador inicial, defina no seu arquivo `.env`:

```env
ADMIN_NAME=Administrador
ADMIN_EMAIL=admin@seudominio.com
ADMIN_PASSWORD=uma-senha-forte-aqui
```

E em seguida rode:

```bash
php artisan db:seed
```

O `DatabaseSeeder` lerá essas variáveis e criará/atualizará o usuário com `is_admin = true`. Para promover um usuário existente manualmente:

```bash
php artisan tinker
>>> \App\Models\User::where('email','foo@bar.com')->update(['is_admin' => true]);
```

---

Sistema completo de gerenciamento de loja de veículos desenvolvido em Laravel, com área pública para clientes e área administrativa para gestão de veículos, marcas, modelos e cores.

## 📋 Sobre o Projeto

Este projeto foi desenvolvido como trabalho acadêmico e implementa um sistema completo de e-commerce de veículos com:

- **Área Pública**: Vitrine de veículos com filtros, detalhes e busca
- **Área Administrativa**: CRUD completo para gerenciamento de:
  - Veículos
  - Marcas
  - Modelos
  - Cores
  - Clientes
  - Categorias

## 🛠️ Tecnologias Utilizadas

- **Backend**: Laravel 12.0
- **Frontend**: Blade Templates, Bootstrap 5.3.3, Font Awesome 6.0
- **Banco de Dados**: MySQL
- **PHP**: 8.2+
- **Servidor Local**: XAMPP

## 📦 Pré-requisitos

- PHP >= 8.2
- Composer
- MySQL (via XAMPP ou similar)
- Node.js e NPM
- Git

## 🚀 Instalação e Configuração

### 1. Clone o Repositório

```bash
git clone https://github.com/Bruno-engdev/Laravel-Estudos.git
cd Laravel-Estudos
```

### 2. Instale as Dependências

```bash
# Dependências PHP
composer install

# Dependências JavaScript
npm install
```

### 3. Configure o Banco de Dados

1. Inicie o XAMPP e ative o MySQL
2. Crie um banco de dados chamado `lojadecarros_database` no phpMyAdmin
3. Copie o arquivo `.env.example` para `.env`:

```bash
copy .env.example .env
```

4. Edite o arquivo `.env` com as seguintes configurações:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lojadecarros_database
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Gere a Chave da Aplicação

```bash
php artisan key:generate
```

### 5. Execute as Migrations e Seeders

```bash
# Cria todas as tabelas no banco de dados
php artisan migrate

# Popula o banco com dados de exemplo
php artisan db:seed
```

**Nota**: Os seeders criarão:
- 1 usuário administrador
- 8 marcas de veículos
- 16 modelos de veículos
- 10 cores
- 6 veículos de exemplo

### 6. Inicie o Servidor

```bash
php artisan serve
```

Acesse a aplicação em: `http://localhost:8000`

## 👤 Credenciais de Acesso

### Área Administrativa

**URL do Site**: `http://localhost:8000` ou `http://127.0.0.1:8000`

**URL da Área Admin**: `http://localhost:8000/admin/login` ou `http://127.0.0.1:8000/admin/login`

#### Usuário do Professor Escobar:
- **E-mail**: `Escobar@autoprime.com`
- **Senha**: `palmeirasegrande`

#### Usuário Admin Alternativo:
- **E-mail**: `admin@autoprime.com`
- **Senha**: `admin123`

## 📱 Estrutura do Projeto

### Área Pública (`/`)

- **Home** (`http://localhost:8000`): Página inicial com destaques de veículos
- **Modelos** (`http://localhost:8000/modelos`): Listagem completa de veículos com paginação
- **Detalhes** (`http://localhost:8000/veiculo/{id}`): Informações detalhadas do veículo

### Área Administrativa (`/admin`)

**Acesso**: Faça login em `http://localhost:8000/admin/login` com as credenciais do Professor Escobar

Após o login, você terá acesso ao menu lateral com todas as opções:

- **Veículos** (`/admin/veiculos`): CRUD completo de veículos
- **Marcas** (`/admin/marcas`): Gerenciamento de marcas
- **Modelos** (`/admin/modelos`): Gerenciamento de modelos
- **Cores** (`/admin/cores`): Gerenciamento de cores
- **Clientes** (`/admin/clientes`): Gerenciamento de clientes
- **Categorias** (`/admin/categoria`): Gerenciamento de categorias
- **Meu Perfil** (`/admin/profile`): Edição de dados pessoais e senha

## 🗂️ Estrutura do Banco de Dados

### Tabelas Principais

1. **users**: Usuários administradores
2. **marcas**: Marcas de veículos (BMW, Toyota, etc.)
3. **modelos**: Modelos vinculados às marcas
4. **cores**: Cores disponíveis com código hexadecimal
5. **veiculos**: Veículos com relacionamentos para marca, modelo e cor
6. **clientes**: Clientes cadastrados no sistema

### Relacionamentos

- `veiculos` -> `marcas` (marca_id)
- `veiculos` -> `modelos` (modelo_id)
- `veiculos` -> `cores` (cor_id)
- `modelos` -> `marcas` (marca_id)

## 🎨 Funcionalidades Implementadas

### ✅ Requisitos Acadêmicos Atendidos

- [x] **Área pública** com listagem de veículos e página de detalhes
- [x] **Área administrativa** com autenticação
- [x] **CRUD completo** para Marca, Modelo, Cor e Veículos
- [x] **Tabelas separadas** com relacionamentos via foreign keys
- [x] **Templates Blade** com `@extends` e `@yield`
- [x] **3 fotos por veículo** (campos foto1, foto2, foto3 como URLs)
- [x] **Banco de dados normalizado** com relacionamentos
- [x] **Interface visual** com Bootstrap e design responsivo
- [x] **README completo** com instruções de instalação

### 🌟 Funcionalidades Extras

- SoftDeletes em todos os models principais
- Validação de dados nos formulários
- Paginação nas listagens
- Filtros e busca de veículos
- Dashboard com estatísticas
- Sistema de autenticação multi-guard (admin e cliente)

## 📸 Screenshots

*(Adicione aqui screenshots do seu sistema após a execução)*

### Página Inicial
![Home](docs/screenshots/home.png)

### Listagem de Veículos
![Modelos](docs/screenshots/modelos.png)

### Dashboard Admin
![Dashboard](docs/screenshots/dashboard.png)

### CRUD de Veículos
![CRUD Veículos](docs/screenshots/veiculos-crud.png)

## 🔄 Comandos Úteis

```bash
# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Recriar banco de dados (apaga tudo e recria)
php artisan migrate:fresh --seed

# Ver rotas
php artisan route:list

# Ver status das migrations
php artisan migrate:status
```

## 🐛 Solução de Problemas

### Erro: "SQLSTATE[HY000] [1045] Access denied"

**Solução**: Verifique se o MySQL está rodando no XAMPP e se o `DB_PASSWORD` no `.env` está vazio (para instalações padrão do XAMPP).

### Erro: "Class 'Marca' not found"

**Solução**: Execute `composer dump-autoload`

### Página em branco após login

**Solução**: Verifique se rodou `php artisan migrate` e `php artisan db:seed`

## 📝 Licença

Este projeto é de código aberto desenvolvido para fins acadêmicos.

## 👨‍💻 Autores

**Bruno** e **Miguel**
- GitHub: [@Bruno-engdev](https://github.com/Bruno-engdev)
- Repositório: [Laravel-Estudos](https://github.com/Bruno-engdev/Laravel-Estudos)

## 🙏 Agradecimentos

Projeto desenvolvido como trabalho acadêmico para a disciplina de Desenvolvimento Web.

**Professor**: Escobar

---

## 📌 Informações Importantes para Avaliação

### ✅ Como Testar o Sistema

1. **Inicie o servidor**: `php artisan serve`
2. **Acesse o site público**: `http://localhost:8000`
3. **Acesse a área admin**: `http://localhost:8000/admin/login`
4. **Faça login com**:
   - Email: `Escobar@autoprime.com`
   - Senha: `palmeiraegrande`
5. **Explore as funcionalidades** através do menu lateral

### 📊 Dados Pré-cadastrados

O sistema já vem com:
- 8 marcas de veículos
- 16 modelos de veículos
- 10 cores
- 6 veículos completos com fotos e especificações
- Usuário admin personalizado para o professor

---

**Data de Criação**: Novembro de 2025  
**Versão do Laravel**: 12.0  
**Versão do PHP**: 8.3.8
