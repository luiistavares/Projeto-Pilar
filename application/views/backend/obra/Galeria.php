<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!--  Botão para voltar para a pré-visualização  -->
            <?php echo form_open('Obra_Controller/pesquisar_obra/'.$id_obra); ?>
                <button style="width: 110px" class="btn btn-default" type="submit"> Voltar </button>
            <?php echo form_close();?>
            <!--  FIM  -->
        </div>

        <!-- <div class="col-sm-offset-10"> -->
            <!-- Botão que direciona para a página de cadastro de exposição -->
            <!-- <?php echo form_open('Obra_Controller/cadastrar_exposicao/'.$id_obra); ?>
                <button style="width: 230px" class="btn btn-default" type="submit"> Nova Imagem </button>
            <?php echo form_close();?> -->
            <!-- FIM -->
        <!-- </div> -->

        <!-- Coluna da direita -->
        <div class="col-md-4">
            <div class="form-group">
                <div class="img-container-card">                      
                        
                </div>
                <?php
                    //Cria variaveis para estilizar o form de imagem
                    $div_open = '<div class="form-group">';
                    $div_close = '</div>';

                    // Chama o form de imagem
                    echo form_open_multipart('Funcionario_Controller/add_img_obra/'.$id_obra);
                    //Passa o id do usuario p ser usado no controller e model
                    echo form_hidden('id_funcionario', $id_obra);
                    echo $div_open;
                    //cria um arrray com as definicões que o form upload deve ter
                    $imagem = array('name' => 'userfile', 'id' => 'userfile', 'class' => 'form-control');
                    //definicao padrão para arqivos q serao enviados para servers remotos, obrigado a ser 'userfile'
                    echo form_upload($imagem);
                    echo $div_close;
                    echo $div_open;
                    //Cria as definições dos atributos html do botao
                    $botao = array('name' => 'btn-adicionar', 'id' => 'btn-adicionar', 'class' => 'btn btn-default', 'value' => 'Adicionar Nova Imagem');
                    //Cria botão de submit do form;
                    echo form_submit($botao);
                    echo$div_close;
                    //Fecha o form
                    echo form_close();
                ?>                        
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Aqui serão carregadas todas as fotos da galeria -->
    </div>

        
</div>