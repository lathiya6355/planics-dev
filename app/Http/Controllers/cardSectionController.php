<?php

namespace App\Http\Controllers;

use App\Models\cardSection;
use App\services\cardSectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cardSectionController extends Controller
{
    private cardSectionService $cardSectionService;

    public function __construct(cardSectionService $cardSectionService)
    {
        $this->cardSectionService = $cardSectionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('show')) {
            $cardsections = cardSection::with('cards')->get();
            // $cardsections = $this->cardSectionService->getAll();
            return $this->sendResponse($cardsections, 'Card Section Created Successfully...!', 201);
        } else {
            return $this->sendError('Employee can not accesible...!', 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('create')) {
            $result = $request->all();
            $card = $this->cardSectionService->create($result);
            return $this->sendResponse($card, 'Card Section Created Successfully...!', 201);
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
            $result = $this->cardSectionService->getById($id);
            if (is_null($result)) {
                return $this->sendError('section not found');
            } else {
                return $this->sendResponse($result, 'Card Section retrieved successfully...!', 200);
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
        if (Auth::user()->can('update')) {
            $result = $request->all();
            $card = $this->cardSectionService->update($id, $result);
            return $this->sendResponse($card, 'Card section updated successfully...!');
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
            $card = $this->cardSectionService->getById($id);
            $card->delete();
            return $this->sendResponse([], 'Card Deleted Successfully');
        } else {
            return $this->sendError('Employee can not Delete Articles...!', 401);
        }
    }
}
