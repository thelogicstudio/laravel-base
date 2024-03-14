<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Authenticatable implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable, AuthorizesRequests, ValidatesRequests, SoftDeletes;

    public $table = 'roles';

    public $fillable = [
        'name'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    public static $rules = [
        'name' => 'required|string|max:191'
    ];

    public static $searchable = [
        'name' => 'Name',
    ];

    public function getFillable() {
        return $this->fillable;
    }

    public function getSearchable() {
        return $this->searchable;
    }

    public function privileges()
    {
        return $this->belongsToMany(Privilege::class, 'privilege_role');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }

}
