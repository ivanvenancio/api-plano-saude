<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $clientes = [
            ['nome' => 'Claudianus Boast','email' => 'cboast0@fastcompany.com','telefone' => '19957645371','estado' => 'São Paulo','cidade' =>  'Araraquara','data_nascimento' => '1993-06-07'],
            ['nome' => 'Loni Jennions','email' => 'ljennions1@va.gov','telefone' => '19905613161','estado' => 'São Paulo','cidade' =>  'Limeira','data_nascimento' => '1985-05-09'],
            ['nome' => 'Margi Gilhouley','email' => 'mgilhouley2@telegraph.co.uk','telefone' => '19966290104','estado' => 'São Paulo','cidade' =>  'Araraquara','data_nascimento' => '1984-09-13'],
            ['nome' => 'Lexy Sprulls','email' => 'lsprulls3@moonfruit.com','telefone' => '19976121601','estado' => 'São Paulo','cidade' =>  'Rio Claro','data_nascimento' => '1999-10-19'],
            ['nome' => 'Marie Shatliff','email' => 'mshatliff4@cbslocal.com','telefone' => '19991376354','estado' => 'São Paulo','cidade' =>  'Rio Claro','data_nascimento' => '1990-07-20'],
            ['nome' => 'Graig Mouncey','email' => 'gmouncey5@so-net.ne.jp','telefone' => '19941806149','estado' => 'São Paulo','cidade' =>  'Araraquara','data_nascimento' => '1990-03-27'],
            ['nome' => 'Laurice Liger','email' => 'lliger0@php.net','telefone' => '35971740954','estado' => 'Minas Gerais','cidade' =>  'Areado','data_nascimento' => '1992-10-25'],
            ['nome' => 'Kendrick Sooper','email' => 'ksooper1@slate.com','telefone' => '31944324086','estado' => 'Minas Gerais','cidade' =>  'Belo Horizonte','data_nascimento' => '1981-06-02'],
            ['nome' => 'Gordon Levington','email' => 'glevington2@hpost.com','telefone' => '31922405868','estado' => 'Minas Gerais','cidade' =>  'Belo Horizonte','data_nascimento' => '1993-11-25'],
            ['nome' => 'Noam Scolland','email' => 'nscolland3@mozilla.org','telefone' => '35996817669','estado' => 'Minas Gerais','cidade' =>  'Areado','data_nascimento' => '1999-12-31'],
            ['nome' => 'Lindon Skehens','email' => 'lskehens4@npr.org','telefone' => '35967671104','estado' => 'Minas Gerais','cidade' =>  'Areado','data_nascimento' => '1985-01-10'],
            ['nome' => 'Kimbra Rase','email' => 'krase5@topsy.com','telefone' => '35999428030','estado' => 'Minas Gerais','cidade' =>  'Areado','data_nascimento' => '1999-05-05'],
            ['nome' => 'Lorenzo Fisk','email' => 'lfisk6@businessweek.com','telefone' => '31912695467','estado' => 'Minas Gerais','cidade' =>  'Belo Horizonte','data_nascimento' => '1985-12-22'],
            ['nome' => 'Bourke Flavelle','email' => 'bflavelle7@fc2.com','telefone' => '35959386145','estado' => 'Minas Gerais','cidade' =>  'Itapeva','data_nascimento' => '1984-04-10'],
            ['nome' => 'Curran McSharry','email' => 'cmcsharry8@webeden.co.uk','telefone' => '35902916131','estado' => 'Minas Gerais','cidade' =>  'Itapeva','data_nascimento' => '1983-01-15'],
            ['nome' => 'Aveline Dowtry','email' => 'adowtry9@miibeian.gov.cn','telefone' => '31945227500','estado' => 'Minas Gerais','cidade' =>  'Belo Horizonte','data_nascimento' => '1994-12-23'],
            ['nome' => 'John Sebastian','email' => 'jsebastiana@cbslocal.com','telefone' => '31907366740','estado' => 'Minas Gerais','cidade' =>  'Belo Horizonte','data_nascimento' => '1998-04-06'],
            ['nome' => 'Reynolds Greenan','email' => 'rgreenanb@bloomberg.com','telefone' => '35923551410','estado' => 'Minas Gerais','cidade' =>  'Itapeva','data_nascimento' => '1985-07-19'],
        ];


        foreach ($clientes as $cliente) {
            $cliente = Cliente::create($cliente);
            $plano = rand(1,3);
            $cliente->planos()->attach($plano);
        }
    }
}
