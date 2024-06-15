<?php

use App\Models\TelegraphBot;
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
        Schema::table('users', static function (Blueprint $table) {
            $table->string('password')
                ->nullable()
                ->change();
            $table->string('email')
                ->nullable()
                ->change();
        });

        Schema::table('users', static function (Blueprint $table) {
            $table->foreignIdFor(TelegraphBot::class)
                ->after('id')
                ->constrained()
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->bigInteger('telegram_id')
                ->after('id');

            $table->boolean('is_active')
                ->default(true);

            $table->string('phone')
                ->after('name')
                ->nullable();

            $table->dateTime('phone_verified_at')
                ->after('phone')
                ->nullable();

            $table->unique(['telegraph_bot_id', 'phone']);
            $table->index('telegram_id');

        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropColumns('users', ['telegram_id', 'telegram_bot_id', 'is_active']);
        }
    }
};
