<?php

namespace App\Models;


class Post
{
    private static $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Holee Sheet",
            "body" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi quam neque quas quo necessitatibus. Labore vel exercitationem adipisci facilis consectetur architecto magnam. Expedita illo saepe et numquam veniam suscipit rem minus minima delectus porro exercitationem non quasi, ea eum aliquam accusantium voluptates eveniet impedit necessitatibus ipsa explicabo. Debitis numquam quaerat porro cupiditate ipsum optio consequatur veniam. Corporis ratione saepe odit architecto, fugit a dignissimos voluptates molestias aut nisi temporibus sunt laboriosam eius quaerat, assumenda adipisci ut aperiam mollitia! Ad, iusto?"
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Agung Haryanto",
            "body" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem at eaque natus ad optio nemo, enim aut cumque aperiam maxime veritatis ullam dolore quis quas, impedit doloremque adipisci quam perspiciatis, molestiae iusto repellat blanditiis? Magni, nemo. Earum totam hic excepturi accusamus tempore maiores recusandae in, iure error iusto fugit sunt voluptates nisi molestiae ullam dolores, perspiciatis perferendis facere cum adipisci enim nulla aliquam inventore! Delectus magnam nisi ducimus, debitis beatae ab nobis quidem voluptatum! Saepe accusamus error tempore? Odio, neque minus incidunt aut, tempora asperiores quibusdam cumque enim a quas nobis temporibus eveniet facere mollitia nulla? Tempora, eius quis? Laboriosam autem eos iste dolorem perferendis, pariatur sapiente aperiam aliquid quos facere provident, sunt, praesentium voluptatum vero! Itaque, provident. Quia, fugiat?"
        ],
        [
            "title" => "Judul Post Ketiga",
            "slug" => "judul-post-ketiga",
            "author" => "Yanto",
            "body" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. At quos quaerat eveniet accusantium, nam tenetur explicabo iure ipsam. Nihil eaque in perferendis quod maxime voluptates accusamus minus ab asperiores, assumenda, consequuntur repudiandae reiciendis rem, magni blanditiis magnam sapiente facere quasi illum aliquid? Rerum repudiandae sunt tenetur voluptatem nihil molestias perspiciatis aliquam alias quidem dolorum laboriosam dolorem magnam unde nobis, dolor molestiae ex vel quas impedit possimus corporis sequi eos! Perspiciatis, inventore a! Odit, ipsam itaque. Assumenda temporibus voluptate autem numquam rerum. Dolorem aperiam dolores hic iure corrupti, sed sapiente. Eum cupiditate obcaecati ullam exercitationem blanditiis velit mollitia dolorem veniam esse. Et quod recusandae impedit repellendus saepe culpa sapiente dolorem cum similique, at voluptate libero soluta ipsam unde nesciunt consectetur veritatis asperiores? Molestiae nam officia animi dolorem beatae, consequuntur autem hic ipsa reprehenderit libero natus a voluptates repellat sit, optio quidem rem neque fugiat minima at tenetur. Molestiae quas fuga cum, iusto quidem nemo est laborum molestias assumenda et id voluptate officiis repellendus quae fugit nesciunt rerum, dicta dolores? Blanditiis expedita veniam soluta, earum minima quidem exercitationem saepe quaerat ducimus modi."
        ],
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }
    
    public static function find($slug)
    {
        $posts = static::all();
        // $post = [];
        // foreach($posts as $p) {
        //     if($p["slug"] === $slug) {
        //         $post = $p;
        //     }
        // }

        return $posts->firstWhere('slug', $slug);
    }

}
