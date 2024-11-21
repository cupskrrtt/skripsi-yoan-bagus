<?php

namespace App\Models;

class planning
{
    private static $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Juan",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni pariatur assumenda similique, ullam facilis quibusdam voluptatem et expedita nobis distinctio, cupiditate ducimus libero veritatis ratione? Sit distinctio placeat accusamus libero!"
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Joan",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni pariatur assumenda similique, ullam facilis quibusdam voluptatem et expedita nobis distinctio, cupiditate ducimus libero veritatis ratione? Sit distinctio placeat accusamus libero!"
        ]
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }
}
