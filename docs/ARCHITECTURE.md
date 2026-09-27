# Arsitektur Aplikasi HistoryKedai

Dokumen ini menjelaskan arsitektur perangkat lunak HistoryKedai Laravel.

## Struktur Layer
- **Presentation Layer (Views):** Blade templates & Tailwind CSS UI.
- **Application Layer (Controllers & FormRequests):** Menerima HTTP request, melakukan validasi via FormRequest, dan memanggil Service/Model.
- **Domain Layer (Models & Traits):** Eloquent models (`Menu`, `Transaksi`, `User`) dengan relasi dan scopes.
- **Persistence Layer (Database):** MySQL Database schema dengan migrations dan seeders.
