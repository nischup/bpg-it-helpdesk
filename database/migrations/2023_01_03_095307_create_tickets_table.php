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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_category');
            $table->foreignId('company_id')->nullable();
            $table->foreignId('project_id')->nullable();
            $table->foreignId('module_id')->nullable();
            $table->string('page_name')->nullable();
            $table->string('remarks')->nullable();
            $table->string('subject');
            $table->integer('created_by')->nullable();
            $table->integer('assign_by')->nullable();
            $table->integer('assign_to')->nullable();
            $table->integer('start_date')->nullable();
            $table->integer('end_date')->nullable();
            $table->integer('deadline')->nullable();
            $table->string('issue_details');
            $table->string('status_id');
            $table->string('priority_id');
            $table->string('severity_id');
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
        Schema::dropIfExists('tickets');
    }
};
