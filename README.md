# Jigsaw Photostream

A Photo Stream site written in Jigsaw, Tailwind and Alpine.

[![Netlify Status](https://api.netlify.com/api/v1/badges/573deda7-3b57-4e11-aab4-e2e87f9cddce/deploy-status)](https://app.netlify.com/sites/jigsaw-tailwindcss/deploys)

## Features

- Native and Polyfilled Lazy Loading
- Photo tinting to provide modal background shade when looking at images in full screen
- Keyboard shortcuts

## Requirements

- PHP 7.2
- [Composer](https://getcomposer.org/)

## Getting Started

1. Clone this repo

    ```sh
    git clone https://github.com/talvbansal/jigsaw-photo-stream.git
    ```

2. Navigate to the folder

    ```sh
    cd jigsaw-photo-stream
    ```

3. Install PHP dependencies
    ```sh
    composer install
    ```

4. Delete and replace my photos with yours in `source/assets/photos/original`

5. Build the site with your photos
    ```sh
    ./vendor/bin/jigsaw build
    ```
6. See your new site
    ```sh
    ./vendor/bin/jigsaw serve
   ```

# Credits

This project is heavily inspired and influenced by [Max Voltar's Photo Stream](https://github.com/maxvoltar/photo-stream])

