<?php

use Inertia\Testing\AssertableInertia as Assert;

test('dashboard route is accessible and renders overview page', function () {
    $response = $this->get('/dashboard');

    $response->assertOk();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Dashboard/Overview')
    );
});

test('dashboard books route is accessible and renders books page', function () {
    $response = $this->get('/dashboard/books');

    $response->assertOk();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Dashboard/Books')
    );
});

test('dashboard borrowed route is accessible and renders borrowed page', function () {
    $response = $this->get('/dashboard/borrowed');

    $response->assertOk();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Dashboard/Borrowed')
    );
});

test('dashboard manage-user route is accessible and renders manage user page', function () {
    $response = $this->get('/dashboard/manage-user');

    $response->assertOk();
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Dashboard/ManageUser')
    );
});
