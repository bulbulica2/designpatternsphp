# Builder design pattern
**The problem:**<br/>
The constructor has a lot of parameters, some of them are mandatory (or not) and a lot of them are optional. 

In order to use this class, a programmer needs to construct it with all the parameters and there might be a lot of null values:<br/> 
<pre>$customObject = new CustomObject(1, null, null, null, null);</pre>

Or it is needed only with the first parameter and the last parameter and the others will be null. <br/>
<pre>$customObject = new CustomObject(1, null, null, null, 2);</pre>

The class has only a constructor and getters. In will be closed for changing, once it is instantiated, so the values will not be modified on the whole runtime process.

**The solution of the design pattern:**<br/>
Create a dynamic class that will return its instance with only the needed parameters using functional programming.

**Explications for the PHP solution:**<br/>
Because in PHP we can't write nested classes, the solution is to create 2 different classes, one with setters and default constructor, and the other with the builder that matches exactly the example bellow only with setters that return the current instance. The build method will return the instance of the first class once it was created, and the values were added to it.

**Java source example:**
<pre>
public class BankAccount {

    public static class Builder {

        private long accountNumber; //This is important, so we'll pass it to the constructor.
        private String owner;
        private String branch;

        public Builder(long accountNumber) {
            this.accountNumber = accountNumber;
        }

        public Builder withOwner(String owner){
            this.owner = owner;

            return this; //By returning the builder each time, we can create a fluent interface.
        }

        public Builder atBranch(String branch){
            this.branch = branch;

            return this;
        }

        public BankAccount build(){
            //Here we create the actual bank account object, which is always in a fully initialised state when it's returned.
            BankAccount account = new BankAccount();  //Since the builder is in the BankAccount class, we can invoke its private constructor.
            account.accountNumber = this.accountNumber;
            account.owner = this.owner;
            account.branch = this.branch;
            
            return account;
        }
    }
    
    //Fields omitted for brevity.
    private BankAccount() {
        //Constructor is now private.
    }

    //Getters and setters omitted for brevity.
    
}

BankAccount account = new BankAccount.Builder(1234L)
            .withOwner("Marge")
            .atBranch("Springfield")
            .build();

BankAccount anotherAccount = new BankAccount.Builder(4567L)
            .withOwner("Homer")
            .atBranch("Springfield")
            .build();
</pre>

The code idea was taken from the following website: https://dzone.com/articles/design-patterns-the-builder-pattern
