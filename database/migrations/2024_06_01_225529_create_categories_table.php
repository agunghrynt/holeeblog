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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

// Post::create([
//     'title' => 'Judul Post Kelima',
//     'category_id' => 1,
//     'slug' => 'judul-post-kelima',
//     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae deserunt sunt consequatur delectus, illum vero. Minima, vitae aut. Repellat, praesentium.',
//     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In quod labore repellat obcaecati corrupti quis debitis, adipisci hic accusantium, dolorum dignissimos? Itaque reprehenderit quibusdam dolores. Ab praesentium quam similique voluptates tenetur itaque? Non cumque iste fugiat illum laborum pariatur quod expedita earum blanditiis, reprehenderit molestias doloremque quae exercitationem est, reiciendis tempore, voluptatibus odio minus dolores assumenda nam aperiam! Temporibus, necessitatibus repellendus distinctio cum dicta consequatur mollitia earum asperiores repudiandae provident et ipsum nisi ad!</p><p>Qui consectetur suscipit ducimus atque possimus, corrupti fugiat doloremque nemo laudantium, perferendis tenetur quae temporibus ratione corporis molestiae in optio, saepe id. Incidunt, maxime! Deleniti fugiat eligendi minima, iste eaque omnis aspernatur, esse hic vel unde blanditiis dicta. Dolorem tenetur fugiat, quod animi dolores repudiandae! At.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus quod natus in dolores voluptatum distinctio quia nemo nihil fuga perferendis nesciunt reprehenderit nam quos, ipsa rerum cupiditate id ea voluptate!</p>',
// ]);

// Category::create([
//     'name' => 'Personal',
//     'slug' => 'personal',
// ]);
