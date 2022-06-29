<?php

namespace Matheus\CentralCrmall\Controller;

class CSV {

    /**
     * Método responsável por ler um arquivo CSV e retornar um array de dados com delimitador ;
     */

	public static function lerArquivo(string $arquivo, $cabecalho = true, $delimitador = ';') {
		// Verifica se o arquivo existe
		if(!file_exists($arquivo)) {
			die("Arquivo não encontrado");
		} 

		// Dados das linhas do arquivo
		$dados = [];

		// Abre o arquivo
		$csv = fopen($arquivo, 'r');

		// Cabeçalho dos dados (Primeira linha)
		$cabecalhoDados = $cabecalho ? fgetcsv($csv,0,$delimitador) : [];

		// Itera o arquivo, lendo linha por linha
		while($linha = fgetcsv($csv,0,$delimitador)) {
			$dados[] = $cabecalho ? array_combine($cabecalhoDados, $linha) : $linha;
		}

		// Fecha o arquivo
		fclose($csv);

		// Retorna os dados processados	
		return $dados;
	}

	// EXCLUIR ARRAYS IGUAIS var_dump(array_unique(array));

}

?>