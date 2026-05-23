# World Cup 2026 Placard/Base Generator Website — plan.md

## 1. Project Overview

এই ওয়েবসাইটের মাধ্যমে ইউজাররা বিশ্বকাপ ২০২৬ উপলক্ষে নিজের পছন্দের দেশের জন্য একটি কাস্টম ফুটবল সাপোর্টার প্ল্যাকার্ড/বেজ তৈরি করতে পারবে। ইউজার দেশ নির্বাচন করবে, নাম, ফোন নম্বর এবং নিজের ছবি দিয়ে রিয়েলটাইমে ডিজাইন প্রিভিউ দেখবে এবং শেষে ছবি ডাউনলোড করতে পারবে।

সিস্টেমে ইউজারের নাম, ফোন নম্বর, নির্বাচিত দেশ এবং ডাউনলোড কাউন্ট সংরক্ষণ হবে। একই ফোন নম্বর একই দেশের জন্য একবার গণনা হবে, তবে একই ফোন নম্বর ভিন্ন দেশ নির্বাচন করলে সেটি আলাদা কাউন্ট হিসেবে গণনা হবে।

---

## 2. Main Objectives

- বিশ্বকাপ ২০২৬ উপলক্ষে কাস্টম সাপোর্টার বেজ/প্ল্যাকার্ড তৈরি করা
- ইউজারকে রিয়েলটাইম লাইভ প্রিভিউ দেখানো
- ইউজার যেন নিজের ছবি দিয়ে বেজ তৈরি করতে পারে
- তৈরি করা বেজ ডাউনলোড করার সুবিধা দেওয়া
- কোন দেশের জন্য কতটি প্ল্যাকার্ড তৈরি/ডাউনলোড হয়েছে তা দেখানো
- অ্যাডমিন প্যানেল থেকে দেশ, বছর, সাইট সেটিংস এবং ফুটার কন্টেন্ট ম্যানেজ করা

---

## 3. Technology Stack

### Backend

- Laravel 12
- MySQL
- Laravel Blade
- REST API Ready Structure

### Frontend

- HTML5
- CSS3
- Bootstrap / Tailwind CSS
- JavaScript
- Canvas API / html2canvas
- jQuery / Vanilla JS

### Admin Panel

- AdminLTE / Custom Laravel Admin Panel

---

## 4. User Flow

1. ইউজার ওয়েবসাইটে প্রবেশ করবে
2. দেশ নির্বাচন করবে
3. বছর নির্বাচন করবে অথবা ডিফল্ট ২০২৬ দেখাবে
4. নাম লিখবে
5. ফোন নম্বর লিখবে
6. নিজের ছবি আপলোড করবে
7. সার্কেল বর্ডার কালার নির্বাচন করবে
8. নাম দেখাবে কিনা তা নির্বাচন করবে
9. লাইভ প্রিভিউ পাশে দেখা যাবে
10. ইউজার বেজ/প্ল্যাকার্ড ডাউনলোড করবে
11. ডাউনলোড সফল হলে কাউন্ট বৃদ্ধি পাবে
12. পেজে দেখাবে কোন দেশের কতটি প্ল্যাকার্ড তৈরি/ডাউনলোড হয়েছে

---

## 5. Frontend Features

### 5.1 Placard Generator Form

ফর্মে থাকবে:

- Name
- Phone Number
- Country Select
- Year Select
- User Photo Upload
- Circle Border Color Picker
- Show/Hide Name Option
- Generate Preview Button
- Download Button

### 5.2 Live Preview Layout

বেজ/প্ল্যাকার্ড ডিজাইনে থাকবে:

- গোলাকার বেজ ডিজাইন
- ইউজারের আপলোড করা ছবি মাঝখানে
- বাম পাশে দেশের ফ্ল্যাগ
- ফ্ল্যাগের নিচে দেশের নাম
- ডান পাশে বছর
- নিচে ইউজারের নাম
- ইউজার চাইলে নাম হাইড করতে পারবে
- ইউজার নিজের পছন্দের সার্কেল/বর্ডার কালার নির্বাচন করতে পারবে

### 5.3 Download Feature

- ছবি সার্ভারে স্টোর হবে না
- ব্রাউজারেই Canvas/html2canvas দিয়ে ইমেজ তৈরি হবে
- PNG/JPG হিসেবে ডাউনলোড হবে
- ডাউনলোড হলে কাউন্ট বৃদ্ধি পাবে

### 5.4 Download Note

ডাউনলোড বাটনের নিচে নোট দেখাতে হবে:

> যদি ডাউনলোডে সমস্যা হয়, তাহলে লিংক কপি করে Google Chrome অথবা Firefox ব্রাউজারে চেষ্টা করুন।

---

## 6. Data Save Logic

### 6.1 Save Data

ডাটাবেজে সংরক্ষণ হবে:

- Name
- Phone Number
- Country ID
- Year ID
- Download Count
- IP Address
- User Agent
- Created At
- Updated At

### 6.2 Duplicate Logic

- একই ফোন নম্বর + একই দেশ হলে একবারই গণনা হবে
- একই ফোন নম্বর + ভিন্ন দেশ হলে আলাদা কাউন্ট হবে
- ডাউনলোড সফল হলে কাউন্ট বৃদ্ধি পাবে

Example:

| Phone      | Country   | Count Logic             |
| ---------- | --------- | ----------------------- |
| 017xxxxxxx | Argentina | Count 1                 |
| 017xxxxxxx | Argentina | Duplicate, count হবে না |
| 017xxxxxxx | Brazil    | New country, count হবে  |

---

## 7. Public Pages

### 7.1 Home Page

- Hero section
- Placard generator form
- Live preview area
- Country-wise count section
- Download instruction note

### 7.2 Country Ranking Section

পেজে দেখাবে:

- Country Flag
- Country Name
- Total Placards / Downloads

Example:

| Rank | Country   | Total Placards |
| ---- | --------- | -------------- |
| 1    | Argentina | 1250           |
| 2    | Brazil    | 990            |
| 3    | Spain     | 540            |

---

## 8. Admin Panel Features

### 8.1 Dashboard

Dashboard এ থাকবে:

- Total Countries
- Total Users
- Total Downloads
- Top Country
- Today’s Downloads
- Country-wise chart

### 8.2 Country Management

Admin দেশ ম্যানেজ করতে পারবে:

- Country Name
- Country Flag
- Country Code
- Status Active/Inactive
- Sorting Order

### 8.3 Year Management

Admin বছর ম্যানেজ করতে পারবে:

- Year Name, যেমন: 2026
- Status Active/Inactive
- Default Year Selection

### 8.4 Site Settings

Admin সাইটের সেটিংস ম্যানেজ করতে পারবে:

- Website Name
- Website Logo
- Favicon
- Footer Text
- Copyright Text
- Meta Title
- Meta Description
- Meta Keywords
- Open Graph Image

### 8.5 User Data / Download Records

Admin দেখতে পারবে:

- Name
- Phone Number
- Country
- Year
- Download Count
- Created Date
- IP Address

Filter থাকবে:

- Country wise
- Year wise
- Date wise
- Phone number search

---

## 9. Suggested Database Tables

### 9.1 countries

| Field      | Type      |
| ---------- | --------- |
| id         | bigint    |
| name       | varchar   |
| flag       | varchar   |
| code       | varchar   |
| status     | tinyint   |
| sort_order | int       |
| created_at | timestamp |
| updated_at | timestamp |

### 9.2 years

| Field      | Type      |
| ---------- | --------- |
| id         | bigint    |
| year       | varchar   |
| is_default | tinyint   |
| status     | tinyint   |
| created_at | timestamp |
| updated_at | timestamp |

### 9.3 placard_records

| Field          | Type             |
| -------------- | ---------------- |
| id             | bigint           |
| name           | varchar nullable |
| phone          | varchar          |
| country_id     | bigint           |
| year_id        | bigint           |
| download_count | int default 1    |
| ip_address     | varchar nullable |
| user_agent     | text nullable    |
| created_at     | timestamp        |
| updated_at     | timestamp        |

Unique Index:

```sql
UNIQUE(phone, country_id, year_id)
```

### 9.4 settings

| Field      | Type          |
| ---------- | ------------- |
| id         | bigint        |
| key        | varchar       |
| value      | text nullable |
| created_at | timestamp     |
| updated_at | timestamp     |

---

## 10. Important Backend Logic

### 10.1 Download Count Logic

যখন ইউজার ডাউনলোড করবে:

1. ফোন নম্বর, দেশ এবং বছর চেক করবে
2. যদি একই রেকর্ড আগে থাকে, তাহলে নতুন রেকর্ড তৈরি হবে না
3. যদি রেকর্ড না থাকে, তাহলে নতুন রেকর্ড তৈরি হবে
4. Country-wise total count public page এ দেখাবে

### 10.2 Image Storage Logic

- ইউজারের আপলোড করা ছবি সার্ভারে সংরক্ষণ করা হবে না
- ছবি শুধু ব্রাউজারে preview এবং canvas rendering এর জন্য ব্যবহার হবে
- Privacy friendly system হিসেবে উল্লেখ করা যাবে

---

## 11. Validation Rules

### Public Form Validation

- Name: nullable, max 100 character
- Phone: required, valid Bangladeshi/mobile format বা international format
- Country: required
- Year: required
- Photo: required for preview only, image type jpg/png/webp
- Border Color: required

### Admin Validation

- Country name required
- Flag image required/nullable on update
- Year required
- Website name required

---

## 12. Security Requirements

- CSRF Protection
- Form validation
- Rate limiting for download API
- Admin authentication
- Role-based permission optional
- File type validation for flag/logo upload
- XSS protection for user input
- Phone number sanitization

---

## 13. SEO Requirements

- Dynamic meta title
- Dynamic meta description
- Open Graph image
- Social share preview
- Clean URL structure
- Mobile responsive design

---

## 14. Responsive Design Requirements

সাইটটি নিচের ডিভাইসে সুন্দরভাবে কাজ করতে হবে:

- Mobile
- Tablet
- Laptop
- Desktop
- Large screen

---

## 15. Future Features

- Social media share button
- Facebook frame style generator
- Multiple template design
- Top supporters leaderboard
- Country fan battle page
- QR code support
- Campaign analytics
- Multi-language support: Bangla + English

---

## 16. Suggested Routes

### Public Routes

```php
GET /                         HomeController@index
POST /download-count           PlacardController@storeDownload
GET /country-ranking           PlacardController@ranking
```

### Admin Routes

```php
GET /admin/dashboard
GET /admin/countries
POST /admin/countries
GET /admin/years
POST /admin/years
GET /admin/settings
POST /admin/settings
GET /admin/placard-records
```

---

## 17. Final Note

এই প্রজেক্টটি বিশ্বকাপ ২০২৬ কেন্দ্রিক একটি ভাইরাল, ইন্টারেক্টিভ এবং ডেটা-ড্রিভেন ওয়েবসাইট হতে পারে। সঠিক UI/UX, দ্রুত লোডিং, মোবাইল ফ্রেন্ডলি ডিজাইন এবং সহজ ডাউনলোড সুবিধা থাকলে এটি সোশ্যাল মিডিয়ায় দ্রুত ছড়িয়ে পড়ার সম্ভাবনা থাকবে।
