<?php

namespace App\Models\Laravel_test_admin_website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    /** @var string  */
    protected $table = 'products';

    /** @var string  */
    protected $connection = "laravel_test_admin_website";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'price',
    ];

    /** @var array  */
    protected $dates = [
        'created_at', 'update_at', 'deleted_at'
    ];

    /**
     * get orders_id priradene ku products_id
     */

    public function orders()
    {
        return $this->hasMany(ProductOrderPivot::Class, 'products_id', 'id');
    }

}
