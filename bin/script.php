<?php

// change this path with your GitHub repository name
$repos = "/2023-03-remote-fr-php-wild-project-cat-watch";

//list the php files from root directory that must be converted.
//important: do not write the extension .php
$files = [
    "advice",
    "article_1",
    "article_2",
    "article_3",
    "article_4",
    "article_5",
    "articlesChattearoulete",
    "contact",
    "index",
];

foreach ($files as $file) {
    $fileInputPath = $file . '.php';
    $fileOutputPath = 'docs/' . $file . '.html';
    shell_exec('php ' . $fileInputPath . ' > ' . $fileOutputPath);
    $handle = fopen($fileOutputPath, "r");
    $contents = fread($handle, filesize($fileOutputPath));
    fclose($handle);
    
    $contents = str_replace('href="', 'href="' . $repos, $contents);
    $contents = str_replace('src="', 'src="' . $repos, $contents);
    $contents = str_replace('src=="', 'src=="' . $repos, $contents);
    $contents = str_replace('action="', 'action="' . $repos, $contents);
    $contents = str_replace('.php', '.html', $contents);
    
    $handle = fopen($fileOutputPath, "w");
    fwrite($handle, $contents);
    fclose($handle);
}
