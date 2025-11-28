#!/bin/bash
#renomeado o htaccess
mv htaccess .htaccess

# Verifica se está rodando como root
if [ "$EUID" -ne 0 ]; then
    echo "Por favor, execute com sudo."
    exit 1
fi

APACHE_CONF="/etc/apache2/apache2.conf"
BACKUP="/etc/apache2/apache2.conf.backup_$(date +%Y%m%d_%H%M%S)"

echo "Criando backup em: $BACKUP"
cp "$APACHE_CONF" "$BACKUP"

echo "Aplicando alterações..."

# Substitui AllowOverride None → AllowOverride All
sed -i 's/AllowOverride[[:space:]]\+None/AllowOverride All/g' "$APACHE_CONF"

# Substitui Require all denied → Require all granted
sed -i 's/Require all denied/Require all granted/g' "$APACHE_CONF"

echo "ativando modulo rewrite"
a2enmod rewrite

echo "Reiniciando Apache..."
systemctl restart apache2

echo "Configuração atualizada com sucesso!"
