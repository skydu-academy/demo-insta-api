<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Post::where('status', 'published')->withCount('comments')->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post)
    {
        if (!$post->isPublished()) {
            throw new AccessDeniedHttpException("This post is not available right now");
        }

        $postData = $post->load('comments')->toArray();
        $postData['likes_info'] = $post->getLikesInfo(request()->user('sanctum'));

        return response()->json(['data' => $postData]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function updateLikes(Request $request, Post $post)
    {
        $user = $request->user('sanctum');
        $likeIndex = $post->userLikeIndex($user);
        $postLikerId = $post->likes;

        if ($likeIndex !== false) {
            unset($postLikerId[$likeIndex]);
            $result = 'removed';
        } else {
            $postLikerId[] = $user->id;
            $result = 'added';
        }
        $post->update(['likes' => $postLikerId]);

        return response()->json(['data' => 'Like has been '.$result]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Post $post): ?bool
    {
        if ($post->user_id != request()->user('sanctum')->id) {
            throw new UnauthorizedHttpException("You're not allowed to do this operation");
        }

        return $post->delete();
    }
}
