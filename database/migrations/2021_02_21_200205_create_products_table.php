<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->integer('shop_id')->index();
            $table->string('code')->index()->comment('Código del producto')->nullable();
            $table->string('title_small')->nullable();
            $table->string('title_large')->nullable();
            $table->string('slug')->unique();
            $table->decimal('price_normal', 10, 2)->default(0);
            $table->decimal('price_online', 10, 2)->default(0);
            $table->decimal('price_partner', 10, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->text('conditions')->nullable();
            $table->string('poster')->nullable();
            $table->string('ficha_tecnica')->nullable();
            /*caracteristicas*/
            $table->string('alto')->nullable();
            $table->string('ancho')->nullable();
            $table->string('fondo')->nullable();
            $table->integer('tipo_cantidad_puertas_id')->nullable();
            $table->string('alto_puerta')->nullable();
            $table->string('ancho_puerta')->nullable();
            $table->integer('tipo_material_id')->nullable();
            $table->string('pintura')->nullable();
            $table->string('puerta_reforsada')->nullable();
            $table->integer('tipo_cerradura')->nullable();
            $table->integer('tipo_cantidad_cuerpos_id')->nullable();
            $table->text('bisagras')->nullable();
            $table->text('accesorios')->nullable();
            $table->text('ventilacion')->nullable();
            $table->text('garantia')->nullable();
            $table->integer('tipo_cantidad_cajones_id')->nullable();
            $table->integer('tipo_cantidad_bandejas_id')->nullable();
            $table->integer('rubro_id')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('categoria_id')->nullable()->index();
            $table->integer('sub_categoria_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();

            $table->integer('created_user_id')->nullable();
            $table->integer('updated_user_id')->nullable();
            $table->integer('deleted_user_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
