# Setup Docker com Autenticação Laravel Sanctum Para Projetos Laravel
[Inspirado em EspecializaTI](https://academy.especializati.com.br)

### Passo a passo

Clone o repositório

Crie o Arquivo .env
```sh
cp .env.example .env
```

Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME="Laravel 11 com Autenticação"
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```

Suba os containers do projeto
```sh
docker compose up -d
```


Acessar o container
```sh
docker compose exec app bash
```


Instalar as dependências do projeto
```sh
composer install
```

Rodar as migrations do projeto
```sh
php artisan migrate
```

Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

# Acessar o Projeto

Para acessar o projeto, utilize o seguinte link:

- [Projeto](http://localhost:8989)

# Acessar o PHPMyAdmin

Para acessar o PHPMyAdmin, utilize o seguinte link:

- [PHPMyAdmin](http://localhost:8080)

## Credenciais

- **Usuário:** `DB_USERNAME`
- **Senha:** `DB_PASSWORD`

Importar a collection de rotas que estão na raiz do projeto em: 

```json
Auth.postman_collection.json
```


# Changelogs

### Atualizado para Laravel 12