<?php

function getURI() : string
{
  $uri = $_SERVER['REQUEST_URI'];
  $uri = explode('/', $uri);
  array_shift($uri);
  array_shift($uri);
  $uri = '/' . implode('/', $uri);
  return $uri;
}

function getRequestMethod() : string
{
  return $_SERVER['REQUEST_METHOD'];
}

function view(string $file)
{
  return "view: $file";
}