<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Mostrar la lista de proyectos
    public function index()
    {
        // Verificar el rol del usuario autenticado
        if (auth()->user()->role === 'student') {
            return view('layouts.student'); // Cargar la vista de estudiantes
        }

        // Si es administrador, cargar los proyectos
        $projects = Project::with('user')->get();
        return view('projects.index', compact('projects'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('projects.create');
    }

    // Guardar un nuevo proyecto
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        // Verificar si existe al menos un usuario en la base de datos
        $defaultUser = User::first();
        if (!$defaultUser) {
            return redirect()
                ->route('projects.index')
                ->with('error', 'No default user found. Please create a user first.');
        }

        // Crear el proyecto
        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'user_id' => $defaultUser->id, // Usuario predeterminado
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

    // Mostrar un proyecto específico
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    // Mostrar el formulario de edición
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // Actualizar un proyecto
    public function update(Request $request, Project $project)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        // Actualizar el proyecto
        $project->update($request->only(['name', 'description', 'deadline']));

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

    // Eliminar un proyecto
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}
