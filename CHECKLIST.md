# Project Roadmap Checklist

Use this to track the 6-step plan so we don’t miss anything.

---

## Step 0 – Current status (no action)

- [x] `.env` file in project root
- [x] `.env` loader in `include/milkprams.php`
- [x] ImageKit upload working and used in modules
- [x] DB still works with old defaults when env is empty

---

## Step 1 – Secure upload folders

Goal: block PHP execution in upload folders.

- [x] Add `.htaccess` in `/banner`
- [x] Add `.htaccess` in `/category`
- [x] Add `.htaccess` in `/collection`
- [x] Add `.htaccess` in `/city`
- [x] Add `.htaccess` in `/setting`
- [x] Add `.htaccess` in `/product`
- [x] Add `.htaccess` in `/subcategory`
- [x] Add `.htaccess` in `/coupon`
- [x] Add `.htaccess` in `/payment`
- [ ] Add `.htaccess` in any new upload folders we create later

---

## Step 2 – Standardise configuration access

Goal: Laravel‑like config helper, no behaviour change.

- [x] Add `config()` helper in `milkprams.php`
- [x] Use `config()` for DB connection
- [x] Use `config()` for ImageKit keys
- [ ] Use `config()` for new settings we add in future

---

## Step 3 – Centralise common logic (module by module)

Goal: shared helpers/services, same routes and screens.

**Image upload helper**

- [x] Add `upload_image()` in `Milkman`
- [x] City images use helper
- [x] Banner images use helper
- [x] Category images use helper
- [x] Subcategory images use helper
- [x] Collection images use helper
- [x] Product images use helper
- [x] Coupon images use helper
- [x] Payment gateway images use helper
- [x] Setting logos and banners use helper

**DB / business logic refactor**

- [x] City module write logic centralised
- [x] Banner module write logic centralised
- [x] Category module write logic centralised
- [x] Subcategory module write logic centralised
- [x] Collection module write logic centralised
- [x] Coupon module write logic centralised
- [x] Product module write logic centralised
- [x] Payment module write logic centralised
- [x] Setting module write logic centralised

---

## Step 4 – Harden inputs (validation & escaping)

Goal: better security, no change for valid users.

- [x] Add server-side validation for Product
- [x] Add server-side validation for Category/Subcategory
- [x] Add server-side validation for Collection
- [x] Add server-side validation for City
- [x] Add server-side validation for Coupon
- [x] Add server-side validation for Payment gateway
- [x] Add server-side validation for Deliveries / Timeslot
- [x] Add server-side validation for Subscription orders
- [x] Add server-side validation for Wallet / Coupon / Payment APIs
- [x] Normalise and sanitise uploaded file names in all modules

---

## Step 5 – Error handling & logging

Goal: safe errors in UI, detailed errors in logs.

- [x] Replace raw `die()` / plain error echoes in admin
- [x] Replace raw `die()` / plain error echoes in APIs
- [x] Log internal errors with `error_log()` instead of exposing details
- [x] Keep existing redirects and visible messages the same

---

## Step 6 – Structural clean-up (Laravel‑style, long‑term)

Goal: introduce services and thin controllers, keep all workflows.

- [x] Create simple `app/` or `src/` folder
- [x] Add `app/Services/OrderService.php`
- [x] Add `app/Services/UserService.php`
- [x] Move logic from `uapi/*.php` into services (incremental)
- [x] Move logic from `rapi/*.php` into services (incremental)
- [x] Keep all existing URLs, forms, and response formats unchanged

Pending for later passes (do not change yet, just notes):

- [ ] Review remaining `uapi/*.php` that still contain inline business logic
- [ ] Review remaining `rapi/*.php` that still contain inline business logic
