<?php
/**
 * Created by PhpStorm.
 * User: XSC
 * Date: 2017/4/9
 * Time: 15:30
 */

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
}