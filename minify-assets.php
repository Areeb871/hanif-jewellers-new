<?php

/**
 * Asset Minifier for Hanif Jewellers
 * Minifies CSS and JavaScript files
 */

class AssetMinifier
{
    private $inputDir;
    private $outputDir;
    private $jsFiles;
    private $cssFiles;
    
    public function __construct()
    {
        $this->inputDir = 'public/assets';
        $this->outputDir = 'public/assets/minified';
        $this->jsFiles = [
            'js/custom/landing.js',
            'js/custom/widgets.js',
            'js/scripts.bundle.js',
            'js/widgets.bundle.js',
            'f_assets/js/style.js'
        ];
        $this->cssFiles = [
            'css/custom.css',
            'css/style.bundle.css',
            'f_assets/css/style.css'
        ];
    }
    
    public function minifyJS($file)
    {
        $inputPath = $this->inputDir . '/' . $file;
        $outputPath = $this->outputDir . '/' . $file;
        
        if (!file_exists($inputPath)) {
            return false;
        }
        
        $code = file_get_contents($inputPath);
        
        // Basic JS minification
        $code = preg_replace('/\/\*.*?\*\//s', '', $code); // Remove /* */ comments
        $code = preg_replace('/\/\/.*$/m', '', $code); // Remove // comments
        $code = preg_replace('/\s+/', ' ', $code); // Replace multiple spaces with single space
        $code = preg_replace('/;\s*}/', '}', $code); // Remove semicolons before }
        $code = preg_replace('/{\s*/', '{', $code); // Remove spaces after {
        $code = preg_replace('/\s*}/', '}', $code); // Remove spaces before }
        $code = preg_replace('/\s*{/', '{', $code); // Remove spaces before {
        $code = preg_replace('/;\s*/', ';', $code); // Remove spaces after ;
        $code = preg_replace('/,\s*/', ',', $code); // Remove spaces after ,
        $code = preg_replace('/\s*=/', '=', $code); // Remove spaces around =
        $code = preg_replace('/=\s*/', '=', $code); // Remove spaces after =
        $code = trim($code);
        
        // Ensure output directory exists
        $outputDir = dirname($outputPath);
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }
        
        return file_put_contents($outputPath, $code) !== false;
    }
    
    public function minifyCSS($file)
    {
        $inputPath = $this->inputDir . '/' . $file;
        $outputPath = $this->outputDir . '/' . $file;
        
        if (!file_exists($inputPath)) {
            return false;
        }
        
        $css = file_get_contents($inputPath);
        
        // Basic CSS minification
        $css = preg_replace('/\/\*.*?\*\//s', '', $css); // Remove /* */ comments
        $css = preg_replace('/\s+/', ' ', $css); // Replace multiple spaces with single space
        $css = preg_replace('/;\s*}/', '}', $css); // Remove semicolons before }
        $css = preg_replace('/{\s*/', '{', $css); // Remove spaces after {
        $css = preg_replace('/\s*}/', '}', $css); // Remove spaces before }
        $css = preg_replace('/\s*{/', '{', $css); // Remove spaces before {
        $css = preg_replace('/;\s*/', ';', $css); // Remove spaces after ;
        $css = preg_replace('/,\s*/', ',', $css); // Remove spaces after ,
        $css = preg_replace('/:\s*/', ':', $css); // Remove spaces after :
        $css = preg_replace('/\s*:/', ':', $css); // Remove spaces before :
        $css = trim($css);
        
        // Ensure output directory exists
        $outputDir = dirname($outputPath);
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }
        
        return file_put_contents($outputPath, $css) !== false;
    }
    
    public function generateManifest()
    {
        $manifest = [
            'js' => [],
            'css' => [],
            'generated' => date('Y-m-d H:i:s')
        ];
        
        // Add JS files to manifest
        foreach ($this->jsFiles as $file) {
            $originalPath = $this->inputDir . '/' . $file;
            $minifiedPath = $this->outputDir . '/' . $file;
            
            if (file_exists($minifiedPath)) {
                $originalSize = filesize($originalPath);
                $minifiedSize = filesize($minifiedPath);
                $savings = round((($originalSize - $minifiedSize) / $originalSize) * 100, 2);
                
                $manifest['js'][$file] = [
                    'original' => $originalPath,
                    'minified' => $minifiedPath,
                    'originalSize' => $originalSize,
                    'minifiedSize' => $minifiedSize,
                    'savings' => $savings . '%'
                ];
            }
        }
        
        // Add CSS files to manifest
        foreach ($this->cssFiles as $file) {
            $originalPath = $this->inputDir . '/' . $file;
            $minifiedPath = $this->outputDir . '/' . $file;
            
            if (file_exists($minifiedPath)) {
                $originalSize = filesize($originalPath);
                $minifiedSize = filesize($minifiedPath);
                $savings = round((($originalSize - $minifiedSize) / $originalSize) * 100, 2);
                
                $manifest['css'][$file] = [
                    'original' => $originalPath,
                    'minified' => $minifiedPath,
                    'originalSize' => $originalSize,
                    'minifiedSize' => $minifiedSize,
                    'savings' => $savings . '%'
                ];
            }
        }
        
        $manifestPath = $this->outputDir . '/manifest.json';
        return file_put_contents($manifestPath, json_encode($manifest, JSON_PRETTY_PRINT)) !== false;
    }
    
    public function run()
    {
        echo "🚀 Starting asset minification process...\n\n";
        
        // Ensure output directory exists
        if (!is_dir($this->outputDir)) {
            mkdir($this->outputDir, 0755, true);
        }
        
        // Minify JS files
        echo "Starting JS minification...\n";
        foreach ($this->jsFiles as $file) {
            if ($this->minifyJS($file)) {
                echo "✓ Minified: {$file}\n";
            } else {
                echo "✗ Error minifying: {$file}\n";
            }
        }
        
        echo "\n";
        
        // Minify CSS files
        echo "Starting CSS minification...\n";
        foreach ($this->cssFiles as $file) {
            if ($this->minifyCSS($file)) {
                echo "✓ Minified: {$file}\n";
            } else {
                echo "✗ Error minifying: {$file}\n";
            }
        }
        
        echo "\n";
        
        // Generate manifest
        if ($this->generateManifest()) {
            echo "✓ Generated manifest.json\n";
        } else {
            echo "✗ Error generating manifest\n";
        }
        
        echo "\n✨ Minification complete!\n";
        echo "📁 Minified files saved to: {$this->outputDir}\n";
        echo "📋 Check manifest.json for details\n";
    }
}

// Run the minifier
$minifier = new AssetMinifier();
$minifier->run();

