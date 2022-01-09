<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique();
            $table->string('name');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->text('address')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->string('photo')->nullable();
            $table->integer('nominal')->default(0);
            $table->integer('incomes')->default(0);
            $table->dateTime('received_at');
            $table->softDeletes();
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
        Schema::dropIfExists('merchants');
    }
}
