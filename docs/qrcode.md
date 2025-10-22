# QR Code Generator

This QR Code generator class provides a simple and elegant way to generate QR codes in your Laravel application. It handles QR code generation, storage, URL creation, and cleanup with a fluent API.

## Features

✅ Generate QR codes as PNG images <br />
✅ Automatic storage management in Laravel's public disk <br />
✅ Encoded verification URLs for security <br />
✅ Fluent method chaining API <br />
✅ Easy cleanup with delete method <br />
✅ Integration with Laravel Storage facade <br />


## Requirements

- PHP 8.2 or higher
- Laravel 9.x, 10.x, or 11.x
- QR Code external library `phpqrcode`
- Custom `Verification` class for encoding

## Installation

### 1. Install QR Code Library
- [Download QR Code Library](https://sourceforge.net/projects/phpqrcode/files/latest/download)
- Extract to `libs\phpqrcode`
- Add a composer in `composer.json`:
```json
"autoload": {
    "files": [
        "libs/phpqrcode/qrlib.php"
    ]
}
```
- Run Composer Autoload Dump:
```bash
composer dump-autoload
```

### 2. Ensure Storage Link

Make sure your public storage is linked:

```bash
php artisan storage:link
```

### 3. Encoded/Decode QRCode URLs

Ensure you have the `Verification` class in `app/Support/Verification.php`:

```php
<?php

use App\Support\Verification;

/**
* Encode Verification Code
* 
* @param string $value
* @return string
*/
$encode = Verification::encode(string $value);

/**
* Decode Verification Value
* 
* @param string $encode
* @return string
*/
$value = Verification::decode(string $encode);
```

### 4. Define Verification Controller
```php
<?php

use App\Support\Verification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $req)
    {
        $fileName = Verification::decode($req->code);
        return view('verification', compact('fileName'));
    }
}
```

### 5. Define Verify Route

Add a route in `routes/web.php`:

```php
Route::get('/verify/{code}', [VerificationController::class, 'verify'])->name('verify');
```

## Usage

### Basic QR Code Generation

```php
<?php

use App\Support\Facades\QRCode;

/** 
 * Generate QR code from a URL context 
 */
$qrCode = QRCode::url('certificate_12345.pdf')->generate();

/**
 * Get the file system path
 * 
 * Example: /var/www/html/storage/app/public/qrcode/qrcode_1704067200.png
 */
$path = $qrCode->getPath();

/** Get the verification URL
 * 
 * Example: https://yourapp.com/verify/Y2VydGlmaWNhdGVfMTIzNDU=
 */
$url = $qrCode->getUrl();
```

### Generate QR Code with Custom Context

```php
<?php

use App\Support\Facades\QRCode;

/** 
 * Generate QR code with custom text/URL directly
 */
$qrCode = QRCode::generate('https://example.com/custom-link');

/**
 * Get the file system path
 * 
 * Example: /var/www/html/storage/app/public/qrcode/qrcode_1704067200.png
 */
$path = $qrCode->getPath();
```

### Delete QR Code After Use

```php
<?php

use App\Support\Facades\QRCode;

/** 
 * Generate QR code with custom text/URL directly
 */
$qrCode = QRCode::url('temporary_file.pdf')->generate();

// Clean up when done
$qrCode->delete();
```

### License 
MIT License. © 2025 [FullStackOnDemand](https://github.com/fullstackondemand)