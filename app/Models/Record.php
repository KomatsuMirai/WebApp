<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;

class Record extends Model
{


    protected $fillable = [
        'price',
        'note',
        'registration_date',
    ];

    protected $guarded = [
        'id',
        'user_id',
        'category_id',
    ];

    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this ->belongsTo(Category::class);
    }


}
