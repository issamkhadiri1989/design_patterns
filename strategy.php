<?php
/*
 * we do have several algorithms of hashing, instead of putting all the code in a single method,
 * split each algorithm into a class and then switch between them at runtime when needed.
 * here the strategy pattern is important because all the EncrypterInterface implementation are similar, but
 * each of them uses its own business logic.
 *
 * if we need to add a new hasher, all what we need to add is a class that implements the EncrypterInterface and then
 * override the method encrypt() to implement the hashing algorithem.
 *
 * notice that the Hasher::setEncrypter() does not care about what object is used. it only calls the encrypt() method
 * in its hash() and everything is encapsulated the corresponding class object.
 */

/**
 * The implementation that should be respected by all implementing classes.
 */
interface EncrypterInterface
{
    public function encrypt(string $input): string;
}

/**
 * A MD5-Strategy implementation.
 */
class Md5Encrypter implements EncrypterInterface
{
    public function encrypt(string $input): string
    {
        return hash('md5', $input);
    }
}

/**
 * A Whirlpool-Strategy implementation.
 */
class WhirlpoolEncrypter implements EncrypterInterface
{
    public function encrypt(string $input): string
    {
        return hash('whirlpool', $input);
    }
}

/**
 * A SHA256-Strategy implementation.
 */
class Sha256Encrypter implements EncrypterInterface
{
    public function encrypt(string $input): string
    {
        return hash('sha256', $input);
    }
}

class Hasher
{
    private EncrypterInterface $encrypter;

    /**
     * Set the encrypter strategy at runtime.
     *
     * @param EncrypterInterface $encrypter
     */
    public function setEncrypter(EncrypterInterface $encrypter): void
    {
        $this->encrypter = $encrypter;
    }

    public function hash(string $input): void
    {
        echo "Encrypting {$input}...".PHP_EOL;
        echo $this->encrypter->encrypt($input).PHP_EOL;
    }
}


/*
 * We must be able to switch between hashing algorithms at runtime
 */
$hasher = new Hasher();
$hasher->setEncrypter(new Md5Encrypter());
$hasher->hash('123');

$hasher->setEncrypter(new Sha256Encrypter());
$hasher->hash('123');

$hasher->setEncrypter(new WhirlpoolEncrypter());
$hasher->hash('123');
