## Requirements
- php v8
- mysql v8
- laravel v8

## Cara install
1. ```composer install```
2. copy .env.example menjadi .env
3. set semua data di .env
4. ```php artisan key:generate```
5. ```php artisan migrate```
6. ```php artisan db:seed```
7. ```php artisan db:seed DriverSeeder```
8. ```php artisan db:seed UserSeeder```
9. ```php artisan db:seed VehicleSeeder```
10. ```php artisan serve```

## Cara Penggunaan
### Menambahkan data peminjaman
1. Login sebagai admin (lihat di list dummy user)
2. Masuk ke tab ```Peminjaman``` 
3. Masukan semua data peminjaman
4. Kirimkan dengan tekan tombol ```Ajukan Peminjaman```
### Menyetujui peminjaman
1. Login sebagai Supervisor atau Manager (lihat di list dummy user)
2. Peminjaman yang bisa disetujui akan ditandai dengan adanya aksi ```approve```
3. Untuk melihat detail peminjaman tekan aksi ```detail```

### Ekspor data periodik
1. Login sebagai user manapun (lihat di list dummy user)
2. Masuk ke tab ```peminjaman``` setelah itu pilih ```riwayat peminjaman```
3. Tekan tombol ```Export``` maka secara otomatis sistem akan melakukan download file excel dengan data peminjaman yang telah disetujui dalam 1 tahun terakhir

### List dummy user
## Admin:
- **Username**: admin
  - **Password**: password
- **Username**: admin2
  - **Password**: password

## Supervisor:
- **Supervisor 1**:
  - **Username**: spv1
  - **Password**: password
- **Supervisor 2**:
  - **Username**: spv2
  - **Password**: password
- **Supervisor 3**:
  - **Username**: spv3
  - **Password**: password

## Manager:
- **Manager 1**:
  - **Username**: manager1
  - **Password**: password
- **Manager 2**:
  - **Username**: manager2
  - **Password**: password
- **Manager 3**:
  - **Username**: manager3
  - **Password**: password