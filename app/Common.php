<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (!function_exists('time_ago')) {
    /**
     * Returns a human-readable "X minutes ago" string.
     */
    function time_ago(string $datetime): string
    {
        $diff = time() - strtotime($datetime);

        if ($diff < 60)           return 'just now';
        if ($diff < 3600)         return floor($diff / 60) . 'm ago';
        if ($diff < 86400)        return floor($diff / 3600) . 'h ago';
        if ($diff < 86400 * 7)   return floor($diff / 86400) . 'd ago';
        if ($diff < 86400 * 30)  return floor($diff / (86400 * 7)) . 'w ago';
        if ($diff < 86400 * 365) return floor($diff / (86400 * 30)) . 'mo ago';
        return floor($diff / (86400 * 365)) . 'y ago';
    }
}
