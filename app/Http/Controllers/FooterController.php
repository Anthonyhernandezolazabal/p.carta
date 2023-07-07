<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function setRegistrarFooter(Request $request)
    {
        //
        $data       = request()->all();
        $footer      = json_decode($data["footer"])->footer;
        $tipo       = "Footer";
        $est        = $data["estado"];
        $idFooter     = $data["idFooterEdit"];
        $dataCount  = Footer::where('tipo','=',$tipo)->get(); //Hay registros con estado 1e
        if($est == "Add"){
            if($dataCount->count() == 0){
                //Registra
                $arrData =  array(
                    'tipo'=> $tipo,
                    'datajson' => array(
                            'footer'=> $footer
                    )
                );
                $rpta = Footer::create([
                    'tipo' => $tipo,
                    'estructura' => json_encode($arrData),
                    'estado' => 1, //Inactivo automáticamente
                ]);

            }else{
                //Editar
                $mydata = json_decode($dataCount[0]["estructura"])->datajson->footer;  //Viene de la BD
                array_push($mydata,$footer[0]);
                $arrData =  array(
                    'tipo'=> $tipo,
                    'datajson' => array(
                            'footer'=> $mydata

                    )
                );
                $rpta = Footer::where('tipo', $tipo)->update(['estructura' => json_encode($arrData)]);

            }

        }

        if($est == "edit"){
            $rpta = json_decode($dataCount[0]["estructura"])->datajson->footer;
            $rpta[$idFooter]=$footer[0];

            $arrData =  array(
                'tipo'=> $tipo,
                'datajson' => array(
                        'footer'=> array_values($rpta)
                )
            );
            $rpta = Footer::where('tipo', $tipo)->update(['estructura' => json_encode($arrData)]);
        }
        return $arrData;

    }
    public function getListarFooter($tipo)
    {
        $data = Footer::where('tipo','=',$tipo)->get();
        return response()->json($data);
    }
    public function getEditarEliminarFooter($id,$e)
    {

        $tipo = "Footer";
        $data = Footer::where('tipo','=',$tipo)->first();
        if($e == "edit")
        {
            $rpta = json_encode(json_decode($data["estructura"])->datajson->footer[$id]);
        }
        if($e == "deleted")
        {
            $rpta = json_decode($data["estructura"])->datajson->footer;
            unset($rpta[$id]);

            $arrData =  array(
                'tipo'=> $tipo,
                'datajson' => array(
                        'footer'=> array_values($rpta)
                )
            );

            $rpta = Footer::where('tipo', $tipo)->update(['estructura' => json_encode($arrData)]);
        }
        return $rpta;
    }

    public function setRegistrarFooter02(Request $request){
        $data       = request()->all();
        $icon        = $data["icon"];
        $url        = $data["url"];
        $copy        = $data["copy"];
        $tipo = "Footer02";
        $arr = [
            'icon'  => $icon,
            'url'   => $url,
        ];
        $arrData =  array(
            'tipo'=> $tipo,
            'copy'  => $copy,
            'datajson' => ($icon == null & $url == null) ? array() : array($arr)
        );

        $dataCountF02  = Footer::where('tipo','=',$tipo)->get(); //Hay registros con estado 1e

        if($dataCountF02->count() == 0){
            //Registra
            $rpta = Footer::create([
                'tipo' => $tipo,
                'estructura' => json_encode($arrData),
                'estado' => 1,
            ]);
        }else{
            //edit
            $mydata = json_decode($dataCountF02[0]->estructura,true)["datajson"];  //Viene de la BD
            ($icon == null & $url == null) ? $mydata : array_push($mydata,$arr);
            $arrData =  array(
                'tipo'=> $tipo,
                'copy'  => $copy,
                'datajson' => $mydata
            );
            $rpta = Footer::where('tipo', $tipo)->update(['estructura' => json_encode($arrData)]);
        }

        return $rpta;
    }
}
