<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Cliente;
use App\Endereco;

Route::get('/clientes', function () {
    $clientes = Cliente::all();
    foreach($clientes  as $c){
        echo "<p>ID: ".$c->id."</p>";
        echo "<p>NOME: ".$c->nome."</p>";
        echo "<p>TELEFONE: ".$c->telefone."</p>";
        /*$e = Endereco::where('cliente_id', $c->id)->first();*/
        echo "<p>ID: ".$c->endereco->cliente_id."</p>";
        echo "<p>RUA: ".$c->endereco->rua."</p>";
        echo "<p>NUMERO: ".$c->endereco->numero."</p>";
        echo "<p>BAIRRO: ".$c->endereco->bairro."</p>";
        echo "<p>CIDADE: ".$c->endereco->cidade."</p>";
        echo "<p>UF: ".$c->endereco->uf."</p>";
        echo "<p>CEP: ".$c->endereco->cep."</p>";
        echo "<hr>";
    }
});

Route::get('/enderecos', function () {
    $enderecos = Endereco::all();
    foreach($enderecos  as $e){
        echo "<p>ID: ".$e->cliente_id."</p>";
        echo "<p>Nome: ".$e->cliente->nome."</p>";
        echo "<p>Telefone: ".$e->cliente->telefone."</p>";
        echo "<p>RUA: ".$e->rua."</p>";
        echo "<p>NUMERO: ".$e->numero."</p>";
        echo "<p>BAIRRO: ".$e->bairro."</p>";
        echo "<p>CIDADE: ".$e->cidade."</p>";
        echo "<p>UF: ".$e->uf."</p>";
        echo "<p>CEP: ".$e->cep."</p>";
        echo "<hr>";
    }
});

Route::get('/inserir', function() {
    $c = new Cliente();
    $c->name = "Jose Almeida";
    $c->telefone = "343434343";
    $c->save();

    $e = new Endereco();
    $e->rua = "Av. do Estado";
    $e->numero = 400;
    $e->bairro = "Centro";
    $e->cidade = "São Paulo";
    $e->uf = "SP";
    $e->cep = "12000-456";

    $c->endereco()->save($e);
});

Route::get('/clientes/json', function(){
    //clientes = Cliente::all();

    //Para carregar os dados com o endereco 
    $clientes = Cliente::with(['endereco'])->get();
    return $clientes->toJson();
});

Route::get('/enderecos/json', function(){

    $enderecos = Endereco::with(['cliente'])->get();
    return $enderecos->toJson();

})