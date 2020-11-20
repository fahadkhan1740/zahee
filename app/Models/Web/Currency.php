<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Currency extends Model
{

    public function getter()
    {
        return DB::table('currencies')->get();
    }

}
