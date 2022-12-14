<?php 
/**
 * PHP Version 7.4.9
 * 
 * @category Helpers
 * @package  Equus
 * @author   Dan Castanera <dan@ctsfla.com>
 * @license  https://ctsfla.com/equus/proprietary-license Proprietary
 * @link     https://ctsfla.com/equus
 */

namespace Stingraydevelopment\RolesAndPermissions;

use Illuminate\Support\Facades\Blade;

/**
 * Custom Blade Directives Helper
 * Adds custom blade commands to manage roles easily in views.
 * 
 * @category Helpers
 * @package  Equus
 * @author   Dan Castanera <dan@ctsfla.com>
 * @license  https://ctsfla.com/equus/proprietary-license Proprietary
 * @link     https://ctsfla.com/equus
 */
class BladeDirectives {

    public static function boot()
    {
        /**
         * Custom Blade Directives
         */

        // Role
        Blade::directive(
            'role', function ($expression) {
                return "<?php if (Auth::id() > 0 && Auth::user()->hasRole($expression)) : ?>";
            }
        );

        // Else Role
        Blade::directive(
            'elseifrole', function ($expression) {
                return "<?php elseif (Auth::id() > 0 && Auth::user()->hasRole($expression)) : ?>";
            }
        );

        // EndRole
        Blade::directive(
            'endrole', function () {
                return "<?php endif ?>";
            }
        );
    }
}