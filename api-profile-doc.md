# 🙍‍♂️ Profile API Documentation

Base URL: `http://147.93.106.201/api`  
Authentication: **Bearer Token** (via Laravel Sanctum) login untuk mendapat bearer token untuk bisa akses api

---

## 🔐 Headers (Required for all)

```
Authorization: Bearer {access_token}
Accept: application/json
Content-Type: application/json
```

---

## 📄 Endpoints

### 1. **GET `/api/profile`**

**Description:** Retrieve the currently authenticated user's profile.

**Response:**
```json
{
  "id": 1,
  "name": "John Doe",
  "phone_number": "081234567890",
  ...
}
```

---

### 2. **PUT `/api/profile`**

**Description:** Update the authenticated user's profile.

**Request Body:**
```json
{
  "name": "Updated Name",
  "phone_number": "081298765432",
  "password": "newpass123",
  "password_confirmation": "newpass123"
}
```

**Success Response:**
```json
{
  "message": "Profile updated successfully",
  "user": {
    "id": 1,
    "name": "Updated Name",
    "phone_number": "081298765432"
  }
}
```

**Validation Error (422):**
```json
{
  "errors": {
    "phone_number": ["The phone number has already been taken."]
  }
}
```

---

## 🔁 Notes

- You can update just part of the profile (e.g., only `name` or only `password`).
- Password change requires `password_confirmation` to match.
- All updates are applied to the authenticated user (`auth:sanctum` required).