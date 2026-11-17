# Product Management API
## Simple Frontend Documentation

Welcome! This document explains how to connect the Frontend application to the Product Management API.

It explains each API endpoint, what it does, what data you need to send, and what response you can receive.

---

## 1. What Can This API Do?

The API allows the Frontend application to:

1. Get all products.
2. Get one product by ID.
3. Add a new product.
4. Update a product.
5. Delete a product.
6. Search products by name.
7. Filter products by category.

The API also returns the related category information with each product.

---

## 2. Start the Backend Server

Before connecting the Frontend, make sure the Laravel backend server is running.

Open the project terminal and run:

```bash
php artisan serve
```

The local server URL is:

```text
http://127.0.0.1:8000
```

The API Base URL is:

```text
http://127.0.0.1:8000/api
```

**Important:** The backend server must be running before you send API requests.

For a deployed application, replace this URL with the production API URL.

---

## 3. API Headers

For API requests, use these headers:

| Key | Value |
|---|---|
| Accept | application/json |
| Content-Type | application/json |

These headers tell the backend that we are sending and receiving JSON data.

---

## 4. All API Endpoints

Here is the complete list of Product API endpoints.

| Method | Endpoint | What does it do? |
|---|---|---|
| GET | `/products` | Get all products |
| GET | `/products/{id}` | Get one product |
| POST | `/products` | Add a new product |
| PUT | `/products/{id}` | Update a product |
| PATCH | `/products/{id}` | Update selected fields |
| DELETE | `/products/{id}` | Delete a product |

The `{id}` means the product ID.

For example:

```text
/api/products/5
```

This endpoint works with the product whose ID is 5.

---

## 5. Get All Products

**Method:** GET

**URL:**

```text
http://127.0.0.1:8000/api/products
```

**Purpose:**

Get all products from the database.

**Example response:**

```json
[
    {
        "id": 1,
        "name": "iPhone 17",
        "category_id": 2,
        "price": 1200,
        "stock": 15,
        "is_active": true,
        "category": {
            "id": 2,
            "name": "Mobile Phones",
            "description": "Smartphones"
        }
    }
]
```

**Frontend use:**

Use this endpoint when you want to display the products list.

---

## 6. Get One Product

**Method:** GET

**URL:**

```text
http://127.0.0.1:8000/api/products/1
```

**Purpose:**

Get one product using its ID.

**Frontend use:**

Use this endpoint when the user opens a product details page or wants to see product information before editing it.

If the product does not exist, the API returns `404 Not Found`.

---

## 7. Add a New Product

**Method:** POST

**URL:**

```text
http://127.0.0.1:8000/api/products
```

**Request Body:**

```json
{
    "name": "iPhone 17",
    "category_id": 2,
    "price": 1200,
    "stock": 15,
    "is_active": true
}
```

**Field explanation:**

| Field | Meaning | Example |
|---|---|---|
| name | Product name | iPhone 17 |
| category_id | Category ID | 2 |
| price | Product price | 1200 |
| stock | Available quantity | 15 |
| is_active | Product status | true |

**Success response:**

Status code: `201 Created`

The API returns the newly created product.

**Frontend use:**

When the user fills in the Add Product form and clicks Save, send a POST request with the form data.

---

## 8. Update a Product

You can update a product using PUT or PATCH.

### PUT – Update the product

**Method:** PUT

**URL:**

```text
http://127.0.0.1:8000/api/products/1
```

**Request Body:**

```json
{
    "name": "iPhone 17 Pro",
    "category_id": 2,
    "price": 1400,
    "stock": 10,
    "is_active": true
}
```

PUT can send all the product fields you want to update.

### PATCH – Update selected fields

**Method:** PATCH

**URL:**

```text
http://127.0.0.1:8000/api/products/1
```

**Request Body:**

```json
{
    "price": 1500
}
```

PATCH allows you to send only the fields you want to change.

**Frontend use:**

When the user edits a product and clicks Update, send the request with the product ID and updated information.

---

## 9. Delete a Product

**Method:** DELETE

**URL:**

```text
http://127.0.0.1:8000/api/products/1
```

**Purpose:**

Delete the product with ID 1.

**Frontend use:**

When the user clicks Delete, send a DELETE request.

It is recommended to show a confirmation message before deleting.

**Success response:**

The API returns a success message if the deletion is successful.

---

## 10. Search Products by Name

**Method:** GET

**URL:**

```text
http://127.0.0.1:8000/api/products?name=Samsung
```

**Purpose:**

Search for products whose names contain the word Samsung.

For example, the result may include:

- Samsung Galaxy S25
- Samsung Galaxy A55

**Frontend use:**

Use this endpoint when the user types a product name in the search box.

---

## 11. Filter Products by Category

**Method:** GET

**URL:**

```text
http://127.0.0.1:8000/api/products?category_id=2
```

**Purpose:**

Get products that belong to category ID 2.

**Frontend use:**

Use this endpoint when the user selects a category from the category dropdown.

---

## 12. Search and Filter Together

You can use both filters in one request.

**Method:** GET

**URL:**

```text
http://127.0.0.1:8000/api/products?category_id=2&name=Samsung
```

This returns products that match both conditions:

- Category ID is 2.
- Product name contains Samsung.

---

## 13. Product Data Types

The Product API uses these data types:

| Field | Data Type | Example |
|---|---|---|
| id | Integer | 1 |
| name | String | iPhone 17 |
| category_id | Integer | 2 |
| price | Number | 1200 |
| stock | Integer | 15 |
| is_active | Boolean | true |
| category | Object | Category information |

**Important:**

- `true` means the product is active.
- `false` means the product is inactive.
- `category_id` must match an existing category ID.
- Price and stock cannot be negative.

---

## 14. Validation Rules

The backend checks the data before saving it.

| Field | Validation |
|---|---|
| name | Required, text, maximum 255 characters |
| category_id | Required when creating; must exist in categories |
| price | Required when creating; numeric and minimum 0 |
| stock | Required when creating; integer and minimum 0 |
| is_active | Required when creating; must be true or false |

For updates, you can send only the fields you want to change. Any field you send must pass its validation rules.

---

## 15. HTTP Status Codes

The Frontend should check the HTTP status code after every request.

| Status Code | Meaning | Frontend Action |
|---|---|---|
| 200 | Request successful | Display the result |
| 201 | Product created | Show success message |
| 404 | Product not found | Show not found message |
| 422 | Validation error | Display field errors |
| 500 | Server error | Show a general error message |

---

## 16. Validation Error Example

If the user sends invalid data, the API returns status `422`.

Example:

```json
{
    "message": "The name field is required.",
    "errors": {
        "name": [
            "The name field is required."
        ]
    }
}
```

**Frontend use:**

Read the `errors` object and show the error beside the related input field.

For example, if the name is missing, show:

```text
Name field is required.
```

---

## 17. Recommended Frontend Workflow

Follow these steps when building the Product Management UI:

**Step 1:** Call GET `/products` to display all products.

**Step 2:** Create a product form with these fields:

- Product name
- Category
- Price
- Stock
- Active status

**Step 3:** When the user clicks Save, call POST `/products`.

**Step 4:** When the user clicks Edit, get the product information and fill the form.

**Step 5:** When the user clicks Update, call PUT or PATCH `/products/{id}`.

**Step 6:** When the user clicks Delete, show a confirmation message and call DELETE `/products/{id}`.

**Step 7:** Use the search and category filter endpoints to find products.

---

## 18. Important Notes for Frontend Developers

- The API uses JSON for requests and responses.
- Always send the correct HTTP method.
- Use the product ID when showing, updating, or deleting a product.
- Do not send negative prices or stock quantities.
- Handle validation errors with status code 422.
- Handle missing products with status code 404.
- Refresh the product list after creating, updating, or deleting a product.
- Do not store database credentials in the Frontend.
- The local Base URL is only for local development.
- If the Frontend runs on a different domain or port, the backend may need CORS configuration.

---

## 19. Testing with Postman

Before connecting the Frontend, test all endpoints using Postman.

Recommended testing order:

1. GET `/products`
2. GET `/products/1`
3. POST `/products`
4. PUT `/products/1`
5. PATCH `/products/1`
6. GET `/products?name=Samsung`
7. GET `/products?category_id=2`
8. DELETE `/products/1`
9. Test invalid data to check status 422.
10. Test a non-existing product ID to check status 404.

---

## 20. Final Note

This document is prepared to help Frontend developers understand and integrate with the Product Management API.

If an endpoint or response is different in the running backend, please confirm it with the Backend Developer before implementing it in the UI.

**Backend:** Laravel 12  
**Database:** MySQL  
**API Type:** RESTful API  
**Data Format:** JSON