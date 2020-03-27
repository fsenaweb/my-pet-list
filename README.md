# TLO Pets API
Criar uma api para cadastrar pets, proprietários e raças.

## Setup
``` bash
$ git clone git@bitbucket.org:fsenaweb/tlo-teste.git
```
Após baixar o repositório, terão 2 pastas (backend e frontend), cada um possui suas configurações, que serão explicadas abaixo:
### Backend:

Será necessário verificar as configurações no arquivo docker-compose.yml e configurar as variáveis de sua preferência, ou deixar como está, após isso, 
execute o comando **docker-compose**:
``` bash
$ docker-compose up -d
```

Este comando irá criar os containers. Então, ele instalará as dependências necessárias para iniciar o servidor de desenvolvimento. 
O ambiente de desenvolvimento estará disponível em  *http://localhost:8000* (ou em outra porta que você configurar). 
Você pode usar o IP do Docker Machine (*http://192.168.99.100* por padrão) dependendo do seu sistema operacional.
Para acessar o PHPMyAdmin, estará disponível em *http://localhost:8080* e você pode utilizar as credenciais que estão no arquivo docker-compose.yml .

## Utilização

### Iniciando o servidor de desenvolvimento
Depois de utilizar o comando `docker-compose up -d` sua aplicação estará disponível em `localhost: 8000`.

### Acesso aos comandos do laravel
* Inicialmente tem que executar o container que contém os dados do laravel: `docker exec -it {CONTAINER_ID} bash`  

Com o container aberto, executar o comando `composer install`, após esse comando, executar as migrations (com os dados fictícios "seed")do laravel `php artisan migrate --seed`

Pronto, a api estará pronta para funcionamento.

###Frontend:

O front não está rodando no container, por isso é importante ter instalado na máquina o node.js, o npm (ou yarn) para executar os comandos abaixo:

O processo do front é bem mais simples. Após a pasta `frontend` , instalar as dependências: 

```
yarn install
ou
npm install
```
Após a instalação das dependências, a aplicação pode rodar em modo de desenvovimento: 

```
yarn serve
ou
npm run serve
```
Ou se preferir, pode fazer o build (que ficará na pasta /dist) da aplicação:4

```
yarn build
ou
npm run build
```

A aplicação será servida no endereço http://locahost:8080 (ou 8081 caso a primeira esteja sendo utilizada).

