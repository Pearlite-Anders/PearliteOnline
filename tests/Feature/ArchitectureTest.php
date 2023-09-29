<?php

it('finds missing debug statements', function() {
    expect(['dd', 'dump'])
    ->not->toBeUsed();
});
