<?php

class FileManager {
    private string $directory;

    public function __construct(string $directory) {
        $this->directory = rtrim($directory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        
        if (!is_dir($this->directory)) {
            mkdir($this->directory, 0755, true);
        }
    }

    public function readFile(string $filename): string {
        $filePath = $this->directory . $filename;
        if (file_exists($filePath)) {
            return file_get_contents($filePath);
        }
        throw new Exception("Файл не найден: " . $filename);
    }

    public function writeFile(string $filename, string $data): void {
        $filePath = $this->directory . $filename;
        file_put_contents($filePath, $data);
    }

    public function deleteFile(string $filename): void {
        $filePath = $this->directory . $filename;
        if (file_exists($filePath)) {
            unlink($filePath);
        } else {
            throw new Exception("Файл не найден: " . $filename);
        }
    }

    public function listFiles(): array {
        return array_diff(scandir($this->directory), ['..', '.']);
    }
}

try {
    $fileManager = new FileManager('my_files');

    $fileManager->writeFile('newtext.txt', 'Gример текста.');
    
    echo $fileManager->readFile('newtext.txt') . PHP_EOL;

    print_r($fileManager->listFiles());

    $fileManager->deleteFile('newtext.txt');

    print_r($fileManager->listFiles());

} catch (Exception $e) {
    echo 'Ошибка: ' . $e->getMessage();
}

?>