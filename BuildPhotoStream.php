<?php


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use TightenCo\Jigsaw\Jigsaw;

class BuildPhotoStream
{
    public function handle(Jigsaw $jigsaw): void
    {
        // Clear out existing photo markdown files...
        $this->clearExistingFiles('./source/_photos', '.md');

        // Collect new photos...
        $this->clearExistingFiles('./source/assets/photos/large', '.jpg');
        $this->clearExistingFiles('./source/assets/photos/thumbnail', '.jpg');

        // Create resized images...
        // Create new photo markdown files...
        $filesystem = new Filesystem();
        $files = $filesystem->allFiles('./source/assets/photos/original');

        collect($files)->filter(function($file){
            return Str::endsWith($file, '.jpg');
        })->each(function(SplFileInfo $file, $index) use ($jigsaw) {

                $filename = str_replace('--', '-', strtolower(str_replace('_', '-', $file->getBasename('.' . $file->getExtension()))));
                $image = imagecreatefromjpeg($file->getRealPath());

                // Resize images for efficiency...
                $thumbnail = imagescale($image, 800);
                imagejpeg($thumbnail, $thumbnailFileName = sprintf('source/assets/photos/thumbnail/%s.jpg', $filename), 65);

                $tint = (new Tooleks\Php\AvgColorPicker\Gd\AvgColorPicker)->getImageAvgHexByPath($file->getRealPath());

                $large = imagescale($image, 1800);
                imagejpeg($large, $largeFileName = sprintf('source/assets/photos/large/%s.jpg', $filename));

                list($width, $height) = getimagesize($thumbnailFileName);
                $exif = exif_read_data($file->getRealPath(), 'FILE');

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
                    \Carbon\Carbon::parse($exif['FileDateTime'])
                );

                $jigsaw->writeSourceFile(sprintf('./_photos/%s.md', $filename), $contents);
        });

    }

    private function clearExistingFiles(string $path, string $fileType) : void
    {
        $filesystem = new Filesystem();
        $existingFiles = collect($filesystem->allFiles($path))->filter(function (SplFileInfo $file) use($fileType) {
            return Str::endsWith($fileType, $file->getExtension());
        })->map(function (SplFileInfo $file) {
            return $file->getRealPath();
        });

        $filesystem->delete($existingFiles->toArray());
    }
}
