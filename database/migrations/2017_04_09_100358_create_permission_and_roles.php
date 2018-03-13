<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionAndRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("admin_roles", function(Blueprint $table){
           $table->increments('id');
           $table->string('name')->comment('角色名称');
           $table->string('description')->comment('角色描述');
           $table->timestamps();
        });

        Schema::create("admin_permissions", function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->comment('权限名');
            $table->string('title')->comment('权限标题');
            $table->string('description')->comment('描述');
            $table->integer('pid')->comment('父级ID');
            $table->timestamps();
        });

        Schema::create("admin_permission_role", function(Blueprint $table){
            $table->increments('id');
            $table->integer("role_id");
            $table->integer("permission_id");
            $table->timestamps();
        });

        Schema::create("admin_role_user", function(Blueprint $table){
            $table->increments('id');
            $table->integer("role_id");
            $table->integer("user_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_permission_role');
        Schema::dropIfExists('admin_role_user');
    }
}