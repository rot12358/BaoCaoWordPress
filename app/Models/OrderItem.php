<?php

// app/Models/OrderItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'post_id', 'quantity', 'gia'];

    // Mối quan hệ với Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Mối quan hệ với Post (sản phẩm)
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

