<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * Add Company to User Table
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(Product::DBNAME, function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->integer('product_stock');
            $table->dateTime('product_stock_increased_at')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('companies');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
