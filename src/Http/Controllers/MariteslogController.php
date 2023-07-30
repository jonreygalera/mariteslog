<?php

namespace Jonre\Mariteslog\Http\Controllers;

use Illuminate\Http\Request;
use Jonre\Mariteslog\Mariteslog;
use Throwable;
use Exception;

class MariteslogController extends Controller
{
  public function ping()
  {
    return 'PONG';
  }

  public function getLogs(Request $request)
  {
    try {
      return (new Mariteslog($request->logname))->toArray();
    } catch(\Throwable $throwable) {
      return response()->json(['message' => $throwable->getMessage()], 500);
    }
  }

  public function insert(Request $request)
  {
    try {
      return Mariteslog::insert($request->channel ?? null, $request->level ?? 'info', $request->message ?? '', $request->array ?? []);
    } catch(\Throwable $throwable) {
      return response()->json(['message' => $throwable->getMessage()], 500);
    }
  }
}