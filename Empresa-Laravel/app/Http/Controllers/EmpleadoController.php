<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['empleados']=Empleado::all();

        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    
    {

        //Validaciones
        $campos = array(
            'nombre' => 'required|string|max:100',
            'app' => 'required|string|max:100',
            'apm' => 'required|string|max:100',
            'correo' => 'required|email',
            'foto' => 'required|max:100000|mimes:jpeg,png,jpg'
        );
        
        $mensaje = array(
            'required' => 'El :attribute es requerido',
            'foto.required' => 'La foto es requerida'
        );
        
        $this->validate($request, $campos, $mensaje);
        




        $datosEmpleado = request()->except('_token');

        if($request->hasFile('foto')){
            $datosEmpleado['foto']=$request->file('foto')->store('uplodads', 'public');
        }

        Empleado::insert($datosEmpleado);

        return redirect('empleado')->with('success', 'Creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado=Empleado::findOrFail($id);


        return view('empleado.edit', compact('empleado'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //Validaciones
        $campos = array(
            'nombre' => 'required|string|max:100',
            'app' => 'required|string|max:100',
            'apm' => 'required|string|max:100',
            'correo' => 'required|email',
            
        );
        
        $mensaje = array(
            'required' => 'El :attribute es requerido',
            
        );

        if($request->hasFile('foto')){
           $campos=[ 'foto' => 'required|max:100000|mimes:jpeg,png,jpg'];
           $mensaje = array(
            'foto.required' => 'La foto es requerida'
        );

        }
        
        $this->validate($request, $campos, $mensaje);

        $datosEmpleado = request()->except(['_token', '_method']);
        //update foto
        if($request->hasFile('foto')){
            $empleado=Empleado::findOrFail($id);

            Storage::delete('public/'.$empleado->foto);

            $datosEmpleado['foto']=$request->file('foto')->store('uplodads', 'public');
        }

        //
        Empleado::where('id','=',$id)->update($datosEmpleado);
        //buscar y retornar
        $empleado=Empleado::findOrFail($id);
       //return view('empleado.edit', compact('empleado')); 
        return redirect('empleado')->with('success', 'Editado correctamente');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado=Empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->foto)){
            Empleado::destroy($id);
        }
        
        return redirect('empleado')->with('success', 'Eliminado correctamente');
    }
}
