<?php

class BankAccount
{
    /**
     * @var int
     */
    private $accountNumber;
    /**
     * @var string|null
     */
    private $owner;
    /**
     * @var string|null
     */
    private $branch;

    public function setAccountNumber(int $accountNumber): void
    {
        $this->accountNumber = $accountNumber;
    }

    public function setOwner(?string $owner): void
    {
        $this->owner = $owner;
    }

    public function setBranch(?string $branch): void
    {
        $this->branch = $branch;
    }
}

class AccountBuilder
{
    /**
     * @var int
     */
    private $accountNumber;
    /**
     * @var string
     */
    private $owner;
    /**
     * @var string
     */
    private $branch;

    public function __construct(int $accountNumber = 0)
    {
        $this->accountNumber = $accountNumber;
    }

    public function withOwner(string $owner): AccountBuilder
    {
        $this->owner = $owner;
        return $this;
    }

    public function atBranch(string $branch): AccountBuilder
    {
        $this->branch = $branch;
        return $this;
    }

    public function build(): BankAccount
    {
        $account = new BankAccount();
        $account->setAccountNumber($this->accountNumber);
        $account->setOwner($this->owner);
        $account->setBranch($this->branch);

        return $account;
    }
}

$account = (new AccountBuilder(50))
    ->withOwner("Homer")
    ->build();

$account2 = (new AccountBuilder(51))
    ->atBranch("Spring Time")
    ->build();

$account3 = (new AccountBuilder())
    ->withOwner("Jolly")
    ->atBranch("Branchy")
    ->build();

var_dump($account);
var_dump($account2);
var_dump($account3);

/*
The output:

designpatternsphp\Builder\index.php:88:
object(BankAccount)[2]
  private 'accountNumber' => int 50
  private 'owner' => string 'Homer' (length=5)
  private 'branch' => null

designpatternsphp\Builder\index.php:89:
object(BankAccount)[3]
  private 'accountNumber' => int 51
  private 'owner' => null
  private 'branch' => string 'Spring Time' (length=11)

designpatternsphp\Builder\index.php:90:
object(BankAccount)[4]
  private 'accountNumber' => int 0
  private 'owner' => string 'Jolly' (length=5)
  private 'branch' => string 'Branchy' (length=7)
*/