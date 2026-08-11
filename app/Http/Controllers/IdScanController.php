<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IdScanController extends Controller
{
    // Expected aspect ratio ranges per ID type [min, max]
    private array $idAspectRatios = [
        'passport'          => [0.65, 0.80],  // portrait booklet page
        'drivers_license'   => [1.45, 1.75],  // CR80 landscape
        'national_id'       => [1.45, 1.75],  // PhilSys landscape
        'sss_id'            => [1.45, 1.75],
        'pagibig_id'        => [1.45, 1.75],
        'philhealth_id'     => [1.45, 1.75],
        'voters_id'         => [1.45, 1.75],
        'postal_id'         => [1.45, 1.75],
        'senior_citizen_id' => [1.45, 1.75],
        'residence_permit'  => [1.45, 1.75],
        'tin_id'            => [1.45, 1.75],
        'umid'              => [1.45, 1.75],
        'student_id'        => [0.57, 0.70], //portrait CR80 card
    ];

    // Minimum resolution per ID type [width, height]
    private array $minResolution = [
        'passport'          => [400, 500],
        'drivers_license'   => [500, 300],
        'national_id'       => [500, 300],
        'default'           => [300, 200],
    ];

    public function scan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_document' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'id_type'     => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'valid'   => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $file   = $request->file('id_document');
        $idType = $request->input('id_type');

        // Get image dimensions
        $imageInfo = @getimagesize($file->getRealPath());

        if (!$imageInfo || !in_array($imageInfo[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG])) {
            return response()->json([
                'valid'   => false,
                'message' => 'The uploaded file does not appear to be a valid image. Please upload a clear photo of your ID.',
            ]);
        }

        [$width, $height] = $imageInfo;

        // Check minimum resolution
        $minRes = $this->minResolution[$idType] ?? $this->minResolution['default'];
        if ($width < $minRes[0] || $height < $minRes[1]) {
            return response()->json([
                'valid'   => false,
                'message' => "The image is too small ({$width}x{$height}px). Please upload a clearer, higher-resolution photo of your ID.",
            ]);
        }

        // Check aspect ratio
        $aspectRatio = $width / $height;
        $expected    = $this->idAspectRatios[$idType] ?? [1.45, 1.75];

        if ($aspectRatio < $expected[0] || $aspectRatio > $expected[1]) {
            $orientation = $idType === 'passport' ? 'portrait (taller than wide)' : 'landscape (wider than tall)';
            $ratio       = number_format($aspectRatio, 2);
            return response()->json([
                'valid'   => false,
                'message' => "This doesn't look like a {$this->getIdLabel($idType)}. The image should be {$orientation}. Make sure you're photographing the correct ID flat and fully visible (detected ratio: {$ratio}).",
            ]);
        }

        // Check image is not too dark or too bright (basic quality check)
        $qualityCheck = $this->checkImageQuality($file->getRealPath(), $imageInfo[2]);
        if (!$qualityCheck['pass']) {
            return response()->json([
                'valid'   => false,
                'message' => $qualityCheck['message'],
            ]);
        }

        return response()->json([
            'valid'   => true,
            'message' => "✓ ID image looks valid. Your {$this->getIdLabel($idType)} has been accepted.",
        ]);
    }

    private function checkImageQuality(string $path, int $type): array
    {
        try {
            $img = $type === IMAGETYPE_PNG ? imagecreatefrompng($path) : imagecreatefromjpeg($path);
            if (!$img) {
                return ['pass' => false, 'message' => 'Could not read the image. Please upload a clear, undamaged photo.'];
            }

            $width  = imagesx($img);
            $height = imagesy($img);

            // Sample brightness from a grid of points
            $samples    = 0;
            $totalBrightness = 0;
            $step       = max(1, (int) ($width / 20));

            for ($x = 0; $x < $width; $x += $step) {
                for ($y = 0; $y < $height; $y += $step) {
                    $rgb   = imagecolorat($img, $x, $y);
                    $r     = ($rgb >> 16) & 0xFF;
                    $g     = ($rgb >> 8) & 0xFF;
                    $b     = $rgb & 0xFF;
                    $totalBrightness += (0.299 * $r + 0.587 * $g + 0.114 * $b);
                    $samples++;
                }
            }

            imagedestroy($img);

            if ($samples === 0) {
                return ['pass' => true, 'message' => ''];
            }

            $avgBrightness = $totalBrightness / $samples;

            if ($avgBrightness < 30) {
                return ['pass' => false, 'message' => 'The image is too dark. Please take the photo in better lighting so the ID details are clearly visible.'];
            }

            if ($avgBrightness > 240) {
                return ['pass' => false, 'message' => 'The image is overexposed (too bright/washed out). Please retake the photo without direct flash or glare on the ID.'];
            }

            return ['pass' => true, 'message' => ''];
        } catch (\Throwable $e) {
            return ['pass' => true, 'message' => '']; // allow on error
        }
    }

    private function getIdLabel(string $idType): string
    {
        return match ($idType) {
            'passport'          => 'Passport',
            'drivers_license'   => "Driver's License",
            'national_id'       => 'National ID (PhilSys)',
            'sss_id'            => 'SSS ID',
            'pagibig_id'        => 'Pag-IBIG ID',
            'philhealth_id'     => 'PhilHealth ID',
            'voters_id'         => "Voter's ID",
            'postal_id'         => 'Postal ID',
            'senior_citizen_id' => 'Senior Citizen ID',
            'residence_permit'  => 'Residence Permit',
            'tin_id'            => 'TIN ID',
            'umid'              => 'UMID Card',
            'student_id'        => 'Student ID',
            default             => 'ID',
        };
    }
}
