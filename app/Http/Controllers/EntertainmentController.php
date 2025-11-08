<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Entertainment;
use App\Enums\EntertainmentStatus;
use App\Http\Requests\StoreEntertainmentRequest;
use App\Http\Requests\UpdateEntertainmentRequest;

class EntertainmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->query('search');

        $status = $request->query('status')
            ? EntertainmentStatus::tryFrom($request->query('status'))
            : null;

        $sortDirection = $request->query('sort', 'asc');

        $tag = $request->query('tag');

        $entertainments = Entertainment::query()
            ->search($searchTerm)
            ->filterByStatus($status)
            ->filterByTag($tag)
            ->sortByTitle($sortDirection)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('entertainments.index', [
            'entertainments' => $entertainments,
            'searchTerm' => $searchTerm,
            'status' => $status,
            'tag' => $tag,
            'countInTrash' => Entertainment::countInTrash(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entertainments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntertainmentRequest $request)
    {
        $data = $request->validated();

        $entertainment = Entertainment::create($data);

        $this->syncTags($entertainment, $data['tags'] ?? null);

        return to_route('entertainments.index')->with('success', "$entertainment->title created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Entertainment $entertainment)
    {
        return view('entertainments.show', ['entertainment' => $entertainment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entertainment $entertainment)
    {
        return view('entertainments.edit', ['entertainment' => $entertainment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntertainmentRequest $request, Entertainment $entertainment)
    {
        $data = $request->validated();

        $entertainment->update($data);

        $this->syncTags($entertainment, $data['tags'] ?? null);

        return to_route('entertainments.index')->with('success', "$entertainment->title updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entertainment $entertainment)
    {
        $entertainment->delete();

        return to_route('entertainments.index')->with('success', "$entertainment->title deleted successfully");
    }

    public function trash()
    {
        $trashed = Entertainment::onlyTrashed()->paginate(10);

        return view('entertainments.trash', ['trashed' => $trashed]);
    }

    public function restore(Entertainment $entertainment)
    {
        $entertainment->restore();

        return to_route('entertainments.trash')->with('success', "$entertainment->title restored successfully");
    }

    public function forceDelete(Entertainment $entertainment)
    {
        $title = $entertainment->title;
        $entertainment->forceDelete();

        return to_route('entertainments.trash')->with('success', "$title permanently deleted");
    }

    private function syncTags(Entertainment $entertainment, ?string $tagsInput): void
    {
        if (! $tagsInput) {
            $entertainment->tags()->detach();
            return;
        }

        $tagNames = collect(explode(',', $tagsInput))
            ->map(fn ($tag) => trim(strip_tags($tag)))
            ->filter() // remove empty strings
            ->unique();

        $tags = $tagNames->map(fn ($name) =>
            Tag::firstOrCreate(['name' => $name])
        );

        $entertainment->tags()->sync($tags->pluck('id')->toArray());
    }
}
