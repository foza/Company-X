<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('products');
        Schema::create('products', function (Blueprint $table) {
            $table->id();
        });
        \Illuminate\Support\Facades\DB::unprepared('ALTER TABLE `products` ROW_FORMAT = DYNAMIC');
        Schema::table('products', function (Blueprint $table) {
            $table->string('type_id')->nullable();
            $table->string('sku')->nullable();
            $table->string('opera_sku')->nullable();
            $table->string('old_sku')->nullable();
            $table->string('override_opera')->nullable();
            $table->string('name')->nullable();
            $table->string('inlet')->nullable();
            $table->string('outlet')->nullable();
            $table->string('hose_type')->nullable();
            $table->string('angle_in_deg')->nullable();
            $table->string('max_lpm')->nullable();
            $table->string('voltage')->nullable();
            $table->string('material')->nullable();
            $table->string('bar')->nullable();
            $table->text('o-ring_thickness')->nullable();
            $table->string('diameter')->nullable();
            $table->string('colour')->nullable();
            $table->string('rpm')->nullable();
            $table->string('status')->nullable();
            $table->string('url_key')->nullable();
            $table->string('visibility')->nullable();
            $table->string('clearance')->nullable();
            $table->string('max_temperature')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('tech_spec_1')->nullable();
            $table->text('tech_spec_2')->nullable();
            $table->text('tech_spec_3')->nullable();
            $table->text('product_videos')->nullable();
            $table->string('nozzle_value')->nullable();
            $table->string('nozzle_size')->nullable();
            $table->string('foam_value')->nullable();
            $table->string('is_featured')->nullable();
            $table->string('featured_position')->nullable();
            $table->string('hose_clamp_size')->nullable();
            $table->string('orifice_size')->nullable();
            $table->string('shoe_size')->nullable();
            $table->string('thread')->nullable();
            $table->string('size_and_angle')->nullable();
            $table->string('inlet_outlet')->nullable();
            $table->string('clothing_size')->nullable();
            $table->string('wheel_style')->nullable();
            $table->string('flow_and_pressure')->nullable();
            $table->string('country_of_manufacture')->nullable();
            $table->string('select_nozzle_size')->nullable();
            $table->string('dn_internal_diameter')->nullable();
            $table->string('currency')->nullable();
            $table->string('pack_size')->nullable();
            $table->string('easyturn')->nullable();
            $table->string('priority')->nullable();
            $table->string('manufacturer_number_1')->nullable();
            $table->string('manufacturer_number_2')->nullable();
            $table->string('manufacturer_number_3')->nullable();
            $table->string('manufacturer_number_4')->nullable();
            $table->string('manufacturer_number_5')->nullable();
            $table->string('manufacturer_number_6')->nullable();
            $table->string('manufacturer_number_7')->nullable();
            $table->string('manufacturer_number_8')->nullable();
            $table->string('manufacturer_number_9')->nullable();
            $table->string('manufacturer_number_10')->nullable();
            $table->string('hose_application')->nullable();
            $table->string('hose_inlet')->nullable();
            $table->string('hose_outlet')->nullable();
            $table->string('hose_length')->nullable();
            $table->string('hose_colour')->nullable();
            $table->string('price')->nullable();
            $table->string('special_price')->nullable();
            $table->string('poa')->nullable();
            $table->string('poa_price')->nullable();
            $table->string('msrp')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('pdf_title_1')->nullable();
            $table->string('pdf_title_2')->nullable();
            $table->string('pdf_title_3')->nullable();
            $table->string('pdf_title_4')->nullable();
            $table->string('categories')->nullable();
            $table->string('bullet_point_1')->nullable();
            $table->string('bullet_point_2')->nullable();
            $table->string('bullet_point_3')->nullable();
            $table->string('bullet_point_4')->nullable();
            $table->string('maintenance_videos')->nullable();
            $table->string('maintenance_video_title_1')->nullable();
            $table->string('maintenance_video_url_1')->nullable();
            $table->string('maintenance_video_title_2')->nullable();
            $table->string('maintenance_video_url_2')->nullable();
            $table->string('maintenance_video_title_3')->nullable();
            $table->string('maintenance_video_url_3')->nullable();
            $table->string('maintenance_video_title_4')->nullable();
            $table->string('maintenance_video_url_4')->nullable();
            $table->string('stock_status')->nullable();
            $table->text('related_products')->nullable();
            $table->string('configurable_product_parent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
