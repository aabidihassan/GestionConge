<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->Integer('id_user');
            $table->Integer('id_adjoint');
            $table->String('referance');
            $table->Integer('type_vac');
            $table->Integer('annee');
            $table->Date('date_debut');
            $table->Date('date_fin');
            $table->Integer('nbJours');
            $table->Integer('adjoint');
            $table->Integer('chef_service');
            $table->Integer('greffier_chef');
            $table->Integer('etat');
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
        Schema::dropIfExists('conges');
    }
}
