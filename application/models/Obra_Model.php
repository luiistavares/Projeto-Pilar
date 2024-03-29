<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Obra_Model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    // Responsável por gerar a operação de Cadastrate do CRUD
    public function cadastrar_obra($obra){
        $this->db->insert('obra', $obra);
        $this->db->where('id_obra', $this->db->insert_id());
        return $this->db->get('obra')->result();
    }

    // Responsável por gerar a pré-visualização de TODAS as obras cadastradas na view
    public function pre_visualizacao(){
        // get_compiled_select() deve ser usado para a pesquisa funcionar corretamente neste join
    	$this->db->select('id_obra', 'num_atual', 'descricao_objeto', 'nome_objeto', 'titulo')->get_compiled_select();

        // Indica em que tabela será realizada a pesquisa pelos atributos
        $this->db->from('obra');

        // Ordena por critério descendente de ID (esperança de ordenar do registro mais recente para o mais antigo)
        $this->db->order_by('id_obra','DESC');

    	// Retorna o resultado da pesquisa
    	return $this->db->get()->result();
    }

    // Reaponsável por realizar a operação de Read do CRUD
    public function pesquisa_unitaria($chave){

        // get_compiled_select() deve ser usado para a pesquisa funcionar corretamente
        $this->db->select();

        // Indica em que tabela será realizada a pesquisa pelos atributos
        $this->db->from('obra');

        $this->db->where('id_obra', $chave);


        // Retorna o resultado da pesquisa
        return $this->db->get()->result();
    }
    public function pesquisa_nome($id){
        $this->db->select('nome');
        $this->db->from('funcionario');
        $this->db->where('id_funcionario', $id);
        return $this->db->get()->result();
    }

    // Realiza a operação de Update do CRUD
    public function atualizar_obra($id, $dados){
        // Informa que a obra que será atualizada será a que contém o id_obra = $id
        $this->db->where('id_obra', $id);

        //Define quais dados serão inseridos na tabela
        $this->db->set($dados);

        //  Realiza a instrução de update na tabela selecionada, conforme os dados e o id informados
        return $this->db->update('obra');
    }

    public function excluir_obra($id_obra) {
        $this->db->where('id_obra', $id_obra);
        return $this->db->delete('obra');
    }

    public function imagens_desta_obra($id){
        $this->db->select();

        // Indica em que tabela será realizada a pesquisa pelos atributos
        $this->db->from('galeria');

        $this->db->where('id_obra', $id);

        // Ordena por critério descendente de ID (esperança de ordenar do registro mais recente para o mais antigo)
        $this->db->order_by('id_img','DESC');

        // Retorna o resultado da pesquisa
        return $this->db->get()->result();
    }
    
    // Responsável por gerar a operação de Cadastrate do CRUD
    public function cadastrar_registro_imagem($dados){
        //Grava uma imagem na tabela de dados já inserindo um id
        $this->db->insert('galeria', $dados);

        //Retorna o último id inserido na tabela galeria
        return $this->db->insert_id();
    }

    // Responsável por gerar a operação de Update do CRUD
    public function atualizar_registro_img($id, $dados){
        // Informa que a imagem que será atualizada será a que contém o id_img = $id
        $this->db->where('id_img', $id);

        //Define quais dados serão inseridos na tabela
        $this->db->set($dados);

        //  Realiza a instrução de update na tabela selecionada, conforme os dados e o id informados
        return $this->db->update('galeria');
    }

    //Exclui os registros de uma imagem do banco de dados (falta remover o registro da pasta do projeto)
    public function remover_registro_imagem($id_img){
        $this->db->where('id_img', $id_img);
        return $this->db->delete('galeria');
    }

    public function tornar_padrao($id_img, $id_obra, $dados){
        //Limpa a imagem padrao anterior
        $this->db->from('galeria');        
        $this->db->where('id_obra', $id_obra);
        $this->db->where('img_padrao', 1);
        $remove_padrao['img_padrao'] = 0;
        $this->db->set($remove_padrao);
        $this->db->update('galeria');

        //Define a nova imagem padrao
        $this->db->from('galeria');
        $this->db->where('id_img', $id_img);
        $this->db->set($dados);
        return $this->db->update('galeria');
    }

    // Seleciona todas as imagens da tabela de galeria que são imagens padrão das obras
    public function seleciona_img_padrao(){
        $this->db->select();
        $this->db->from('galeria');
        $this->db->where('img_padrao', 1);
        $this->db->order_by('id_img','DESC');

        return $this->db->get()->result();
    }

    public function excluir_imagens($id_obra) {
        $this->db->where('id_obra', $id_obra);
        return $this->db->delete('galeria');
    }

    public function pesquisar_uma_img($id_img){
        $this->db->select();

        // Indica em que tabela será realizada a pesquisa pelos atributos
        $this->db->from('galeria');

        $this->db->where('id_img', $id_img);

        // Retorna o resultado da pesquisa
        return $this->db->get()->result();
    }
}