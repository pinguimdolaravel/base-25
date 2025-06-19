<?php

declare(strict_types = 1);

use App\Http\Middleware\CheckImpersonate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Session;

beforeEach(function () {
    $this->middleware = new CheckImpersonate();
});

it('handles request without impersonation', function () {
    Session::shouldReceive('get')
        ->with('impersonate_as')
        ->once()
        ->andReturnNull();

    $request  = Request::create('/test', 'GET');
    $response = $this->middleware->handle($request, fn ($req) => new Symfony\Component\HttpFoundation\Response());

    expect($response)->toBeInstanceOf(Symfony\Component\HttpFoundation\Response::class);
});

it('sets context and authenticates user when impersonating', function () {
    $impersonatorId  = 1;
    $impersonateAsId = 2;

    Auth::shouldReceive('id')
        ->once()
        ->andReturn($impersonatorId);

    Auth::shouldReceive('onceUsingId')
        ->with($impersonateAsId)
        ->once();

    Session::shouldReceive('get')
        ->with('impersonate_as')
        ->once()
        ->andReturn($impersonateAsId);

    Context::shouldReceive('add')
        ->with('impersonator_id', $impersonatorId)
        ->once();

    Context::shouldReceive('add')
        ->with('impersonate_as', $impersonateAsId)
        ->once();

    $request  = Request::create('/test', 'GET');
    $response = $this->middleware->handle($request, fn ($req) => new Symfony\Component\HttpFoundation\Response());

    expect($response)->toBeInstanceOf(Symfony\Component\HttpFoundation\Response::class);
});
