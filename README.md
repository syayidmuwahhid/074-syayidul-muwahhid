## Project Akhir JDA Fase 2

Nama : Syayidul Muwahhid

No Absen : 074

Judul : API Resource Manager

Deskripsi :
Website yang diperuntukan untuk menyimpan resource file berupa foto/dokumen/video yang nantinya setiap file akan diberikan url yang dapat digunakan sebagai resource dari sebuah aplikasi. sehingga dapat menghemat cost storage dari aplikasi karena hanya perlu memanggil url API dari filenya.

Contoh Alur utama:

1. user mengupload gambar.
2. Sistem menyimpan dan megenerate link lokasi gambar.
3. user dapat menggunakan link tersebut sebagai resource untuk aplikasi lain, seperti:

`img src="link hasil generate"`

atau

`Picasso.with(this).load("link hasil generate").into(imageView);`

## Persyaratan perangkat

1. PHP versi `8.2` atau diatasnya
2. Database `Mysql` (bisa diubah pada .env)
3. terinstal `composer`

## Cara Menjalankan

1. Clone respository

```
git clone https://github.com/syayidmuwahhid/074-syayidul-muwahhid
```

atau download dari web

```
https://github.com/syayidmuwahhid/074-syayidul-muwahhid/archive/refs/heads/master.zip
```

2. buka folder repositori

```
cd 074-syayidul-muwahhid
```

3. instal dependencies laravel

```
composer install
```

4. buat database mysql dengan nama database `jda` username `root` dan password kosong

5. migrasi database

```
php artisan migrate --seed
```

atau

```
php artisan migrate:fresh --seed
```

6. jalankan aplikasi

```
php artisan serve
```

7. login ke aplikasi dengan akun

-   email : `admin@gmail.com`
-   password : `12345678`

atau register dengan menu register pada halaman login.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
