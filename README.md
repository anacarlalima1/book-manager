# 📚 Book Manager System

Bem-vindo ao **Book Manager System**! Este projeto foi desenvolvido para gerenciar registros de livros com funcionalidades como criação, edição, exclusão e exibição de detalhes. Utilizamos uma abordagem baseada em boas práticas, incluindo padrões de design como **Repository Pattern** e separação de responsabilidades. O sistema utiliza Laravel no backend e Blade para renderização de views no frontend.

---

## 🛠 Tecnologias Utilizadas

- **PHP 8.2**: Linguagem de programação principal utilizada no backend.
- **Laravel 11**: Framework PHP para desenvolvimento rápido, com foco em organização e escalabilidade.
- **Docker**: Ambiente containerizado para fácil configuração e execução.
- **MySQL**: Banco de dados relacional para armazenar os registros de livros.
- **Bootstrap 5**: Framework CSS para estilização e responsividade.
- **Font Awesome**: Biblioteca de ícones para visualização intuitiva.

---

## ⚙️ Funcionalidades

- **Listagem de Livros**: Exibe todos os livros cadastrados em uma tabela.
- **Adicionar Livros**: Formulário para criar novos registros de livros.
- **Editar Livros**: Funcionalidade para alterar dados de livros existentes.
- **Excluir Livros**: Permite remover livros com confirmação via modal.
- **Paginação Customizada**: Interface amigável e estilizada para navegação entre páginas.
- **404 Personalizado**: Página de erro customizada para rotas inexistentes.
- **Eventos e Filas**: Implementação de eventos para notificar a criação de livros via e-mail.

---

## 🧱 Arquitetura do Projeto

Adotamos uma estrutura organizada baseada no **Repository Pattern** para facilitar a manutenção e escalabilidade.

### 📂 Estrutura de Diretórios

```bash
.
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Controladores para gerenciar as requisições
│   │   ├── Requests/           # Validações de formulários
│   ├── Repositories/           # Implementação do padrão Repository
│   ├── Services/               # Regras de negócio centralizadas
│   ├── Events/                 # Eventos do sistema (ex: BookCreated)
│   ├── Listeners/              # Escutadores para os eventos (ex: SendBookCreatedEmail)
├── database/
│   ├── migrations/             # Scripts para criação das tabelas do banco de dados
│   ├── seeders/                # Dados iniciais para popular o banco
├── resources/
│   ├── views/                  # Arquivos Blade para renderização do frontend
│       ├── books/              # Views específicas para o módulo de livros
│       ├── layouts/            # Layouts gerais
│   ├── sass/                   # Estilizações customizadas
├── routes/
│   ├── web.php                 # Rotas do sistema
├── tests/
│   ├── Unit/                   # Testes unitários
│   ├── Feature/                # Testes de integração
└── docker-compose.yml          # Configuração do Docker

# 📚 Como Executar o Projeto

Este guia detalha os passos para configurar e executar o projeto **Book Manager System** utilizando Docker e Laravel.

---

## 🛠 Pré-requisitos

Certifique-se de ter as seguintes ferramentas instaladas na sua máquina:

- **Docker**: Para criar e gerenciar os contêineres.
- **Docker Compose**: Para orquestrar os contêineres.
- **Node.js & npm** (opcional, se rodar fora do Docker): Para instalar as dependências do frontend.

---

## 🚀 Passo a Passo

### 1. Clone o Repositório

```bash
git clone https://github.com/anacarlalima1/book-manager.git
cd book-manager

## 🛠 Configuração do Arquivo `.env`

Crie o arquivo `.env` baseado no exemplo fornecido:

```bash
cp .env.example .env
Atualize as configurações do banco de dados no arquivo .env:

env
Copiar código
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=bookmanager
DB_USERNAME=root
DB_PASSWORD=root
Para testes, crie o arquivo .env.testing:

```bash
cp .env.example .env.testing
Atualize as configurações no arquivo .env.testing para usar um banco de dados diferente:

```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=bookmanagertesting
DB_USERNAME=root
DB_PASSWORD=root
Gere a chave da aplicação:

```bash
php artisan key:generate

## 🐳 Subir os Contêineres com Docker
Inicie os serviços utilizando o Docker:

```bash
docker-compose up --build -d
Os contêineres configurados incluem:

App (Laravel): Servidor PHP para executar o Laravel.
MySQL: Banco de dados relacional para armazenar os registros.
Verifique os contêineres em execução:

```bash
docker ps

## 📦 Instalar Dependências do Laravel
Acesse o contêiner do Laravel:

```bash
docker exec -it book_manager_app bash

Dentro do contêiner, instale as dependências do Laravel:

```bash
composer install

🗄️ Configuração do Banco de Dados
Aplique as migrações para criar as tabelas no banco de dados:

```bash
php artisan migrate
Popule o banco de dados com dados iniciais:

```bash
php artisan db:seed

** **🚀 Inicie o Servidor
Para iniciar o servidor Laravel, execute:

```bash
php artisan serve
O servidor estará disponível em: http://localhost:8000

🛠 Comandos Úteis
Gerenciamento do Docker
Subir os contêineres:

```bash
docker-compose up --build -d
Parar os contêineres:

```bash
docker-compose down
Acessar o contêiner do Laravel:

```bash
docker exec -it book_manager_app bash
Visualizar logs de um contêiner:

```bash
docker logs <container_name>
Laravel
Aplicar migrações:

```bash
php artisan migrate
Rodar seeds:

```bash
php artisan db:seed
Limpar cache de configuração:

```bash
php artisan config:clear
Gerar cache de configuração:

```bash
php artisan config:cache

## 🧪 Testes
Rodar Testes Automatizados
Execute todos os testes automatizados:

```bash
php artisan test
Configuração do Banco de Dados de Teste
Certifique-se de que o banco de testes está configurado corretamente no arquivo .env.testing. Aplique as migrações no ambiente de testes:

```bash
php artisan migrate --env=testing

