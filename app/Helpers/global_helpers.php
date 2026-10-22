<?php

/* check user à une permission sur quelque chose */
if (!function_exists('hasPermission')) {
    function hasPermission(array $permission) : bool
    {
        return auth('admin')->user()->hasAnyPermission($permission);
    }
}
