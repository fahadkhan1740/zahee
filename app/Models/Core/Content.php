<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;


class content extends Model {

    use Sortable;
    public $sortable =['id','title'];

    public static function contentList($language_id) {
    }
}
