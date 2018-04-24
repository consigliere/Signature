<?php
/**
 * BaseModel.php
 * Created by @anonymoussc on 6/5/2017 6:23 AM.
 */

namespace App\Components\Signature\Models;

use Illuminate\Database\Eloquent\Model;
use App\Components\Signature\Traits\QueryBasic;
use App\Components\Signature\Traits\Pagination;

class BaseModel extends Model
{
    use QueryBasic, Pagination;

    protected $fillable = [];
}
