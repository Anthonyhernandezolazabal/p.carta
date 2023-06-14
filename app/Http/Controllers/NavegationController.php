<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Navegation;
use Illuminate\Support\Facades\Storage;

class NavegationController extends Controller
{
    public function addMenus(Request $request)
    {
        $data = request()->all();
        $tipo = $data["tipo"];
        $nombre = $data["nombre"];
        $estado = $data["estado"];
        $id = $data["id"];

        $dataCount = Navegation::where('tipo','=','menu')->get()->count();
        if($dataCount == 0){
            $rpta = Navegation::create([
                'tipo' => $tipo,
                'nombre' => $nombre,
                'estado' => $estado, //Inactivo automáticamente
            ]);
        }else{
            $rpta = Navegation::where('id', $id)->update(['nombre' => $nombre]);
        }

        return $rpta;
    }
    public function getListaMenus()
    {
        $data = Navegation::where('tipo','=','menu')->get();
        return $data;
    }
    public function getMostrarLogo(){
        $data = Navegation::where('tipo','=','logo')->get();
        return $data;
    }
    public function addLogo(Request $request)
    {
        $data = request()->all();


        $pathOld = $data["pathOld"];
        $validar_img = $request->file('path');
        $url = '';

        if(isset($validar_img)){
            $imagenes = $request->file('path')->store('public/Configuraciones');
            $url .= Storage::url($imagenes);
        }else{
            $url .= $pathOld;
        }

        $id = $data["id"];
        $nombre = $data["imgLogo"];
        $tipo = 'logo';
        $estado = 1; //activo

        $datajson = [];

        $jsonarray = array(
            "tipo" => $tipo,
            "nombres" => array
                    (
                        "path" => $url,
                        "filename" => $nombre,
                    )
        );

        array_push($datajson,$jsonarray);

        $dataCount = Navegation::where('tipo','=','logo')->get()->count();
        if($dataCount == 0){
            $rpta = Navegation::create([
                'tipo' => $tipo,
                'nombre' => json_encode($datajson),
                'estado' => $estado, //Inactivo automáticamente
            ]);
        }else{
            $rpta = Navegation::where('id', $id)->update(['nombre' => json_encode($datajson)]);
            // eliminar Imágen anterior
            $imgDeleted = str_replace('storage','public',$pathOld);
            Storage::delete($imgDeleted);
        }

        return $rpta;
    }
}
