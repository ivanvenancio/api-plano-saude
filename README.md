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
## Baixar dependencias
```sh
$ composer update
```
## Copiar o .env
```sh
$ cp .env.example .env
```
as configurações de banco de dados já estão setadas

## Gerar a key
```sh
$ php artisan key:generate
```

## Permissões (se tiver com problema de permissão na storage)

```sh
$ chmod 777 -R storage
``` 

## Rodar as tabelas do banco de dados
Comando vai criar as tabelas e dar uma carga, caso não queira, comentar a chamada dos seeders nos migrates (CreatePlanosTable, CreateClientePlanoTable)

```sh
$ php artisan migrate --seed
```
