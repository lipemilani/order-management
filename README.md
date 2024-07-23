## Order Management

Projeto de Desafio Comerc

## Tecnologias Utilizadas

- *PHP 8.3*: Linguagem de programação server-side utilizada no projeto.
- *Laravel 11*: Framework PHP utilizado para o desenvolvimento da aplicação.
- *MySQL*: Banco de dados relacional utilizado para armazenar os dados da aplicação.

## Como Subir o Projeto

Siga os passos abaixo para subir o projeto localmente:

1. Clone o repositório do projeto:
   bash
   git clone https://github.com/lipemilani/order-management.git


2. Navegue até o diretório do projeto:
   bash
   cd order-management


3. Configure o arquivo .env com as suas variáveis de ambiente. Um exemplo de .env pode ser encontrado em .env.example.


4. Execute este comando:
   bash
   sudo chmod +x start.sh


5. Suba os containers do Docker:
   bash
   docker-compose up --build -d


6. Execute as migrações do banco de dados:
   bash
   docker-compose exec app php artisan migrate

7. Execute as seeders do banco de dados:
   bash
   docker-compose exec app php artisan db:seed

* Será criado um usuario teste para se autenticar: 
  Email: test@example.com Senha: password

* Será criado varios produtos na tabela products


9. Gerar token de autenticação:
* POST: http://127.0.0.1:8000/oauth/token
* BODY: {
  "grant_type": "password",
  "client_id": 1, // Pegar essa informação na tabela oauth_clients
  "client_secret": "", Pegar essa informação na tabela oauth_clients
  "username": "test@example.com",
  "password": "password",
  "scope": "*"
  }
* Com o token gerado, você poderá se autenticar em todas as todas da aplicação


10. Rotas:
* Customer:
- Index - GET /api/customers
- Create - POST /api/customers
- Update - PUT /api/customers/uuid
- Show - GET /api/customers/uuid
- Delete - DEL /api/customers/uuid
- Restore - PUT /api/customers/uuid/restore

* Product:
- Index - GET /api/products
- Create - POST /api/products
- Update - PUT /api/products/uuid
- Show - GET /api/products/uuid
- Delete - DEL /api/products/uuid
- Restore - PUT /api/products/uuid/restore

* Order:
- Create - Post /api/orders
- Delete - Del /api/orders
