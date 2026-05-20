<?php

$target = '/home/trk/trikon/storage/app/public';
$link = '/home/trk/public_html/storage';

// 1. Delete any existing broken link or folder
if (file_exists($link)) {
    if (is_link($link)) {
        unlink($link);
        echo "Deleted old symbolic link.<br>";
    } else {
        // If it's a real folder, rename it to back it up
        rename($link, $link . '_backup_' . time());
        echo "Renamed old storage folder to backup.<br>";
    }
}

// 2. Create the new link
if (symlink($target, $link)) {
    echo "<b>Success!</b> The storage link has been created.<br>";
    echo "Target: " . $target . "<br>";
    echo "Link: " . $link;
} else {
    echo "<b>Failed!</b> Could not create the link. Check permissions.";
}