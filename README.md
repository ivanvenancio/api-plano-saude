# Api Plano Saúde
API simples com Laravel 8 - Crud tabela Clientes relacionamento many to many com tabela Planos

## Tabelas
* clientes - (nome string, email string,data_nascimento date,telefone string,estado string,cidade string)
* users - Tabela default
* planos - (nome string, valor decimal)
* cliente_plano - tabela pivot (cliente_id, plano_id)


## Instruções para instalação via Docker do ambiente de desenvolvimento

### Preparação do ambiente

```sh
$ git clone https://github.com/ivanvenancio/api-plano-saude.git
```
### Na pasta do projeto:

```sh
$ docker-compose build
$ docker-compose up -d
```

### Entrar na instância do docker
```sh
$ docker-compose exec app bash
```

### Baixar dependencias do projeto  e fazer as demais configurações dentro da instância
#### Baixar dependencias
```sh
$ composer install
```
#### Copiar o .env
```sh
$ cp .env.example .env
```
caso necessite, mas normalmente  o composer já copia o .env, no .env.example já tem as configurações de banco, chaves (APP_KEY e JWT_SECRET).

#### Gerar as key
Caso queira mudar no .env copiada já tem as key 
```sh
$ php artisan key:generate
```
```sh
$ php artisan jwt:secret
```

#### Permissões (se tiver com problema de permissão na storage)

```sh
$ chmod 777 -R storage
``` 

#### Rodar as tabelas do banco de dados
Comando vai criar as tabelas e dar uma carga, caso não queira, comentar a chamada dos seeders nos migrates (CreatePlanosTable, CreateClientePlanoTable)

```sh
$ php artisan migrate
```
## Docuumentação
### URLS do projeto
$ URL Base: http://localhost:9090/api
URL phpMyAdmin: http://localhost:9797

### Autenticação
Foi usada a autenticação com a lib [jwt-auth](https://jwt-auth.readthedocs.io/en/develop/)

### Endpoints
Todos os endpoints precisam de autenticação com excessão do login
#### Login
Usuario de Teste para logar e pegar o token Bearer
$ usuário = user@user.com
$ senha = 123mudar
$ endpoint = http://localhost:9090/api/login
$ POST
```sh
{
	"email" : "user@user.com",
	"password" : "123mudar"
}
```
#### Todos os clientes
$ endpoint = http://localhost:9090/api/clientes
$ GET

#### Busca cliente
$ endpoint = http://localhost:9090/api/clientes/{{cliente_id}}
$ GET

#### Criar novo cliente
$ endpoint = http://localhost:9090/api/clientes
$ POST
```sh
{
	"nome" : "Usuário Teste",
	"data_nascimento" : "1998-05-19",
	"email" : "teste@teste.com.br",
	"telefone" : "119456456123",
	"estado" : "São Paulo",
	"cidade" : "São Paulo"
}
```

#### Atualizar cliente
$ endpoint = http://localhost:9090/api/clientes/{{cliente_id}}
$ PUT
```sh
{
	"telefone" : "11456789123"
}
```

#### Deletar cliente
$ endpoint = http://localhost:9090/api/clientes/{{cliente_id}}
$ DELETE

#### Contratar Plano
$ endpoint = http://localhost:9090/api/cliente/plano
$ POST
```sh
{
	"plano" : 1,
	"cliente" : 4
}
