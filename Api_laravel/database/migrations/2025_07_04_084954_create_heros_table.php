<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
//     public function up()
// {
//     Schema::create('heros', function (Blueprint $table) {
//         $table->id();
//         $table->string('headline');
//         $table->string('subheadline')->nullable();
//         $table->string('background_image')->nullable();
//         $table->string('cta_text')->nullable();
//         $table->string('cta_link')->nullable();
//         $table->timestamps();
//     });
// }

public function up()
{
    Schema::create('heros', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('subtitle');
        $table->string('background_gradient')->default('linear-gradient(120deg, #042048 60%, #01AD88 100%)');
        $table->string('image')->nullable();
        $table->integer('order')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heros');
    }
};
