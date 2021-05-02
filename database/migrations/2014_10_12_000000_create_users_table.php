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
            $table->string('username');
            $table->string('email');
            $table->tinyInteger('email_verified')->default(EmailVerificationType::NOT_VERIFIED);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token');
            $table->string('profile_picture')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('exist')->nullable()->storedAs('case when deleted_at is null then 1 else null end');
            $table->timestamps();
            $table->softDeletes('deleted_at');

            // 複合ユニーク制約
            $table->unique(['username', 'email', 'exist']);
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
