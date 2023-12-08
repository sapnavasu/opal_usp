import * as CryptoJS from 'crypto-js';
import swal from 'sweetalert';

export class Encrypt {
	private passphrase = 'BGILyPIS';
	constructor() {}

	aesencrypt(texttoenc: any) {

		const salt = CryptoJS.lib.WordArray.random(256);
		const iv = CryptoJS.lib.WordArray.random(16);

		const key = CryptoJS.PBKDF2(this.passphrase, salt, { hasher: CryptoJS.algo.SHA512, keySize: 64 / 8, iterations: 999 });

		const encrypted = CryptoJS.AES.encrypt(texttoenc, key, { iv });

		const data = {
		ciphertext: CryptoJS.enc.Base64.stringify(encrypted.ciphertext),
		salt: CryptoJS.enc.Hex.stringify(salt),
		iv: CryptoJS.enc.Hex.stringify(iv)
		};
		return btoa(JSON.stringify(data));
	}

	aesdecrypt(texttodec: any) {

		const obj_json = JSON.parse(this.decrypt(texttodec));

		const encrypted = obj_json.ciphertext;
		const salt = CryptoJS.enc.Hex.parse(obj_json.salt);
		const iv = CryptoJS.enc.Hex.parse(obj_json.iv);

		const key = CryptoJS.PBKDF2(this.passphrase, salt, { hasher: CryptoJS.algo.SHA512, keySize: 64 / 8, iterations: 999});

		const decrypted = CryptoJS.AES.decrypt(encrypted, key, { iv});

		return decrypted.toString(CryptoJS.enc.Utf8);
	}

	encrypt(texttoenc: any) {
		return btoa(texttoenc);
	}

	decrypt(texttodec: any) {
		if (texttodec != null && texttodec != undefined) {
		return atob(texttodec);
		}
	}
	// user perimission pop up
	userpermissionpop() {
		swal({
		  title: 'You don\'t have permission to access',
		  icon: 'warning',
		});
	  }
}
