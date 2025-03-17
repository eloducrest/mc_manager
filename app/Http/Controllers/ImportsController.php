<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImportsController extends Controller
{
  public function downloadExampleFile(Request $request): BinaryFileResponse
  {

    $file = $request->input('file');

    return response()->download(public_path('imports-example/' . $file));
  }
}
