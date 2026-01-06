<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('lieu');
        $table->datetime('date_debut');
        $table->datetime('date_fin');
        $table->integer('nombre_place');
        $table->decimal('prix', 10, 2);
        $table->string('image')->nullable();
        $table->boolean('featured')->default(false);
        $table->enum('status', ['active', 'annule', 'termine'])->default('active');
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('events');
}
};
