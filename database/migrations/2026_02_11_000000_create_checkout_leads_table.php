<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('checkout_leads', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('session_id', 255)->nullable()->index();

            $table->unsignedBigInteger('order_id')->nullable()->index(); // link when order is created

            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();

            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable()->index();

            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();

            $table->string('delivery_option')->nullable();
            $table->unsignedTinyInteger('checkout_step')->default(1); // 1 shipping, 2 payment

            $table->boolean('is_converted')->default(false)->index(); // order placed?
            $table->timestamp('last_activity_at')->nullable()->index();
            $table->string('last_reason')->nullable();

            $table->timestamps();

            $table->unique(['session_id']); // 1 lead per session
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checkout_leads');
    }
};

