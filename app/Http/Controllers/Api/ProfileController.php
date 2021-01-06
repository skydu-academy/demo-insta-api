<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __invoke(Request $request, $identifier = null)
    {
        if (is_null($identifier)) {
            $user = $request->user();
            $user->load('posts');
        } else {
            $user = User::where('id', $identifier)->orWhere('username', $identifier)->with('posts')->firstOrFail();
        }

        return new JsonResponse(['data' => $user]);
    }
}
