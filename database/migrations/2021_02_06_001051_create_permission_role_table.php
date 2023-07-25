<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('permission_id')->unsigned()->nullable()->index();
            $table->bigInteger('role_id')->unsigned()->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_user_id')->nullable();
            $table->integer('updated_user_id')->nullable();
            $table->integer('deleted_user_id')->nullable();
        });

        /*Administrador*/
        DB::table('permission_role')->insert([
            'id'=>1,
            'role_id'=>1,
            'permission_id'=>1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>2,
            'role_id'=>1,
            'permission_id'=>2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>3,
            'role_id'=>1,
            'permission_id'=>3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>4,
            'role_id'=>1,
            'permission_id'=>4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>5,
            'role_id'=>1,
            'permission_id'=>5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>6,
            'role_id'=>1,
            'permission_id'=>6,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>7,
            'role_id'=>1,
            'permission_id'=>7,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>8,
            'role_id'=>1,
            'permission_id'=>8,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>9,
            'role_id'=>1,
            'permission_id'=>9,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        /******Promotor********/
        DB::table('permission_role')->insert([
            'id'=>10,
            'role_id'=>1,
            'permission_id'=>10,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>11,
            'role_id'=>1,
            'permission_id'=>11,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_role');
    }
}
