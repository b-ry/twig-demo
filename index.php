<?php
require_once 'vendor/autoload.php';
require_once 'src/Attribute.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$loader->addPath('components/components', 'components');
$loader->addPath('components/elements', 'elements');
$loader->addPath('images');
$twig = new \Twig\Environment($loader, ['debug' => true]);
$twig->addExtension(new \Twig\Extension\DebugExtension());
$twig->addFunction(new \Twig\TwigFunction('create_attribute', fn() => new \TwigDemo\Attribute()));
$twig->getExtension(\Twig\Extension\EscaperExtension::class)->addSafeClass(\TwigDemo\Attribute::class, ['html']);

$recipes = [
  [
    'field_orientation' => 'default',
    'title' => 'Mediterranean Olive Pasta',
    'field_tags' => ['Vegetarian'],
    'field_link' => [
      'uri' => '#',
      'title' => 'Add To Cart',
      'options' => ['attributes' => ['target' => '_blank', 'rel' => 'noopener']],
    ],
    'field_price' => [
      'number' => '15.49',
      'currency_code' => 'USD',
    ],
    'field_star_rating' => '4.6',
    'field_image' => ['url' => '../images/spaghetti.png', 'alt' => 'Demo image'],
    'field_description' => 'Golden tagliatelle ribbons served with roasted tomatoes, briny olives, and aromatic herbs.',
  ],
  [
    'field_orientation' => 'c-recipe-teaser--horizontal',
    'title' => 'Forest Whisper Risotto',
    'field_tags' => ['Vegetarian', 'Vegan'],
    'field_link' => [
      'uri' => '#',
      'title' => 'Add To Cart',
      'options' => ['attributes' => ['target' => '_blank', 'rel' => 'noopener']],
    ],
    'field_price' => [
      'number' => '12.99',
      'currency_code' => 'USD',
    ],
    'field_star_rating' => '4.8',
    'field_image' => ['url' => '../images/risotto.png', 'alt' => 'Demo image'],
    'field_description' => 'Creamy arborio rice infused with wild mushrooms, truffle oil, and Parmesan shavings.',
  ],
];

$data = ['recipes' => $recipes];

echo $twig->render('node/node--recipe--teaser.html.twig', $data);