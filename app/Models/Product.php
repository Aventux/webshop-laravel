<?php

namespace App\Models;

use App\Events\AddToProductStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

class Product extends Authenticatable
{
    use HasTranslations, HasFactory;

    public const DBNAME = 'products';
    protected $table = self::DBNAME;

    /** @var array */
    protected array $translatable = ['title', 'description'];

    /** @var array */
    protected $casts = ['title' => 'array', 'description' => 'array', 'product_stock_increased_at' => 'datetime'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_number', 'title', 'description', 'product_stock', 'product_stock_increased_at',
    ];

    final public static function addToProductStock(int $id, int $value = 1): int
    {
        $product = Product::findorFail($id);
        $product->increment('product_stock', $value, ['product_stock_increased_at' => Carbon::now()]);
        event(new AddToProductStock($product));
        return $product->product_stock;
    }


}
