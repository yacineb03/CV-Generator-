<?php
$file = $argv[1] ?? 'CV_Yacine_Quick.pdf';
if (!file_exists($file)) {
    echo "File not found: $file\n";
    exit(1);
}
$content = file_get_contents($file);
$count = preg_match_all('/\/Type\s*\/Page\b/', $content);
echo "File: $file | Pages: $count | Size: " . strlen($content) . " bytes\n";
if ($count !== 1) {
    echo "WARNING: Not exactly 1 page!\n";
    exit(2);
}
echo "OK: Strictly 1 page!\n";
