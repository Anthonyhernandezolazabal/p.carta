<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setRegistrarMenu01(Request $request)
    {
        $data = request()->all();
        $cTitulo        = $data["cTitulo"];
        $cDescription   = $data["cDescription"];
        $oImgOld   = $data["oImgOld"];
        $id   = $data["id"];
        $tipo   = 'Menu01';

        if(empty($id)){
         //Registrar
            $imagen = $request->file('oFotografia')->store('public/Menus');
            $url    = Storage::url($imagen);
            $jsonarray = array(
                "tipo" => $tipo,
                "datajson" => array
                        (
                            'img'=> $url,
                            'titulo'=> $cTitulo,
                            'estructura'=> $cDescription
                        )
            );
            $rpta = Menu::create([
                'tipo' => $tipo,
                'estructura' => json_encode($jsonarray),
                'estado' => 1, //Inactivo automáticamente
            ]);
        }else{
            //Editar
            //¿Cambió de imágen?
            //Validar si cabió de imágen
            $valImg = $request->file('oFotografia');
            // $v = (!empty($valImg)) ? Storage::url($request->file('oFotografia')->store('public/Menus')) && Storage::delete(str_replace('storage','public',$oImgOld)) : $oImgOld;
            if(!empty($valImg)){
                $url = Storage::url($request->file('oFotografia')->store('public/Menus'));
                Storage::delete(str_replace('storage','public',$oImgOld));
            }else{
                $url = $oImgOld;
            }
            $jsonarray = array(
                "tipo" => $tipo,
                "datajson" => array
                        (
                            'img'=> $url,
                            'titulo'=> $cTitulo,
                            'estructura'=> $cDescription
                        )
            );
            $rpta = Menu::where('id', $id)->update(['estructura' => json_encode($jsonarray)]);
        }
        return $rpta;
    }

    public function getListarMenu01($tipo)
    {
        $data = Menu::where('tipo','=',$tipo)->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
