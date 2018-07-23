<?php


/**
 * Check if it is admin
 */
function is_admin() {
    return is_role('admin');
}

function is_role($role) {
    if(auth()->check() && auth()->user()->role == $role) {
        return true;
    }

    return false;
}

/**
 * Return nav-here if current path begins with this path.
 */
function is_active($paths, $active_class = 'active', $not_active = '')
{
    if (is_array($paths)) {
        foreach ($paths as $path) {
            if (request()->is($path)) {
                return $active_class;
            }
        }

        return $not_active;
    } else {
        return request()->is($paths) ? $active_class :  $not_active;
    }
}