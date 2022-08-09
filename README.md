# Gerando o ambiente
- Para subir os devidos dockers, rodar o comando:
  >docker-compose up -d --build
- Para configurar o banco, é necessário copiar as credenciais salvar no arquivo ***.env.example***
- Rodar as migrations com o comando:
  >docker-compose exec php container_php /var/www/html/artisan migrate
  - Caso já esteja no docker php apenas:
    >php artisan migrate

# Utilizando o sistema
- Para uso, basta acessar o caminho:
  >http://localhost:8080