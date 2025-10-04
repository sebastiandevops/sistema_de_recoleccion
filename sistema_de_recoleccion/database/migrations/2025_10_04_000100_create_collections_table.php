<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // organic, inorganic, hazardous
            $table->string('mode')->nullable(); // programada | demanda
            $table->integer('frequency')->nullable(); // times per week if programada
            $table->dateTime('scheduled_at')->nullable();
            $table->decimal('kilos', 8, 2)->nullable();
            $table->string('status')->default('scheduled'); // scheduled, completed, cancelled
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
};
