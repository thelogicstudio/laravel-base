<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use AuthorizesRequests, ValidatesRequests, HasFactory, Notifiable, SoftDeletes, \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function createNewUser($input) {
        $user = User::create($input);
        return $user;
    }

    public function isAdmin() {
        return $this->roles()->get()->contains(1);
    }

    public function allowedTo($privileges): bool {
        if (is_string($privileges)) {
            $privileges = explode(",", $privileges);
        }

        $roles = Cache::remember(auth()->user()->id.'-privileges', 900, function() use ($privileges){
            return $this->roles()->with('privileges')->get()->pluck('privileges')->flatten()->groupBy('name');
        });

        return $roles->has($privileges);
    }

    public function hasRole($role_id) {
        return $this->roles()->get()->contains($role_id);
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'user_role');
    }
}
