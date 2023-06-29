<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Menu;

class MenuController extends Controller
{
    public function getListarMenus($tipo)
    {
        $data = Menu::where('tipo','=',$tipo)->get();
        return response()->json($data);
    }
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

    public function setRegistrarImagenMenu02(Request $request)
    {
        $data = request()->all();
        $iTitle             = $data["iTitle"];
        $iDescription       = $data["iDescription"];
        $urlImgOld          = $data["urlImgOld"];
        $id                 = $data["id"];
        $tipo               = 'Menu02';

        $dataCount = Menu::where('tipo','=',$tipo)->get(); //Hay registros con estado 1
        if($dataCount->count() == 0){
            //Registrar
            $imagen             = $request->file('iImagen')->store('public/Menus');
            $url                = Storage::url($imagen);

            $arrData =  array(
                            'tipo'=> $tipo,
                            'datajson' => array(
                                    'img_title_desc'=>
                                    array(
                                            'img'=> $url,
                                            'title'=> $iTitle,
                                            'desc'=> $iDescription
                                    ),
                                    'carta'=> array()
                            )

                        );

            $rpta = Menu::create([
                'tipo' => $tipo,
                'estructura' => json_encode($arrData),
                'estado' => 1, //Inactivo automáticamente
            ]);

        }else{
            // //Editar
            $valImg = $request->file('iImagen');
            if(!empty($valImg)){
                $url = Storage::url($request->file('iImagen')->store('public/Menus'));
                Storage::delete(str_replace('storage','public',$urlImgOld));
            }else{
                $url = $urlImgOld;
            }
            $arrData =  array(
                'tipo'=> $tipo,
                'datajson' => array(
                        'img_title_desc'=>
                        array(
                                'img'=> $url,
                                'title'=> $iTitle,
                                'desc'=> $iDescription
                        ),
                        'carta'=> json_decode($dataCount[0]["estructura"])->datajson->carta
                )
            );

            $rpta = Menu::where('id', $id)->update(['estructura' => json_encode($arrData)]);
        }
        return $rpta;
    }

    public function setRegistrarSectionMenu02(Request $request)
    {
        $data      = request()->all();
        $carta     = json_decode($data["carta"])->carta;
        $est       = $data["estado"];
        $idCar     = $data["idCartaEdit"];
        $tipo      = 'Menu02';

        $dataCount = Menu::where('tipo','=',$tipo)->get(); //Hay registros con estado 1e

        if($est == "Add"){
            if($dataCount->count() == 0){
                //Registra
                $arrData =  array(
                    'tipo'=> $tipo,
                    'datajson' => array(
                            'img_title_desc'=>array(),
                            'carta'=> $carta
                    )
                );
                $rpta = Menu::create([
                    'tipo' => $tipo,
                    'estructura' => json_encode($arrData),
                    'estado' => 1, //Inactivo automáticamente
                ]);

            }else{
                //Editar
                $mydata = json_decode($dataCount[0]["estructura"])->datajson->carta;  //Viene de la BD
                array_push($mydata,$carta[0]);
                $arrData =  array(
                    'tipo'=> $tipo,
                    'datajson' => array(
                            'img_title_desc'=>json_decode($dataCount[0]["estructura"])->datajson->img_title_desc,
                            'carta'=> $mydata

                    )
                );
                $rpta = Menu::where('tipo', $tipo)->update(['estructura' => json_encode($arrData)]);
            }
        }

        if($est == "edit"){
            $rpta = json_decode($dataCount[0]["estructura"])->datajson->carta;
            $rpta[$idCar]=$carta[0];

            $arrData =  array(
                'tipo'=> $tipo,
                'datajson' => array(
                        'img_title_desc'=>json_decode($dataCount[0]["estructura"])->datajson->img_title_desc,
                        'carta'=> array_values($rpta)
                )
            );
            $rpta = Menu::where('tipo', $tipo)->update(['estructura' => json_encode($arrData)]);
        }


        return $rpta;
    }

    public function getEditarEliminarCarta($id,$e)
    {

        $tipo = "Menu02";
        $data = Menu::where('tipo','=',$tipo)->first();
        if($e == "edit")
        {
            $rpta = json_encode(json_decode($data["estructura"])->datajson->carta[$id]);
        }
        if($e == "deleted")
        {
            $rpta = json_decode($data["estructura"])->datajson->carta;
            unset($rpta[$id]);

            $arrData =  array(
                'tipo'=> $tipo,
                'datajson' => array(
                        'img_title_desc'=>json_decode($data["estructura"])->datajson->img_title_desc,
                        'carta'=> array_values($rpta)
                )
            );

            $rpta = Menu::where('tipo', $tipo)->update(['estructura' => json_encode($arrData)]);
        }

        return $rpta;
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
