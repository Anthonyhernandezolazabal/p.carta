<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SliderController extends Controller
{
    public function getListarSlider()
    {
        $data = Slider::all();
        return response()->json($data);
    }
    public function setRegistrarSlider(Request $request)
    {
        $data = request()->all();
        $cTitulo = $data["cTitulo"];
        $cDescription = $data["cDescription"];
        $oNameImg = $data["oNameImg"];
        $imagenes = $request->file('oFotografia')->store('public/Slider');
        $url = Storage::url($imagenes);
        $rpta = Slider::create([
            'titulo' => $cTitulo,
            'descripcion' => $cDescription,
            'filename' => $url,
            'imgname' => $oNameImg,
            'estado' => 0, //Inactivo automáticamente
        ]);

        return $rpta;

    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function showEditSlider($id)
    {
        $data = Slider::where('id','=',$id)->get();
        return response()->json($data);
    }
    public function editSlider(Request $request)
    {
        $data = request()->all();
        $id = $data["id"];
        $cTitulo = $data["cTitulo"];
        $cDescription = $data["cDescription"];
        $oNameImg = $data["oNameImg"];
        $imgOld = $data["imgOld"];
        $imagenes = $request->file('oFotografia');
        if(!empty($imagenes))
        {
            $imagenesNew = $request->file('oFotografia')->store('public/Slider');
            $url = Storage::url($imagenesNew);
            Slider::where('id', $id)->update(
                [
                    'titulo' => $cTitulo,
                    'descripcion' => $cDescription,
                    'filename' => $url,
                    'imgname' => $oNameImg,
                ]
            );
            // eliminar Imágen anterior
            $imgDeleted = str_replace('storage','public',$imgOld);
            Storage::delete($imgDeleted);
        }else{
            Slider::where('id', $id)->update(
                [
                    'titulo' => $cTitulo,
                    'descripcion' => $cDescription,
                ]
            );
        }

    }
    public function cambiarEstadoView(Request $request)
    {
        $datas = request()->all();
        $estado = $datas["estado"];
        $id = $datas["id"];
        $respuesta = "";
        try {
            $dataCount = Slider::where('estado','=',1)->get()->count(); //Hay registros con estado 1
            if($dataCount != 0){
                $dataObtenida = Slider::where('estado','=',1)->get();
                foreach ($dataObtenida  as $key =>  $item) { //Valida si hay mas de 1
                    Slider::where('id', $item->id)->update(['estado' => 0]); //Actualizo con estado 0
                }
                Slider::where('id', $id)->update(['estado' => $estado]); //Actualizo con estado 1
                $respuesta .= "Actualizado";
            }else{
                Slider::where('id', $id)->update(['estado' => $estado]); //Actualizo con estado 1
                $respuesta .= "Actualizado";
            }
            return $respuesta;
          } catch (\Exception $e) {
              return $e->getMessage();
          }

    }
    public function delSlider($id)
    {
        $post = Slider::find($id);
        $post->delete();
    }
    public function delImgSlider(Request $request, $id)
    {
        $data = request()->all();
        $rutaimg = $data['img'];
        // eliminar imágen
        $borrar_url = str_replace('storage','public',$rutaimg);
        Storage::delete($borrar_url);
    }

}
