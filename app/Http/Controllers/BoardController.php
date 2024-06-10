<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Card;
use App\Models\Comment;
use App\Models\Favorite_user_board;
use App\Models\Label;
use App\Models\User;
use App\Models\Workspace;
use App\Models\Workspace_user;

class BoardController extends Controller
{
    public function addFavorite(Request $request)
    {
        $favorite_user_board = new favorite_user_board;
        $favorite_user_board->u_id = $request->user()->id;
        $favorite_user_board->b_id = $request->boardId;

        $favorite_user_board->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function removeFavorite(Request $request)
    {
        $boardId = $request->input('b_id');
        $favorite_user_board = Favorite_user_board::findOrFail($boardId);
        $favorite_user_board->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    //done
    public function addWorkspace(Request $request)
    {
        $workspace = new Workspace;
        $workspace->title = $request->title;
        $workspace->description = $request->description;
        $workspace->type = $request->type;
        $workspace->save();


        $workspaceUser = new Workspace_user;
        $workspaceUser->userId = $request->user()->id;
        $workspaceUser->workspaceId = $workspace->id;


        $workspaceUser->save();


        return response()->json([
            'success' => true,
            'workspace' => $workspace,
            'workspace_user' => $workspaceUser
        ]);
    }

    //done
    public function removeWorkspace(Request $request)
    {
        $workspaceId = $request->input('workspace_id');
        $workspaceId = Workspace::findOrFail($workspaceId);
        $workspaceId->delete();

        $workspaceUser = Workspace_user::where('workspaceId', $workspaceId->id)->first();
        $workspaceUser->delete();

        return response()->json([
            'success' => true,
            'workspace' => $workspaceId
        ]);
    }


    public function getWorkspaces(Request $request)
    {
        $user = $request->user();
        $workspaces = $user->userWorkspaces()->with('workspaceBoards')->get();

        return response()->json($workspaces);
    }



    public function addBoard(Request $request)
    {
        $board = Board::create($request->all());

        return response()->json([
            'success' => true,
            'board' => $board
        ]);
    }

    public function removeBoard(Request $request)
    {
        $boardId = $request->input('board_id');
        $board = Board::findOrFail($boardId);
        $board->delete();

        return response()->json([
            'success' => true,
            'board_id' => $boardId,
        ]);
    }

    public function addComment(Request $request)
    {
        $comment = new Comment;
        $comment->content = $request->content;

        $comment->u_id = $request->user()->id;
        $comment->c_id = $request->c_id;

        $comment->save();

        return response()->json([
            'success' => true,
            'comment_id' => $comment->id,
        ]);
    }

    public function addCard(Request $request)
    {
        $card = Card::create($request->all());

        return response()->json([
            'success' => true,
            'card' => $card,
        ]);
    }

    public function removeCard(Request $request)
    {
        $card = $request->input('card_id');
        $card = Card::findOrFail($card);
        $card->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function addLabel(Request $request)
    {
        $label = Label::create($request->all());

        return response()->json([
            'success' => true,
            'card' => $label,
        ]);
    }

    public function removeLabel(Request $request)
    {
        $label = $request->input('label_id');
        $label = Label::findOrFail($label);
        $label->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
