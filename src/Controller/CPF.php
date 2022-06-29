<?php

namespace Matheus\CentralCrmall\Controller;

class CPF 
	{

	// Metódo responsável para verificar se o CPF é válido	.
	public static function validar(string $cpf) {

		// Obtém somente os números
		$cpf = preg_replace('/\D/','',$cpf);

		// Verifica a quantidade de caracteres
		if(strlen($cpf) != 11) {
			return false;
		}

		// Dígito verificador.
		$cpfValidacao = substr($cpf,0,9);
		$cpfValidacao .= self::calcularDigitoVerificador($cpfValidacao);
		$cpfValidacao .= self::calcularDigitoVerificador($cpfValidacao);
		
		// Compara o CPF calculado com o CPF enviado.
			return $cpfValidacao == $cpf;
	}

	// Método responsável por calcular um digito verificador com base em uma sequência númerica.
	public static function calcularDigitoVerificador(string $base) {

		// Auxiliares.
		$tamanho = strlen($base);
		$multiplicador = $tamanho + 1;

		// Soma.
		$soma = 0;

		// Itera os números do CPF.
		for ($i = 0; $i < $tamanho; $i++) {
			$soma += $base[$i] * $multiplicador;
			$multiplicador--;
		}
	// Resto da divisão.
	$resto = $soma % 11;

	// Retorna o dígito verificador.
	return $resto > 1 ? 11 - $resto : 0;
		
	}
} 

?>