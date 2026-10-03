# Deployment ke Vercel

## Checklist Sebelum Deploy

### 1. Environment Variables di Vercel Dashboard
Set ini di Project Settings → Environment Variables:

```
APP_NAME=Portofolio Saya
APP_ENV=production
APP_KEY=base64:xxxxx (generate dengan: php artisan key:generate --show)
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your-db
DB_USERNAME=your-user
DB_PASSWORD=your-password

VERCEL=true
LOG_CHANNEL=stderr
```

### 2. Database
- Database HARUS di cloud (bukan localhost)
- Gunakan: MySQL, PostgreSQL, atau managed service
- Pastikan Vercel IP whitelisted di firewall database

### 3. Storage
- Untuk file uploads, gunakan S3 atau storage cloud lain
- Vercel filesystem read-only kecuali `/tmp`

### 4. Git Push
```bash
git add .
git commit -m "Configure Vercel deployment"
git push origin main
```

### 5. Deploy via Vercel CLI atau Dashboard
```bash
npm i -g vercel
vercel
```

Atau langsung di: https://vercel.com/new

## Troubleshooting

### "502 Bad Gateway"
- Cek logs: `vercel logs`
- Biasanya: APP_KEY missing atau database error

### "Composer install failed"
- Vercel 50GB build limit, jika melampaui cleanup vendor lokal

### Storage permission denied
- Sudah di-handle di `/config/filesystems.php` dan `/config/cache.php`

### Build timeout
- Increase maxDuration di `vercel.json` (default: 30s)

## File-file Penting untuk Review

- `vercel.json` - Konfigurasi build & routing
- `.vercelignore` - File yang di-skip saat deploy
- `bootstrap/app.php` - Writable paths config
- `config/filesystems.php` - Storage paths untuk Vercel
- `config/cache.php` - Cache driver untuk Vercel
