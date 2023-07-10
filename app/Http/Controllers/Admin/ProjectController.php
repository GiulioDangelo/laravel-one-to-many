<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public $validation = ([
        'title'         => 'required',
        'url_image'     => 'required',
        'content'       => 'required',
    ]);

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $projects = Project::paginate(5);

       return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validation);

        $data = $request->all();

        $newproject = new Project();
        $newproject->title = $data['title'];
        $newproject->type_id = $data['type_id'];
        $newproject->url_image = $data['url_image'];
        $newproject->content = $data['content'];
        $newproject->save();

        return to_route('admin.projects.show', ['project' => $newproject]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate($this->validation);

        $data = $request->all();
        
        $project->title = $data['title'];
        $project->url_image = $data['url_image'];
        $project->content = $data['content'];
        $project->update();

        return to_route('admin.projects.show', ['project' => $project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('delete_success', $project);
    }
}
