# 🚗 Estrutura de Views - Front-End Cliente

## 📁 Organização dos Arquivos

```
resources/views/cliente/
├── layouts/
│   └── app.blade.php              # Layout principal
├── partials/
│   ├── navbar.blade.php           # Barra de navegação
│   └── footer.blade.php           # Rodapé
├── home.blade.php                 # Página inicial (tela inicial)
├── modelos.blade.php              # Página de modelos (listagem de veículos)
└── veiculo-detalhes.blade.php     # Detalhes de um veículo específico
```

## 🎨 Arquivos CSS (já existentes)

```
public/FrontCliente/css/
├── base.css                       # Estilos globais e base
├── style.css                      # Estilos da home
├── components/
│   ├── navbar.css                 # Estilos da navbar
│   ├── footer.css                 # Estilos do footer
│   └── cards.css                  # Estilos dos cards
└── pages/
    ├── home.css                   # Estilos específicos da home
    └── modelos.css                # Estilos da página modelos
```

## 🛣️ Rotas Criadas

### Front-End (Cliente)
- `GET /` → Home (Tela Inicial)
- `GET /modelos` → Listagem de Modelos
- `GET /veiculo/{id}` → Detalhes do Veículo
- `POST /newsletter/subscribe` → Inscrição na Newsletter

### Autenticação do Cliente
- `GET /cliente/login` → Login do Cliente
- `GET /cliente/register` → Registro do Cliente
- `GET /cliente/dashboard` → Dashboard do Cliente (autenticado)
- `POST /cliente/logout` → Logout

### Admin (Backend)
- `GET /admin/categoria` → Categorias
- `GET /admin/clientes` → Listagem de Clientes (Admin)
- `POST /admin/clientes` → Criar Cliente
- `PUT /admin/clientes/{id}` → Atualizar Cliente
- `DELETE /admin/clientes/{id}` → Deletar Cliente

## 🎯 Controllers

### ClienteFrontController
Localização: `app/Http/Controllers/Cliente/ClienteFrontController.php`

Métodos:
- `home()` - Página inicial com últimos 6 veículos
- `modelos()` - Lista todos os veículos disponíveis (paginado)
- `show($id)` - Exibe detalhes de um veículo
- `newsletterSubscribe()` - Processa inscrição na newsletter

## 🔐 Autenticação

### Guard Cliente
Configurado em `config/auth.php`:
- **Guard**: `cliente`
- **Provider**: `clientes`
- **Model**: `App\Models\Cliente`

### Uso:
```php
// Login
Auth::guard('cliente')->attempt($credentials);

// Verificar autenticação
Auth::guard('cliente')->check();

// Obter cliente logado
Auth::guard('cliente')->user();

// Logout
Auth::guard('cliente')->logout();
```

## 📊 Models

### Veiculo
Campos principais:
- marca, modelo, ano_fabricacao, ano_modelo
- placa, cor, tipo, chassi, renavam
- quilometragem, combustivel, cambio, portas, motor
- preco_compra, preco_venda, status, categoria
- descricao, observacoes, data_aquisicao

Status possíveis: Disponível, Vendido, Reservado, Em Manutenção, Indisponível

### Cliente
Extends `Authenticatable` - Pode fazer login
Campos:
- nome, email, password, telefone, CPF, DataNasc
- email_verified_at, remember_token

## 🎨 Componentes Blade

### Layout Principal (`layouts/app.blade.php`)
- Estrutura base com head, navbar, main, footer
- Suporte a @stack('styles') e @stack('scripts')
- Section @yield('content') para conteúdo

### Navbar (`partials/navbar.blade.php`)
- Logo clicável
- Links de navegação
- Menu de autenticação (Login/Logout)
- Responsivo com Bootstrap

### Footer (`partials/footer.blade.php`)
- Informações da empresa
- Links úteis
- Redes sociais
- Formulário de newsletter
- Copyright dinâmico

## 🚀 Como Usar

### 1. Exibir a Home
```
http://localhost:8000/
```

### 2. Ver Modelos
```
http://localhost:8000/modelos
```

### 3. Ver Detalhes de um Veículo
```
http://localhost:8000/veiculo/1
```

## 📝 Notas Importantes

1. **Imagens**: As views estão usando imagens placeholder. Você pode adicionar imagens reais na pasta `public/FrontCliente/TelaInicial/`

2. **Dados Dinâmicos**: As views já estão preparadas para receber dados do banco através dos controllers

3. **Paginação**: A página de modelos usa paginação (12 veículos por página)

4. **Filtros**: Apenas veículos com status "Disponível" são exibidos no front-end

5. **Relacionamentos**: A página de detalhes mostra veículos relacionados (mesma marca)

## ✨ Próximos Passos

- [ ] Criar views de login e registro do cliente
- [ ] Implementar sistema de busca/filtros de veículos
- [ ] Adicionar upload de múltiplas imagens por veículo
- [ ] Implementar carrinho de favoritos
- [ ] Sistema de agendamento de test drive
- [ ] Integração com WhatsApp para contato
