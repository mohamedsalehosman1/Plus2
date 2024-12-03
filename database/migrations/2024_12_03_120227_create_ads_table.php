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

        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->boolean('status')->default(1);
            $table->foreignIdFor(Vendor::class)->constrained('vendors')->onDeleteCascade();

            $table->timestamps();
        });
    }




    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
