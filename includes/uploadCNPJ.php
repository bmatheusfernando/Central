<main>

	<form action="" method="POST" enctype="multipart/form-data">
     <input type="file" name="csv">  
     <input type="submit" name="enviar" value=Enviar>

    
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#JanelaModal">       
            Validar
        </button>

        <div id="JanelaModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h3 class="modal-title">CNPJs Inválidos</h3>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
                
                    <div class="modal-body">
                    <p>

                        <?php

                            include __DIR__.'/../src/Controller/resultadoCNPJ.php';

                                echo '<pre>';
                                print_r($invalidosCNPJ);
                                echo '</pre>';
     
                        ?>

                    </p>
                    <div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    </div>    
                </div>    
            </div>
        </div>   
    </form>    
</main>