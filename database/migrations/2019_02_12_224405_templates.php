<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Templates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maileclipse_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('template_name')->unique();
            $table->string('template_slug')->unique();
            $table->string('template_type')->default('markdown');
            $table->string('template_view_name');
            $table->string('template_skeleton');
            $table->string('template_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maileclipse_templates');
    }
}