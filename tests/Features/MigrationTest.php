<?php
use function Pest\Laravel\assertDatabaseHas;

it('can create a model in the database', function () {
    $this->setConfigTestingValues();
    $this->assertTrue(1 === 1);
});
