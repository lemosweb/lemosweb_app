<?php


namespace App\Controllers;


use lemosweb\Controller\Action;
use lemosweb\DI\Container;

class Artigos extends Action
{

    public function artigos()
    {
        $listaArtigos = Container::getClass('Artigo');

        $del = filter_input(INPUT_GET, 'del', FILTER_DEFAULT);

        if(!empty($del) && $listaArtigos->find($del)) {

            $listaArtigos->delete($del);

        }

        $todos = $listaArtigos->fetchAll();

        $this->view->todos = $todos;


        $this->render('artigos');
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

            $this->artigos();

        }else{

            $registro = $buscaArtigo->find($id);

            $this->view->registro = $registro;

            $this->view->id = $id;

            $inputVars =  filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if(!empty($inputVars)){

                 $buscaArtigo->update($id, $inputVars);

                $this->artigos();
            }else{

                $this->render('atualiza');

            }


        }
    }

}