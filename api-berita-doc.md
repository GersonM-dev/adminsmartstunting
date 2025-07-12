# 📘 Berita REST API Documentation

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

### 1. **GET `/api/berita`**

**Description:** Retrieve a list of all Berita records.

**Response:**
```json
[
  {
    "id": 1,
    "title": "New Health Program Launched",
    "content": "Details about the health program...",
    "url": "https://example.com/news/1",
    "image": "https://example.com/images/news1.jpg"
  }
]
```

---

### 2. **POST `/api/berita`**

**Description:** Create a new Berita record.

**Body:**
```json
{
  "title": "New Health Program Launched",
  "content": "Details about the health program...",
  "url": "https://example.com/news/1",
  "image": "https://example.com/images/news1.jpg"
}
```

**Response:**
```json
{
  "id": 1,
  "title": "New Health Program Launched",
  "content": "...",
  "url": "https://example.com/news/1",
  "image": "https://example.com/images/news1.jpg"
}
```

---

### 3. **GET `/api/berita/{id}`**

**Description:** Retrieve a single Berita record by ID.

**Response:**
```json
{
  "id": 1,
  "title": "New Health Program Launched",
  "content": "...",
  "url": "https://example.com/news/1",
  "image": "https://example.com/images/news1.jpg"
}
```

---

### 4. **PUT `/api/berita/{id}`**

**Description:** Update an existing Berita record.

**Body (example):**
```json
{
  "title": "Updated News Title"
}
```

**Response:**
```json
{
  "id": 1,
  "title": "Updated News Title",
  "content": "...",
  "url": "...",
  "image": "..."
}
```

---

### 5. **DELETE `/api/berita/{id}`**

**Description:** Delete a Berita record by ID.

**Response:**
```json
{
  "message": "Deleted successfully"
}
```