<?php

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
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('event_id');
            $table->string('phone_number')->nullable()->after('gender');
            $table->json('responses')->nullable()->after('phone_number');
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['gender', 'phone_number', 'responses']);
        });
    }
};
