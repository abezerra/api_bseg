<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Seguradoras\LibertyAuto;
use App\Http\Controllers\Seguradoras\SulAmericaAuto;
use Illuminate\Http\Request;

class PdfParser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $data = $request->all();
        // 1º - receber o arquivo PDF e salvar em algum buraco
        $file_named = md5(time() . rand(0, 666));
        $renamed_file = $file_named . '.' . request()->policy->getClientOriginalExtension();
        request()->policy->move(public_path('policies_pdf'), $renamed_file);

        $filename = public_path('policies_pdf/') . $renamed_file;

        //2º - parsear os PDF pra HTML
        $page_start = $data['page_start'];
        $page_end = $data['page_end'];

        $command = 'pdf2htmlEX --embed cfijo' . ' -f ' . $page_start . ' -l ' . $page_end . ' ' . $filename . ' --dest-dir policies_html';
        shell_exec($command);

        //3º - Buscar as paradas no arquivo html
        $url = 'http://127.0.0.1:8000/' . 'policies_html/' . $file_named . '.html';
        return response()->json($url, 200);
        //  return [
        //      'url' => $url
        //  ];
        #\phpQuery::newDocumentFileHTML(public_path('policies_html/' . $file_named . '.html'));

//        $bradesco_auto = new BradescoAutoResidencial();
//        $sulamerica_auto = new SulAmericaAuto();
//        $liberty_auto = new LibertyAuto();
//
//
//        switch ($data['insurer_id']):
//
//            case 1:
//                $bradesco_auto->auto_residential($k);
//            break;
//
//            case 2:
//                $sulamerica_auto->auto_simples($k);
//            break;
//
//            case 3:
//                #return
//                    $liberty_auto->by_title($k);
//            break;
//
//            default;
//
//        endswitch;




    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
//    public function store()
//    {
//        $file = public_path('policies_html/473d6507d931b9f647128951ad84e985.html');
//        $pk = \phpQuery::newDocumentFileHTML($file);
//        dd($file);
//
//        $titleElement = pq('.y12:first');
//        $title = $titleElement->html();
//        echo '<h2>Seguradora:</h2>';
//        echo  $title;
//
//        $titleElement = pq('.y42:first');
//        $title = $titleElement->html();
//        echo '<h2>Apolice:</h2>';
//        echo  $title;
//
//        $titleElement = pq('.y49:last ');
//        $title = $titleElement->html();
//        echo '<h2>Marca / Modelo:</h2>';
//        echo  $title;
//
//        $titleElement = pq('.y9a');
//        $title = $titleElement->html();
//        echo '<h2>Combustivel:</h2>';
//        echo '<p>' . htmlentities( $title) . '</p>';
//
//        $titleElement = pq('.y8c:first ');
//        $title = $titleElement->html();
//        echo '<h2>Segurado:</h2>';
//        echo  $title;
//        //echo '<p>' . htmlentities( $title) . '</p>';
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
