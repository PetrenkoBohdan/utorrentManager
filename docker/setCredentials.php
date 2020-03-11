<?php

$env = \file_get_contents(__DIR__ . '/../.env');

$getValue = function (string $key) use ($env): ?string {
    \preg_match("/{$key}\ *?=\ *?(?'value'\w+)/", $env, $matches);

    return $matches['value'];
};

$name = $getValue('USER_NAME') ?? 'admin';
$password = $getValue('USER_PASSWORD') ?? 'admin';

$authFileName = __DIR__ . '/app/' . 'auth';
\file_put_contents($authFileName, $name . ':' . \crypt($password, \base64_encode($password)));

$utorrentFileName = __DIR__ . '/utorrent/' . 'utserver.conf';
\file_put_contents($utorrentFileName, getConfig($name, $password));

while (! \file_exists($utorrentFileName) || !\file_exists($authFileName)) {
    echo 'Waiting for creating config files' . PHP_EOL;
    \sleep(2);
}

function getConfig($name, $password)
{
    return "admin_name: {$name}
admin_password: {$password}
dir_active: /utorrent/data/incomplete
dir_autoload: /utorrent/data/torrents
dir_completed: /utorrent/data
dir_request: /utorrent/data/request
dir_root: /utorrent/data
dir_torrent_files: /utorrent/data/torrents
low_cpu: 1
max_ul_rate: -1
max_ul_rate_seed: -1
prealloc_space: 1
append_incomplete: 1
seed_ratio: 0
ut_webui_dir: /utorrent";
}
