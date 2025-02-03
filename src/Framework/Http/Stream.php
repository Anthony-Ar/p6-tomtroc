<?php


declare(strict_types = 1);

namespace App\Framework\Http;

use App\Framework\Exception\HttpException\InvalidPointerPositionInStreamException;
use App\Framework\Exception\HttpException\InvalidStreamFormatException;
use App\Framework\Exception\HttpException\StreamDontExistException;
use App\Framework\Exception\HttpException\StreamNotSeekableException;
use App\Framework\Exception\HttpException\UnableToReadStreamException;
use App\Framework\Exception\HttpException\UnableToSeekStreamException;
use App\Framework\Exception\HttpException\UnableToWriteStreamException;
use App\Framework\Http\Interface\StreamInterface;

class Stream implements StreamInterface
{
    protected bool $readable;
    protected bool $writable;
    protected bool $seekable;
    protected int|null $size;
    protected array $meta;
    protected mixed $stream;

    /**
     * @param $stream
     * @throws InvalidStreamFormatException
     */
    public function __construct($stream)
    {
        $this->assertStream($stream);
        $this->stream = $stream;

        $meta = $this->getMetadata();

        $this->readable = false;
        $this->writable = false;

        if (str_contains($meta['mode'], '+')) {
            $this->readable = true;
            $this->writable = true;
        }

        if (preg_match('/^[waxc][t|b]{?}$/', $meta['mode'], $matches, PREG_OFFSET_CAPTURE)) {
            $this->writable = true;
        }

        if (str_contains($meta['mode'], 'r')) {
            $this->readable = true;
        }

        $this->seekable = $meta['seekable'];
    }

    /**
     * @return bool
     */
    public function isWritable() : bool
    {
        return $this->writable;
    }

    /**
     * @return bool
     */
    public function isReadable() : bool
    {
        return $this->readable;
    }

    /**
     * @return bool
     */
    public function isSeekable() : bool
    {
        return $this->seekable;
    }

    /**
     * @return void
     */
    public function close() : void
    {
        if ($this->isStream()) {
            fclose($this->stream);
        }

        $this->detach();
    }

    /**
     * @return resource|null
     */
    public function detach()
    {
        if (!$this->isStream()) {
            return null;
        }

        $legacy = $this->stream;

        $this->readable = false;
        $this->writable = false;
        $this->seekable = false;
        $this->size = null;
        $this->meta = [];

        unset($this->stream);

        return $legacy;
    }

    /**
     * @return int|null
     */
    public function getSize() : ?int
    {
        if (!$this->isStream()) {
            return null;
        }

        if ($this->size === null) {
            $stats = fstat($this->stream);
            $this->size = $stats['size'] ?? null;
        }

        return $this->size;
    }

    /**
     * @return int
     * @throws InvalidPointerPositionInStreamException
     * @throws StreamDontExistException
     */
    public function tell() : int
    {
        $this->assertPropertyStream();

        $pointer = false;

        if ($this->stream) {
            $pointer = ftell($this->stream);
        }

        if ($pointer === false) {
            throw new InvalidPointerPositionInStreamException(
                'Impossible de déterminer la position du pointeur de fichier dans le flux.'
            );
        }

        return $pointer;
    }

    /**
     * @return bool
     */
    public function eof() : bool
    {
        return !$this->stream || feof($this->stream);
    }

    /**
     * @param $offset
     * @param $whence
     * @return void
     * @throws StreamDontExistException
     * @throws StreamNotSeekableException
     * @throws UnableToSeekStreamException
     */
    public function seek($offset, $whence = SEEK_SET) : void
    {
        $this->assertPropertyStream();

        if (!$this->seekable) {
            throw new StreamNotSeekableException(
                'Le stream n\'est pas seekable.'
            );
        }

        $offset = (int)$offset;
        $whence = (int)$whence;

        if (fseek($this->stream, $offset, $whence) === -1) {
            throw new UnableToSeekStreamException();
        }
    }

    /**
     * @return void
     * @throws StreamDontExistException
     * @throws StreamNotSeekableException
     * @throws UnableToSeekStreamException
     */
    public function rewind() : void
    {
        $this->seek(0);
    }

    /**
     * @param $string
     * @return int
     * @throws StreamDontExistException
     * @throws UnableToWriteStreamException
     */
    public function write($string) : int
    {
        $this->assertPropertyStream();

        $size = 0;

        if ($this->isWritable()) {
            $size = fwrite($this->stream, $string);
        }

        if ($size === false) {
            throw new UnableToWriteStreamException(
                'Impossible d\'écrire le stream.'
            );
        }

        $this->size = null;

        return $size;
    }

    /**
     * @param $length
     * @return string
     * @throws StreamDontExistException
     * @throws UnableToReadStreamException
     */
    public function read($length) : string
    {
        $this->assertPropertyStream();

        $string = false;

        if ($this->isReadable()) {
            $string = fread($this->stream, $length);
        }

        if ($string === false) {
            throw new UnableToReadStreamException(
                'Impossible de lire le contenu du stream.'
            );
        }

        return $string;
    }

    /**
     * @return string
     * @throws StreamDontExistException
     * @throws UnableToReadStreamException
     */
    public function getContents() : string
    {
        $this->assertPropertyStream();

        $string = false;

        if ($this->isReadable()) {
            $string = stream_get_contents($this->stream);
        }

        if ($string === false) {
            throw new UnableToReadStreamException(
                'Impossible de lire le contenu du stream.'
            );
        }

        return $string;
    }

    /**
     * @param $key
     * @return array|mixed|null
     */
    public function getMetadata($key = null) : mixed
    {
        if ($this->isStream()) {
            $this->meta = stream_get_meta_data($this->stream);

            if (!$key) {
                return $this->meta;
            }

            if (isset($this->meta[$key])) {
                return $this->meta[$key];
            }
        }

        return null;
    }

    /**
     * @return string
     * @throws StreamDontExistException
     * @throws StreamNotSeekableException
     * @throws UnableToReadStreamException
     * @throws UnableToSeekStreamException
     */
    public function __toString() : string
    {
        if ($this->isSeekable()) {
            $this->rewind();
        }

        return $this->getContents();
    }

    /**
     * @param $stream
     * @return void
     * @throws InvalidStreamFormatException
     */
    protected function assertStream($stream) : void
    {
        if (!is_resource($stream)) {
            throw new InvalidStreamFormatException(
                'Le stream doit être une ressource.'
            );
        }
    }

    /**
     * @return void
     * @throws StreamDontExistException
     */
    protected function assertPropertyStream() : void
    {
        if (!$this->isStream()) {
            throw new StreamDontExistException(
                'La ressource Stream n\'existe pas.'
            );
        }
    }

    /**
     * @return bool
     */
    protected function isStream() : bool
    {
        return isset($this->stream) && is_resource($this->stream);
    }
}
