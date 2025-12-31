<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Score;

class Alternative extends Model
{
    protected $table = 'alternatives';
    protected $primaryKey = 'alternative_id';
    protected $guarded = [];

    public function scores()
    {
        return $this->hasMany(Score::class, 'alternative_id', 'alternative_id');
    }
}
