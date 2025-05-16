<?php
require 'config.php';

function getSongs() {
    global $songsCollection;
    return $songsCollection->find([], ['sort' => ['_id' => -1]])->toArray();
}

function getSongsByAlbum($album) {
    global $songsCollection;
    return $songsCollection->find(['album' => $album], ['sort' => ['_id' => -1]])->toArray();
}

function addSong($data, $imageName, $audioName) {
    global $songsCollection;
    $insertResult = $songsCollection->insertOne([
        'title' => $data['title'],
        'artist' => $data['artist'],
        'album' => $data['album'],
        'lyrics' => $data['lyrics'],
        'image' => $imageName,
        'audio' => $audioName,
        'favorite' => false,
        'createdAt' => new MongoDB\BSON\UTCDateTime()
    ]);
    return $insertResult->getInsertedId();
}
