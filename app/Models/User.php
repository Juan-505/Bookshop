<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';

    protected $primaryKey = 'user_id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'full_name',
        'password_hash',
        'user_role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'password_hash',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function getAuthPassword(): string
    {
        return (string) $this->password_hash;
    }

    public function getNameAttribute(): ?string
    {
        return $this->full_name;
    }

    public function setNameAttribute(string $value): void
    {
        $this->attributes['full_name'] = $value;
    }

    public function getRoleAttribute(): ?string
    {
        return $this->user_role;
    }

    public function setRoleAttribute(string $value): void
    {
        $this->attributes['user_role'] = $value;
    }

    public function getPasswordAttribute(): ?string
    {
        return $this->password_hash;
    }

    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password_hash'] = $value;
    }
}
