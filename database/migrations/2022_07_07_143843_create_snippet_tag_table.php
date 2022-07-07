<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('snippet_tag', function (Blueprint $table) {
            $table->foreignId('snippet_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('tag_id')->constrained()->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('snippet_tag');
    }
};
