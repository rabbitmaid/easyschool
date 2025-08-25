<?php

namespace App\Http\Trait;

use App\Models\Option;

/**
 * Get and Manage Site Options
 */
trait SiteOption
{

    /**
     * Get and Return the site title
     *
     * @return string
     */
    public static function siteTitle()
    {
        $siteTitle = Option::select('value')->where(['name' => 'site_title'])->first();   
        return $siteTitle['value'];
    }

}