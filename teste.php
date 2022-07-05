<?php

	require __DIR__."/../../vendor/autoload.php";

	use Matheus\CentralCrmall\Controller\CSV;
	use Matheus\CentralCrmall\Controller\CPF;

	$upload = new \CoffeeCode\Uploader\File("storage", "files");
    $files = $_FILES;

    if(!empty($files["csv"])) {
        $file = $files["csv"];

        if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())) {
            echo "<p>Selecione um arquivo CSV</p>";
        } else {
            $uploaded = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME));
        } 
   
	$dados = CSV::lerArquivo($uploaded,true, ';');	

	$validos = fopen(__DIR__.'/storage/validos/cpf_validos.csv', 'w');

	$invalidos = fopen(__DIR__.'/storage/invalidos/cpf_invalidos.csv', 'w');

		foreach ($dados as $key => $valores) {
			$resultado = CPF::validar($valores['CPF']);	
		
			if ($resultado == false) {
						$linhaFalso['CPF'] 	= $valores['CPF'];
						$linhaFalso['Nome'] = $valores['Nome'];		
						fputcsv($invalidos, $linhaFalso, ';');
						$invalidosCPF[] = $linhaFalso;
						}
					}	
			fclose($invalidos);		

		foreach ($dados as $key => $valores) {
			$resultado = CPF::validar($valores['CPF']);	
		
			if ($resultado == true ) {
						$linha['CPF'] 	= $valores['CPF'];
						$linha['Nome']  = $valores['Nome'];		
						fputcsv($validos, $linha, ';');
						}
					}	
			fclose($validos);
		}	
?>