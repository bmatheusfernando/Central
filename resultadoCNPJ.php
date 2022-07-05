<?php

	require __DIR__."/../../vendor/autoload.php";

	use Matheus\CentralCrmall\Controller\CSV;
	use Matheus\CentralCrmall\Controller\CNPJ;

	$upload = new \CoffeeCode\Uploader\File("storage", "files");
    $files = $_FILES;

    if(!empty($files["csv"])) {
        $file = $files["csv"];

        if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())) {
            echo "<p>Selecione um arquivo CSV</p>";
        } else {
            $uploadedCNPJ = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME));
        } 

	$dados = CSV::lerArquivo($uploadedCNPJ,true, ';');		

	$arquivo = fopen(__DIR__.'/storage/validos/cnpj_validos.csv', 'w');

		foreach ($dados as $key => $valores) {
			$resultado = CNPJ::validar($valores['CNPJ']);	
		
			if ($resultado === false) {

				$invalidosCNPJ[] = $valores;

			} else {

				$linha['CNPJ'] 	        = $valores['CNPJ'];
				$linha['Razão Social']  = $valores['Razão Social'];	
				$linha['Fantasia']      = $valores['Fantasia'];		
				fputcsv($arquivo, $linha, ';');
			}
		}	
		fclose($arquivo);
	}
?>