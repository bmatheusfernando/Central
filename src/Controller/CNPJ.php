<?php

namespace Matheus\CentralCrmall\Controller;

class CNPJ 
	{

	// Método responsável por verificar se um CNPJ é válido.
	public static function validar ($cnpj) {

		// Obtém os números do CNPJ
		$cnpj = preg_replace('/\D/', '', $cnpj);

		// Verifica a quantidade de caractéres
		if(strlen($cnpj) != 14) {
			return false;
		}

		// Dígito verificador
		$cnpjValidacao = substr($cnpj, 0, 12);
		$cnpjValidacao .= self::calcularDigitoVerificador($cnpjValidacao);
		$cnpjValidacao .= self::calcularDigitoVerificador($cnpjValidacao);

		// Compara o CNPJ calculado com o enviado
			return $cnpjValidacao == $cnpj;
	}

	// Método responspavel por calcular o digito verificar com base em uma sequência numérica.
	public static function calcularDigitoVerificador($base) {

		// Auxiliares
		$tamanho = strlen($base);
		$multiplicador = 9;

		// Soma das multiplicações
		$soma = 0;

		// Itera todos os números da base (direita -> esquerda)
		for ($i = ($tamanho -1); $i >= 0; $i--) {

			// Soma da multiplicação atual
			$soma += $base[$i] * $multiplicador;

			// Ajusta o multiplicador
			$multiplicador--;
			$multiplicador = $multiplicador < 2 ? 9 : $multiplicador;
			}

		// Resto da divisão = dígito verificador
		return $soma % 11;	
		}	
	}
?>