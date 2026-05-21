<?php
/**
 * Static site builder for GitHub Pages.
 * Renders Twig templates to docs/index.html with corrected asset paths.
 */
require_once 'vendor/autoload.php';
require_once 'src/Attribute.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$loader->addPath('components/components', 'components');
$loader->addPath('components/elements', 'elements');
$loader->addPath('images');
$twig = new \Twig\Environment($loader, ['debug' => false]);
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
    'field_image' => ['url' => 'images/spaghetti.png', 'alt' => 'Demo image'],
    'field_description' => 'Golden tagliatelle ribbons served with roasted tomatoes, briny olives, and aromatic herbs.',
  ],
  [
    'field_orientation' => 'horizontal',
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
    'field_image' => ['url' => 'images/risotto.png', 'alt' => 'Demo image'],
    'field_description' => 'Creamy arborio rice infused with wild mushrooms, truffle oil, and Parmesan shavings.',
  ],
];

$html = $twig->render('node/node--recipe--teaser.html.twig', ['recipes' => $recipes]);

// Convert absolute paths to relative so the site works on GitHub Pages
// (served from a subdirectory like /twig-demo/)
$html = preg_replace('/\bhref="\//', 'href="', $html);
$html = preg_replace('/\bsrc="\//', 'src="', $html);

if (!is_dir('docs')) {
    mkdir('docs', 0755, true);
}

file_put_contents('docs/index.html', $html);
echo "Built docs/index.html\n";
