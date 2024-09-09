<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pirate extends Model
{
    use HasFactory;

    // Define the table name (optional if it's 'pirates' by default)
    protected $table = 'pirates';

    // Allow mass assignment for these fields
    protected $fillable = ['name', 'role', 'bounty', 'image'];

    // Optionally, you can define any relationships (e.g., one-to-many, many-to-many, etc.) if needed in the future.
}