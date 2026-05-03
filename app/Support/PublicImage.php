<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class PublicImage
{
    public static function url(?string $path): string
    {
        $path = self::normalize($path);

        if ($path === '') {
            return asset(self::fallbackPath());
        }

        if (is_file(public_path($path))) {
            return asset($path);
        }

        if (Storage::disk('public')->exists($path)) {
            return Route::has('public-files.show')
                ? route('public-files.show', ['path' => $path])
                : Storage::disk('public')->url($path);
        }

        return asset(self::fallbackPath());
    }

    public static function normalize(?string $path): string
    {
        $path = str_replace('\\', '/', trim((string) $path));

        foreach (['/storage/', 'storage/', '/'] as $prefix) {
            if (str_starts_with($path, $prefix)) {
                $path = substr($path, strlen($prefix));
            }
        }

        return ltrim($path, '/');
    }

    private static function fallbackPath(): string
    {
        return 'frontend/assets/images/thumbs/guagua-apt.png';
    }
}
