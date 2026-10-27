<?php

/* check user à une permission sur quelque chose */
if (!function_exists('hasPermission')) {
    function hasPermission(array $permission) : bool
    {
        /* Ici nous verifions si l'auth est admin
        il a accès à toutes les fonctionnalités */
        if(auth('admin')->user()->hasRole('Super Admin')) return true;

        return auth('admin')->user()->hasAnyPermission($permission);
    }
}
