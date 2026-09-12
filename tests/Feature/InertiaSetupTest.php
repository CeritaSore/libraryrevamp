<?php

use Inertia\Testing\AssertableInertia as Assert;

test('root route returns inertia welcome frontpage with showcase props', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Welcome')
        ->has('stats')
        ->has('categories')
        ->has('featuredBooks')
        ->has('services')
    );
});

test('inertia request returns proper component and header', function () {
    $version = file_exists($manifest = public_path('build/manifest.json'))
        ? hash_file('xxh128', $manifest)
        : null;

    $headers = ['X-Inertia' => 'true'];
    if ($version) {
        $headers['X-Inertia-Version'] = $version;
    }

    $response = $this->withHeaders($headers)->get('/');

    $response->assertOk();
    $response->assertHeader('X-Inertia', 'true');
});
