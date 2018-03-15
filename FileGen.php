<?php

namespace FileGen;

class FileGen extends \SplFileObject
{
    const OPEN_MODE = 'r+';

    /**
     * @param int $nbBytes
     * @return \Generator
     * @throws \Exception
     */
    public function readFile($nbBytes, $rewind = true)
    {
        if (! $this->isFile()) {
            throw new \Exception('Le fichier n\existe pas.');
        }

        if ($rewind) {
            $this->rewind();
        }
        $numLine = 1;
        while ($part = $this->fread($nbBytes)) {
            yield $numLine++ => $part;
        }
    }

    public function readAllFile($rewind = true)
    {
        if (! $this->isFile()) {
            throw new \Exception('Le fichier n\existe pas.');
        }

        if ($rewind) {
            $this->rewind();
        }
        return $this->fread($this->getSize());
    }

    public function readLine()
    {
        if (! $this->isFile()) {
            throw new \Exception('Le fichier n\existe pas.');
        }
        $line = $this->current();
        $this->next();
        return $line;
    }

    public function readLinePerLine()
    {
        $numLine = 0;
        $this->rewind();
        while (! $this->eof()) {
            yield ++$numLine => $this->current();
            $this->next();
        }
    }

    public function writeFile($text, $offset = null)
    {
        if (! $this->isWritable()) {
            return null;
        }
        $whence = (null !== $offset) ? SEEK_SET : SEEK_END;
        $this->fseek($offset, $whence);

        return $this->fwrite($text);
    }

    /**
     * @param string $fileName
     * @return Reader
     */
    public function setFile($fileName)
    {
        return self::factory($fileName);
    }

    public static function factory($fileName)
    {
        if (! file_exists($fileName) || is_writable($fileName)) {
            $fOpen = fopen($fileName, 'a');
            fclose($fOpen);
        }

        return new self($fileName, self::OPEN_MODE);
    }

}
