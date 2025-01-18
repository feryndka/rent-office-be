# Rent - Office Setup Guide  

### Admin Credentials  
- Email: `fery@rentoffice.com`  
- Password: `123456789`  

---

### 🚀 Project Steps  
**1. Install Laravel**

Run the following command to install Laravel 11:  
```bash  
composer create-project laravel/laravel rentoffice
```
###
**2. Configure Environment**

Update the `.env` file with the following details:  
- Database Settings: Configure your database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
- App URL: Set `APP_URL` to match your application's domain.

###
**3. Generate Models and Migrations**

Run these commands to create models with migrations:  
```bash  
php artisan make:model City -m  
php artisan make:model OfficeSpace -m  
php artisan make:model OfficeSpacePhoto -m  
php artisan make:model OfficeSpaceBenefit -m  
php artisan make:model BookingTransaction -m  
php artisan make:model ApiKey -m 
```

###
**4. Install Filament Admin Panel**
- Filament is a modern Laravel admin panel.
- Learn more here: [Filament](https://filamentphp.com)

Use the following commands to install Filament:
```bash  
composer require filament/filament:"^3.2" -W  
php artisan filament:install --panels  
php artisan make:filament-user
```
During installation, you can create your first Filament user for admin access.
###
**5. Setting Resource Filament**

Use the following commands to install Resource Filament:
``` bash
php artisan make:filament-resource City
php artisan make:filament-resource OfficeSpace
php artisan make:filament-resource BookingTransaction
php artisan make:filament-resource ApiKey
```
###
**6. Setting Up CMS**

CRUD Management
- `City`: Add, edit, and manage data city.
- `Office Space`: Handle listings for office spaces, including details, photos, and benefits.
- `Booking Transaction`: Track and manage user bookings for office spaces.

Additional Models
- `OfficeSpacePhoto`: Manage photos for each office space.
- `OfficeSpaceBenefit`: Attach benefits like WiFi, parking, and more to office spaces.
- `ApiKey`: Secure integration with external API.
###
**7. Setting APIs End Point**

Use the following commands to install Resource Laravel for API:
``` bash
php artisan make:resource Api/CityResource
php artisan make:resource Api/OfficeSpaceResource
php artisan make:resource Api/OfficeSpacePhotoResource
php artisan make:resource Api/OfficeSpaceBenefitResource
php artisan make:resource Api/BookingTransactionResource
php artisan make:resource Api/ViewBookingResource
```

Install API:
``` bash
php artisan install:api
```

Install Controller API:
``` bash
php artisan make:controller Api/CityController
php artisan make:controller Api/OfficeSpaceController
php artisan make:controller Api/BookingTransactionController
```

Setting route API in `routes/api.php`
