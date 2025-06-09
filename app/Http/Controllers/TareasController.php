<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Tareas;

class TareasController extends Controller
{
    public function createTask(Request $request){

        try{

            Tareas::updateOrCreate([
                'id' => $request->id,
            ],[
                'project_id' => $request->projectId,
                'title' => $request->title,
                'completed' => $request->completed,
                'due_date' => $request->dueDate,
            ]);

            return response()->json([
                'message' => 'Se creo la tarea',
            ],200);

        }catch(\Throwable $th){

            return response->json([
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'message' => 'Error, consulta con soporte'
            ],500);
        }

    }

    public function updateTask(Request $request){

        try{

            $tarea = Tareas::findOrFail($request->id);

            $tarea->update([
                'project_id' => $request->projectId,
                'title' => $request->title,
                'completed' => $request->completed,
                'due_date' => $request->dueDate,
            ]);

        }catch(\Throwable $th){

            return response->json([
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'message' => 'Error, consulta con soporte'
            ],500);
        }

    }

    public function getTask(Request $request){

        try{

            $tasks = Tareas::get();

            return response()->json([
                'info' => $tasks,
            ],200); 

        }catch(\Throwable $th){

            return response->json([
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'message' => 'Error, consulta con soporte'
            ],500);
        }

    }

    public function deleteTask(Request $request){

        try{

            $tarea = Tareas::findOrFail($request->id);

            $tarea->delete();

            return response()->json([
                'message' => 'Tarea eliminada'
            ],200);

        }catch(\Throwable $th){

            return response->json([
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'message' => 'Error, consulta con soporte'
            ],500);
        }

    }

    public function completeTask(Request $request){

        try{

            $tarea = Tareas::findOrFail($request->id);

            $tarea->update([
                'completed' => $request->completed,
            ]);

            return response->json([
                'message' => 'Se completo la tarea',
            ],200);

        }catch(\Throwable $th){

            return response->json([
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'message' => 'Error, consulta con soporte'
            ],500);
        }
    }
}
