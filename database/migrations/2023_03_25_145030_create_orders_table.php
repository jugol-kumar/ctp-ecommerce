<?php

use App\Models\Address;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(Address::class, 'address_id')->constrained('addresses');
            $table->integer('delivery_charge')->nullable();
            $table->integer('cart_total_price')->nullable();
            $table->date('check_out_date')->nullable();
            $table->date('order_date')->nullable();
            $table->integer('order_price')->nullable();
            $table->integer('delivery_price')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('order_status', ['pending', 'received', 'process', 'shipped', 'delivered', 'cancel']);
            $table->enum('payment_status', ['pending', 'paid', 'due', 'cancel']);
            $table->boolean('isShow')->default(1);
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
        Schema::dropIfExists('orders');
    }
};
