<?php

namespace tests;

use PHPUnit\Framework\TestCase;

class AuthControllerTest extends TestCase
{
    public function test_login_page()
    {
        $this->getRequest()
            ->setMethod('POST')
            ->setPost(new Parameters(array('argument' => 'value')));
        $this->dispatch('/');
    }
}