<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'post_id' => 'required|exists:posts,id',
            'text' => 'required|max:500'
        ]);

        $comment = Comment::create([
            'user_id' => $request->user('sanctum')->id,
            'post_id' => $request->input('post_id'),
            'text' => $request->input('text')
        ]);

        return new JsonResponse(['data' => $comment], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Comment $comment
     * @return JsonResponse
     */
    public function update(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'text' => 'required|max:500'
        ]);

        if ($comment->user_id != $request->user('sanctum')->id) {
            throw new UnauthorizedHttpException("You are not allowed to do this operation");
        }

        $comment->text = $request->input('text');
        $comment->save();

        return new JsonResponse(['data' => $comment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return Response
     * @throws Exception
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id != request()->user('sanctum')->id) {
            throw new UnauthorizedHttpException("You are not allowed to do this operation");
        }

        $comment->delete();

        return new JsonResponse(['data' => 'Comment deleted']);
    }
}
