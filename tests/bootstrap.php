<?php
if (!$loader = @include __DIR__.'/../vendor/autoload.php') {
    exit(1);
}

use Seedr\Seedr;

$MAGNET = "";

$s = new Seedr('', '');

$torrent = $s->addTorrentFromMagnet($MAGNET);
$title = $torrent->title;
echo $title, PHP_EOL;

echo "Waiting for torrent process ~6 seconds", PHP_EOL;
sleep(6);

$content= $s->getFolder();
foreach ($content->folders as $folder) {
    if ($folder->name == $title){
        $files = $s->getFolder($folder->id)->files;
        break;
    }
}

foreach ($files as $f) {
    if ($f->stream_video){
        echo $f->name, PHP_EOL;
        $dl = $f;
        break;
    }
}

$s->downloadFile('/tmp/seedr/' . $dl->name, $dl->id);
