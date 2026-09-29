<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationRegistration extends Model
{
    use HasFactory;

    protected $table = 'application_registrations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'application_id',
        'name',
        'email',
        'phone',
        'organization',
        'designation',
        'purpose',
        'ip_address',
        'user_agent',
    ];

    /**
     * Relationship: application this registration belongs to
     */
    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }
}
