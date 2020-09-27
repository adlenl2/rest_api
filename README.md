# REST API - Developer CRUD

Ambiente dockerizado contendo uma REST API montado com:
* [PHP 7.4](https://hub.docker.com/_/php)
* [Nginx 1.19](https://hub.docker.com/_/nginx)
* [MySQL 5.7](https://hub.docker.com/_/mysql)

REST API desenvolvida em PHP utilizando o framework [Lumen](https://lumen.laravel.com/).

## Instalação

Clone este repositório

```bash
git clone https://github.com/adlenl2/rest_api
cd dev_api
```

Utilize o docker para buildar e subir as imagens configuradas no docker-compose.yml.

```bash
docker-compose up --build
```

## Utilização

Ao instanciar os containers a partir do docker, a REST API já está pronta para receber os requests, mas primeiro é necessário utilizar o composer para atualizar as dependências do lumen e criar o banco de dados. 

Para isso vamos executar o bash no container da API e utilizar o composer e o artisan.

```bash
docker exec -it api bash
# inside the container
composer update -vvv
php artisan migrate --seed
```

Após isso, nesta mesma seção, podem ser executados os testes unitários do PHPUNIT pelo comando abaixo
```bash
vendor/bin/phpunit
```

A partir deste momento a API pode ser consumida através do endereço [http://localhost/api/](http://localhost/api/). Foram tratados os seguintes casos:
* GET /developers - Retorna todos os desenvolvedores
* GET /developers?parametros_busca - Retorna os desenvolvedores de acordo com a busca por querystring, exemplo: "?idade=22"
* GET /developers/{id} - Retorna os dados de um desenvolvedor pelo ID
* POST /developers - Cria um novo desenvolvedor
* PUT /developers/{id} - Altera os dados de um desenvolvedor
* DELETE /developers/{id} - Remove um desenvolvedor

## Documentação e Código fonte

O código elaborado encontra-se integralmente dentro da pasta **lumen**

Controller e Model podem ser encontrados nas pastas **app** e **app/Http/Controller**.

A estrutura da tabela criada, os seeds de teste estão na pasta **database**.

Os testes unitários estão no diretório **tests**.

## License

Código elaborado por Adlen Lucas Cachuba.

[MIT](https://choosealicense.com/licenses/mit/)