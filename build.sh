#!/usr/bin/env bash
set -e

echo "Building static site for GitHub Pages..."

# Compile SCSS
npm run build

# Render Twig templates to HTML
php build.php

# Copy CSS
mkdir -p docs/css
cp css/global.css docs/css/global.css

# Copy images (including icons subdirectory)
mkdir -p docs/images/icons
cp images/spaghetti.png docs/images/
cp images/risotto.png docs/images/
cp images/topographic.svg docs/images/
cp images/icons/icon-star.svg docs/images/icons/
cp images/icons/icon-verified.svg docs/images/icons/

# Copy component CSS and JS
mkdir -p docs/components/components/teaser/src
cp components/components/teaser/teaser.css docs/components/components/teaser/
cp components/components/teaser/src/teaser.js docs/components/components/teaser/src/

mkdir -p docs/components/elements/button
cp components/elements/button/button.css docs/components/elements/button/

# Prevent GitHub Pages from processing with Jekyll
touch docs/.nojekyll

echo "Done! Static site is in the docs/ directory."
