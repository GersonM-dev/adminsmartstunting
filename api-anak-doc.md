# 📘 Anak REST API Documentation

Base URL: `http://147.93.106.201/api`  
Authentication: **Bearer Token** (via Laravel Sanctum) login untuk mendapat bearer token untuk bisa akses api

---

## 🔐 Authentication

All endpoints require a valid token in the header:

```
Authorization: Bearer {access_token}
Accept: application/json
Content-Type: application/json
```

---

## 📄 Endpoints

### 1. **GET `/api/anak`**

**Description:** Get a list of all Anak records.

**Headers:**
```http
Authorization: Bearer {token}
```

**Response:**
```json
[
  {
    "id": 1,
    "user_id": 1,
    "nama": "Ali",
    "jenis_kelamin": "Laki-laki",
    "umur_bulan": 24,
    "berat": 10.5,
    "tinggi": 85.2
  }
]
```

---

### 2. **POST `/api/anak`**

**Description:** Create a new Anak.  
Triggers webhook + creates a new `Riwayat`.

**Body:**
```json
{
  "user_id": 1,
  "nama": "Ali",
  "jenis_kelamin": "Laki-laki",
  "umur_bulan": 24,
  "berat": 10.5,
  "tinggi": 85.2,
  "lingkar_kepala": 48,
  "lingkar_lengan": 15,
  "kecamatan": "Cibinong",
  "jumlah_vit_a": 2,
  "pendidikan_ayah": "SMA",
  "pendidikan_ibu": "SMA",
  "status_gizi": "Normal",
  "tanggal_lahir": "2023-07-01"
}
```

**Success Response:**
```json
{
  "id": 1,
  "nama": "Ali"
}
```

---

### 3. **GET `/api/anak/{id}`**

**Description:** Get a single Anak by ID.

**Example:**
```http
GET /api/anak/1
```

**Response:**
```json
{
  "id": 1,
  "nama": "Ali",
  "user": { ... },
  "riwayats": [ ... ]
}
```

---

### 4. **PUT `/api/anak/{id}`**

**Description:** Update an Anak record.  
Also triggers webhook and adds a new `Riwayat`.

**Body (example):**
```json
{
  "berat": 11.2,
  "tinggi": 86.0
}
```

**Success Response:**
```json
{
  "id": 1,
  "berat": 11.2,
  "tinggi": 86.0
}
```

---

### 5. **DELETE `/api/anak/{id}`**

**Description:** Delete a specific Anak.

**Example:**
```http
DELETE /api/anak/1
```

**Success Response:**
```json
{
  "message": "Deleted successfully"
}
```

---

## 🔁 Webhook Integration

After each `POST` and `PUT` to `/api/anak`, the server sends a request to:

```
POST https://n8n.dfxx.site/webhook/post-data
```

### Webhook Payload:

```json
{
  "nama": "Ali",
  "jenis_kelamin": "Laki-laki",
  "umur_bulan": 24,
  "berat": 10.5,
  "tinggi": 85.2,
  "lingkar_lengan": 15,
  "lingkar_kepala": 48,
  "kecamatan": "Cibinong",
  "jumlah_vit_a": 2,
  "pendidikan_ibu": "SMA",
  "pendidikan_ayah": "SMA"
}
```

### Webhook Response Expected:

```json
{
  "status_stunting": "Normal",
  "status_underweight": "Berisiko",
  "status_wasting": "Normal",
  "response": "Berikan makanan bergizi secara teratur"
}
```

The response is stored in the `riwayats` table with timestamp.

---

## 🧾 Riwayat Data (created automatically)

```json
{
  "anak_id": 1,
  "timestamp": "2025-07-13T10:00:00Z",
  "status_stunting": "Normal",
  "status_underweight": "Berisiko",
  "status_wasting": "Normal",
  "rekomendasi": "Berikan makanan bergizi secara teratur"
}
```