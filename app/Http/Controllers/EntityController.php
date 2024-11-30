<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;  // Asegúrate de importar esta clase


class EntityController extends Controller
{


    public function index()
    {
        return view('welcome');
    }

    public function procesar(Request $request)
    {
        $pythonPath = env('PYTHON_PATH');
        $scriptPath = base_path('scripts/extract_entities.py');

        $url = $request->input('url');

        if (!file_exists($scriptPath)) {
            Log::error("Script de Python no encontrado en la ruta: " . $scriptPath);
            return response()->json(['error' => 'Script no encontrado.'], 500);
        }

        $env = array_merge(getenv(), [
            'PYTHONIOENCODING' => 'UTF-8',
            'PATH' => getenv('PATH') . ';' . dirname($pythonPath)
        ]);

        $process = new Process([$pythonPath, $scriptPath, $url], null, $env);
        $process->run();

        if (!$process->isSuccessful()) {
            Log::error('Error en el script de Python: ' . $process->getErrorOutput());
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();
        Log::info('Salida del script de Python: ' . $output);
        return response()->json(json_decode($output));
    }
}
