# NekoERP

Sistema ERP minimalista com gestão de cupons e outras funcionalidades.
🛠️ Instalação
Pré-requisitos
- PHP ≥ 8.2
- Composer
- MySQL
- Git
- (Opcional) Docker & Docker Compose

## Clone do repositório

```
git clone https://github.com/messias-barreto/nekoerp.git
cd nekoerp
```

## 🔧 Opção 1: Sem Docker (modo manual)
Dentro da Pasta www, rode o comando:
```
composer install
```

Gere a chave:
```
php artisan key:generate
``` 
Configure o .env com os dados do seu MySQL.

Crie o banco:
```
CREATE DATABASE nekoerp;
```
Rode migrations:
```
php artisan migrate
``` 
Popule a tabela cupoms:
```
INSERT INTO cupoms (name, valor, quantidade, data_expiracao) VALUES
('#neko5', 5, 30, '2025-07-28 00:00:00'),
('#neko10', 10, 10, '2025-07-28 00:00:00'),
('#neko25', 25, 5, '2025-07-28 00:00:00'),
('#neko50', 50, 2, '2025-07-28 00:00:00');
```
Inicie o servidor:
```
php artisan serve
```
Acesse em http://localhost:8000.



## 🚀 Opção 2: Com Docker

- Crie o arquivo .env:
```
cp .env.example .env
```
- Ajuste as variáveis de ambiente conforme desejado (banco, portas, etc.).
```
Banco de Dados
DB_CONNECTION=mysql
DB_HOST=nekoerp_database
DB_PORT=3306
DB_DATABASE=nekoerp
DB_USERNAME=root
DB_PASSWORD=123456
```
```
Mail (EXEMPLO)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=ed413f08e853fd
MAIL_PASSWORD=2790769af38796
```

- Inicie os containers:
```
docker compose up --build -d
```
- Execute o Comando para gerar a chave: 
```
docker exec -it web php artisan key:generate
```
- Execute migrations e populate inicial:
```    
docker compose exec -it web docker-php-ext-install pdo_mysql
docker compose exec -it web php artisan migrate --seed (vai gerar os cupons (#neko5, #neko10, #neko20 e #neko50)
```
## Obs: 
- Após buildar o projeto pela primeira vêz, e gerar a pasta vendor em www, você pode alterar o comando do docker-compose.yml 
```
de 
command: sh -c "composer install && php artisan serve --host=0.0.0.0 --port=8000"
```
```
para
command: php artisan serve --host=0.0.0.0 --port=8000"
```

- A aplicação estará disponível em http://localhost:8000.
