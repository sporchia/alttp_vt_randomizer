<?php

return [
	'default' => 'local',

	/*
	|--------------------------------------------------------------------------
	| Default Cloud Filesystem Disk
	|--------------------------------------------------------------------------
	|
	| Many applications store files both locally and in the cloud. For this
	| reason, you may specify a default "cloud" driver here. This driver
	| will be bound as the Cloud disk implementation in the container.
	|
	*/

	'cloud' => 's3',

	/*
	|--------------------------------------------------------------------------
	| Filesystem Disks
	|--------------------------------------------------------------------------
	|
	| Here you may configure as many filesystem "disks" as you wish, and you
	| may even configure multiple disks of the same driver. Defaults have
	| been setup for each driver as an example of the required options.
	|
	| Supported Drivers: "local", "ftp", "s3", "rackspace"
	|
	*/

	'disks' => [
		'local' => [
			'driver' => 'local',
			'root' => storage_path('app'),
		],

		'public' => [
			'driver' => 'local',
			'root' => storage_path('app/public'),
			'visibility' => 'public',
		],

        'sprites' => [
            'driver' => 'local',
            'root'   => resource_path('sprites'),
        ],

		'rackspace' => [
			'driver'    => 'rackspace',
			'username'  => env('RACKSPACE_USER', ''),
			'key'       => env('RACKSPACE_KEY', ''),
			'container' => 'sprites',
			'endpoint'  => 'https://identity.api.rackspacecloud.com/v2.0/',
			'region'    => 'ORD',
			'url_type'  => 'publicURL',
		],

		's3' => [
			'driver' => 's3',
			'key' => 'your-key',
			'secret' => 'your-secret',
			'region' => 'your-region',
			'bucket' => 'your-bucket',
		],
	],

];
