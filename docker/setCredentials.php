<?php

$env = file_get_contents(__DIR__. '/../.env');

$getValue = function (string $key) use ($env): ?string {
    preg_match("/{$key}\ *?=\ *?(?'value'\w+)/", $env, $matches);

    return $matches['value'];
};

$name = $getValue('USER_NAME');
$password = $getValue('USER_PASSWORD');

$authFileName = 'auth';

file_put_contents(__DIR__ . '/app/' . $authFileName, $name . ':' . crypt($password, base64_encode($password)));

$utorrentFileName = 'utserver.conf';

file_put_contents(__DIR__ . '/utorrent/' . $utorrentFileName, getConfig($name, $password));

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

sleep(2);
