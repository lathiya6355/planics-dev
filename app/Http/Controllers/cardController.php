<?php

namespace App\Http\Controllers;

use App\Http\Requests\cardRequest;
use App\Models\card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\services\cardService;
use Illuminate\Support\Facades\Storage;

class cardController extends Controller
{
    private cardService $cardService;

    public function __construct(cardService $cardService)
    {
        $this->cardService = $cardService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('show')) {
            $cards = $this->cardService->getAll();
            foreach ($cards as  $card) {
                $card['section'] = $card->section;
                $card['action_link'] = url('/' . $card['action_link']);
                $card['image'] = url('/' . $card['image']);
            }
            return $this->sendResponse($cards, 'Section Created Successfully...!', 201);
        } else {
            return $this->sendError('Employee can not accesible...!', 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(cardRequest $request)
    {
        if (Auth::user()->can('create')) {
            $result = $request->all();
            if ($request->hasFile('image')) {
                $filename = $request->image->store('images', ['disk' => 'public']);
                $result['image'] = $filename;
            }
            $card = $this->cardService->create($result);
            $card['section'] = $card->section;
            $card['action_link'] = $this->cardService->link($result);
            $card['image'] = asset('storage/' . $result['image']);
            return $this->sendResponse($card, 'Card Created Successfully...!', 201);
        } else {
            return $this->sendError('Employee can not accesible...!', 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->can('show')) {
            $result = $this->cardService->getById($id);
            $result['section'] = $result->section;
            if (is_null($result)) {
                return $this->sendError('section not found');
            } else {
                $result['image'] = asset('storage/' . $result['image']);
                $result['card_action_link'] = $this->cardService->link($result);
                return $this->sendResponse($result, 'section retrieved successfully...!', 200);
            }
        } else {
            return $this->sendError('Employee can not accesible...!', 401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all);
        if (Auth::user()->can('update')) {
            $result = $request->all();
            if ($request->hasFile('image')) {
            $card = $this->cardService->getById($id);
            if (Storage::disk('public')->exists($request->image)) {
                Storage::disk('public')->delete($request->image);
            }
            $fileName = $request->image->store('images', ['disk' => 'public']);
            $result['image'] = $fileName;
            }
            $card = $this->cardService->update($id, $result);
            return $this->sendResponse($card, 'Card updated successfully...!');
        } else {
            return $this->sendError('Employee can not accesible...!', 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->can('delete')) {
            $card = $this->cardService->getById($id);
            $card->delete();
            if (Storage::disk('public')->exists($card->image)) {
                Storage::disk('public')->delete($card->image);
            }
            return $this->sendResponse([], 'Card Deleted Successfully');
        } else {
            return $this->sendError('Employee can not Delete Articles...!', 401);
        }
    }
}
