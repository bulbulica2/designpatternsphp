<?php

class Singleton
{
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * @var string
     */
    private $text;

    private function __construct(string $text)
    {
        $this->text = $text;
    }

    public static function getInstance(string $text): Singleton
    {
        if (!self::$instance) {
            self::$instance = new Singleton($text);
        }

        return self::$instance;
    }

    public function getText(): string
    {
        return $this->text;
    }
}

class First
{
    /**
     * @var string
     */
    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }
}

class Second
{
    /**
     * @var string
     */
    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }
}

$singleton = Singleton::getInstance("This is the text.");
$firstClass = new First($singleton->getText());
$secondClass = new Second($singleton->getText());

var_dump($singleton);
var_dump($firstClass);
var_dump($secondClass);

/*
The output:

designpatternsphp\Singleton\index.php:65:
object(Singleton)[1]
  private 'text' => string 'This is the text.' (length=17)

designpatternsphp\Singleton\index.php:66:
object(First)[2]
  private 'text' => string 'This is the text.' (length=17)

designpatternsphp\Singleton\index.php:67:
object(Second)[3]
  private 'text' => string 'This is the text.' (length=17)
*/