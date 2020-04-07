<?php


use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use TightenCo\Jigsaw\Jigsaw;

class BuildPhotoStream
{
    public function handle(Jigsaw $jigsaw): void
    {
        // Clear out existing photo markdown files...
        $this->clearExistingFiles('./source/_photos', '.md');

        // Clear out existing thumbnails and large processed images...
        $this->clearExistingFiles('./source/assets/photos/large', '.jpg');
        $this->clearExistingFiles('./source/assets/photos/thumbnail', '.jpg');

        // Collect new photos...
        $filesystem = new Filesystem();
        $files = $filesystem->allFiles('./source/assets/photos/original');

        collect($files)->filter(function($file){
            return Str::endsWith($file, '.jpg');
        })->each(function(SplFileInfo $file, $index) use ($jigsaw) {

            $filename = str_replace('--', '-', strtolower(str_replace('_', '-', $file->getBasename('.' . $file->getExtension()))));
            $image = imagecreatefromjpeg($file->getRealPath());

            // Work out average colour of images to create tint...
            $tint = (new Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker)->getImageAvgHexByPath($file->getRealPath());

            // Resize images for efficiency...
            $thumbnailSize = $jigsaw->getConfig('images.thumbnail.size');
            $thumbnail = imagescale($image, $thumbnailSize);
            imagejpeg($thumbnail, $thumbnailFileName = sprintf('source/assets/photos/thumbnail/%s.jpg', $filename), 80);

            $largeImageSize = $jigsaw->getConfig('images.large.size');
            $large = imagescale($image, $largeImageSize);
            imagejpeg($large, $largeFileName = sprintf('source/assets/photos/large/%s.jpg', $filename));

            list($width, $height) = getimagesize($thumbnailFileName);

            // Bad exif data will throw a warning but not an exception...
            $exif = @exif_read_data($file->getRealPath(), 'FILE');
            if(!isset($exif['FileDateTime'])) {
                $exif = [
                    'FileDateTime' => Carbon::today(),
                ];
            }

            $thumbnailFileName = str_replace('source/', '', $thumbnailFileName);
            $largeFileName = str_replace('source/', '', $largeFileName);

            $name = str_replace(['-'], ' ', $filename);

            // Create markdown file contents...
            $contents = sprintf('---
id: %s
photo: "%s"
thumbnail: "%s"
tint: "%s"
filename: "%s"
name: "%s"
height: "%s"
width: "%s"
date: "%s"
---
',
                ($index +1),
                $largeFileName,
                $thumbnailFileName,
                $tint,
                $filename,
                $name,
                $height,
                $width,
                Carbon::parse($exif['FileDateTime'])
            );

            $jigsaw->writeSourceFile(sprintf('./_photos/%s.md', $filename), $contents);
        });

    }

    private function clearExistingFiles(string $path, string $fileType) : void
    {
        $filesystem = new Filesystem();
        if(!$filesystem->exists($path)){
            $filesystem->makeDirectory($path);
        }

        $existingFiles = collect($filesystem->allFiles($path))->filter(function (SplFileInfo $file) use($fileType) {
            return Str::endsWith($fileType, $file->getExtension());
        })->map(function (SplFileInfo $file) {
            return $file->getRealPath();
        });

        $filesystem->delete($existingFiles->toArray());
    }
}
