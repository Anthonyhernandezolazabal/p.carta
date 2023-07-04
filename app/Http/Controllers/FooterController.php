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
}
