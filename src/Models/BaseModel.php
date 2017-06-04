<?php
/**
 * BaseModel.php
 * Created by @rn on 12/28/2016 10:30 AM.
 */

namespace App\Components\Signature\Models;

use Illuminate\Database\Eloquent\Model;
use App\Components\Signature\Traits\QueryBasic;
use App\Components\Signature\Traits\Pagination;
use App\Components\Signal\Traits\Signal;

class BaseModel extends Model
{
    use QueryBasic;
    use Pagination;
    use Signal;

    protected $fillable = [];
}
