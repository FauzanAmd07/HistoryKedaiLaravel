# Documentation API HistoryKedai

Dokumen ini berisi spesifikasi endpoint dan struktur payload API/Route untuk aplikasi HistoryKedai.

## Endpoint Publik (Pelanggan)

### 1. Halaman Menu Utama
- **URL:** `/`
- **Method:** `GET`
- **Deskripsi:** Menampilkan daftar kategori dan menu yang tersedia.

### 2. Proses Pesanan Customer
- **URL:** `/proses-pesanan`
- **Method:** `POST`
- **Headers:** `Content-Type: application/json`
- **Payload:**
```json
{
  "nama_pelanggan": "John Doe",
  "metode_bayar": "QRIS",
  "total_harga": 40000,
  "pesanan_json": "[{\"id\": 1, \"qty\": 2, \"price\": 20000}]"
}
```

---

## Endpoint Admin & Kasir (Protected)

### 1. Manajemen Menu (`/dashboard/menu`)
- `GET /dashboard/menu`: Menampilkan seluruh daftar menu.
- `POST /dashboard/menu`: Menambah menu baru (`StoreMenuRequest`).
- `PUT /dashboard/menu/{id}`: Mengubah data menu (`UpdateMenuRequest`).
- `DELETE /dashboard/menu/{id}`: Mengarsipkan menu.

### 2. Transaksi Kasir (`/dashboard/transaksi`)
- `GET /dashboard/transaksi`: Daftar transaksi pesanan masuk.
- `PATCH /dashboard/transaksi/{id}/status`: Mengubah status pesanan.
