<?php
require "vendor/autoload.php";

use TightenCo\Jigsaw\Jigsaw;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

/**
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */


$events->beforeBuild(function(Jigsaw $jigsaw){
    // Clear out existing photo markdown files...
    // Collect new photos...
    // Create resized images...
    // Create new photo markdown files...

    $filesystem = new \Illuminate\Filesystem\Filesystem();
    $files = $filesystem->allFiles('./source/assets/photos/original');

    collect($files)->filter(function($file){
        return \Illuminate\Support\Str::endsWith($file, '.jpg');
    })->each(function(SplFileInfo $file) use ($jigsaw){

        $filename = $file->getBasename('.' . $file->getExtension());
        $image = imagecreatefromjpeg($file->getRealPath());

        // Resize images for efficiency...
        $thumbnail = imagescale($image, 800);
        imagejpeg($thumbnail, $thumbnailFileName = sprintf('source/assets/photos/thumbnail/%s.jpg', $filename));

        $tint = (new Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker)->getImageAvgHexByPath($file->getRealPath());

        $large = imagescale($image, 2048);
        imagejpeg($large, $largeFileName = sprintf('source/assets/photos/large/%s.jpg', $filename));

        list($width, $height) = getimagesize($thumbnailFileName);
        $exif= exif_read_data($file->getRealPath(), 'FILE');

        $thumbnailFileName = str_replace('source/', '', $thumbnailFileName);
        $largeFileName = str_replace('source/', '', $largeFileName);

        $name = str_replace(['-', '_'], ' ', $filename);

        // Create markdown file contents...
        $contents = sprintf('---
extends: _layouts.photo
section: content
photo: "%s"
thumbnail: "%s"
tint: "%s"
name: "%s"
height: "%s"
width: "%s"
date: "%s"
---
',
            $largeFileName,
            $thumbnailFileName,
            $tint,
            $name,
            $height,
            $width,
            \Carbon\Carbon::parse($exif['FileDateTime'])
        );

        $jigsaw->writeSourceFile(sprintf('./_photos/%s.md', $filename), $contents);

    });



});
