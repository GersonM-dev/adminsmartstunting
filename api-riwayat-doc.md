# 📘 Riwayat REST API Documentation

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

### 1. **GET `/api/riwayat`**

**Description:** Get a list of all Riwayat records.

**Response:**
```json
[
  {
    "id": 1,
    "anak_id": 1,
    "timestamp": "2025-07-13T10:00:00Z",
    "status_stunting": "Normal",
    "status_underweight": "Berisiko",
    "status_wasting": "Normal",
    "rekomendasi": "Berikan makanan bergizi secara teratur",
    "anak": { ... }
  }
]
```

---

### 2. **POST `/api/riwayat`**

**Description:** Create a new Riwayat record.

**Body:**
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

**Success Response:**
```json
{
  "id": 1,
  "anak_id": 1,
  "timestamp": "2025-07-13T10:00:00Z",
  ...
}
```

---

### 3. **GET `/api/riwayat/{id}`**

**Description:** Get a single Riwayat record by ID.

**Example:**
```http
GET /api/riwayat/1
```

**Response:**
```json
{
  "id": 1,
  "anak_id": 1,
  "timestamp": "2025-07-13T10:00:00Z",
  "status_stunting": "Normal",
  "status_underweight": "Berisiko",
  "status_wasting": "Normal",
  "rekomendasi": "Berikan makanan bergizi secara teratur",
  "anak": { ... }
}
```

---

### 4. **PUT `/api/riwayat/{id}`**

**Description:** Update a Riwayat record.

**Body (example):**
```json
{
  "status_stunting": "Tinggi",
  "rekomendasi": "Segera konsultasi ke puskesmas"
}
```

**Response:**
```json
{
  "id": 1,
  "status_stunting": "Tinggi",
  "rekomendasi": "Segera konsultasi ke puskesmas"
}
```

---

### 5. **DELETE `/api/riwayat/{id}`**

**Description:** Delete a specific Riwayat record.

**Response:**
```json
{
  "message": "Deleted successfully"
}
```