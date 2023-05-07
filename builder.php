<?php
/*
 * Example of a Builder implementation.
 *
 * The idea of this example is that we are going to build a path dynamically and then print the full path in the screen
 */
class Path
{
    private array $path = [];

    public function __construct()
    {
        // initialize here with S as the path construction has been marked.
        $this->path[] = 'S';
    }

    /**
     * Move a step to `UP`.
     *
     * @return $this
     */
    public function up(): Path
    {
        if ($this->isEnded() === false) {
            $this->path[] = 'UP';
        }

        return $this;
    }

    /**
     * Move a step to `DOWN`.
     *
     * @return $this
     */
    public function down(): Path
    {
        if ($this->isEnded() === false) {
            $this->path[] = 'DOWN';
        }

        return $this;
    }

    /**
     * Move a step to `LEFT`.
     *
     * @return $this
     */
    public function left(): Path
    {
        if ($this->isEnded() === false) {
            $this->path[] = 'LEFT';
        }

        return $this;
    }

    /**
     * Move a step to `RIGHT`.
     *
     * @return $this
     */
    public function right(): Path
    {
        if ($this->isEnded() === false) {
            $this->path[] = 'RIGHT';
        }

        return $this;
    }

    /**
     * Marks the end of the path.
     *
     * @return $this
     */
    public function end(): Path
    {
        if ($this->isEnded() === false) {
            $this->path[] = 'E';
        }

        return $this;
    }

    /**
     * Transforms the Path into a string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return implode(' > ', $this->path) . PHP_EOL;
    }

    /**
     * Check that the end has been reached.
     *
     * @return bool
     */
    private function isEnded(): bool
    {
        return end($this->path) === 'E';
    }
}

$path = (new Path())
    ->up()
    ->up()
    ->left()
    ->up()
    ->right()
    ->end()
    ->left();

echo $path;