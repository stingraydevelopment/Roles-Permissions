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
        Schema::create(
            'roles',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug');
                $table->text('description')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );

        Schema::create(
            'permissions',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug');
                $table->text('description')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );

        Schema::create(
            'role_user',
            function (Blueprint $table) {
                $table->bigInteger('role_id')->unsigned();
                $table->foreign('role_id')->references('id')->on('roles');
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
            }
        );

        Schema::create(
            'permission_user',
            function (Blueprint $table) {
                $table->bigInteger('permission_id')->unsigned();
                $table->foreign('permission_id')
                    ->references('id')
                    ->on('permissions');
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
            }
        );

        Schema::create(
            'permission_role',
            function (Blueprint $table) {
                $table->bigInteger('permission_id')->unsigned();
                $table->foreign('permission_id')
                    ->references('id')
                    ->on('permissions');
                $table->bigInteger('role_id')->unsigned();
                $table->foreign('role_id')->references('id')->on('roles');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permission_user');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
}
