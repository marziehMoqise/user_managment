<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
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
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'country',
        'currency',
    ];

    /**
     * Scope filter
     * @param Builder $query
     * @return Builder query builder.
     * @var array $data : array of filters.
     */
    public function scopeFilter(Builder $query, array $data = []): Builder
    {
        if (!empty($data['name'])) {
            $query->where('name', 'like', '%' . strtolower($data['name']) . '%');
        }
        if (!empty($data['email'])) {
            $query->where('email', 'like', '%' . strtolower($data['email']) . '%');
        }
        if (!empty($data['country'])) {
            $query->where('country', $data['country']);
        }
        if (!empty($data['currency'])) {
            $query->where('currency', $data['currency']);
        }
        return $query;
    }

}
