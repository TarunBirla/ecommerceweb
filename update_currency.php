<?php

$dir = new RecursiveDirectoryIterator(__DIR__);
$ite = new RecursiveIteratorIterator($dir);
$count = 0;

foreach ($ite as $file) {
    if ($file->isDir()) continue;
    $path = $file->getPathname();
    if (strpos($path, 'vendor') !== false || strpos($path, 'storage') !== false || strpos($path, '.git') !== false) continue;
    if (preg_match('/\.(php|css|js|json|md)$/', $path)) {
        $content = file_get_contents($path);
        if (strpos($content, '£') !== false || strpos($content, 'GBP') !== false || strpos($content, 'All UK Standard Zone') !== false) {
            $newContent = str_replace(
                ['£', 'GBP', 'All UK Standard Zone', 'Flat 5 OFF'],
                ['£', 'GBP', 'All UK Standard Zone', 'Flat 5 OFF'],
                $content
            );
            file_get_contents($path);
            file_put_contents($path, $newContent);
            echo "Updated: " . $path . "\n";
            $count++;
        }
    }
}

echo "Total files updated: " . $count . "\n";
