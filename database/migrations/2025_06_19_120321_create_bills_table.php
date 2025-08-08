<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('bill_number')->unique();
            $table->dateTime('bill_date');

            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('customer_email')->nullable();

            $table->string('salesperson_name')->nullable();

            $table->enum('jewel_type', ['Silver', 'Gold', 'Diamond', 'Other']);
            $table->enum('purity_carat', ['18K', '22K', '24K', 'Other']);

            $table->text('net_weight');
            $table->text('making_charges');
            $table->text('wastage_charges');
            $table->text('items_description');

            $table->enum('payment_mode', ['Cash', 'Card', 'UPI', 'Bank Transfer', 'Cheque', 'Gold Scheme/Advance', 'Other'])->nullable();

            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->timestamps();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
