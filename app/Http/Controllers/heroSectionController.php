<?php

namespace App\Http\Controllers;

use App\Http\Requests\herosectionRequest;
use App\Http\Requests\herosectionUpdateRequest;
use App\Http\Resources\heroResource;
use App\Models\herosection;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\services\heroService;
use Illuminate\Http\Response;

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
        if (Auth::user()->can('show all articles')) {
            $heros = $this->heroService->getAll();
            return $this->sendResponse(heroResource::collection($heros), 'section found');
        } else {
            return $this->sendError('Employee can not accesible this route');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(herosectionRequest $request)
    {
        if (Auth::user()->can('create articles')) {
            $hero = $request->validated();
            if ($request->hasFile('image')) {
                $hero['image'] = $request->image->store('images', ['disk' => 'public']);
            }
            $hero = herosection::create($hero);
            $hero['image'] = asset('storage/' . $hero['image']);
            return $this->sendResponse($hero, 'Section Created Successfully',200);
        } else {
            return $this->sendError('Employee can not accesible...!',403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->can('show articles')) {
            $hero = $this->heroService->getById($id);
            if (is_null($hero)) {
                return $this->sendError('section not found');
            } else {
                return $this->sendResponse(new heroResource($hero), 'section retrieved successfully', Response::HTTP_FOUND);
            }
        } else {
            return $this->sendError('Employee can not accesible...!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(herosectionUpdateRequest $request, $id)
    {
        if (Auth::user()->can('edit articles')) {
            // $result = $request->all();
            // $hero = $this->heroService->getById($id);
            $hero = herosection::where('id', $id)->update($request->validated());
            if ($hero == 0) {
                return $this->sendError('section not found');
            } else {
                if (Storage::disk('public')->exists($request->image)) {
                    Storage::disk('public')->delete($request->image);
                }
                $hero['image'] = $request->image->store('images', ['disk' => 'public']);
                return $this->sendResponse($hero, 'section found');
            }
        } else {
            return $this->sendError('Employee can not accesible...!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if (Auth::user()->can('delete articles')) {
            $hero = $this->heroService->getById($id);
            // dd($hero);
            // $hero = herosection::find($id);
            // dd($hero);
            if (is_null($hero)) {
                return $this->sendError('section not found');
            } else {
                $hero->delete();
                if (Storage::disk('public')->exists($hero->image)) {
                    Storage::disk('public')->delete($hero->image);
                }
                return $this->sendResponse([], 'Section Deleted Successfully');
            }
        } else {
            return $this->sendError('Employee can not accesible...!');
        }
    }
}
