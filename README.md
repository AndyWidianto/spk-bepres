## Install

1. Git clone :
```
git clone https://github.com/galihap76/spk-bepres.git
```

2. Masuk ke projek :
```
cd spk-bepres
```

3. Install package :
```
1. composer install
2. npm install
```

4. Copy .env.example ke .env :
```
copy .env.example .env
```

5. Generate key :
```
php artisan key:generate
```

6. Sesuaikan konfigurasi database :
```
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migrate :
```
php artisan migrate
```

8. Jalankan seeder :
```
php artisan db:seed
```

9. Jalankan aplikasi :
```
1. php artisan serve
2. npm run dev
```

10. Selesai!
