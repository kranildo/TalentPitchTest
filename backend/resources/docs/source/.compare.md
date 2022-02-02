---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://dev.api.com/docs/collection.json)

<!-- END_INFO -->

#OAuth

APIs para controle de autorização
<!-- START_a9aa957c66437e22b90086d9584392f4 -->
## Revogar token do Usuário logado
Endpoint para faz logout do usuario revogando o token

> Example request:

```bash
curl -X GET \
    -G "http://dev.api.com/api/v1/oauth/sair" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/sair"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Você foi desconectado com sucesso",
    "data": [],
    "errors": []
}
```
> Example response (401):

```json
null
```
> Example response (404):

```json
{
    "status": 404,
    "message": "Dados não encontrados",
    "data": [],
    "errors": []
}
```

### HTTP Request
`GET api/v1/oauth/sair`


<!-- END_a9aa957c66437e22b90086d9584392f4 -->

#User

APIs para gerenciamento de usuários
<!-- START_53d698edc8d112775ead6dea81f2c1b2 -->
## Criar Usuário
Endpoint para criar usuário

> Example request:

```bash
curl -X POST \
    "http://dev.api.com/api/v1/user/criar" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"name":"Ricardo Gomez","email":"ricardo@assys.com.br","password":"asdf1234","password_confirmation":"asdf1234"}'

```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/user/criar"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "name": "Ricardo Gomez",
    "email": "ricardo@assys.com.br",
    "password": "asdf1234",
    "password_confirmation": "asdf1234"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "status": 201,
    "message": "Salvo com sucesso",
    "data": {
        "name": "ricardo",
        "email": "ricardo@assys.com.br",
        "updated_at": "2021-03-15T22:04:29.000000Z",
        "created_at": "2021-03-15T22:04:29.000000Z",
        "id": 14
    },
    "errors": []
}
```
> Example response (304):

```json
{
    "status": 304,
    "message": "Erro ao salvar",
    "data": [],
    "errors": []
}
```
> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```
> Example response (403):

```json
{
    "status": 403,
    "message": "Sem permissão",
    "data": [],
    "errors": []
}
```
> Example response (422):

```json
{
    "status": 422,
    "message": "Erro de validação",
    "data": [],
    "errors": {
        "fieldeName1": [
            "The fieldeName1 field is required."
        ],
        "fieldeName2": [
            "The fieldeName2 field is required.",
            "The fieldeName2 must be at least 8 characters."
        ]
    }
}
```

### HTTP Request
`POST api/v1/user/criar`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Nome do Usuário.
        `email` | e-mail |  required  | E-mail do Usuário.
        `password` | string |  required  | Senha do usuário.
        `password_confirmation` | string |  required  | Confirmação da senha do usuário.
    
<!-- END_53d698edc8d112775ead6dea81f2c1b2 -->

<!-- START_016c7ec55a95952f3e6af02729042b6b -->
## Buscar Usuários
Endpoint para localizar usuários, retorna uma lista com todos usuários compatíveis com os parâmetros da busca. Recomendado para data Grids, Filtros e Relatórios.

Compatível com paginação e ordenação

> Example request:

```bash
curl -X POST \
    "http://dev.api.com/api/v1/user/buscar?page=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"name":"Ricardo","email":"ricardo@assys.com.br","per_page":10,"order_by":"name","order_sorted":"ASC"}'

```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/user/buscar"
);

let params = {
    "page": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "name": "Ricardo",
    "email": "ricardo@assys.com.br",
    "per_page": 10,
    "order_by": "name",
    "order_sorted": "ASC"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```
> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```
> Example response (403):

```json
{
    "status": 403,
    "message": "Sem permissão",
    "data": [],
    "errors": []
}
```
> Example response (404):

```json
{
    "status": 404,
    "message": "Dados não encontrados",
    "data": [],
    "errors": []
}
```

### HTTP Request
`POST api/v1/user/buscar`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  optional  | int Indice da paginação.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  optional  | Nome do Usuário.
        `email` | e-mail |  optional  | E-mail do Usuário.
        `per_page` | integer |  optional  | Quantida de itens por pagina.
        `order_by` | string |  optional  | Coluna para ordenar os resultados.
        `order_sorted` | ASC,DESC |  optional  | Definir a ordenação com crescente ou decrescente.
    
<!-- END_016c7ec55a95952f3e6af02729042b6b -->

<!-- START_ed6b198510e41a5fcb3c14af04265606 -->
## Listar Usuários
Endpoint para localizar usuários, retorna uma lista com todos usuários compatíveis com os parâmetros da busca. Recomendado para listas, Selects e Auto complete.

Compatível com ordenação. NÃO e compatível com paginação.

> Example request:

```bash
curl -X POST \
    "http://dev.api.com/api/v1/user/listar" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"name":"Ricardo","email":"ricardo@assys.com.br","order_by":"name","order_sorted":"ASC"}'

```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/user/listar"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "name": "Ricardo",
    "email": "ricardo@assys.com.br",
    "order_by": "name",
    "order_sorted": "ASC"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```
> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```
> Example response (404):

```json
{
    "status": 404,
    "message": "Dados não encontrados",
    "data": [],
    "errors": []
}
```

### HTTP Request
`POST api/v1/user/listar`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  optional  | Nome do Usuário.
        `email` | e-mail |  optional  | E-mail do Usuário.
        `order_by` | string |  optional  | Coluna para ordenar os resultados.
        `order_sorted` | ASC,DESC |  optional  | Definir a ordenação com crescente ou decrescente.
    
<!-- END_ed6b198510e41a5fcb3c14af04265606 -->

<!-- START_f4f14661497117b51e562d2fc0225faf -->
## Exibir Usuário
Endpoint para pegar os dados de um usuário através do Id. Recomendado para mostra dados ou montar formulário de edição.

> Example request:

```bash
curl -X GET \
    -G "http://dev.api.com/api/v1/user/exibir/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/user/exibir/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Dados encontrados",
    "data": {
        "id": 1,
        "name": "admin",
        "email": "desenvolvimento@assys.com.br",
        "email_verified_at": null,
        "remember_token": null,
        "created_at": "2021-03-15T02:23:05.000000Z",
        "updated_at": "2021-03-15T02:23:05.000000Z",
        "deleted_at": null
    },
    "errors": []
}
```
> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```
> Example response (403):

```json
{
    "status": 403,
    "message": "Sem permissão",
    "data": [],
    "errors": []
}
```
> Example response (404):

```json
{
    "status": 404,
    "message": "Dados não encontrados",
    "data": [],
    "errors": []
}
```

### HTTP Request
`GET api/v1/user/exibir/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | Nome do Usuário.

<!-- END_f4f14661497117b51e562d2fc0225faf -->

<!-- START_397d09658f8872891dcfebe9ad860473 -->
## Editar Usuário
Endpoint para editar os dados de um usuário através do Id.

NÃO permite altera a senha do usuário

> Example request:

```bash
curl -X PUT \
    "http://dev.api.com/api/v1/user/editar/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"name":"Jose Maria","email":"jose.maria@assys.com.br"}'

```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/user/editar/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "name": "Jose Maria",
    "email": "jose.maria@assys.com.br"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (202):

```json
{
    "status": 202,
    "message": "Atualizado com sucesso",
    "data": {
        "id": 14,
        "name": "Jose Maria",
        "email": "jose.maria@assys.com.br",
        "email_verified_at": null,
        "remember_token": null,
        "created_at": "2021-03-15T22:04:29.000000Z",
        "updated_at": "2021-03-16T03:44:56.000000Z",
        "deleted_at": null
    },
    "errors": []
}
```
> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```
> Example response (403):

```json
{
    "status": 403,
    "message": "Sem permissão",
    "data": [],
    "errors": []
}
```
> Example response (404):

```json
{
    "status": 404,
    "message": "Dados não encontrados",
    "data": [],
    "errors": []
}
```
> Example response (422):

```json
{
    "status": 422,
    "message": "Erro de validação",
    "data": [],
    "errors": {
        "fieldeName1": [
            "The fieldeName1 field is required."
        ],
        "fieldeName2": [
            "The fieldeName2 field is required.",
            "The fieldeName2 must be at least 8 characters."
        ]
    }
}
```

### HTTP Request
`PUT api/v1/user/editar/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | Nome do Usuário.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  optional  | Nome do Usuário.
        `email` | e-mail |  optional  | E-mail do Usuário.
    
<!-- END_397d09658f8872891dcfebe9ad860473 -->

<!-- START_09ca497c6e2231bb60404a40612a9407 -->
## Alterar senha Usuário
Endpoint para alterar a senha de um usuário através do Id.

> Example request:

```bash
curl -X PUT \
    "http://dev.api.com/api/v1/user/alterar-senha/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"password":"1234asdf","password_confirmation":"1234asdf"}'

```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/user/alterar-senha/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "password": "1234asdf",
    "password_confirmation": "1234asdf"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (202):

```json
{
    "status": 202,
    "message": "Atualizado com sucesso",
    "data": {
        "id": 1,
        "name": "admin",
        "email": "desenvolvimento@assys.com.br",
        "email_verified_at": null,
        "remember_token": null,
        "created_at": "2021-03-15T02:23:05.000000Z",
        "updated_at": "2021-03-16T04:20:42.000000Z",
        "deleted_at": null
    },
    "errors": []
}
```
> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```
> Example response (403):

```json
{
    "status": 403,
    "message": "Sem permissão",
    "data": [],
    "errors": []
}
```
> Example response (404):

```json
{
    "status": 404,
    "message": "Dados não encontrados",
    "data": [],
    "errors": []
}
```
> Example response (422):

```json
{
    "status": 422,
    "message": "Erro de validação",
    "data": [],
    "errors": {
        "fieldeName1": [
            "The fieldeName1 field is required."
        ],
        "fieldeName2": [
            "The fieldeName2 field is required.",
            "The fieldeName2 must be at least 8 characters."
        ]
    }
}
```

### HTTP Request
`PUT api/v1/user/alterar-senha/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | Nome do Usuário.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `password` | string |  required  | Senha do usuário.
        `password_confirmation` | string |  required  | Confirmação da senha do usuário.
    
<!-- END_09ca497c6e2231bb60404a40612a9407 -->

<!-- START_34c68a7ebd9ffc568a0f842372fee1a6 -->
## Excluir Usuário
Endpoint para excluir um usuário através do Id.

> Example request:

```bash
curl -X DELETE \
    "http://dev.api.com/api/v1/user/excluir/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/user/excluir/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (204):

```json
null
```
> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```
> Example response (403):

```json
{
    "status": 403,
    "message": "Sem permissão",
    "data": [],
    "errors": []
}
```
> Example response (404):

```json
{
    "status": 404,
    "message": "Dados não encontrados",
    "data": [],
    "errors": []
}
```

### HTTP Request
`DELETE api/v1/user/excluir/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | Nome do Usuário.

<!-- END_34c68a7ebd9ffc568a0f842372fee1a6 -->

<!-- START_45aeb17347691bdaa310d46bd9d7a9f1 -->
## Buscar Usuários Excluidos
Endpoint para localizar usuários excluidos com softdelet, retorna uma lista com todos usuários compatíveis com os parâmetros da busca. Recomendado para data Grids, Filtros e Relatórios.

Compatível com paginação e ordenação

> Example request:

```bash
curl -X POST \
    "http://dev.api.com/api/v1/user/buscar-excluidos?page=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"name":"Ricardo","email":"ricardo@assys.com.br","per_page":10,"order_by":"name","order_sorted":"ASC"}'

```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/user/buscar-excluidos"
);

let params = {
    "page": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "name": "Ricardo",
    "email": "ricardo@assys.com.br",
    "per_page": 10,
    "order_by": "name",
    "order_sorted": "ASC"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```
> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```
> Example response (403):

```json
{
    "status": 403,
    "message": "Sem permissão",
    "data": [],
    "errors": []
}
```
> Example response (404):

```json
{
    "status": 404,
    "message": "Dados não encontrados",
    "data": [],
    "errors": []
}
```

### HTTP Request
`POST api/v1/user/buscar-excluidos`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  optional  | int Indice da paginação.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  optional  | Nome do Usuário.
        `email` | e-mail |  optional  | E-mail do Usuário.
        `per_page` | integer |  optional  | Quantida de itens por pagina.
        `order_by` | string |  optional  | Coluna para ordenar os resultados.
        `order_sorted` | ASC,DESC |  optional  | Definir a ordenação com crescente ou decrescente.
    
<!-- END_45aeb17347691bdaa310d46bd9d7a9f1 -->

<!-- START_35148461d7aae2a93d08cf85d883e946 -->
## Restaurar Usuário
Endpoint para restaurar um usuário excluido através do Id.

> Example request:

```bash
curl -X GET \
    -G "http://dev.api.com/api/v1/user/restaurar/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/user/restaurar/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "status": 201,
    "message": "Restaurado com sucesso",
    "data": {
        "id": 14,
        "name": "Jose Maria",
        "email": "jose.maria@assys.com.br",
        "email_verified_at": null,
        "remember_token": null,
        "created_at": "2021-03-15T22:04:29.000000Z",
        "updated_at": "2021-03-16T04:51:12.000000Z",
        "deleted_at": null
    },
    "errors": []
}
```
> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```
> Example response (403):

```json
{
    "status": 403,
    "message": "Sem permissão",
    "data": [],
    "errors": []
}
```
> Example response (404):

```json
{
    "status": 404,
    "message": "Dados não encontrados",
    "data": [],
    "errors": []
}
```

### HTTP Request
`GET api/v1/user/restaurar/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | Id do Usuário.

<!-- END_35148461d7aae2a93d08cf85d883e946 -->

<!-- START_3bf87a55eacd2924f295273ef6ab39e2 -->
## Pegar dados do Usuário logado
Endpoint para receber as informações do usuario logado

> Example request:

```bash
curl -X GET \
    -G "http://dev.api.com/api/v1/user/meus-dados" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/user/meus-dados"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": 200,
    "message": "Dados encontrados",
    "data": {
        "id": 1,
        "name": "ricardo",
        "email": "ricardo@assys.com.br",
        "email_verified_at": null,
        "remember_token": null,
        "created_at": "2021-03-24T22:15:25.000000Z",
        "updated_at": "2021-03-24T22:15:25.000000Z",
        "deleted_at": null
    },
    "errors": []
}
```
> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```
> Example response (404):

```json
{
    "status": 404,
    "message": "Dados não encontrados",
    "data": [],
    "errors": []
}
```

### HTTP Request
`GET api/v1/user/meus-dados`


<!-- END_3bf87a55eacd2924f295273ef6ab39e2 -->

#general


<!-- START_082270de255b970cfc68ebc1ca1261c7 -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl -X POST \
    "http://dev.api.com/api/v1/oauth/token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/oauth/token`


<!-- END_082270de255b970cfc68ebc1ca1261c7 -->

<!-- START_4d36b0a01c250bd4802d17c4e13eac73 -->
## Get all of the authorized tokens for the authenticated user.

> Example request:

```bash
curl -X GET \
    -G "http://dev.api.com/api/v1/oauth/tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```

### HTTP Request
`GET api/v1/oauth/tokens`


<!-- END_4d36b0a01c250bd4802d17c4e13eac73 -->

<!-- START_3aa5098c914c7f46e9af761cc02f9f7f -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE \
    "http://dev.api.com/api/v1/oauth/tokens/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/oauth/tokens/{tokenId}`


<!-- END_3aa5098c914c7f46e9af761cc02f9f7f -->

<!-- START_30389561b7c7ec6b1f6a55aa378412b3 -->
## Get a fresh transient token cookie for the authenticated user.

> Example request:

```bash
curl -X POST \
    "http://dev.api.com/api/v1/oauth/token/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/token/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/oauth/token/refresh`


<!-- END_30389561b7c7ec6b1f6a55aa378412b3 -->

<!-- START_e910a788d5dbd62d4fad4d86d5a2cbe1 -->
## Get all of the clients for the authenticated user.

> Example request:

```bash
curl -X GET \
    -G "http://dev.api.com/api/v1/oauth/clients" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/clients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```

### HTTP Request
`GET api/v1/oauth/clients`


<!-- END_e910a788d5dbd62d4fad4d86d5a2cbe1 -->

<!-- START_70b60149da1587bf078ad3a8505f4b54 -->
## Store a new client.

> Example request:

```bash
curl -X POST \
    "http://dev.api.com/api/v1/oauth/clients" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/clients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/oauth/clients`


<!-- END_70b60149da1587bf078ad3a8505f4b54 -->

<!-- START_f19c2bba4c0282272d1e2cc66da17305 -->
## Update the given client.

> Example request:

```bash
curl -X PUT \
    "http://dev.api.com/api/v1/oauth/clients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/oauth/clients/{clientId}`


<!-- END_f19c2bba4c0282272d1e2cc66da17305 -->

<!-- START_1c67363abd7f45f88b6f448e56077c98 -->
## Delete the given client.

> Example request:

```bash
curl -X DELETE \
    "http://dev.api.com/api/v1/oauth/clients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/oauth/clients/{clientId}`


<!-- END_1c67363abd7f45f88b6f448e56077c98 -->

<!-- START_612f500f8fa69218eb53deb7406d6064 -->
## Get all of the available scopes for the application.

> Example request:

```bash
curl -X GET \
    -G "http://dev.api.com/api/v1/oauth/scopes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/scopes"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```

### HTTP Request
`GET api/v1/oauth/scopes`


<!-- END_612f500f8fa69218eb53deb7406d6064 -->

<!-- START_935933a2d33dd06b66616685ef29230d -->
## Get all of the personal access tokens for the authenticated user.

> Example request:

```bash
curl -X GET \
    -G "http://dev.api.com/api/v1/oauth/personal-access-tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/personal-access-tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": 401,
    "message": "Não autorizado",
    "data": [],
    "errors": []
}
```

### HTTP Request
`GET api/v1/oauth/personal-access-tokens`


<!-- END_935933a2d33dd06b66616685ef29230d -->

<!-- START_daadea0d7a284c73cbae122ca9c9b1a4 -->
## Create a new personal access token for the user.

> Example request:

```bash
curl -X POST \
    "http://dev.api.com/api/v1/oauth/personal-access-tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/personal-access-tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/oauth/personal-access-tokens`


<!-- END_daadea0d7a284c73cbae122ca9c9b1a4 -->

<!-- START_35febc15272eadecd62453360e25bb53 -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE \
    "http://dev.api.com/api/v1/oauth/personal-access-tokens/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://dev.api.com/api/v1/oauth/personal-access-tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/oauth/personal-access-tokens/{tokenId}`


<!-- END_35febc15272eadecd62453360e25bb53 -->


