<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('snippets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->text('example')->nullable()->comment('code that is executed on page');
            $table->string('scripts')->nullable();
            $table->string('styles')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('snippets');
    }
};
