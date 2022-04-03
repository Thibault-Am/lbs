<?php require_once './vendor/autoload.php';

$loader = new \Twig\Loader\ArrayLoader([
    'index' => '{{libelle}}, {{descritption}}',
]);
$twig = new \Twig\Environment($loader);
$content= file_get_contents(`http://localhost:19055/items/categories?fields=libelle,description `);
$data = json_decode($content);

foreach($data as $d){
    echo $twig->render('index', ['libelle ' => $d->libelle, 'description'=>$d->description]);
}
