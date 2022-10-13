<?php

namespace App\Http\Controllers;
use App\Http\Requests\CommentRequest;
use App\Models\Post;
use App\Models\Comment;
use App\Models\SubComment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\InformationNotification;

class CommentController extends Controller
{
    public function sendComment(CommentRequest $request, Comment $comment)
    {
        // sendCommentにはポリシーは不要。
        // 理由としては、$request->user()->id;でちゃんとリクエストを送ってきてるユーザーは特定出来ているから。また、削除や更新処理であれば該当コメントを投稿したユーザーと、ログインユーザーを照合しなければならないが、新規でのコメント投稿にはその照合の必要がないから
        // $request->validate([
        //     'comment' => ['string', new textMaxWidth(2000),],
        // ]);

        $comment->user_id = $request->user()->id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->save();


        $post = Post::find($request->post_id);
        if ($request->user()->id !== $post->user->id) {

            $fromUser = User::find($request->user()->id);
            $post->user->notify(new InformationNotification($post, $fromUser, "comment", null));
        }
    }
    public function getComment(Request $request)
    {
        $comments = Comment::where('post_id', $request->post_id)->orderByDesc('created_at')->with("user")->get();
        // dd($comments);
        return $comments;
    }
    public function deleteComment(Request $request)
    {
        $comment = Comment::find($request->commeid);
        $this->authorize('deleteComment', [Comment::class,$comment->user_id]);
        // ↑Comment::classは、どのポリシーを使うのかを決めるために必要。
        $comment->delete();
    }
    public function sendSubComment(Request $request, SubComment $subcomment)
    {
        // $request->validate([
        //     'sub_comment' => ['string', new textMaxWidth(2000),],
        // ]);

        $subcomment->user_id = $request->user()->id ;
        $subcomment->comment_id = $request->comment_id;
        $subcomment->sub_comment = $request->sub_comment;
        $subcomment->to_user_name = $request->to_user_name;
        $subcomment->save();

        if ($request->type === "a-type") {
            $comment = Comment::find($request->comment_id);
            $post = $comment->post;
            if ($request->user()->id !== $comment->user->id) {
                $to_comment_text = mb_strimwidth($comment->comment, 0, 60, '…', 'UTF-8');
                $fromUser = User::find($request->user()->id);
                $comment->user->notify(new InformationNotification($post, $fromUser, "reply-a", $to_comment_text));
            }
        } elseif ($request->type === "b-type") {
            $comment = Comment::find($request->comment_id);
            $post = $comment->post;
            $to_subcomment = SubComment::find($request->to_subcomment_id);
            if ($request->user()->id !== $to_subcomment->user->id) {
                $to_comment_text = mb_strimwidth($to_subcomment->sub_comment, 0, 60, '…', 'UTF-8');
                $fromUser = User::find($request->user()->id);
                $to_subcomment->user->notify(new InformationNotification($post, $fromUser, "reply-b", $to_comment_text));
            }
        }
    } 

    public function getSubComment(Request $request)
    {
        $subcomments = SubComment::where('comment_id', $request->comment_id)->orderByDesc('created_at')->with("user")->get();
        return $subcomments;
    }
    public function deleteSubComment(Request $request)
    {
        $Subcomment = SubComment::find($request->commeid);
        $this->authorize('deleteSubComment', [Comment::class,$Subcomment->user_id]);
        // ↑Comment::classは、どのポリシーを使うのかを決めるために必要。
        $Subcomment->delete();
    }
}
