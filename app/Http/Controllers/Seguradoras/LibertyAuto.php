<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 07/06/2018
 * Time: 13:01
 */

namespace App\Http\Controllers\Seguradoras;


class LibertyAuto
{
//    public function auto_simples($k)
//    {
//        $data = [];
//        $data['nome_segurado'] = pq($k)->find("#pf1 div:eq(3)")->text();
//        $data['endereco'] = pq($k)->find("#pf1 div:eq(5)")->text();
//        $data['bairro_cep_email'] = pq($k)->find("#pf1 div:eq(7)")->text();
//        $data['cidade_telefone_uf'] = pq($k)->find("#pf1 div:eq(9)")->text();
//
//        //dados da apolice
//
//        $data['apolice_numero'] = pq($k)->find("#pf1 div:eq(12)")->text();
//        $data['premio'] = pq($k)->find("#pf1 div:eq(17)")->text();
//
//        //
//
//        $data['chassi'] = pq($k)->find("#pf2 div:eq(2)")->text();
//        $data['utilizacao'] = pq($k)->find("#pf2 div:eq(4)")->text();
//        $data['gravame'] = pq($k)->find("#pf2 div:eq(6)")->text();
//        $data['classe_bonus'] = pq($k)->find("#pf2 div:eq(8)")->text();
//
//        $data['cobertura'][0] = pq($k)->find("#pf2 div:eq(11)")->text();
//        $data['cobertura'][1] = pq($k)->find("#pf2 div:eq(12)")->text();
//        $data['cobertura'][2] = pq($k)->find("#pf2 div:eq(13)")->text();
//        $data['cobertura'][3] = pq($k)->find("#pf2 div:eq(14)")->text();
//        $data['cobertura'][4] = pq($k)->find("#pf2 div:eq(15)")->text();
//        $data['cobertura'][5] = pq($k)->find("#pf2 div:eq(16)")->text();
//        $data['cobertura'][6] = pq($k)->find("#pf2 div:eq(17)")->text();
//        $data['cobertura'][7] = pq($k)->find("#pf2 div:eq(18)")->text();
//        $data['cobertura'][8] = pq($k)->find("#pf2 div:eq(19)")->text();
//
//        $data['info_complementar'][0] = [
//            'liberty_vip' => pq($k)->find("#pf2 div:eq(21)")->text() .
//                ' ' . pq($k)->find("#pf2 div:eq(22)")->text() .
//                ' ' . pq($k)->find("#pf2 div:eq(23)")->text() .
//                ' ' . pq($k)->find("#pf2 div:eq(24)")->text(),
//
//            'liberty_assystencia' => pq($k)->find("#pf2 div:eq(25)")->text(),
//            'carro_reserva' => pq($k)->find("#pf2 div:eq(26)")->text() . ' ' . pq($k)->find("#pf2 div:eq(26)")->text(),
//        ];
//
//
//        $data['coberturas_contratadas'][0] = pq($k)->find("#pf2 div:eq(30)")->text();
//        $data['coberturas_contratadas'][1] = pq($k)->find("#pf2 div:eq(31)")->text();
//        $data['coberturas_contratadas'][2] = pq($k)->find("#pf2 div:eq(32)")->text();
//        $data['coberturas_contratadas'][3] = pq($k)->find("#pf2 div:eq(33)")->text();
//        $data['coberturas_contratadas'][4] = pq($k)->find("#pf2 div:eq(34)")->text();
//        $data['coberturas_contratadas'][5] = pq($k)->find("#pf2 div:eq(35)")->text();
//        $data['coberturas_contratadas'][6] = pq($k)->find("#pf2 div:eq(36)")->text();
//
//        $data['condutor_nome'] = pq($k)->find("#pf2 div:eq(39)")->text();
//        $data['condutor_cpf'] = pq($k)->find("#pf2 div:eq(41)")->text();
//        $data['qtd_veiculo_residencia'] = pq($k)->find("#pf2 div:eq(43)")->text();
//        $data['condutor_18_24'] = pq($k)->find("#pf2 div:eq(45)")->text();
//        $data['pernoite'] = pq($k)->find("#pf2 div:eq(48)")->text();
//
//
//        //dados do proprietario
//        $data['nome_proprietario'] = pq($k)->find("#pf3 div:eq(3)")->text();
//        $data['nascimento_proprietario'] = pq($k)->find("#pf3 div:eq(5)")->text();
//        $data['observacoes'] = pq($k)->find("#pf3 div:eq(7)")->text() . ' ' . pq($k)->find("#pf3 div:eq(8)")->text();
//
//        dd($data);
//    }

    //com a porra da barra na ultima pagina
    public function auto_simples($k)
    {
        $data = [];
        $data['nome_segurado'] = pq($k)->find("#pf1 div:eq(3)")->text();
        $data['endereco'] = pq($k)->find("#pf1 div:eq(5)")->text();
        $data['bairro_cep_email'] = pq($k)->find("#pf1 div:eq(7)")->text();
        $data['cidade_telefone_uf'] = pq($k)->find("#pf1 div:eq(9)")->text();

        //dados da apolice

        $data['apolice_numero'] = pq($k)->find("#pf1 div:eq(12)")->text();
        $data['premio'] = pq($k)->find("#pf1 div:eq(17)")->text();

        //

        $data['fipe_marca_tipo'] = pq($k)->find("#pf2 div:eq(3)")->text();
        $data['chassi'] = pq($k)->find("#pf2 div:eq(5)")->text();
        $data['utilizacao'] = pq($k)->find("#pf2 div:eq(7)")->text();
        $data['gravame'] = pq($k)->find("#pf2 div:eq(9)")->text();

        $data['classe_bonus'] = pq($k)->find("#pf2 div:eq(11)")->text();

        $data['cobertura'][0] = pq($k)->find("#pf2 div:eq(14)")->text();
        $data['cobertura'][1] = pq($k)->find("#pf2 div:eq(15)")->text();
        $data['cobertura'][2] = pq($k)->find("#pf2 div:eq(16)")->text();
        $data['cobertura'][3] = pq($k)->find("#pf2 div:eq(17)")->text();
        $data['cobertura'][4] = pq($k)->find("#pf2 div:eq(18)")->text();
        $data['cobertura'][5] = pq($k)->find("#pf2 div:eq(19)")->text();
        $data['cobertura'][6] = pq($k)->find("#pf2 div:eq(20)")->text();
        $data['cobertura'][7] = pq($k)->find("#pf2 div:eq(21)")->text();
        $data['cobertura'][8] = pq($k)->find("#pf2 div:eq(22)")->text();
        $data['cobertura'][9] = pq($k)->find("#pf2 div:eq(23)")->text();

        $data['info_complementar'][0] = [
            'liberty_vip' => pq($k)->find("#pf2 div:eq(21)")->text() .
                ' ' . pq($k)->find("#pf2 div:eq(22)")->text() .
                ' ' . pq($k)->find("#pf2 div:eq(23)")->text() .
                ' ' . pq($k)->find("#pf2 div:eq(24)")->text(),

            'liberty_assystencia' => pq($k)->find("#pf2 div:eq(25)")->text(),
            'carro_reserva' => pq($k)->find("#pf2 div:eq(26)")->text() . ' ' . pq($k)->find("#pf2 div:eq(26)")->text(),
        ];


        $data['coberturas_contratadas'][0] = pq($k)->find("#pf2 div:eq(30)")->text();
        $data['coberturas_contratadas'][1] = pq($k)->find("#pf2 div:eq(31)")->text();
        $data['coberturas_contratadas'][2] = pq($k)->find("#pf2 div:eq(32)")->text();
        $data['coberturas_contratadas'][3] = pq($k)->find("#pf2 div:eq(33)")->text();
        $data['coberturas_contratadas'][4] = pq($k)->find("#pf2 div:eq(34)")->text();
        $data['coberturas_contratadas'][5] = pq($k)->find("#pf2 div:eq(35)")->text();
        $data['coberturas_contratadas'][6] = pq($k)->find("#pf2 div:eq(36)")->text();

        $data['condutor_nome'] = pq($k)->find("#pf2 div:eq(39)")->text();
        $data['condutor_cpf'] = pq($k)->find("#pf2 div:eq(41)")->text();
        $data['qtd_veiculo_residencia'] = pq($k)->find("#pf2 div:eq(43)")->text();
        $data['condutor_18_24'] = pq($k)->find("#pf2 div:eq(45)")->text();
        $data['pernoite'] = pq($k)->find("#pf2 div:eq(48)")->text();


        //dados do proprietario
        $data['nome_proprietario'] = pq($k)->find("#pf3 div:eq(3)")->text();
        $data['nascimento_proprietario'] = pq($k)->find("#pf3 div:eq(5)")->text();
        $data['observacoes'] = pq($k)->find("#pf3 div:eq(7)")->text() . ' ' . pq($k)->find("#pf3 div:eq(8)")->text();

        return response()->json($data, 300);
    }


    public function by_title($k)
    {
        $data = [];

        //tenta pegar todos os titulos da pagina
        //$data['nome_segurado'] = pq($k)->find("#pf1 div:eq(3)")->text();

        $dados_segurado = pq($k)->find("#pf1 div:contains('DADOS DO(A) SEGURADO(A)'):gt(0)");


        $dados_apolice = pq($k)->find("#pf1 div:contains('DADOS DA APÓLICE'):gt(0)");
        $demonstrativo_premio = pq($k)->find("#pf1 div:contains('DEMONSTRATIVO DE PRÊMIO'):gt(0)");
        $forma_pagamento = pq($k)->find("#pf1 div:contains('FORMA DE PAGAMENTO'):gt(0)");
        $dados_cobertura = pq($k)->find("#pf2 div:contains('DADOS DO SEGURO/COBERTURA'):gt(0)");
        $informacoes_complementares = pq($k)->find("#pf2 div:contains('INFORMAÇÕES COMPLEMENTARES'):gt(0)");
        $ramo_cobertura = pq($k)->find("#pf2 div:contains('Ramo da cobertura contratada'):gt(0)");
        $dados_perfil = pq($k)->find("#pf2 div:contains('DADOS DO PERFIL'):gt(0)");

        $garagem = pq($k)->find("#pf3 div:contains('GARAGEM'):gt(0)");
        $dados_proprietario = pq($k)->find("#pf3 div:contains('DADOS DO PROPRIETÁRIO'):gt(0)");
        $observacoes = pq($k)->find("#pf3 div:contains('OBSERVAÇÕES'):gt(0)");
        $corretor = pq($k)->find("#pf3 div:contains('DADOS DO CORRETOR'):gt(0)");

//        $test = $k->find("#pf1 div:contains('DADOS DO(A) SEGURADO(A)'):gt(0)");
//        dd($test->index(pq($k->find("#pf1 div:contains('DADOS DO(A) SEGURADO(A)')"))));

        dd(
            $dados_apolice->text(),
            $dados_apolice->text(),
            $demonstrativo_premio->text(),
            $forma_pagamento->text(),
            $dados_cobertura->text(),
            $informacoes_complementares->text(),
            $ramo_cobertura->text(),
            $dados_perfil->text(),
            $garagem->text(),

            $dados_proprietario->text(),
            $observacoes->text(),
            $corretor->text()
            );
    }

}