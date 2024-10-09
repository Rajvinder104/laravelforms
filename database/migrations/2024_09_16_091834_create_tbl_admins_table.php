<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_admins', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->default('AD184507');
            $table->string('name')->default('Admin');
            $table->string('role')->default('admin');
            $table->string('email')->default('admin@gmail.com');
            $table->unsignedBigInteger('phone')->default(9876543210);
            $table->string('Paid_status')->default(0);
            $table->string('password');
            // $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_admins');
    }
};
