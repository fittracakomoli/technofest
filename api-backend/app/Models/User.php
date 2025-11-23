<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke Role (user -> role)
     */
    public function roles(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Mengecek apakah user memiliki permission tertentu
     */
    public function hasPermission(string $permission): bool
    {
        return $this->role?->hasPermission($permission) ?? false;
    }

    /**
     * Mengecek apakah user memiliki salah satu permission dari array
     */
    public function hasAnyPermission(array $permissions): bool
    {
        foreach ($permissions as $perm) {
            if ($this->hasPermission($perm)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Mengecek apakah user memiliki semua permission di array
     */
    public function hasAllPermissions(array $permissions): bool
    {
        foreach ($permissions as $perm) {
            if (!$this->hasPermission($perm)) {
                return false;
            }
        }
        return true;
    }

    public function hasRole($roleNames)
    {
        // Jika $roleNames adalah string, ubah menjadi array untuk penanganan seragam
        if (!is_array($roleNames)) {
            $roleNames = [$roleNames];
        }
        
        // Gunakan relasi roles() untuk mengecek apakah ada peran yang cocok
        return $this->roles()->whereIn('name', $roleNames)->exists();
    }

    /**
     * Mengambil nama role user
     */
    public function getRoleName(): string
    {
        return $this->role?->name ?? 'No Role';
    }

    /**
     * Mengecek apakah user adalah admin
     */
    public function isAdmin(): bool
    {
        return strtolower($this->getRoleName()) === 'admin';
    }

    /**
     * Mengecek apakah user adalah organizer
     */
    public function isOrganizer(): bool
    {
        return strtolower($this->getRoleName()) === 'organizer';
    }

    /**
     * Mengecek apakah user adalah anggota
     */
    public function isCustomer(): bool
    {
        return strtolower($this->getRoleName()) === 'customer';
    }
}
