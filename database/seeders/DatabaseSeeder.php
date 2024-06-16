<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Agung Haryanto',
            'username' => 'agungharyanto',
            'email' => 'agungharyanto1313@gmail.com',
            'password' => bcrypt('Agung13@#')
        ]);

        User::factory(11)->create();

        Category::create([
            'name' => 'Web Programing',
            'slug' => 'web-programing',
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design',
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);

        Post::factory(178)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis exercitationem dicta rerum facilis id, debitis in vero minus. Quod, repudiandae laborum. Beatae, tempora eaque autem necessitatibus, laboriosam non, dolor expedita nisi excepturi minima blanditiis animi.',
        //     'body' => '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel officiis excepturi asperiores ullam ab placeat blanditiis accusamus adipisci eligendi? Quod fuga nam, deserunt, sapiente adipisci dolorem natus suscipit architecto maxime iste aspernatur, consectetur recusandae omnis laborum necessitatibus incidunt culpa sed tempore impedit eos. Voluptatibus amet enim deserunt doloribus quibusdam eligendi aut modi cumque corrupti repudiandae magnam vitae a adipisci fuga atque illum iusto, exercitationem provident beatae reprehenderit et dolor asperiores incidunt laboriosam!</p><p>Quisquam vitae hic explicabo earum consequatur consectetur ducimus est qui non alias! Perspiciatis nobis nam, nulla ab, corporis pariatur quas obcaecati, ullam error porro ipsum soluta! Officiis laborum porro, soluta cumque quaerat odit molestias quibusdam deleniti excepturi quod tempore? Repellendus reiciendis quod distinctio molestias expedita similique recusandae repudiandae magnam, sed, nihil natus ducimus sunt facere officia eveniet iusto facilis?</p><p>Et ducimus voluptatibus commodi temporibus quo architecto quibusdam. Ratione dolores odio incidunt ullam eos vitae eum ipsam cupiditate a.</p>',
        //     'category_id' => 1,
        //     'user_id' => 1,
        // ]);

        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis exercitationem dicta rerum facilis id, debitis in vero minus. Quod, repudiandae laborum. Beatae, tempora eaque autem necessitatibus, laboriosam non, dolor expedita nisi excepturi minima blanditiis animi.',
        //     'body' => '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel officiis excepturi asperiores ullam ab placeat blanditiis accusamus adipisci eligendi? Quod fuga nam, deserunt, sapiente adipisci dolorem natus suscipit architecto maxime iste aspernatur, consectetur recusandae omnis laborum necessitatibus incidunt culpa sed tempore impedit eos. Voluptatibus amet enim deserunt doloribus quibusdam eligendi aut modi cumque corrupti repudiandae magnam vitae a adipisci fuga atque illum iusto, exercitationem provident beatae reprehenderit et dolor asperiores incidunt laboriosam!</p><p>Quisquam vitae hic explicabo earum consequatur consectetur ducimus est qui non alias! Perspiciatis nobis nam, nulla ab, corporis pariatur quas obcaecati, ullam error porro ipsum soluta! Officiis laborum porro, soluta cumque quaerat odit molestias quibusdam deleniti excepturi quod tempore? Repellendus reiciendis quod distinctio molestias expedita similique recusandae repudiandae magnam, sed, nihil natus ducimus sunt facere officia eveniet iusto facilis?</p><p>Et ducimus voluptatibus commodi temporibus quo architecto quibusdam. Ratione dolores odio incidunt ullam eos vitae eum ipsam cupiditate a.</p>',
        //     'category_id' => 2,
        //     'user_id' => 2,
        // ]);

        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis exercitationem dicta rerum facilis id, debitis in vero minus. Quod, repudiandae laborum. Beatae, tempora eaque autem necessitatibus, laboriosam non, dolor expedita nisi excepturi minima blanditiis animi.',
        //     'body' => '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel officiis excepturi asperiores ullam ab placeat blanditiis accusamus adipisci eligendi? Quod fuga nam, deserunt, sapiente adipisci dolorem natus suscipit architecto maxime iste aspernatur, consectetur recusandae omnis laborum necessitatibus incidunt culpa sed tempore impedit eos. Voluptatibus amet enim deserunt doloribus quibusdam eligendi aut modi cumque corrupti repudiandae magnam vitae a adipisci fuga atque illum iusto, exercitationem provident beatae reprehenderit et dolor asperiores incidunt laboriosam!</p><p>Quisquam vitae hic explicabo earum consequatur consectetur ducimus est qui non alias! Perspiciatis nobis nam, nulla ab, corporis pariatur quas obcaecati, ullam error porro ipsum soluta! Officiis laborum porro, soluta cumque quaerat odit molestias quibusdam deleniti excepturi quod tempore? Repellendus reiciendis quod distinctio molestias expedita similique recusandae repudiandae magnam, sed, nihil natus ducimus sunt facere officia eveniet iusto facilis?</p><p>Et ducimus voluptatibus commodi temporibus quo architecto quibusdam. Ratione dolores odio incidunt ullam eos vitae eum ipsam cupiditate a.</p>',
        //     'category_id' => 2,
        //     'user_id' => 1,
        // ]);

        // Post::create([
        //     'title' => 'Judul Keempat',
        //     'slug' => 'judul-keempat',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis exercitationem dicta rerum facilis id, debitis in vero minus. Quod, repudiandae laborum. Beatae, tempora eaque autem necessitatibus, laboriosam non, dolor expedita nisi excepturi minima blanditiis animi.',
        //     'body' => '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel officiis excepturi asperiores ullam ab placeat blanditiis accusamus adipisci eligendi? Quod fuga nam, deserunt, sapiente adipisci dolorem natus suscipit architecto maxime iste aspernatur, consectetur recusandae omnis laborum necessitatibus incidunt culpa sed tempore impedit eos. Voluptatibus amet enim deserunt doloribus quibusdam eligendi aut modi cumque corrupti repudiandae magnam vitae a adipisci fuga atque illum iusto, exercitationem provident beatae reprehenderit et dolor asperiores incidunt laboriosam!</p><p>Quisquam vitae hic explicabo earum consequatur consectetur ducimus est qui non alias! Perspiciatis nobis nam, nulla ab, corporis pariatur quas obcaecati, ullam error porro ipsum soluta! Officiis laborum porro, soluta cumque quaerat odit molestias quibusdam deleniti excepturi quod tempore? Repellendus reiciendis quod distinctio molestias expedita similique recusandae repudiandae magnam, sed, nihil natus ducimus sunt facere officia eveniet iusto facilis?</p><p>Et ducimus voluptatibus commodi temporibus quo architecto quibusdam. Ratione dolores odio incidunt ullam eos vitae eum ipsam cupiditate a.</p>',
        //     'category_id' => 3,
        //     'user_id' => 1,
        // ]);

        // Post::create([
        //     'title' => 'Judul Kelima',
        //     'slug' => 'judul-kelima',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis exercitationem dicta rerum facilis id, debitis in vero minus. Quod, repudiandae laborum. Beatae, tempora eaque autem necessitatibus, laboriosam non, dolor expedita nisi excepturi minima blanditiis animi.',
        //     'body' => '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel officiis excepturi asperiores ullam ab placeat blanditiis accusamus adipisci eligendi? Quod fuga nam, deserunt, sapiente adipisci dolorem natus suscipit architecto maxime iste aspernatur, consectetur recusandae omnis laborum necessitatibus incidunt culpa sed tempore impedit eos. Voluptatibus amet enim deserunt doloribus quibusdam eligendi aut modi cumque corrupti repudiandae magnam vitae a adipisci fuga atque illum iusto, exercitationem provident beatae reprehenderit et dolor asperiores incidunt laboriosam!</p><p>Quisquam vitae hic explicabo earum consequatur consectetur ducimus est qui non alias! Perspiciatis nobis nam, nulla ab, corporis pariatur quas obcaecati, ullam error porro ipsum soluta! Officiis laborum porro, soluta cumque quaerat odit molestias quibusdam deleniti excepturi quod tempore? Repellendus reiciendis quod distinctio molestias expedita similique recusandae repudiandae magnam, sed, nihil natus ducimus sunt facere officia eveniet iusto facilis?</p><p>Et ducimus voluptatibus commodi temporibus quo architecto quibusdam. Ratione dolores odio incidunt ullam eos vitae eum ipsam cupiditate a.</p>',
        //     'category_id' => 1,
        //     'user_id' => 2,
        // ]);

        // Post::create([
        //     'title' => 'Judul Keenam',
        //     'slug' => 'judul-keenam',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis exercitationem dicta rerum facilis id, debitis in vero minus. Quod, repudiandae laborum. Beatae, tempora eaque autem necessitatibus, laboriosam non, dolor expedita nisi excepturi minima blanditiis animi.',
        //     'body' => '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel officiis excepturi asperiores ullam ab placeat blanditiis accusamus adipisci eligendi? Quod fuga nam, deserunt, sapiente adipisci dolorem natus suscipit architecto maxime iste aspernatur, consectetur recusandae omnis laborum necessitatibus incidunt culpa sed tempore impedit eos. Voluptatibus amet enim deserunt doloribus quibusdam eligendi aut modi cumque corrupti repudiandae magnam vitae a adipisci fuga atque illum iusto, exercitationem provident beatae reprehenderit et dolor asperiores incidunt laboriosam!</p><p>Quisquam vitae hic explicabo earum consequatur consectetur ducimus est qui non alias! Perspiciatis nobis nam, nulla ab, corporis pariatur quas obcaecati, ullam error porro ipsum soluta! Officiis laborum porro, soluta cumque quaerat odit molestias quibusdam deleniti excepturi quod tempore? Repellendus reiciendis quod distinctio molestias expedita similique recusandae repudiandae magnam, sed, nihil natus ducimus sunt facere officia eveniet iusto facilis?</p><p>Et ducimus voluptatibus commodi temporibus quo architecto quibusdam. Ratione dolores odio incidunt ullam eos vitae eum ipsam cupiditate a.</p>',
        //     'category_id' => 3,
        //     'user_id' => 2,
        // ]);
    }
}
