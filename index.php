<?php

use Mindk\Blog\Content\Article;
use Mindk\Blog\Content\Contact;
use Mindk\Blog\Content\Video;
use Mindk\Blog\Category;

require_once 'vendor/autoload.php';

// Creating some dummy content:
$article = new Article('Lorem Ipsum', 'Lorem ipsum dolor sit amet...');
$video = new Video('Some inspiring video', 'https://www.youtube.com/embed/H_i1YZS7GQQ');
$contact = new Contact('Davidov Dmitry', [
                    'email' => 'ddavidov@mindk.com',
                    'phone' => '+38 (093) 894 16 45',
                    'phone2' => '+38 (096) 612 49 83'
                ]);

// Push that to a category:
$category = new Category('My featured docs');
$category   ->addItem($article)
            ->addItem($contact)
            ->addItem($video);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Example</title>
</head>
<body>
    <?php
        // Display that:
        $category->displayContent();
    ?>
</body>
</html>