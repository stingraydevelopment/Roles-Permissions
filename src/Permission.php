<?php

namespace Stingraydevelopment\RolesAndPermissions;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stingraydevelopment\RolesAndPermissions\Role;

/**
 * Permission Model
 * Equus Permission model based off a standard Laravel model.
 * 
 * @category Models
 * @package  RolesAndPermissions
 * @author   Dan Castanera <dan@stingraydev.com>
 * @license  https://stingraydev.com/packages/composer/proprietary-license Proprietary
 * @link     https://stingraydev.com/packages/composer/roles-and-permissions
 */
class Permission extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * This table in the database where users are stored.
     * 
     * @var String
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var Array<Integer, String>
     */
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    /**
     * Boot function
     * 
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::creating(
            function ($model) {
                if (!$model->slug) {
                    $cleaned = str_replace(' ', '-', $model->name);
                    $sanitized = preg_replace('/[^a-zA-Z0-9\-]/', '', $cleaned);
                    $model->slug = strtolower($sanitized);
                }
            }
        );

        self::updating(
            function ($model) {
                if (!$model->slug) {
                    $cleaned = str_replace(' ', '-', $model->name);
                    $sanitized = preg_replace('/[^a-zA-Z0-9\-]/', '', $cleaned);
                    $model->slug = strtolower($sanitized);
                }
            }
        );
    }

    /**
     * The eloquesnt relationship between this permission and roles.
     * 
     * @return Array of Roles objects
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * The eloquent relationship between this permission and users.
     * 
     * @return Array of User objects
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
