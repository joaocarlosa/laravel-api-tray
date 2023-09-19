## Instalação
```sh
git clone https://github.com/joaocarlosa/laravel-api-tray.git
```

```sh

./vendor/bin/sail up -d
```

```sh
./vendor/bin/sail exec laravel.test bash
```

```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```

## Autenticação

Todos os endpoints, exigem autenticação por meio de Bearer Token que deve ser enviado no header da requisição.

## Endpoints

### Users

Cria um novo usuário.

Endpoint: POST `/register`

```sh
curl -X POST -H "Content-Type: application/json" -d
'{
    "name": "John Doe",
    "email": "user@email.com",
    "password": "password",
    "password_confirmation": "password"
}'
http://localhost:8000/register

```
Retorno:

```json
{
"data": {
    "id": 1,
    "name": "John Doe",
    "email": "user@email.com",
    "created_at": "2023-09-19T19:25:32.000000Z",
    "updated_at": "2023-09-19T19:25:32.000000Z"
}
}
```

### Login na api
Endpoint para logar na aplicação, seu retorno será o Bearer Token

Endpoint: GET `/login`

```sh
curl -X POST -H "Content-Type: application/json" -d
http://localhost:8000/login

```
Retorno:

```json
{
	"token": "1|M4z4XVTqLZlmHR1gcSF4YRwxlvUyqaMzpxl4KDOJ00d67d78"
}
```

#### Sales:

Recuperar todas as vendas
Endpoint: GET `/api/sales`


```sh
curl -X GET -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/sales

```

Retorno:

```json
{
"data": [
    {
        "id": 7,
        "seller_id": 27,
        "value": "620.70",
        "commission": "52.76",
        "sale_date": "1971-07-05"
    },
    {
        "id": 8,
        "seller_id": 28,
        "value": "889.35",
        "commission": "41.12",
        "sale_date": "2007-12-28"
    },
]}

```

### Recuperar as vendas de um vendedor
Endpoint: GET `/api/sale/seller/{id}`

```sh
curl -X GET -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/sale/seller/$ID

```

### Criar uma nova venda
Endpoint: POST `/api/sale`

```sh
curl -X POST -H "Content-Type: application/json" -H "Authorization: Bearer seu_token_aqui" -d
'{
  "seller_id": 1,
  "value": 1000.50,
  "sale_date": "2023-09-15"
}'
http://localhost/sale

```

### Atualizar uma venda existente
Endpoint: PUT `/sales/{id}`

```sh
curl -X PUT -H "Content-Type: application/json" -H "Authorization: Bearer seu_token_aqui" -d
'{
  "value": 900.75
}'
http://localhost:8000/sales/$ID

```
Retornos de GET, POST e PUT:

```json
{
"data": {
    "id": 1,
    "seller_id": 1,
    "value": 900.75,
    "commission": 76.56375,
    "sale_date": "2023-09-18"
}
}

```

### Remover uma venda
Endpoint: DELETE `/sales/{id}`

```sh
curl -X DELETE -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/sales/$ID

```

Retorno:

```json
{
{
"success": true,
"data": true,
"message": "Deleted successfully"
}
}
```


#### Sellers:

Recuperar todas os vendedores
Endpoint: GET `/api/sellers`


```sh
curl -X GET -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/sellers

```

Retorno:

```json
{
"data": [{
        "id": 3,
        "name": "Lilly Jenkins",
        "email": "allie51@example.com",
        "created_at": "2023-09-18T17:44:20.000000Z",
        "updated_at": "2023-09-18T17:44:20.000000Z"
    },
    {
        "id": 4,
        "name": "Salvador West Jr.",
        "email": "schneider.jaunita@example.org",
        "created_at": "2023-09-18T17:44:20.000000Z",
        "updated_at": "2023-09-18T17:44:20.000000Z"
    }]
}

```

### Recuperar um vendedor
Endpoint: GET `/api/sale/seller/{id}`

```sh
curl -X GET -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/seller/$ID

```

### Criar um novo vendedor
Endpoint: POST `/api/seller`

```sh
curl -X POST -H "Content-Type: application/json" -H "Authorization: Bearer seu_token_aqui" -d
'{
    "name": "John Doe",
    "email": "user@email.com"
}'
http://localhost/seller

```

### Atualizar um vendedor existente
Endpoint: PUT `/seller/{id}`

```sh
curl -X PUT -H "Content-Type: application/json" -H "Authorization: Bearer seu_token_aqui" -d
'{
    "name": "John Doe",
    "email": "user@email.com"
}'
http://localhost:8000/seller/$ID

```
Retornos de GET, POST e PUT:

```json
{
"data": {
    "id": 1,
    "name": "Yasmeen Gislason",
    "email": "gus8@example.com",
    "created_at": "2023-09-18T17:44:20.000000Z",
    "updated_at": "2023-09-18T17:44:20.000000Z"
}
}

```


### Enviar email com resumo de vendas do dia
Endpoint: GET `/summary-email`

```sh
curl -X GET -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/summary-email

```


### Enviar email para o administrador
Endpoint: GET `/send-admin-sales`

```sh
curl -X GET -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/send-admin-sales

```


### Renviar email com vendas de um vendedor
Endpoint: POST `/resend-summary-email/<id>`

```sh
curl -X POST -H "Authorization: Bearer seu_token_aqui"
http://localhost:8000/resend-summary-email/1

```


