<?php

namespace App\Http\Controllers;

use App\Http\Requests\herosectionRequest;
use App\Http\Requests\herosectionUpdateRequest;
use App\Http\Resources\heroResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\services\heroService;

class heroSectionController extends Controller
{
    private heroService $heroService;

    public function __construct(heroService $heroService)
    {
        $this->heroService = $heroService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (Auth::user()->can('show all articles')) {
        $heros = $this->heroService->getAll();
        foreach ($heros as  $hero) {
            $hero['action_link'] = url('/' . $hero['action_link']);
        }
        $returnHTML = view('front-end.heroSection.heroDataTable')->with('heros', $heros)->render();
        return response()->json(['success' => true, 'html' => $returnHTML]);
        // } else {
        // return $this->sendError('Employee can not accesible...!', 401);
        // }
        // return $this->sendResponse($returnHTML, 'section found...!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(herosectionRequest $request)
    {
        // if (Auth::user()->can('create articles')) {
        $result = $request->validated();
        if ($request->hasFile('image')) {
            $filename = $request->image->store('images', ['disk' => 'public']);
            $result['image'] = $filename;
        }
        $hero = $this->heroService->create($result);
        $hero['action_link'] = $this->heroService->link($result);
        $hero['image'] = asset('storage/' . $result['image']);
        return $this->sendResponse($hero, 'Section Created Successfully...!', 201);
        // } else {
        // return $this->sendError('Employee can not accesible...!', 401);
        // }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->can('show articles')) {
            $result = $this->heroService->getById($id);
            if (is_null($result)) {
                return $this->sendError('section not found');
            } else {
                $returnHTML = view('front-end.heroSection.preview')->with('result', $result)->render();
                return response()->json(['success' => true, 'html' => $returnHTML]);
                // $result['action_link'] = $this->heroService->link($result);
                // return $this->sendResponse(new heroResource($result), 'section retrieved successfully...!', 200);
            }
        } else {
            return $this->sendError('Employee can not accesible...!', 401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(herosectionUpdateRequest $request, $id)
    {
        // if (Auth::user()->can('edit articles')) {
        $result = $request->all();
        if ($request->hasFile('image')) {
            $hero = $this->heroService->getById($id);
            if (Storage::disk('public')->exists($request->image)) {
                Storage::disk('public')->delete($request->image);
            }
            $fileName = $request->image->store('images', ['disk' => 'public']);
            $result['image'] = $fileName;
        }
        $hero = $this->heroService->update($id, $result);

        return $this->sendResponse($hero, 'section updated successfully...!');
        // } else {
        //     return $this->sendError('Employee can not accesible...!', 401);
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if (Auth::user()->can('delete articles')) {
            $hero = $this->heroService->getById($id);
            $hero->delete();
            if (Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }
            return $this->sendResponse([], 'Section Deleted Successfully');
        } else {
            return $this->sendError('Employee can not accesible...!', 401);
        }
    }
}
