<?php

use App\Enums\EmailVerificationType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')
                ->comment('名前（名）');
            $table->string('last_name')
                ->comment('苗字（姓）');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->tinyInteger('email_verified')->default(EmailVerificationType::NOT_VERIFIED);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token');
            $table->string('profile_picture')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
