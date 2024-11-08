#!/bin/sh

echo "Starting services..."

# Inicia o apache
apache2-foreground &

# Inicia o Supervisor
service supervisor start

# Releia a configuração do Supervisor e aplique as mudanças
supervisorctl reread
supervisorctl update

# Inicia os processos de fila gerenciados pelo Supervisor
supervisorctl start 'email-queue:*'

# Executa as migrações do Laravel
echo "#### Running migrations..."
php artisan migrate --force 2>&1 | tee /var/www/html/storage/logs/migrate.log

# Mantém o container ativo exibindo os logs do Apache
tail -f /var/log/apache2/*.log
