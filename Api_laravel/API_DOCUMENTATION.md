# Laravel API Documentation

## Table of Contents
1. [Project Overview](#project-overview)
2. [System Requirements](#system-requirements)
3. [Installation & Setup](#installation--setup)
4. [Database Structure](#database-structure)
5. [API Endpoints](#api-endpoints)
6. [Admin Panel](#admin-panel)
7. [Authentication System](#authentication-system)
8. [Models & Relationships](#models--relationships)
9. [Controllers](#controllers)
10. [Views & Frontend](#views--frontend)
11. [File Structure](#file-structure)
12. [Development Workflow](#development-workflow)
13. [Testing](#testing)
14. [Deployment](#deployment)
15. [Troubleshooting](#troubleshooting)

---

## Project Overview

This is a **Laravel 12** API project that serves as a backend for a promotional website. The system provides both API endpoints for frontend consumption and an admin panel for content management.

### Key Features:
- **RESTful API** for frontend integration
- **Admin Panel** for content management
- **Authentication System** for admin access
- **Content Management** for Hero, About, Promotions, Reviews, and Contact sections
- **Contact Message System** with status tracking
- **Responsive Admin Interface** using Blade templates

### Technology Stack:
- **Backend**: Laravel 12 (PHP 8.2+)
- **Database**: MySQL/SQLite
- **Frontend Admin**: Blade templates with Tailwind CSS
- **Authentication**: Laravel Breeze
- **API**: RESTful endpoints

---

## System Requirements

### Minimum Requirements:
- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 18+ (for frontend assets)
- **Database**: MySQL 8.0+ or SQLite 3
- **Web Server**: Apache/Nginx or Laravel's built-in server

### PHP Extensions Required:
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

---

## Installation & Setup

### Step 1: Clone the Repository
```bash
git clone <repository-url>
cd Api_laravel
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

### Step 3: Install Node.js Dependencies
```bash
npm install
```

### Step 4: Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 5: Configure Database
Edit `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 6: Run Database Migrations
```bash
php artisan migrate
```

### Step 7: Seed Database (Optional)
```bash
php artisan db:seed
```

### Step 8: Start Development Server
```bash
# Start Laravel server
php artisan serve

# In another terminal, compile assets
npm run dev
```

**Result**: Your API will be available at `http://localhost:8000`

---

## Database Structure

### 1. Users Table
**Purpose**: Store admin user accounts for authentication

**Migration**: `0001_01_01_000000_create_users_table.php`

**Structure**:
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Usage**: Admin authentication and session management

### 2. Heros Table
**Purpose**: Store hero section content for the homepage

**Migration**: `2025_07_04_084954_create_heros_table.php`

**Structure**:
```sql
CREATE TABLE heros (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    subtitle TEXT NULL,
    background_gradient VARCHAR(255) DEFAULT 'linear-gradient(120deg, #042048 60%, #01AD88 100%)',
    image VARCHAR(255) NULL,
    order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Usage**: Hero slider content management

### 3. Abouts Table
**Purpose**: Store about section content

**Migration**: `2025_07_04_083301_create_abouts_table.php`

**Structure**:
```sql
CREATE TABLE abouts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255) NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### 4. Promotions Table
**Purpose**: Store promotional content

**Migration**: `2025_07_04_083956_create_promotions_table.php`

**Structure**:
```sql
CREATE TABLE promotions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NULL,
    link VARCHAR(255) NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### 5. Reviews Table
**Purpose**: Store customer reviews and testimonials

**Migration**: `2025_07_04_084157_create_reviews_table.php`

**Structure**:
```sql
CREATE TABLE reviews (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    rating INT NOT NULL,
    comment TEXT NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### 6. Contacts Table
**Purpose**: Store contact information

**Migration**: `2025_07_04_084429_create_contacts_table.php`

**Structure**:
```sql
CREATE TABLE contacts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    address TEXT NOT NULL,
    phone VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    website VARCHAR(255) NULL,
    social_media JSON NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### 7. Contact Messages Table
**Purpose**: Store contact form submissions

**Migration**: `2025_07_04_084856_create_contact_messages_table.php`

**Structure**:
```sql
CREATE TABLE contact_messages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('pending', 'read', 'replied') DEFAULT 'pending',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

---

## API Endpoints

### Public API Endpoints (No Authentication Required)

#### 1. Get Hero Content
```http
GET /api/hero
```

**Purpose**: Retrieve active hero slides for the homepage

**Response**:
```json
[
    {
        "id": 1,
        "title": "Welcome to Our Platform",
        "subtitle": "Discover amazing features",
        "background_gradient": "linear-gradient(120deg, #042048 60%, #01AD88 100%)",
        "image": "hero-image.jpg",
        "order": 1,
        "is_active": true,
        "created_at": "2025-01-01T00:00:00.000000Z",
        "updated_at": "2025-01-01T00:00:00.000000Z"
    }
]
```

**Implementation**: `HeroController::apiIndex()`

#### 2. Get About Content
```http
GET /api/about
```

**Purpose**: Retrieve about section content

**Response**:
```json
[
    {
        "id": 1,
        "title": "About Us",
        "content": "We are a leading company...",
        "image": "about-image.jpg",
        "is_active": true,
        "created_at": "2025-01-01T00:00:00.000000Z",
        "updated_at": "2025-01-01T00:00:00.000000Z"
    }
]
```

**Implementation**: `AboutController::index()`

#### 3. Get Promotions
```http
GET /api/promotion
```

**Purpose**: Retrieve promotional content

**Response**:
```json
[
    {
        "id": 1,
        "title": "Special Offer",
        "description": "Get 50% off on all products",
        "image": "promo-image.jpg",
        "link": "https://example.com/offer",
        "is_active": true,
        "created_at": "2025-01-01T00:00:00.000000Z",
        "updated_at": "2025-01-01T00:00:00.000000Z"
    }
]
```

**Implementation**: `PromotionController::index()`

#### 4. Get Reviews
```http
GET /api/reviews
```

**Purpose**: Retrieve customer reviews

**Response**:
```json
[
    {
        "id": 1,
        "name": "John Doe",
        "rating": 5,
        "comment": "Excellent service!",
        "is_active": true,
        "created_at": "2025-01-01T00:00:00.000000Z",
        "updated_at": "2025-01-01T00:00:00.000000Z"
    }
]
```

**Implementation**: `ReviewController::index()`

#### 5. Get Contact Information
```http
GET /api/contact-info
```

**Purpose**: Retrieve contact details

**Response**:
```json
[
    {
        "id": 1,
        "address": "123 Main Street, City, Country",
        "phone": "+1234567890",
        "email": "contact@example.com",
        "website": "https://example.com",
        "social_media": {
            "facebook": "https://facebook.com/example",
            "twitter": "https://twitter.com/example"
        },
        "is_active": true,
        "created_at": "2025-01-01T00:00:00.000000Z",
        "updated_at": "2025-01-01T00:00:00.000000Z"
    }
]
```

**Implementation**: `ContactController::index()`

#### 6. Submit Contact Message
```http
POST /api/contact-message
```

**Purpose**: Submit contact form

**Request Body**:
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "subject": "General Inquiry",
    "message": "I would like to know more about your services."
}
```

**Response**:
```json
{
    "message": "Message sent successfully!",
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "subject": "General Inquiry",
        "message": "I would like to know more about your services.",
        "status": "pending",
        "created_at": "2025-01-01T00:00:00.000000Z",
        "updated_at": "2025-01-01T00:00:00.000000Z"
    }
}
```

**Implementation**: `ContactMessageController::store()`

### Admin API Endpoints (Authentication Required)

All admin endpoints are prefixed with `/api/admin/` and require authentication.

#### Hero Management
```http
POST   /api/admin/hero          # Create hero
GET    /api/admin/hero/{id}     # Get specific hero
PUT    /api/admin/hero/{id}     # Update hero
DELETE /api/admin/hero/{id}     # Delete hero
```

#### About Management
```http
POST   /api/admin/about          # Create about
GET    /api/admin/about/{id}     # Get specific about
PUT    /api/admin/about/{id}     # Update about
DELETE /api/admin/about/{id}     # Delete about
```

#### Promotion Management
```http
POST   /api/admin/promotion          # Create promotion
GET    /api/admin/promotion/{id}     # Get specific promotion
PUT    /api/admin/promotion/{id}     # Update promotion
DELETE /api/admin/promotion/{id}     # Delete promotion
```

#### Review Management
```http
POST   /api/admin/reviews           # Create review
GET    /api/admin/reviews/{id}      # Get specific review
PUT    /api/admin/reviews/{id}      # Update review
DELETE /api/admin/reviews/{id}      # Delete review
```

#### Contact Management
```http
POST   /api/admin/contact           # Create contact
GET    /api/admin/contact/{id}      # Get specific contact
PUT    /api/admin/contact/{id}      # Update contact
DELETE /api/admin/contact/{id}      # Delete contact
```

#### Contact Messages Management
```http
GET    /api/admin/contact-messages              # List all messages
POST   /api/admin/contact-messages              # Create message
GET    /api/admin/contact-messages/{id}         # Get specific message
PUT    /api/admin/contact-messages/{id}         # Update message
DELETE /api/admin/contact-messages/{id}         # Delete message
GET    /api/admin/contact-messages/pending/count # Get pending count
```

---

## Admin Panel

### Accessing the Admin Panel

1. **Navigate to**: `http://localhost:8000/admin`
2. **Login** with admin credentials
3. **Dashboard** shows overview statistics and recent activity

### Dashboard Features

- **Statistics Overview**:
  - Total hero slides vs active slides
  - Total reviews vs active reviews
  - Total messages vs pending/read/replied messages
  - Total promotions, contacts, and users
- **Recent Activity**:
  - Latest 5 contact messages
  - Latest 5 reviews
- **Unread Messages Badge**:
  - Unread message count is shown as a badge next to 'Messages' in the navigation

### Content Management Sections

#### 1. Hero Management
**Location**: `/admin/hero`
- Create, edit, and delete hero slides
- All actions show success/error feedback
- Uses Material Icons

#### 2. About Management
**Location**: `/admin/about`
- Manage about section content
- All actions show success/error feedback
- Uses Material Icons

#### 3. Promotion Management
**Location**: `/admin/promotion`
- Manage promotions
- All actions show success/error feedback
- Uses Material Icons

#### 4. Review Management
**Location**: `/admin/reviews`
- Manage reviews
- All actions show success/error feedback
- Uses Material Icons

#### 5. Contact Management
**Location**: `/admin/contact`
- Manage contact information
- All actions show success/error feedback
- Uses Material Icons

#### 6. Contact Messages
**Location**: `/admin/contact-messages`
- View, mark as read/unread, and delete messages
- All actions show success/error feedback
- Toggle read status via PATCH `/admin/contact-messages/{id}/toggle-read`
- Unread badge in navigation

#### 7. Users, Settings, Profile, Audit Logs
- `/admin/users` (list users)
- `/admin/settings` (settings placeholder)
- `/admin/profile` (profile placeholder)
- `/admin/audit-logs` (audit logs placeholder)

---

## Admin Routes Summary

- `/admin/hero` (resource)
- `/admin/about` (resource)
- `/admin/promotion` (resource)
- `/admin/reviews` (resource)
- `/admin/contact` (resource)
- `/admin/contact-messages` (resource)
- `/admin/contact-messages/pending/count` (GET)
- `/admin/contact-messages/{id}/toggle-read` (PATCH)
- `/admin/users` (index)
- `/admin/settings` (GET)
- `/admin/profile` (GET)
- `/admin/audit-logs` (GET)
- `/logout` (POST, redirects to login)

---

## Authentication System

### User Registration
**Endpoint**: `POST /register`

**Process**:
1. User fills registration form
2. Data is validated
3. Password is hashed
4. User account is created
5. User is redirected to login

**Implementation**: `RegisteredUserController::store()`

### User Login
**Endpoint**: `POST /login`

**Process**:
1. User provides email/password
2. Credentials are validated
3. Session is created
4. User is redirected to admin dashboard

**Implementation**: `AuthenticatedSessionController::store()`

### User Logout
**Endpoint**: `POST /logout`

**Process**:
1. Session is destroyed
2. User is redirected to login page

**Implementation**: `AuthenticatedSessionController::destroy()`

### Authentication Middleware

**Protected Routes**:
- All admin panel routes (`/admin/*`)
- All admin API routes (`/api/admin/*`)

**Middleware**: `auth` middleware ensures only authenticated users can access protected routes.

---

## Models & Relationships

### User Model
**File**: `app/Models/User.php`

**Features**:
- Laravel's default authentication
- Password hashing
- Email verification support
- Remember token functionality

**Fillable Fields**:
- `name`
- `email`
- `password`

### Hero Model
**File**: `app/Models/Hero.php`

**Features**:
- Active scope for filtering
- Order management
- Image handling

**Fillable Fields**:
- `title`
- `subtitle`
- `background_gradient`
- `image`
- `order`
- `is_active`

### About Model
**File**: `app/Models/About.php`

**Features**:
- Active scope for filtering
- Content management

**Fillable Fields**:
- `title`
- `content`
- `image`
- `is_active`

### Promotion Model
**File**: `app/Models/Promotion.php`

**Features**:
- Active scope for filtering
- Link management

**Fillable Fields**:
- `title`
- `description`
- `image`
- `link`
- `is_active`

### Review Model
**File**: `app/Models/Review.php`

**Features**:
- Active scope for filtering
- Rating validation

**Fillable Fields**:
- `name`
- `rating`
- `comment`
- `is_active`

### Contact Model
**File**: `app/Models/Contact.php`

**Features**:
- Active scope for filtering
- Social media JSON handling

**Fillable Fields**:
- `address`
- `phone`
- `email`
- `website`
- `social_media`
- `is_active`

### ContactMessage Model
**File**: `app/Models/ContactMessage.php`

**Features**:
- Status management
- Email validation

**Fillable Fields**:
- `name`
- `email`
- `subject`
- `message`
- `status`

---

## Controllers

### API Controllers

#### HeroController
**File**: `app/Http/Controllers/Api/HeroController.php`

**Methods**:
- `apiIndex()`: Returns active hero slides for API
- `index()`: Admin view for hero management
- `store()`: Create new hero slide
- `show()`: Get specific hero slide
- `update()`: Update hero slide
- `destroy()`: Delete hero slide
- `create()`: Show create form
- `edit()`: Show edit form

#### AboutController
**File**: `app/Http/Controllers/Api/AboutController.php`

**Methods**:
- `index()`: Returns about content for API
- `store()`: Create new about section
- `show()`: Get specific about section
- `update()`: Update about section
- `destroy()`: Delete about section
- `create()`: Show create form
- `edit()`: Show edit form

#### PromotionController
**File**: `app/Http/Controllers/Api/PromotionController.php`

**Methods**:
- `index()`: Returns promotions for API
- `store()`: Create new promotion
- `show()`: Get specific promotion
- `update()`: Update promotion
- `destroy()`: Delete promotion
- `create()`: Show create form
- `edit()`: Show edit form

#### ReviewController
**File**: `app/Http/Controllers/Api/ReviewController.php`

**Methods**:
- `index()`: Returns reviews for API
- `store()`: Create new review
- `show()`: Get specific review
- `update()`: Update review
- `destroy()`: Delete review
- `create()`: Show create form
- `edit()`: Show edit form

#### ContactController
**File**: `app/Http/Controllers/Api/ContactController.php`

**Methods**:
- `index()`: Returns contact info for API
- `store()`: Create new contact info
- `show()`: Get specific contact info
- `update()`: Update contact info
- `destroy()`: Delete contact info
- `create()`: Show create form
- `edit()`: Show edit form

#### ContactMessageController
**File**: `app/Http/Controllers/Api/ContactMessageController.php`

**Methods**:
- `index()`: Returns all messages for admin
- `store()`: Create new message (public API)
- `show()`: Get specific message
- `update()`: Update message status
- `destroy()`: Delete message
- `create()`: Show create form
- `edit()`: Show edit form
- `pendingCount()`: Get count of pending messages

### Admin Controllers

#### DashboardController
**File**: `app/Http/Controllers/Admin/DashboardController.php`

**Methods**:
- `index()`: Display admin dashboard with statistics

### Auth Controllers

#### AuthenticatedSessionController
**File**: `app/Http/Controllers/Auth/AuthenticatedSessionController.php`

**Methods**:
- `create()`: Show login form
- `store()`: Process login
- `destroy()`: Process logout

#### RegisteredUserController
**File**: `app/Http/Controllers/Auth/RegisteredUserController.php`

**Methods**:
- `create()`: Show registration form
- `store()`: Process registration

---

## Views & Frontend

### Admin Views Structure

#### Layout
**File**: `resources/views/admin/layouts/app.blade.php`

**Features**:
- Responsive admin layout
- Navigation menu
- Flash message display
- User authentication status

#### Dashboard
**File**: `resources/views/admin/dashboard.blade.php`

**Features**:
- Statistics cards
- Recent activity widgets
- Quick action buttons

#### Content Management Views

Each content type has its own set of views:

**Hero Views**:
- `admin/hero/index.blade.php`: List all hero slides
- `admin/hero/create.blade.php`: Create new hero slide
- `admin/hero/edit.blade.php`: Edit existing hero slide
- `admin/hero/form.blade.php`: Reusable form component

**About Views**:
- `admin/about/index.blade.php`: List all about sections
- `admin/about/create.blade.php`: Create new about section
- `admin/about/edit.blade.php`: Edit existing about section
- `admin/about/form.blade.php`: Reusable form component

**Promotion Views**:
- `admin/promotion/index.blade.php`: List all promotions
- `admin/promotion/create.blade.php`: Create new promotion
- `admin/promotion/edit.blade.php`: Edit existing promotion
- `admin/promotion/form.blade.php`: Reusable form component

**Review Views**:
- `admin/reviews/index.blade.php`: List all reviews
- `admin/reviews/create.blade.php`: Create new review
- `admin/reviews/form.blade.php`: Reusable form component

**Contact Views**:
- `admin/contact/index.blade.php`: List all contact info
- `admin/contact/create.blade.php`: Create new contact info
- `admin/contact/edit.blade.php`: Edit existing contact info
- `admin/contact/form.blade.php`: Reusable form component

**Contact Messages Views**:
- `admin/contact-messages/index.blade.php`: List all messages
- `admin/contact-messages/show.blade.php`: View specific message
- `admin/contact-messages/create.blade.php`: Create new message
- `admin/contact-messages/edit.blade.php`: Edit message status
- `admin/contact-messages/form.blade.php`: Reusable form component

### Authentication Views

**Login**: `resources/views/auth/login.blade.php`
**Register**: `resources/views/auth/register.blade.php`

### Components

**Admin Components**:
- `components/admin/card.blade.php`: Reusable card component
- `components/admin/form.blade.php`: Reusable form component
- `components/admin/table.blade.php`: Reusable table component

### Styling

The admin panel uses:
- **Tailwind CSS** for styling
- **Responsive design** for mobile compatibility
- **Modern UI components** for better UX

---

## File Structure

```
Api_laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   └── DashboardController.php
│   │   │   ├── Api/
│   │   │   │   ├── AboutController.php
│   │   │   │   ├── ContactController.php
│   │   │   │   ├── ContactMessageController.php
│   │   │   │   ├── HeroController.php
│   │   │   │   ├── PromotionController.php
│   │   │   │   └── ReviewController.php
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   └── RegisteredUserController.php
│   │   │   └── Controller.php
│   │   └── Requests/
│   │       └── Auth/
│   │           └── LoginRequest.php
│   ├── Models/
│   │   ├── About.php
│   │   ├── Contact.php
│   │   ├── ContactMessage.php
│   │   ├── Hero.php
│   │   ├── Promotion.php
│   │   ├── Review.php
│   │   └── User.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── RouteServiceProvider.php
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   └── ...
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2025_07_04_083301_create_abouts_table.php
│   │   ├── 2025_07_04_083956_create_promotions_table.php
│   │   ├── 2025_07_04_084157_create_reviews_table.php
│   │   ├── 2025_07_04_084429_create_contacts_table.php
│   │   ├── 2025_07_04_084856_create_contact_messages_table.php
│   │   └── 2025_07_04_084954_create_heros_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── hero/
│       │   ├── about/
│       │   ├── promotion/
│       │   ├── reviews/
│       │   ├── contact/
│       │   ├── contact-messages/
│       │   └── layouts/
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       └── components/
│           └── admin/
├── routes/
│   ├── api.php
│   ├── web.php
│   └── auth.php
├── storage/
├── tests/
├── composer.json
├── package.json
└── README.md
```

---

## Development Workflow

### 1. Setting Up Development Environment

**Step 1**: Install dependencies
```bash
composer install
npm install
```

**Step 2**: Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

**Step 3**: Set up database
```bash
php artisan migrate
php artisan db:seed
```

**Step 4**: Start development servers
```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Asset compilation
npm run dev
```

### 2. Adding New Features

**Step 1**: Create migration
```bash
php artisan make:migration create_new_table
```

**Step 2**: Create model
```bash
php artisan make:model NewModel
```

**Step 3**: Create controller
```bash
php artisan make:controller Api/NewController
```

**Step 4**: Add routes
```bash
# In routes/api.php
Route::get('/new', [NewController::class, 'index']);
```

**Step 5**: Create views (if needed)
```bash
# Create view files in resources/views/admin/new/
```

### 3. Testing Changes

**Step 1**: Run migrations
```bash
php artisan migrate
```

**Step 2**: Test API endpoints
```bash
# Using curl or Postman
curl http://localhost:8000/api/hero
```

**Step 3**: Test admin panel
```bash
# Visit http://localhost:8000/admin
```

### 4. Code Quality

**Step 1**: Run Laravel Pint (code style)
```bash
./vendor/bin/pint
```

**Step 2**: Run tests
```bash
php artisan test
```

---

## Testing

### Running Tests
```bash
php artisan test
```

### Test Structure
```
tests/
├── Feature/
│   └── ExampleTest.php
├── Unit/
│   └── ExampleTest.php
└── TestCase.php
```

### Writing Tests

**Example API Test**:
```php
public function test_can_get_hero_content()
{
    $response = $this->get('/api/hero');
    
    $response->assertStatus(200)
             ->assertJsonStructure([
                 '*' => [
                     'id',
                     'title',
                     'subtitle',
                     'background_gradient',
                     'image',
                     'order',
                     'is_active'
                 ]
             ]);
}
```

**Example Admin Test**:
```php
public function test_admin_can_create_hero()
{
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)
                     ->post('/admin/hero', [
                         'title' => 'Test Hero',
                         'subtitle' => 'Test Subtitle',
                         'background_gradient' => 'linear-gradient(red, blue)',
                         'is_active' => true
                     ]);
    
    $response->assertRedirect('/admin/hero');
    $this->assertDatabaseHas('heros', ['title' => 'Test Hero']);
}
```

---

## Deployment

### Production Deployment Steps

#### 1. Server Requirements
- PHP 8.2+
- Composer
- MySQL 8.0+ or PostgreSQL
- Nginx or Apache
- SSL certificate

#### 2. Deployment Process

**Step 1**: Clone repository
```bash
git clone <repository-url>
cd Api_laravel
```

**Step 2**: Install dependencies
```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

**Step 3**: Configure environment
```bash
cp .env.example .env
# Edit .env with production settings
```

**Step 4**: Generate keys
```bash
php artisan key:generate
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

**Step 5**: Set up database
```bash
php artisan migrate --force
php artisan db:seed --force
```

**Step 6**: Set permissions
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

#### 3. Nginx Configuration

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/Api_laravel/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

#### 4. Environment Variables

**Production .env**:
```env
APP_NAME="Your App Name"
APP_ENV=production
APP_KEY=base64:your-generated-key
APP_DEBUG=false
APP_URL=https://your-domain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_production_db
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

---

## Troubleshooting

### Common Issues

#### 1. Permission Errors
**Problem**: Storage or cache directories not writable

**Solution**:
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

#### 2. Database Connection Issues
**Problem**: Cannot connect to database

**Solution**:
1. Check database credentials in `.env`
2. Ensure database server is running
3. Verify database exists
4. Check network connectivity

#### 3. 500 Server Error
**Problem**: Internal server error

**Solution**:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Enable debug mode temporarily: `APP_DEBUG=true`
3. Clear caches: `php artisan config:clear`

#### 4. API Endpoints Not Working
**Problem**: API returns 404 or other errors

**Solution**:
1. Check routes are properly defined
2. Verify middleware configuration
3. Test with Postman or curl
4. Check API prefix in routes

#### 5. Admin Panel Access Issues
**Problem**: Cannot access admin panel

**Solution**:
1. Ensure user is authenticated
2. Check auth middleware is applied
3. Verify user has proper permissions
4. Clear session: `php artisan session:clear`

### Debugging Tools

#### 1. Laravel Debug Bar
```bash
composer require barryvdh/laravel-debugbar --dev
```

#### 2. Laravel Telescope
```bash
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

#### 3. Log Files
```bash
# View Laravel logs
tail -f storage/logs/laravel.log

# View web server logs
tail -f /var/log/nginx/error.log
```

### Performance Optimization

#### 1. Caching
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache
```

#### 2. Database Optimization
```bash
# Optimize database
php artisan db:optimize

# Clear query cache
php artisan db:clear-cache
```

#### 3. Asset Optimization
```bash
# Build for production
npm run build

# Optimize images
# Use tools like ImageOptim or TinyPNG
```

---

## Conclusion

This Laravel API provides a robust backend for a promotional website with:

- **RESTful API endpoints** for frontend integration
- **Admin panel** for content management
- **Authentication system** for secure access
- **Comprehensive content management** for all website sections
- **Contact message system** with status tracking
- **Modern development workflow** with testing and deployment

The system is designed to be scalable, maintainable, and follows Laravel best practices. The documentation provides step-by-step guidance for setup, development, and deployment.

For additional support or questions, refer to:
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel API Resources](https://laravel.com/docs/eloquent-resources)
- [Laravel Testing](https://laravel.com/docs/testing)

## Recent Admin Panel Improvements (2024)

- **Consistent Success & Error Feedback:** All content management actions (add, edit, delete) for About, Hero, Promotion, Review, Contact, and Contact Messages now display clear success and error flash messages at the top of each page.
- **Material Icons Everywhere:** All icons in the admin panel use Material Icons for a modern, consistent look.
- **Simplified Navigation:** The admin navigation no longer includes search or dark/light mode toggles, focusing on essential features only.
- **Unread Messages Badge:** The number of unread messages is shown as a red badge next to the 'Messages' link in the admin navigation.
- **Audit Logs, Profile, and Settings:** These pages are present as placeholders or basic pages for future expansion.
- **Logout Redirect:** Logging out now always redirects to the login page for a smooth user experience.
- **All Admin Routes Defined:** All necessary admin routes (including toggle-read for messages) are defined and documented below.
- **Professional Error Handling:** All user feedback is consistent and professional across the admin panel. 