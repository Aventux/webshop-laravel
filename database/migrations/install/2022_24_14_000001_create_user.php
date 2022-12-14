<?php

use App\Models\Address;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * Add the User
     *
     * @return void
     */
    public function up(): void
    {
        User::create([
            'name'     => 'Stefan Schlombs', 'email' => 'stefan.schlombs@gmail.com',
            'password' => '$2y$10$wz8ckPMFUuQ/PNRLBTIVkuInSyYlBOMocgmlGwq7vGF4F2L3lD39y',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        User::query()
            ->truncate();
        Schema::enableForeignKeyConstraints();
    }
}
