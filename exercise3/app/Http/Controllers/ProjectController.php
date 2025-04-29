<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managedProjects = Auth::user()->projects()->with(['members', 'manager'])->get();
        $memberProjects = Auth::user()->memberProjects()->with(['members', 'manager'])->get();

        return view('projects.index', compact('managedProjects', 'memberProjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('projects.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'jobs_count' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id'
        ]);

        $project = new Project($validated);
        $project->manager_id = Auth::id();
        $project->save();

        if (!empty($validated['members'])) {
            $project->members()->attach($validated['members']);
        }

        return redirect()->route('projects.index')
            ->with('success', __('messages.project_created'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        $users = User::where('id', '!=', Auth::id())->get();
        $selectedMembers = $project->members->pluck('id')->toArray();

        return view('projects.edit', compact('project', 'users', 'selectedMembers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'jobs_count' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id'
        ]);

        $project->update($validated);

        // Sync members
        if (isset($validated['members'])) {
            $project->members()->sync($validated['members']);
        } else {
            $project->members()->detach();
        }

        return redirect()->route('projects.index')
            ->with('success', __('messages.project_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', __('messages.project_deleted'));
    }

    /**
     * Update the done jobs count for the project.
     */
    public function updateJobs(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'done_jobs' => 'required|integer|min:0|max:' . $project->jobs_count
        ]);

        $project->update($validated);

        return back()->with('success', __('messages.project_updated'));
    }
}
