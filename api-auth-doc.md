# 🔐 Auth API Documentation

Base URL: `http://147.93.106.201/api`  
Authentication: **Bearer Token** (via Laravel Sanctum)

---

## 📄 Endpoints

### 1. **POST `/api/login`**

**Description:** Login using phone number and password.

**Body:**
```json
{
  "phone_number": "081234567890",
  "password": "secret123"
}
```

**Success Response:**
```json
{
  "access_token": "your_token_here",
  "token_type": "Bearer"
}
```

**Error Response (401):**
```json
{
  "message": "Invalid credentials"
}
```

---

### 2. **POST `/api/logout`**

**Description:** Logout the authenticated user (revokes current token).

**Headers:**
```
Authorization: Bearer {access_token}
```

**Success Response:**
```json
{
  "message": "Logged out"
}
```

---

### 3. **POST `/api/register`**

**Description:** Register a new user with phone number.

**Body:**
```json
{
  "name": "John Doe",
  "phone_number": "081234567890",
  "password": "secret123",
  "password_confirmation": "secret123"
}
```

**Success Response:**
```json
{
  "message": "User registered successfully",
  "access_token": "your_token_here",
  "token_type": "Bearer"
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

- All endpoints require `Accept: application/json`.
- Passwords must be confirmed on registration (`password_confirmation` must match `password`).
- Tokens returned are used as `Bearer` tokens in the `Authorization` header.