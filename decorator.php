<?php
/*
 * Example of a Decorator implementation.
 *
 * The idea of this example is that we are going to extend the save to database functionality to support
 * saving to cookie too.
 */
interface ItemsSaverInterface
{
    public function saveItems($data): void;
}

/**
 * Basic elements' saver. The old one.
 */
class InSessionSaver implements ItemsSaverInterface
{
    /**
     * Saves data into the session.
     *
     * @param $data
     *
     * @return void
     */
    public function saveItems($data): void
    {
        // implement here the code need.
        echo "Saving data in the Session" . PHP_EOL;
    }
}

/**
 * The decorator.
 */
abstract class SaverDecorator implements ItemsSaverInterface
{
    private ItemsSaverInterface $saver;

    public function __construct(ItemsSaverInterface $saver)
    {
        $this->saver = $saver;
    }

    public function saveItems($data): void
    {
        echo $this->saver->saveItems($data) . PHP_EOL;
    }
}

/**
 * A decorator to add `Cookie` functionality.
 */
class InCookieSaver extends SaverDecorator
{
    /**
     * Decorates/overrides the decorated object.
     *
     * @param $data
     *
     * @return void
     */
    public function saveItems($data): void
    {
        // basically, save data in the session
        parent::saveItems($data);
        // extends it to save it in the cookie too.
        echo "... Cookies" . PHP_EOL;
    }
}

/**
 * A decorator to add `File` functionality.
 */
class InFileSaver extends SaverDecorator
{
    public function saveItems($data): void
    {
        parent::saveItems($data);

        echo "... to File" . PHP_EOL;
    }
}

$saver = new InSessionSaver();

$inCookie = new InCookieSaver($saver);

$inFile = new InFileSaver($inCookie);

$inFile->saveItems(['key' => 'value']);