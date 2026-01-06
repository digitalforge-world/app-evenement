<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class Testimonial extends Model
{
    use HasFactory;
    public function up()
{
    Schema::create('testimonials', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('location');
        $table->text('content');
        $table->string('image')->nullable();
        $table->timestamps();
    });
}
}
