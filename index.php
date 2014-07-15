<?php

require_once 'vendor/autoload.php';

$blogPosts = array(
    1 => array(
        'date'      => '2011-03-29',
        'author'    => 'igorw',
        'title'     => 'Using Silex',
        'body'      => '...',
    ),
    2 => array(
        'date'      => '2011-03-29',
        'author'    => 'igorw',
        'title'     => 'Using Silex 2',
        'body'      => '...',
    )
);

$app = new Silex\Application();

$app->get('/blog/', function () use ($blogPosts) {
    $output = '';
    foreach ($blogPosts as $post) {
        $output .= $post['title'];
        $output .= '<br />';
    }

    return $output;
});

$app->get('/blog/{id}', function (Silex\Application $app, $id) use ($blogPosts) {

	try {
		 if (!isset($blogPosts[$id]))
		 	throw new Exception('Opa, falhou bicho');
	}catch(Exception $e) {
		return $e->getMessage();
	}
   

    $post = $blogPosts[$id];

    return  "<h1>{$post['title']}</h1>".
            "<p>{$post['body']}</p>";
});

$app['debug'] = true;
$app->run();