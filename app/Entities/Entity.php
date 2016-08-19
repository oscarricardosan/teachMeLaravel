<?php
/**
 * Created by PhpStorm.
 * User: masterdev
 * Date: 16/08/2016
 * Time: 22:49
 */

namespace TeachMe\Entities;


use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    public static function getClass()
    {
        return get_class(new static);
    }
}