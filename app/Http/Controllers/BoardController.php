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
        $boardId = $request->id_str;
        $userId = $request->user()->id;
        $existingFavorite = Favorite_user_board::where([
            'board_id' => $boardId,
            'user_id' => $userId
        ])
            ->first();

        if ($existingFavorite) {
            $existingFavorite->delete();
            return response()->json([
                'deletedExisting' => $existingFavorite,
            ]);
        }

        $favorite_user_board = new favorite_user_board;
        $favorite_user_board->user_id = $request->user()->id;
        $favorite_user_board->board_id = $boardId;

        $favorite_user_board->save();

        return response()->json([
            'addedNewFavorite' => $favorite_user_board,
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


    public function removeWorkspace(Request $request)
    {
        $workspaceId = $request->input('workspace_id');
        $workspace = Workspace::findOrFail($workspaceId);
        $workspace->delete();

        $workspace->workspaceUser()->detach($workspaceId);

        //$workspaceUser = Workspace_user::where('workspaceId', $workspaceId->id)->first();
        //$workspaceUser->delete();

        return response()->json([
            'success' => true,
            'workspace' => $workspaceId
        ]);
    }

    //works
    public function getWorkspaces(Request $request)
    {
        $user = $request->user();
        $workspaces = $user->userWorkspaces()->get();

        $workspacesArray = $workspaces->makeHidden('id')->map(function ($workspace) use ($user) {
            $workspace->id_str = (string) $workspace->id;
            $workspace->pivot->makeHidden('userId');
            $workspace->pivot->makeHidden('workspaceId');
            $workspace->pivot->userId_str = (string) $workspace->pivot->userId;
            $workspace->pivot->workspaceId_str = (string) $workspace->pivot->workspaceId;
            $workspace->workspace_boards = $workspace->workspaceBoards->makeHidden('id')->map(function ($board) use ($user) {
                $board->makeHidden('id');
                $board->id_str = (string) $board->id;
                $board->workspace_id_str = (string) $board->workspace_id;
                $board->makeHidden('workspace_id');
                $board->is_favorited = $board->favoritedByUsers()->where('user_id', $user->id)->exists();
                return $board;
            });
            unset($workspace->workspaceBoards);
            return $workspace;
        })->toArray();

        return response()->json($workspacesArray);
    }

    public function addBoard(Request $request)
    {
        $board = new Board;
        $board->title = $request->title;
        $board->prefs_background = $request->prefs_background;
        $board->prefs_background_url = $request->prefs_background_url;
        $board->visibility = $request->visibility;
        $board->workspace_id = (int) $request->workspace_id_str;
        $board->save();

        $board->makeHidden('id');
        $board->makeHidden('workspace_id');
        $board->workspace_id_str = (string) $board->workspace_id;
        $board->id_str = (string) $board->id;

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

    public function closeBoard(Request $request)
    {
        $boardId = $request->input('board_id');
        $board = Board::findOrFail($boardId);
        $board->closed = true;
        $board->save();

        return response()->json([
            'success' => true,
            'board_id' => $boardId,
        ]);
    }

    public function getWorkspace(Request $request, $wid)
    {
        $user = $request->user();
        $workspace = Workspace::findOrFail($wid);
        $workspace->makeHidden('id');
        $workspace->id_str = (string) $workspace->id;
        $workspace->workspace_boards = $workspace->workspaceBoards->makeHidden('id')->map(function ($board) use ($user) {
            $board->makeHidden('id');
            $board->id_str = (string) $board->id;
            $board->workspace_id_str = (string) $board->workspace_id;
            $board->makeHidden('workspace_id');
            $board->is_favorited = $board->favoritedByUsers()->where('user_id', $user->id)->exists();
            return $board;
        });

        return response()->json($workspace);
    }

    public function updateWorkspace(Request $request, $wid)
    {
        $workspace = Workspace::findOrFail($wid);
        $workspace->title = $request->title;
        if ($request->description != null) {
            $workspace->description = $request->description;
        }
        $workspace->save();

        $workspace->makeHidden('id');
        $workspace->id_str = (string) $workspace->id;

        return response()->json($workspace);
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
