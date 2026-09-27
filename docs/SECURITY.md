# Kebijakan Keamanan HistoryKedai

## Praktik Keamanan yang Diterapkan
1. **CSRF Protection:** Setiap form input menggunakan directive `@csrf` Laravel.
2. **Password Hashing:** Menggunakan algoritma `bcrypt` / default Laravel `hashed` cast.
3. **Input Validation:** Seluruh request di-filter melalui class `FormRequest`.
4. **SQL Injection Protection:** Menggunakan Eloquent ORM & PDO prepared statements.
