<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    // Доступные поля для сохранения
    protected $fillable = [
        'status',
        'client_email',
        'partner_id',
    ];

    // Products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')->withPivot('quantity');
    }

    // Название партнера
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }


}
