# Div Data Docs API

This WordPress plugin exposes **DivData Help Docs** via a custom REST API endpoint, allowing frontend applications to query posts based on the `role` and `route` metadata.

---

## 🔧 What It Does

- Registers a custom REST API endpoint:

  ```
  GET /wp-json/divdata/v1/posts?role=admin&route=people
  ```

- Returns **published posts** of the custom post type `divdata-help-doc` that match the specified:
  - `role` (custom field)
  - `route` (custom field)

- Designed for use with Vue components or other frontend tools that dynamically render help content.

---

## 📁 Getting Started (Local Dev Setup)

1. Clone the [UCSC WordPress Dev environment](https://github.com/ucsc/wp-dev.ucsc):

   ```bash
   git clone https://github.com/ucsc/wp-dev.ucsc.git
   cd wp-dev.ucsc
   ```

2. Start the local WordPress instance and navigate to:

   ```
   public/wp-content/plugins/
   ```

3. Clone this plugin into the `plugins/` directory:

   ```bash
  git clone https://github.com/ucsc/divdata-help.git  div-data-docs-api
   ```

4. In the WordPress admin dashboard (`http://localhost/wp-admin`):
   - Go to **Plugins**
   - Activate **Div Data Docs API**

---

## 📝 Setup Requirements

To use this plugin, you must:

- Register a custom post type called **DivData Help Doc** (`divdata-help-doc`)  
  You can do this using ACF’s **Post Types** feature or manually via code.

- Add two **custom fields** to this post type:
  - `role` (e.g., `admin`, `student`, etc.)
  - `route` (e.g., `people`, `courses`, etc.)

These fields can be created using ACF **Field Groups**.

Make sure your posts are:
- **Published**
- Assigned a valid `role` and `route` value

---

## 📥 Example Request

```
GET /wp-json/divdata/v1/posts?role=admin&route=people
```

**Response:**

```json
[
  {
    "id": 22,
    "title": "How to manage people",
    "content": "<p>Help article content here</p>",
    "role": "admin",
    "route": "people"
  }
]
```

---

## 📌 Notes

- The post type should **not** be exposed to the default REST API (`show_in_rest` should be `false`).
- This plugin does **not** include frontend rendering; it is purely an API backend for frontend apps.
- There is **no authentication layer**. Only published content is returned.

---

## 🧑‍💻 Author

**Sammy Slug**  
UCSC Web Team
