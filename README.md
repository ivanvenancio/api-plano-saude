# Api Plano Saúde
API simples com Laravel 8 - Crud tabela Clientes relacionamento many to many com tabela Planos

## Tabelas
* clientes - (nome string, email string,data_nascimento date,telefone string,estado string,cidade string)
* users - Tabela default
* planos - (nome string, valor decimal)
* cliente_plano - tabela pivot (cliente_id, plano_id)


## Instruções para instalação via Docker do ambiente de desenvolvimento

### Preparação do ambiente

1. Clonar o projeto
```sh
$ git clone https://github.com/ivanvenancio/api-plano-saude.git
```


  