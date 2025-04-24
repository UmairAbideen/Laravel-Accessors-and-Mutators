# 🧠 Laravel 10 Accessors & Mutators

This project demonstrates how to use **Accessors** and **Mutators** in Laravel 10 to automatically format, transform, and secure model attributes using Eloquent's built-in customization features.

Accessors let you **modify data when retrieving** it from the database, while Mutators let you **modify data before saving** it to the database.

---

## ❓ Why Use Accessors & Mutators?

Accessors and Mutators are powerful because they allow you to:

- 🔐 Automatically **encrypt** and **decrypt** sensitive data like debit-card number.
- 🧹 Format values consistently (e.g., capitalize names, format currency).
- 💾 Save structured data (like arrays) using JSON encoding/decoding.
- 🧠 Keep your data transformations **inside your model**, keeping controllers clean.

> These tools help improve **security**, **readability**, and **data consistency**.

---

## 🛠️ Tech Stack

| Tool         | Purpose                          |
|--------------|----------------------------------|
| Laravel 10   | PHP framework                    |
| Eloquent ORM | Database modeling and relations  |
| Crypt Facade | Secure encryption/decryption     |
| PHP Helpers  | String/data manipulation         |

---

## 🚀 Important Steps

1️⃣ Create a Laravel Model

Example: `User.php` in `app/Models`  
Make sure it has the necessary `$fillable` fields.

```php
protected $fillable = ['name', 'email', 'gender', 'age', 'contact'];
```

2️⃣ Define Accessors and Mutators in the Model

```bash
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'gender', 'age', 'contact'];

    // 🔐 Mutator: Encrypt contact before storing
    public function setContactAttribute($value)
    {
        $this->attributes['contact'] = Crypt::encryptString($value);
    }

    // 🔓 Accessor: Decrypt contact when retrieving
    public function getContactAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    // 🧹 Accessor: Capitalize the first letter of name
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    // 🧹 Accessor: Capitalize gender
    public function getGenderAttribute($value)
    {
        return ucfirst($value);
    }

```

## 📚 Common Accessor & Mutator Methods

Here are some useful methods you’ll often use when creating accessors and mutators:

| Method                          | Purpose                                                                 |
|---------------------------------|-------------------------------------------------------------------------|
| `ucfirst()`                     | Capitalize the first letter of a string (john → John)                   |
| `ucwords()`                     | Capitalize the first letter of each word (john doe → John Doe)          |
| `strtolower()`                  | Convert the string to lowercase (EMAIL@EX.COM → email@ex.com)           |
| `strtoupper()`                  | Convert string to uppercase (john → JOHN)                               |
| `trim()`                        | Remove whitespace from the start and end of a string                    |
| `Crypt::encryptString()`        | Encrypt a string securely before saving                                 |
| `Crypt::decryptString()`        | Decrypt a string when retrieving                                        |
| `json_encode()`                 | Convert array to JSON string for storing in DB                          |
| `json_decode()`                 | Convert JSON string back to array when reading                          |
| `Str::slug()`                   | Convert text to URL-friendly slug (John Doe → john-doe)                 |
| `Str::title()`                  | Capitalize each word, supports Unicode                                  |
