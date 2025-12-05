// database/migrations/xxxxxx_create_products_table.php
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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID único do produto
            $table->string('name'); // Nome do produto
            $table->text('description')->nullable(); // Descrição (pode ser nula)
            $table->decimal('price', 8, 2); // Preço (8 dígitos no total, 2 após a vírgula)
            $table->string('image_path')->nullable(); // Caminho para a imagem do produto
            $table->timestamps(); // Cria as colunas created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};