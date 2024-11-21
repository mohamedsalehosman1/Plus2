<?php

use App\Models\Vendor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('discount_percent', 8, 2);
            $table->decimal('max_discount', 8, 2);
            $table->date('start_at');
            $table->date('end_at');
            $table->integer('max_use'); //عدد الكوبونات
            $table->integer('max_use_per_user');// عدد الكوبونات المسموح بيها للشخص الواحد
            $table->boolean('is_active')->default(true);
            $table->foreignIdFor(Vendor::class)->constrained('vendors')->onDeleteCascade();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};




