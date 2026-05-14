<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MinifyAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assets:minify {--watch : Watch for changes and auto-minify}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Minify CSS and JavaScript assets';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting asset minification process...');
        
        // Run the PHP minification script
        $output = shell_exec('php minify-assets.php 2>&1');
        
        if ($output) {
            $this->line($output);
            
            // Parse and display statistics
            $manifestPath = public_path('assets/minified/manifest.json');
            if (file_exists($manifestPath)) {
                $manifest = json_decode(file_get_contents($manifestPath), true);
                
                $this->newLine();
                $this->info('📊 Minification Statistics:');
                
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
                
                $this->table(
                    ['Metric', 'Value'],
                    [
                        ['Total Original Size', $this->formatBytes($totalOriginalSize)],
                        ['Total Minified Size', $this->formatBytes($totalMinifiedSize)],
                        ['Total Savings', $totalSavings . '%'],
                        ['Files Processed', count($manifest['js']) + count($manifest['css'])],
                        ['Generated', $manifest['generated'] ?? 'Unknown']
                    ]
                );
            }
            
            $this->newLine();
            $this->info('✨ Minification complete!');
            $this->line('📁 Minified files saved to: public/assets/minified');
            $this->line('📋 Use @minifiedCss() and @minifiedJs() directives in your Blade templates');
        } else {
            $this->error('Failed to run minification script');
            return 1;
        }
        
        return 0;
    }
    
    /**
     * Format bytes to human readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
