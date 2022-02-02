<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class Employees extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    use SoftDeletes;
    use HasApiTokens;
    use HasRoles;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected static $logAttributes = [
        'name', 'email', 'password',
    ];

    protected static $recordEvents = [
        'created', 'updated', 'deleted'
    ];

    protected static $logOnlyDirty = true;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function scopeFilter($query, array $filter)
    {
        $likeFilter = Arr::only($filter, ['name']);
        $equalFilter = Arr::only($filter, ['email']);
        foreach ($likeFilter as $key => $value) {
            if (!empty($value)) {
                $query->where($key, 'LIKE', "%{$value}%");
            }
        }
        foreach ($equalFilter as $key => $value) {
            if (!empty($value)) {
                $query->where($key, $value);
            }
        }
        $column = empty($filter["order_by"]) ? "name" : $filter["order_by"];
        $sorted_check = ['ASC', 'DESC'];
        $sorted = !empty($filter["order_by"]) && in_array($filter["order_sorted"], $sorted_check) ?  $filter["order_sorted"] : "ASC";
        $query->orderBy($column, $sorted);
        return $query;
    }
}
