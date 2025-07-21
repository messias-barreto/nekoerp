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
- Inicie os containers:
```
docker-compose up -d
```
- Execute migrations e populate inicial:
```    
docker-compose exec -it web docker-php-ext-install pdo_mysql
docker-compose exec -it web php artisan migrate
``` 
- A aplicação estará disponível em http://localhost:8000.
