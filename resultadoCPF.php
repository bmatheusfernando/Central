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
            $uploadedCPF = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME));
        } 

	$dados = CSV::lerArquivo($uploadedCPF,true, ';');		

	$arquivo = fopen(__DIR__.'/storage/validos/cpf_validos.csv', 'w');

		foreach ($dados as $key => $valores) {
		$resultado = CPF::validar($valores['CPF']);	
		
			if ($resultado === false) {

				$invalidosCPF[] = $valores;

			} else {

				$linha['CPF'] 	= $valores['CPF'];
				$linha['Nome']  = $valores['Nome'];		
				fputcsv($arquivo, $linha, ';');
			}
		}	
		fclose($arquivo);
	}
?>