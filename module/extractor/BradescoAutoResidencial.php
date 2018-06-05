<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 05/06/2018
 * Time: 17:40
 */

namespace Extractor;


class BradescoAutoResidencial
{
    public function auto_residential($k)
    {
        $titleElement = pq(".y64:first");
        echo '<h2>Certificado de seguro</h2>';
        echo $titleElement->html();

        $nome_da_seguradora = pq($k)->find("#pf5 div:eq(5)");
        echo '<br /><br /> Nome da seguradora: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf5 div:eq(7)");
        echo '<br /><br /> CNPJ: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf5 div:eq(16)");
        echo '<br /><br /> Numero da apolice: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf5 div:eq(18)");
        echo '<br /><br /> Renovação da Apólice Nº: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf5 div:eq(24)");
        echo '<br /><br /> Cobertura: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf5 div:eq(26)");
        echo '<br /><br /> CI e RAMO: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf5 div:eq(27)");
        echo '<br /><br /> Vigência: ' . $nome_da_seguradora->text() . ' ' . pq($k)->find("#pf5 div:eq(28)")->text();

        echo '<h2>Segurado:</h2>';

        $nome_da_seguradora = pq($k)->find("#pf5 div:eq(32)");
        echo '<br /><br /> Nome do segurado: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf5 div:eq(34)");
        echo '<br /><br /> CPF: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf5 div:eq(36)");
        echo '<br /><br /> O segurado é proprietário do veículo?: ' . $nome_da_seguradora->text();

        //pagina 6

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(4)");
        echo '<br /><br /> Tipo de pessoa: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(6)");
        echo '<br /><br /> Nascimento: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(8)");
        echo '<br /><br /> Sequiçu: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(10)");
        echo '<br /><br /> O segurado é principal condutor do veículo?: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(12)");
        echo '<br /><br /> Endereço de Pernoite: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(14)");
        echo '<br /><br /> Complemento / Bairro: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(17)");
        echo '<br /><br /> Municpio: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(18)");
        echo '<br /><br /> UF: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(20)");
        echo '<br /><br /> CEP: ' . $nome_da_seguradora->text();

        echo '<h2>Correspondencia:</h2>';

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(22)");
        echo '<br /><br /> Endereço de correspondencia: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(24)");
        echo '<br /><br /> Complemento / Bairro: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(27)");
        echo '<br /><br /> Municipio: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(28)");
        echo '<br /><br /> UF: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(30)");
        echo '<br /><br /> CEP: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(32)");
        echo '<br /><br /> Telefone Residencial: ' . $nome_da_seguradora->text();


        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(32)");
        echo '<br /><br /> Telefone Celular: ' . $nome_da_seguradora->text();


        echo '<h2>Principal Condutor:</h2>';

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(35)");
        echo '<br /><br /> Nome: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(37)");
        echo '<br /><br /> CPF: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(39)");
        echo '<br /><br /> Nascimento: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(41)");
        echo '<br /><br /> SEXO: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(43)");
        echo '<br /><br /> Estado Civil: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(47)");
        echo '<br /><br /> Cobertura molecada: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf6 div:eq(50)");
        echo '<br /><br /> Condominio, garagem, etc: ' . $nome_da_seguradora->text() . ' ' . pq($k)->find("#pf6 div:eq(51)");

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(4)");
        echo '<br /><br /> Há mais de um veículo na residência do Segurado?: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(7)");
        echo '<br /><br /> Qual a atividade principal que o Principal condutor exerce?: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(9)");
        echo '<br /><br /> Utiliza o veículo para ir até o local de trabalho?: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(9)");
        echo '<br /><br /> Utiliza o veículo para ir até o local de trabalho?: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(15)");
        echo '<br /><br /> Qual quilometragem média rodada?: ' . $nome_da_seguradora->text();

        echo '<h2>###########################################</h2>';

        echo '<h2>Informações do proprietario:</h2>';

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(18)");
        echo '<br /><br /> Nome: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(20)");
        echo '<br /><br /> CPF/CNPJ: ' . $nome_da_seguradora->text();

        echo '<h2>###########################################</h2>';
        echo '<h2>Veiculo</h2>';

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(23)");
        echo '<br /><br /> Marca / tipo: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(25)");
        echo '<br /><br /> Ano / modelo / Chassi remarcado: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(28)");
        echo '<br /><br /> Saida da consesionaria: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(31)");
        echo '<br /><br /> Chassi: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(34)");
        echo '<br /><br /> Uso do Veículo: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(36)");
        echo '<br /><br /> Tipo: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(38)");
        echo '<br /><br /> Combustivel: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(40)");
        echo '<br /><br /> portas / eixo / lotacao: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf7 div:eq(42)");
        echo '<br /><br /> Transformado?: ' . $nome_da_seguradora->text();

        $nome_da_seguradora = pq($k)->find("#pf8 div:eq(4)");
        echo '<br /><br /> Antifurto?: ' . $nome_da_seguradora->text();

        echo '<h2>###########################################</h2>';

        echo '<h2>Coberturas:</h2>';

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