<?php

namespace Scooby\Http;

interface MiddlewareInterface
{
    public function handle(Request $request);
}