<?php


namespace App\Controllers;


use lemosweb\Controller\Action;
use lemosweb\DI\Container;

class Artigos extends Action
{

    public function index()
    {
        $listaArtigos = Container::getClass('Artigo');

        $del = filter_input(INPUT_GET, 'del', FILTER_DEFAULT);

        if(!empty($del) && $listaArtigos->find($del)) {

            $listaArtigos->delete($del);

        }

        $todos = $listaArtigos->fetchAll();

        $this->view->todos = $todos;


        $this->render('index');
    }

    public function cadastrar()
    {

        $cadastraArtigo = Container::getClass('Artigo');
        $inputVars =  filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($inputVars) && $inputVars['titulo'] != '' && $inputVars['artigo'] != ''){

            $cadastraArtigo->insert($inputVars);
            $this->artigos();

        }else{


        $this->view->formdata = $cadastraArtigo;

        $this->render('cadastrar');

        }
    }


    public function atualiza()
    {
        $buscaArtigo = Container::getClass('Artigo');

        $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);


        if(empty($id) && !$buscaArtigo->find($id)){

            $this->index();

        }else{

            $registro = $buscaArtigo->find($id);

            $this->view->registro = $registro;

            $this->view->id = $id;

            $inputVars =  filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if(!empty($inputVars)){

                 $buscaArtigo->update($id, $inputVars);

                $this->index();
            }else{

                $this->render('atualiza');

            }


        }
    }

}