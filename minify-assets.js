const fs = require('fs');
const path = require('path');
const terser = require('terser');
const cssnano = require('cssnano');
const postcss = require('postcss');

// Configuration
const config = {
    inputDir: 'public/assets',
    outputDir: 'public/assets/minified',
    jsFiles: [
        'js/custom/landing.js',
        'js/custom/widgets.js',
        'js/scripts.bundle.js',
        'js/widgets.bundle.js',
        'f_assets/js/style.js'
    ],
    cssFiles: [
        'css/custom.css',
        'css/style.bundle.css',
        'f_assets/css/style.css'
    ]
};

// Ensure output directory exists
if (!fs.existsSync(config.outputDir)) {
    fs.mkdirSync(config.outputDir, { recursive: true });
}

// Minify JavaScript files
async function minifyJS() {
    console.log('Starting JS minification...');
    
    for (const file of config.jsFiles) {
        const inputPath = path.join(config.inputDir, file);
        const outputPath = path.join(config.outputDir, file);
        
        if (fs.existsSync(inputPath)) {
            try {
                const code = fs.readFileSync(inputPath, 'utf8');
                const result = await terser.minify(code, {
                    compress: {
                        drop_console: true,
                        drop_debugger: true,
                        pure_funcs: ['console.log', 'console.info', 'console.debug']
                    },
                    mangle: true,
                    format: {
                        comments: false
                    }
                });
                
                // Ensure output directory exists
                const outputDir = path.dirname(outputPath);
                if (!fs.existsSync(outputDir)) {
                    fs.mkdirSync(outputDir, { recursive: true });
                }
                
                fs.writeFileSync(outputPath, result.code);
                console.log(`✓ Minified: ${file}`);
            } catch (error) {
                console.error(`✗ Error minifying ${file}:`, error.message);
            }
        } else {
            console.warn(`⚠ File not found: ${file}`);
        }
    }
}

// Minify CSS files
async function minifyCSS() {
    console.log('Starting CSS minification...');
    
    for (const file of config.cssFiles) {
        const inputPath = path.join(config.inputDir, file);
        const outputPath = path.join(config.outputDir, file);
        
        if (fs.existsSync(inputPath)) {
            try {
                const css = fs.readFileSync(inputPath, 'utf8');
                const result = await postcss([cssnano({
                    preset: ['default', {
                        discardComments: {
                            removeAll: true,
                        },
                        normalizeWhitespace: true,
                        minifyFontValues: true,
                        minifySelectors: true,
                        mergeLonghand: true,
                        mergeRules: true
                    }]
                })]).process(css, { from: inputPath, to: outputPath });
                
                // Ensure output directory exists
                const outputDir = path.dirname(outputPath);
                if (!fs.existsSync(outputDir)) {
                    fs.mkdirSync(outputDir, { recursive: true });
                }
                
                fs.writeFileSync(outputPath, result.css);
                console.log(`✓ Minified: ${file}`);
            } catch (error) {
                console.error(`✗ Error minifying ${file}:`, error.message);
            }
        } else {
            console.warn(`⚠ File not found: ${file}`);
        }
    }
}

// Generate manifest file
function generateManifest() {
    const manifest = {
        js: {},
        css: {},
        generated: new Date().toISOString()
    };
    
    // Add JS files to manifest
    config.jsFiles.forEach(file => {
        const originalPath = path.join(config.inputDir, file);
        const minifiedPath = path.join(config.outputDir, file);
        
        if (fs.existsSync(minifiedPath)) {
            const originalSize = fs.statSync(originalPath).size;
            const minifiedSize = fs.statSync(minifiedPath).size;
            const savings = ((originalSize - minifiedSize) / originalSize * 100).toFixed(2);
            
            manifest.js[file] = {
                original: originalPath,
                minified: minifiedPath,
                originalSize: originalSize,
                minifiedSize: minifiedSize,
                savings: `${savings}%`
            };
        }
    });
    
    // Add CSS files to manifest
    config.cssFiles.forEach(file => {
        const originalPath = path.join(config.inputDir, file);
        const minifiedPath = path.join(config.outputDir, file);
        
        if (fs.existsSync(minifiedPath)) {
            const originalSize = fs.statSync(originalPath).size;
            const minifiedSize = fs.statSync(minifiedPath).size;
            const savings = ((originalSize - minifiedSize) / originalSize * 100).toFixed(2);
            
            manifest.css[file] = {
                original: originalPath,
                minified: minifiedPath,
                originalSize: originalSize,
                minifiedSize: minifiedSize,
                savings: `${savings}%`
            };
        }
    });
    
    fs.writeFileSync(
        path.join(config.outputDir, 'manifest.json'),
        JSON.stringify(manifest, null, 2)
    );
    
    console.log('✓ Generated manifest.json');
}

// Main execution
async function main() {
    console.log('🚀 Starting asset minification process...\n');
    
    await minifyJS();
    console.log('');
    await minifyCSS();
    console.log('');
    generateManifest();
    
    console.log('\n✨ Minification complete!');
    console.log(`📁 Minified files saved to: ${config.outputDir}`);
    console.log('📋 Check manifest.json for details');
}

// Run if called directly
if (require.main === module) {
    main().catch(console.error);
}

module.exports = { minifyJS, minifyCSS, generateManifest };

