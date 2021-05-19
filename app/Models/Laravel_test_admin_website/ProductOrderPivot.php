<?php

namespace App\Models\Laravel_test_admin_website;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasCompositePrimaryKeyTrait;

class ProductOrderPivot extends Model
{
    use HasFactory, SoftDeletes;

    /** @var string  */
    protected $table = 'products_orders_pivot';

    /** @var string  */
    protected $connection = "laravel_test_admin_website";

    /** @var string  */
    public $primaryKey = ['products_id', 'orders_id'];

    /** @var bool  */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'products_id',
        'orders_id',
    ];



    /** @var array  */
    protected $dates = [
        'created_at', 'update_at', 'deleted_at'
    ];



}
