<?php

namespace Stingraydevelopment\RolesAndPermissions;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stingraydevelopment\RolesAndPermissions\Permission;

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
class Role extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * This table in the database where users are stored.
     * 
     * @var String
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var Array<Integer, String>
     */
    protected $fillable = [
        'name', 
        'slug', 
        'description',
    ];

    /**
     * The attributes appended to the model.
     */
    protected $appends = [
        'permission_ids',
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
     * Permission ids attribute appended to the user
     * 
     * @return Array Permission ids from attached roles
     */
    public function getPermissionIdsAttribute()
    {
        // Start with an empty array.
        $permission_ids = [];
        // Loop through the attached roles for this user.
        foreach ($this->permissions as $permission) {
            // Add the role id to the array.
            array_push($permission_ids, $permission->id);
        }
        // Return the role ids 
        return $permission_ids;
    }

    /**
     * The eloquent relationship between this role and permissions.
     * 
     * @return Array of Permission objects
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * The eloquent relationship between this role and users.
     * 
     * @return Array of User objects
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}