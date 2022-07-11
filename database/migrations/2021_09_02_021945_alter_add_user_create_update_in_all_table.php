<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddUserCreateUpdateInAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('bank', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('pages_dynamic', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });
        
        Schema::table('address', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('config', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('blog_categories', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('blog_post_tag', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('chapter', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('compo', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('contact', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('coupon', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('course_categories', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('course_courses', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('course_tags', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('edu_chapter', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('edu_lesson', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('like_user_comment', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('order', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('order_address', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('order_detail', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('partner', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('product_compo', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('product_products_tags', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('product_tags', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('reset_password', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('qa_answer', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('qa_question', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('qa_question_client', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('result_exam', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('widgets', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('warehouse', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('tracnghiem_cauhoi', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->integer("updated_by")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('all', function (Blueprint $table) {
            //
        });
    }
}
