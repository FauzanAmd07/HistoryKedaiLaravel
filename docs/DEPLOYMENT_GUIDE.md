# Panduan Deployment HistoryKedai

Panduan ringkas untuk melakukan pengesetan server dan deployment aplikasi HistoryKedai ke server produksi.

## Persyaratan Server
- PHP >= 8.2 (dengan ekstensi `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `cURL`)
- MySQL / MariaDB
- Composer 2.x
- Node.js & NPM

## Langkah Deployment
```bash
# 1. Clone repository
git clone https://github.com/FauzanAmd07/HistoryKedaiLaravel.git
cd history-kedai-laravel

# 2. Install dependensi
composer install --optimize-autoloader --no-dev
npm install && npm run build

# 3. Setup environment & database
cp .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force

# 4. Storage link & cache
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
