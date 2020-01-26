<?php

/**
 * Copyright 2008-2016 Kyle Baker (Email: kyleabaker@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */

/* Partly modified by Hakula */

/* Detect Web Browser Version */
function get_browser_version($ua, $title) {
    // Grab the browser version if it's present
    preg_match('/' . $title . '[\ |\/|\:]?([.0-9a-zA-Z]+)/i', $ua, $regmatch);
    $version = (is_null($regmatch[1])) ? '' : $regmatch[1];
    return $version;
}
