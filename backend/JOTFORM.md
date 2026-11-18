# Jotform order synchronization

Completed checkout orders are saved to MySQL first and then copied to a Jotform form. A Jotform outage does not discard the local order; an administrator can retry from the order detail page.

## Integrated form

The project is mapped to **Lanyard Order Form**, form ID `263211686457058`:

| Label | Value sent by Blumies |
| --- | --- |
| Fullname | Logged-in user's display name |
| Email Address | Logged-in user's email |
| Phone Number | Phone entered at checkout |
| Street Address, City, Region, Postal / ZIP Code | Delivery address entered at checkout |
| Delivery Method | Selected delivery method |
| Payment Reference Number | Reference entered at checkout |
| Comments or Suggestions | Local order ID, username, products, quantities, prices, total, and optional customer comments |

The form's Product List (question 10) cannot be populated through Jotform's Add Submission API. Product details are therefore written to Comments or Suggestions (question 21), so the complete order is still visible in Jotform. The API also cannot upload a local file to Proof of Payment (question 14); the receipt stays in protected local storage and is available from the admin order page.

## Product and category synchronization

Jotform is the catalog source of truth. Edit products, prices, images, options, and categories in the form's **Available on-hand products** Product List. Then open **Admin → Products → Sync from Jotform**, or run:

```bash
php spark catalog:sync
```

The sync reads the published form and upserts its categories and products into MySQL. Existing website product IDs are preserved. Products or categories removed from Jotform are made inactive on the website instead of being deleted, so historical order data remains valid.

Public catalog pages automatically check for changes every 15 minutes and keep serving the last successful database copy if Jotform is unavailable. Use the admin sync button when a Jotform edit needs to appear immediately. The interval can be changed with `JOTFORM_CATALOG_SYNC_TTL` in `.env`.

Jotform currently does not provide API endpoints for managing or exporting Product List entries. For that reason, editing catalog data on the website is intentionally disabled; maintaining two independently editable catalogs would allow them to drift apart.

## 2. Configure credentials

Generate an API key in Jotform under **My Account → API**, then add these values to `backend/.env`:

```dotenv
JOTFORM_API_KEY = your_api_key
JOTFORM_FORM_ID = 263211686457058
JOTFORM_API_URL = https://api.jotform.com
```

EU accounts should use `https://eu-api.jotform.com`; HIPAA accounts should use `https://hipaa-api.jotform.com`.

This form's question IDs are built into the integration. `JOTFORM_FIELD_MAP` is only needed if the form fields are later replaced or renumbered:

```dotenv
JOTFORM_FIELD_MAP = '{"customer_name":"3","email":"4","phone":"5","street_address":"6","city":"7","region":"8","postal_code":"9","payment_reference":"15","comments":"21","delivery_method":"28"}'
```

## 3. Test

Place an order while logged in and upload a JPG, PNG, WebP, or PDF receipt (maximum 5 MB). In **Admin → Orders**, the Jotform column will show `synced`, `failed`, or `not configured`. Open the order to view the protected proof, inspect an error, or retry synchronization.

The API key is server-side only and must never be committed or rendered in HTML.
