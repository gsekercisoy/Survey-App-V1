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
        Schema::table('users', function (Blueprint $table) {
            // Yeni sütun eklemek için `addColumn` kullanılır
            $table->integer('role')->default(0); // Varsayılan değeri 'user' olarak belirledim, isteğe bağlı
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Eğer geri almak istiyorsanız, `dropColumn` kullanabilirsiniz
            $table->dropColumn('role');
        });
    }
};
