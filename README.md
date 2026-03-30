# College Event Management System

A complete full-stack Laravel 11 application for managing college events with Role-Based Access Control (RBAC), built with Laravel Breeze, Tailwind CSS, and standard MVC Architecture.

## Features Developed

### 1. Secured User Roles (RBAC)
- **Super Admin (`super_admin`)**: Full system access, bypasses certain restrictions.
- **Admin/Faculty (`admin`)**: Can approve/reject student events, view analytics dashboard, create and manage events.
- **Student (`student`)**: Can browse events, register for approved events, view 'My Registrations', and propose new events (which go into a "Pending" state).

### 2. Core Modules
- **Events**: Dynamic creation, editing, deleting, and categorical filtering of events. Includes `max_participants` capacity limits and `approval_status` workflow.
- **Registrations**: System for students to RSVP to events, preventing duplicate signups and respecting capacity limits.
- **Categories**: Taxonomical sorting of events (Arts, Sports, Cultural, etc).

### 3. Professional Frontend (Tailwind CSS)
- **Sidebar Layout**: Modern responsive application layout with interactive states.
- **Dashboards**: Analytics-driven Admin panel and personalized Student overview.
- **Micro-interactions**: Hover states, transition effects, clean typography (Inter font), and SVG iconography.

## Getting Started

Follow these steps to explore and test the application locally.

### 1. Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM

### 2. Installation Let's Setup!

1. Open your terminal in the root of this project folder (`college-event-management`).
2. Run database migrations and seed the testing data:
   ```bash
   php artisan migrate:fresh --seed
   ```
3. Install dependencies and compile assets (Wait for Vite to build successfully):
   ```bash
   npm install && npm run build
   ```
4. Start the Laravel development server:
   ```bash
   php artisan serve
   ```

### 3. Testing the Application

Visit `http://localhost:8000` via your browser. Use the predefined seeded accounts below to test the different role interfaces:

**Super Admin Account** (Full access, analytics)
- **Email:** `super@admin.com`
- **Password:** `password`

**Admin / Faculty Account** (Event approval, analytics)
- **Email:** `admin@faculty.com`
- **Password:** `password`

**Student Account** (Dashboard, Registrations)
- **Email:** `student@college.com`
- **Password:** `password`

---

*Designed and engineered cleanly as per academic and industry specifications.*
