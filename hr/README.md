# HR Application - Quick Start

## 1. Import Database
Open PHPMyAdmin and import: `schema.sql`

## 2. Access Application
URL: **http://localhost/hr/**

## 3. Login
- **HR Admin**: `admin` / `admin123`
- **Employee**: Created automatically when you add an employee

## 4. Features
- ✅ Employee Management (20+ fields)
- ✅ Leave Application & Approval
- ✅ Document Expiry Alerts
- ✅ Role-Based Access Control
- ✅ Premium Dark UI

## File Structure
```
hr/
├── app/
│   ├── config/database.php
│   ├── core/ (App, Controller, Model)
│   ├── controllers/
│   ├── models/
│   └── middleware/
├── public/
│   ├── index.php (Entry Point)
│   └── assets/ (CSS, JS)
├── resources/views/
└── schema.sql
```

All old procedural files have been removed. The app now uses clean MVC architecture.
