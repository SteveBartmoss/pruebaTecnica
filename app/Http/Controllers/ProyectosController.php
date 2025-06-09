<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Proyectos;


class ProyectosController extends Controller
{
    
    public function createProject(Request $request){

        try{

            Proyectos::updateOrCreate([
                'id' => $request->id],[
                    'name' => $request->name,
                    'description' => $request->description,
                    'status' => $request->status,
                ]);

            return response()->json([
                'message' => 'Se creo el proyecto',
            ],200);

        }catch(\Throwable $th){

            return response->json([
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'message' => 'Error, consulta con soporte'
            ],500);
        }


    }

    public function updateProject(Request $request){

        try{

            $proyecto = Proyectos::findOrFail($request->id);

            $proyecto->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            return response()->json([
                'message' => 'Se actualizo el proyecto',
            ],200);

        }catch(\Throwable $th){

            return response->json([
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'message' => 'Error, consulta con soporte'
            ],500);
        }

    }

    public function getProject(Request $request){

        try{

            $projects = Proyectos::get();

            return response()->json([
                'info' => $projets,
            ],200);

        }catch(\Throwable $th){

            return response->json([
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'message' => 'Error, consulta con soporte'
            ],500);
        }

    }

    public function deleteProject(Request $request){
        
        try{

            $proyecto = Proyectos::findOrFail($request->id);

            $proyecto->delete();

            return response()->json([
                'message' => 'Proyecto eliminado',
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
