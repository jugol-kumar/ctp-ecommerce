<?php

use App\Models\Address;
use App\Models\Customer;
use App\Models\CustomerCart;
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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class, 'customer_id')->constrained('customers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignIdFor(CustomerCart::class, 'customer_cart_id')->constrained('customer_carts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignIdFor(Address::class, 'address_id')->constrained('addresses');

            $table->integer('delivery_charge')->nullable();
            $table->integer('cart_total_price')->nullable();
            $table->date('checkout_date')->nullable();
            $table->date('clear_date')->nullable()->comment('if you want to automatically clear checkout after some day then need this fields');

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
        Schema::dropIfExists('checkouts');
    }
};
