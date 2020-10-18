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

class A
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

class B
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
$a = new A($singleton->getText());
$b = new B($singleton->getText());

var_dump($singleton);
var_dump($a);
var_dump($b);

/*
The output:

designpatternsphp\Singleton\index.php:65:
object(Singleton)[1]
  private 'text' => string 'This is the text.' (length=17)

designpatternsphp\Singleton\index.php:66:
object(A)[2]
  private 'text' => string 'This is the text.' (length=17)

designpatternsphp\Singleton\index.php:67:
object(B)[3]
  private 'text' => string 'This is the text.' (length=17)
*/