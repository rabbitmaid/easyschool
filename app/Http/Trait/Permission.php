<?php


namespace App\Http\Trait;

use Illuminate\Support\Facades\Gate;


/**
 * Admin Authorizations to be Inherited
 */
trait Permission
{

    /**
     * Super Admin and Admin Only Access
     * 
     * @return void
     */
    public static function admin_only()
    {

        $admin = auth('admin')->user();
        
        if(Gate::denies('admin-only', $admin)){
            abort(403, 'Access Forbidden');
        }
    }


    /**
     * Super Admin Only Access
     *
     * @return void
     */
    public static function super_admin()
    {

        $admin = auth('admin')->user();

        if(Gate::denies('super-admin', $admin)){
            abort(403, 'Access Forbidden');
        }
    }


    /**
     * Admin Only Access
     *
     * @return void
     */
    public static function admin()
    {

        $admin = auth('admin')->user();

        if(Gate::denies('admin', $admin)){
            abort(403, 'Access Forbidden');
        }
    }


    /**
     * Teacher Only Access
     *
     * @return void
     */
    public static function teacher()
    {

        $admin = auth('admin')->user();

        if(Gate::denies('teacher', $admin)){
            abort(403, 'Access Forbidden');
        }
    }



     /**
     * All Admin Access
     *
     * @return void
     */
    public static function all_admin()
    {
        $admin = auth('admin')->user();

        if(Gate::denies('all-admin', $admin)){
            abort(403, 'Access Forbidden');
        }
    }

}