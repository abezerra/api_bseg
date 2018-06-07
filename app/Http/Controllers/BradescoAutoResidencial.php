<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 06/06/2018
 * Time: 13:16
 */

namespace App\Http\Controllers;


class BradescoAutoResidencial extends Controller
{


    public function __construct()
    {

    }

    public function auto_residential($k)
    {

        $c_seg = [];
        $c_seg['insurer'] = 1;
        $c_seg['apoliceNumber'] = substr(pq($k)->find("#pf5 div:eq(16)")->text(), 0, 7);
        $c_seg['item'] = substr(pq($k)->find("#pf5 div:eq(16)")->text(), 6, 6);
        $c_seg['proposta'] = substr(pq($k)->find("#pf5 div:eq(16)")->text(), 11, 10);
        $c_seg['data_emissao'] = substr(pq($k)->find("#pf5 div:eq(16)")->text(), 21);

        $c_seg['renovation'] = pq($k)->find("#pf5 div:eq(18)")->text();
        $c_seg['coverage_type'] = substr(pq($k)->find("#pf5 div:eq(24)")->text(), 0, 12);
        $c_seg['classe_de_bonus'] = substr(pq($k)->find("#pf5 div:eq(24)")->text(), 12);
        $c_seg['ci'] = substr(pq($k)->find("#pf5 div:eq(26)")->text(), 0, 19);

        $c_seg['validity'] = pq($k)->find("#pf5 div:eq(27)")->text() . ' ' . pq($k)->find("#pf5 div:eq(28)")->text();

        $c_seg['nome_segurado'] = pq($k)->find("#pf5 div:eq(32)")->text();
        $c_seg['cpf_segurado'] = pq($k)->find("#pf5 div:eq(34)")->text();

        $c_seg['o_segurado_e_o_proprietario'] = pq($k)->find("#pf5 div:eq(36)")->text();
        $c_seg['tipo_pessoa'] = pq($k)->find("#pf6 div:eq(4)")->text();
        $c_seg['nascimento'] = pq($k)->find("#pf6 div:eq(6)")->text();
        $c_seg['sexo'] = pq($k)->find("#pf6 div:eq(8)")->text();
        $c_seg['principal_condutor'] = pq($k)->find("#pf6 div:eq(10)")->text();
        $c_seg['endereco_pernoite'] = pq($k)->find("#pf6 div:eq(12)")->text();
        $c_seg['endereco_pernoite_bairro'] = pq($k)->find("#pf6 div:eq(14)")->text();
        $c_seg['endereco_pernoite_municipio'] = pq($k)->find("#pf6 div:eq(17)")->text();
        $c_seg['endereco_pernoite_uf'] = pq($k)->find("#pf6 div:eq(18)")->text();
        $c_seg['endereco_pernoite_cep'] = pq($k)->find("#pf6 div:eq(20)")->text();
        $c_seg['tel_residencial'] = pq($k)->find("#pf6 div:eq(32)")->text();
        $c_seg['celular'] = pq($k)->find("#pf6 div:eq(32)")->text();
        $c_seg['principal_condutor_nome'] = pq($k)->find("#pf6 div:eq(35)")->text();
        $c_seg['principal_condutor_cpf'] = pq($k)->find("#pf6 div:eq(37)")->text();
        $c_seg['principal_condutor_nascimento'] = pq($k)->find("#pf6 div:eq(39)")->text();
        $c_seg['principal_condutor_sexo'] = pq($k)->find("#pf6 div:eq(41)")->text();
        $c_seg['principal_condutor_estado_civil'] = pq($k)->find("#pf6 div:eq(43)")->text();
        $c_seg['cobertura_18_a_25'] = pq($k)->find("#pf6 div:eq(47)")->text();
        $c_seg['condominio_garagem'] = pq($k)->find("#pf6 div:eq(50)")->text() . ' ' . pq($k)->find("#pf6 div:eq(51)")->text();

        //Ta quebrando aqui

        $c_seg['mais_de_um_veiculo'] = pq($k)->find("#pf7 div:eq(4)")->text();
        $c_seg['principal_atividade_do_condutor'] = pq($k)->find("#pf7 div:eq(7)")->text();
        $c_seg['utilia_veiculo_pra_ir_pro_rala'] = pq($k)->find("#pf7 div:eq(9)")->text();
        $c_seg['quilometragem_media_rodada'] = pq($k)->find("#pf7 div:eq(15)")->text();
        $c_seg['proprietario_nome'] = pq($k)->find("#pf7 div:eq(18)")->text();
        $c_seg['proprietario_cnpj'] = pq($k)->find("#pf7 div:eq(20)")->text();


        $c_seg['veiculo_marca'] = pq($k)->find("#pf7 div:eq(23)")->text();
        $c_seg['veiculo_modelo_ano'] = substr(pq($k)->find("#pf7 div:eq(25)")->text(), 0, 9);
        $c_seg['chassi_remarcado'] = substr(pq($k)->find("#pf7 div:eq(25)")->text(), 9);
        $c_seg['saida_consecionaria'] = pq($k)->find("#pf7 div:eq(28)")->text();
        $c_seg['chassi'] = pq($k)->find("#pf7 div:eq(31)")->text();
        $c_seg['uso_do_veiculo'] = pq($k)->find("#pf7 div:eq(34)")->text();
        $c_seg['tipo_do_veiculo'] = pq($k)->find("#pf7 div:eq(36)")->text();

        $c_seg['combustivel'] = pq($k)->find("#pf7 div:eq(38)")->text();
        $c_seg['quantidade_portas'] = substr(pq($k)->find("#pf7 div:eq(40)")->text(), 0, 2);
        $c_seg['quantidade_eoxos'] = substr(pq($k)->find("#pf7 div:eq(40)")->text(), 2, 4);
        $c_seg['lotacao'] = substr(pq($k)->find("#pf7 div:eq(40)")->text(), 5);
        $c_seg['transformado'] = pq($k)->find("#pf7 div:eq(42)")->text();
        $c_seg['antifurto'] = pq($k)->find("#pf8 div:eq(4)")->text();

        $c_seg['LMI'] = pq($k)->find("#pf8 div:eq(25)")->text();
        $c_seg['lmi_veiculo'] = substr(pq($k)->find("#pf8 div:eq(28)")->text(), 0, 27);
        $c_seg['plc_veiculo'] = substr(pq($k)->find("#pf8 div:eq(28)")->text(), 27);


        dd($c_seg);


        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(25)");
        echo '<br /><br /> LMI: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(28)");
        echo '<br /><br /> Veiculo: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(30)");
        echo '<br /><br /> Fator de Ajustes do VRM: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(32)");
        echo '<br /><br /> Danos materiais a terceiros: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(34)");
        echo '<br /><br /> Danos corporais a terceiros: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(36)");
        echo '<br /><br /> Danos morais: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(38)");
        echo '<br /><br /> APP: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(39)");
        echo '<br /><br /> Morte do passajeiro: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(40)");
        echo '<br /><br /> Invalidez : ' . $nome_da_seguradora->text();


        echo '<h2>###########################################</h2>';
        echo '<h2>Serviços complementares:</h2>';

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(42)");
        echo '<br /><br /> ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(43)");
        echo '<br /><br /> ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(44)");
        echo '<br /><br /> ' . $nome_da_seguradora->text();

        echo '<h2>###########################################</h2>';
        echo '<h2>Franquias:</h2>';
        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(48)");
        echo '<br /><br /> Codigo / veiculo: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(50)");
        echo '<br /><br /> Equipamentos / carroceria / clausula 86: ' . $nome_da_seguradora->text();

        echo '<h2>Participacao do segurado:</h2>';

        $nome_da_seguradora = pq($k)->find("#pf9 div:eq(7)");
        echo '<br /><br /> parabrisa / vidros laterais / vidro trazeiro: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf9 div:eq(9)");
        echo '<br /><br /> xenon /led / fareis /lanternas /et: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf9 div:eq(11)");
        echo '<br /><br /> marreta de diamante: ' . $nome_da_seguradora->text();

        echo '<h2>Forma de pagamento:</h2>';

        $nome_da_seguradora = pq($k)->find("#pf9 div:eq(28)");
        echo '<br /><br /> Tipo de cobranca / CCB / data CCB: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf9 div:eq(31)");
        echo '<br /><br /> nº prestacoes / 1 prestacao / n prestacoes: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf9 div:eq(32)");
        echo '<br /><br /> demais prestacoes: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf9 div:eq(35)");
        echo '<br /><br /> Banco: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf9 div:eq(37)");
        echo '<br /><br /> Primeira parcela: ' . $nome_da_seguradora->text() .
            ' ' . pq($k)->find("#pf9 div:eq(38)")->text() .
            ' ' . pq($k)->find("#pf9 div:eq(39)")->text();


        echo '<h2>Corretor:</h2>';

        $nome_da_seguradora = pq($k)->find("#pfa div:eq(5)");
        echo '<br /><br /> Nome: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pfa div:eq(7)");
        echo '<br /><br /> Susepe: ' . $nome_da_seguradora->text();
    }
}