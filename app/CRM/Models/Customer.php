<?php
namespace App\CRM\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'email', 'source', 'status', 'phone', 'address', 'company', 'birthdate'
    ];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}