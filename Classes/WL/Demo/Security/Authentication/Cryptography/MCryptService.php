<?php
namespace WL\Demo\Security\Authentication\Cryptography;
	/*                                                                        *
	 * This script belongs to the  WL.Demo shamework.                       *
	 *                                                                        *
	 * It is free software; you can redistribute it and/or modify it under    *
	 * the terms of the GNU Lesser General Public License, either version 3   *
	 * of the License, or (at your option) any later version.                 *
	 *                                                                        *
	 * The TYPO3 project - inspiring people to share!                         *
	 *                                                                        */

/**
 * Cryptographic algorithms
 *
 *
 */
class MCryptService {
	/**
	 * Encrypt Function
	 *
	 * @param string $encrypt   The plaintext to hash
	 * @param string $crypt_key
	 * @return string the result of the crypt() call
	 */
	public function doEncrypt($encrypt,$crypt_key)
	{
			$iv = "fYfhHeDm";// 8 bit IV
			$bit_check=8;// bit amount for diff algor.

			$text_num =str_split($encrypt,$bit_check);
			$text_num = $bit_check-strlen($text_num[count($text_num)-1]);
			for ($i=0;$i<$text_num; $i++) {$encrypt = $encrypt . chr($text_num);}
			$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
			mcrypt_generic_init($cipher, $crypt_key, $iv);
			$decrypted = mcrypt_generic($cipher,$encrypt);
			mcrypt_generic_deinit($cipher);
			return base64_encode($decrypted);

	}
	/**
	 * Decrypt Function
	 *
	 * @param string $decrypt   The plaintext to hash
	 * @param string $crypt_key
	 * @return string the result of the decrypt() call
	 */
	function doDecrypt($decrypt,$key)
	{
		$iv = "fYfhHeDm";// 8 bit IV
		$bit_check=8;// bit amount for diff algor.

		$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
		mcrypt_generic_init($cipher, $key, $iv);
		$decrypted = mdecrypt_generic($cipher,base64_decode($decrypt));
		mcrypt_generic_deinit($cipher);
		$last_char=substr($decrypted,-1);
		for($i=0;$i<$bit_check-1; $i++){
			if(chr($i)==$last_char){
				$decrypted=substr($decrypted,0,strlen($decrypted)-$i);
				break;
			}
		}
		return $decrypted;
	}


}
