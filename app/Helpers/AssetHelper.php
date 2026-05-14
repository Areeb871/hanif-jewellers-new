<?php

namespace App\Helpers;

class AssetHelper
{
    private static $manifest = null;
    
    /**
     * Load the manifest file
     */
    private static function loadManifest()
    {
        if (self::$manifest === null) {
            $manifestPath = public_path('assets/minified/manifest.json');
            if (file_exists($manifestPath)) {
                self::$manifest = json_decode(file_get_contents($manifestPath), true);
            } else {
                self::$manifest = [];
            }
        }
        return self::$manifest;
    }
    
    /**
     * Get minified asset path
     */
    public static function minified($path)
    {
        $manifest = self::loadManifest();
        
        // Check if we're in production mode
        $useMinified = config('app.env') === 'production' || config('app.debug') === false;
        
        if (!$useMinified || !isset($manifest['js'][$path]) && !isset($manifest['css'][$path])) {
            return asset('assets/' . $path);
        }
        
        // Return minified version
        if (isset($manifest['js'][$path])) {
            return asset('assets/minified/' . $path);
        }
        
        if (isset($manifest['css'][$path])) {
            return asset('assets/minified/' . $path);
        }
        
        return asset('assets/' . $path);
    }
    
    /**
     * Get minified CSS file
     */
    public static function css($path)
    {
        return self::minified($path);
    }
    
    /**
     * Get minified JS file
     */
    public static function js($path)
    {
        return self::minified($path);
    }
    
    /**
     * Get asset statistics
     */
    public static function getStats()
    {
        $manifest = self::loadManifest();
        
        $totalOriginalSize = 0;
        $totalMinifiedSize = 0;
        
        foreach ($manifest['js'] as $file => $data) {
            $totalOriginalSize += $data['originalSize'];
            $totalMinifiedSize += $data['minifiedSize'];
        }
        
        foreach ($manifest['css'] as $file => $data) {
            $totalOriginalSize += $data['originalSize'];
            $totalMinifiedSize += $data['minifiedSize'];
        }
        
        $totalSavings = round((($totalOriginalSize - $totalMinifiedSize) / $totalOriginalSize) * 100, 2);
        
        return [
            'totalOriginalSize' => $totalOriginalSize,
            'totalMinifiedSize' => $totalMinifiedSize,
            'totalSavings' => $totalSavings . '%',
            'filesCount' => count($manifest['js']) + count($manifest['css']),
            'generated' => $manifest['generated'] ?? 'Unknown'
        ];
    }
    
    /**
     * Generate HTML link tag for CSS
     */
    public static function cssLink($path, $attributes = [])
    {
        $url = self::css($path);
        $attrs = '';
        
        foreach ($attributes as $key => $value) {
            $attrs .= " {$key}=\"{$value}\"";
        }
        
        return "<link rel=\"stylesheet\" href=\"{$url}\"{$attrs}>";
    }
    
    /**
     * Generate HTML script tag for JS
     */
    public static function jsScript($path, $attributes = [])
    {
        $url = self::js($path);
        $attrs = '';
        
        foreach ($attributes as $key => $value) {
            $attrs .= " {$key}=\"{$value}\"";
        }
        
        return "<script src=\"{$url}\"{$attrs}></script>";
    }
}

