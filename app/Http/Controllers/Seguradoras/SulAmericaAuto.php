<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 07/06/2018
 * Time: 10:31
 */

namespace App\Http\Controllers\Seguradoras;


use App\Http\Controllers\Controller;

class SulAmericaAuto extends Controller
{
    public function auto_simples($k)
    {
        $data = [];
        $data['saida_consesionaria'] = pq($k)->find("#pf1 div:eq(3)")->text();
        $data['apolice_numero'] = pq($k)->find("#pf1 div:eq(9)")->text();
        $data['emissao'] = pq($k)->find("#pf1 div:eq(10)")->text();
        $data['vigencia'] = pq($k)->find("#pf1 div:eq(11)")->text();
        $data['corretora'] = pq($k)->find("#pf1 div:eq(13)")->text();

        $data['segurado'] = pq($k)->find("#pf1 div:eq(17)")->text();
        $data['cpf'] = pq($k)->find("#pf1 div:eq(18)")->text();
        $data['endereco'] = pq($k)->find("#pf1 div:eq(19)")->text();

        $data['uf'] = pq($k)->find("#pf1 div:eq(21)")->text();
        $data['cep'] = pq($k)->find("#pf1 div:eq(22)")->text();

        $data['veiculo'] = pq($k)->find("#pf1 div:eq(24)")->text();
        $data['chassi'] = pq($k)->find("#pf1 div:eq(25)")->text();
        $data['blindado'] = pq($k)->find("#pf1 div:eq(26)")->text();
        $data['categoria_tarifaria'] = pq($k)->find("#pf1 div:eq(27)")->text();
        $data['pernoite_endereco'] = pq($k)->find("#pf1 div:eq(28)")->text();
        $data['pernoite_cep'] = pq($k)->find("#pf1 div:eq(29)")->text();
        $data['combustivel'] = pq($k)->find("#pf1 div:eq(30)")->text();

        $data['garantia1'] = pq($k)->find("#pf1 div:eq(32)")->text();
        $data['tabela_substituta'] = pq($k)->find("#pf1 div:eq(33)")->text();

        //garantias
        $data['garantias'][0] = pq($k)->find("#pf1 div:eq(35)")->text();
        $data['garantias'][1] = pq($k)->find("#pf1 div:eq(36)")->text();
        $data['garantias'][2] = pq($k)->find("#pf1 div:eq(37)")->text();
        $data['garantias'][3] = pq($k)->find("#pf1 div:eq(38)")->text();
        $data['garantias'][4] = pq($k)->find("#pf1 div:eq(39)")->text();
        $data['garantias'][4] = pq($k)->find("#pf1 div:eq(40)")->text();
        $data['garantias'][4] = pq($k)->find("#pf1 div:eq(41)")->text();
        $data['garantias'][4] = pq($k)->find("#pf1 div:eq(42)")->text();
        $data['garantias'][4] = pq($k)->find("#pf1 div:eq(43)")->text();
        $data['garantias'][4] = pq($k)->find("#pf1 div:eq(44)")->text();

        $data['premio_liquido'] = pq($k)->find("#pf1 div:eq(45)")->text();
        $data['iof'] = pq($k)->find("#pf1 div:eq(46)")->text();
        $data['premio_total_avista'] = pq($k)->find("#pf1 div:eq(47)")->text();
        $data['premio_total'] = pq($k)->find("#pf1 div:eq(48)")->text();

        $data['franquia'][0] = pq($k)->find("#pf2 div:eq(4)")->text();
        $data['franquia'][1] = pq($k)->find("#pf2 div:eq(5)")->text();
        $data['franquia'][2] = pq($k)->find("#pf2 div:eq(6)")->text();
        $data['franquia'][3] = pq($k)->find("#pf2 div:eq(7)")->text();
        $data['franquia'][4] = pq($k)->find("#pf2 div:eq(8)")->text();
        $data['franquia'][5] = pq($k)->find("#pf2 div:eq(9)")->text();
        $data['franquia'][6] = pq($k)->find("#pf2 div:eq(10)")->text();
        $data['franquia'][7] = pq($k)->find("#pf2 div:eq(11)")->text();
        $data['franquia'][8] = pq($k)->find("#pf2 div:eq(12)")->text();
        $data['franquia'][9] = pq($k)->find("#pf2 div:eq(12)")->text();


        $data['descontos'][0] = pq($k)->find("#pf2 div:eq(14)")->text();
        $data['descontos'][1] = pq($k)->find("#pf2 div:eq(15)")->text();


        $data['forma_pagamento_premio'] = [
          'parcelas_mensais' => pq($k)->find("#pf2 div:eq(18)")->text(),
          'melhor_dia' => pq($k)->find("#pf2 div:eq(19)")->text(),
          'primeira_parcela' => pq($k)->find("#pf2 div:eq(20)")->text(),
          'primeira_parcela_forma' => pq($k)->find("#pf2 div:eq(21)")->text(),
          'demais_parcelas' => substr(pq($k)->find("#pf2 div:eq(22)")->text(), 16),
          'conta' => pq($k)->find("#pf2 div:eq(23)")->text(),
          'conta_nome' => substr(pq($k)->find("#pf2 div:eq(24)")->text(), 5),
          'conta_cpf' => substr(pq($k)->find("#pf2 div:eq(25)")->text(), 29),
        ];

        dd($data);

    }
}