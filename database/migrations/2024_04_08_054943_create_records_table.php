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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('ユーザーID');
            $table->integer('category_id')->comment('カテゴリーID');
            // $table->string('category')->comment('種類');
            $table->integer('price')->comment('金額');
            // $table->integer('income')->comment('収入')->nullable();
            // $table->integer('expense')->comment('支出')->nullable();
            $table->string('note')->comment('補足')->nullable();
            $table->date('registration_date')->comment('登録日');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
