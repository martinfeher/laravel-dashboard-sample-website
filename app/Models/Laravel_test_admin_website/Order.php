<?php

namespace App\Models\Laravel_test_admin_website;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Generate UUID on model creation
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Str::orderedUuid();
            if(Auth::user()->id) {
                $model->user_id = Auth::user()->id;
            }
        });
    }

    /** @var string  */
    protected $table = 'orders';

    /** @var string  */
    protected $connection = "laravel_test_admin_website";

    /** @var string  */
    protected $keyType = 'string';

    /** @var boolean  */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'document_name',
        'document_path',
    ];

    /** @var array  */
    protected $dates = [
        'created_at', 'update_at', 'deleted_at'
    ];

    /** @var array  */
    protected $casts = [
        'id' => 'string'
    ];

    /**
     * get products_id priradene ku orders_id
     *
     */
    public function products()
    {
        return $this->hasMany(ProductOrderPivot::Class, 'orders_id', 'id');
    }


}
