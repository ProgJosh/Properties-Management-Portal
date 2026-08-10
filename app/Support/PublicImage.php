<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class PublicImage
{
    public static function url(?string $path): string
    {
        $path = self::normalize($path);

        if ($path === '') {
            return asset(self::fallbackPath());
        }

        // On Vercel/production, serve from Supabase
        if (config('filesystems.default') !== 'local') {
            if (Storage::disk('supabase')->exists($path)) {
                return Storage::disk('supabase')->url($path);
            }
            return asset(self::fallbackPath());
        }

        // Local: check public disk or public folder
        if (is_file(public_path($path))) {
            return asset($path);
        }

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->url($path);
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
