# Projeto Yii2 - TESTE

## Descrição
Teste de desenvolvimento em Yii2 Framework

## Configuração do Ambiente

### Pré-requisitos
- Docker instalado

Iniciando o Servidor
Para iniciar o servidor Yii2, execute o seguinte comando na raiz do projeto:  

```bash
docker-compose up
```
O servidor estará disponível em http://localhost:8000.

### Comando para Executar Migrações
Para aplicar as migrações e configurar o banco de dados, execute o seguinte comando Yii2:

```bash
docker-compose exec php php yii migrate/up --interactive=0
```

## Comandos Úteis
Criar Usuário
Para criar um usuário administrativo, execute o seguinte comando Yii2:

```bash
docker-compose exec php php yii create-user --username=admin --password=secret --name="Admin User"
```
Substitua admin, secret e Admin User pelos valores desejados para o novo usuário

# Testando as APIs
## Login
URL: http://localhost:8000/user/login

Método: POST

Body: {"username": "yourusername", "password": "yourpassword"}

## Retorna o Token:
{
    "token": "uAmf_oIFAmAYtSMoa-CylIk-GQTMZuLM"
}

## Cadastro de Cliente

URL: http://localhost:8000/client/create

Método: POST

Headers: Authorization: Bearer {token}

Body: {"name": "Client Name", "cpf": "12345678901", "address": "Address", "city": "City", "state": "State", "zip": "12345-678", "photo": "photo.jpg", "gender": "M"}

## Retorna as Informações do CLiente Cadastrado

{
    "message": "Cliente criado com sucesso",
    "client": {
        "name": "Nome do Cliente",
        "cpf": "1245",
        "address": "Endereço",
        "city": "Cidade",
        "state": "Estado",
        "zip": "12345-678",
        "photo": "foto.png",
        "gender": "M",
        "id": 1
    }
}

## Listar Clientes

URL: http://localhost:8080/client

Método: GET

Headers: Authorization: Bearer {token}

## Listar Clientes Paginados

URL: http://localhost:8000/client/list?page=2

Método: GET

Headers: Authorization: Bearer {token}

## Cadastro de Produto
URL: http://localhost:8000/product/create

Método: POST

Headers: Authorization: Bearer {token}

Body: {"name": "Product Name", "price": 100.00, "client_id": 1, "photo": "produto.jpg"}

## Resultado Produto Criado com o Id

{
    "name": "Nome do Produto",
    "price": 99.99,
    "client_id": 1,
    "photo": "produto.png",
    "id": 2
}

## Listar Todos os Produtos

URL: http://localhost:8080/product

Método: GET

Headers: Authorization: Bearer {token}

## Listar Produtos Paginados

URL: http://localhost:8000/product/list?page=2

Método: GET

Headers: Authorization: Bearer {token}

## Listar Produto Filtrado pelo cliente

URL: http://localhost:8000/product/list?client_id=1

Método: GET

Headers: Authorization: Bearer {token}



