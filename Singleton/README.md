# Singleton design pattern
**The problem:**<br/>
The pattern refers to limiting the class creation to only one object. In other programming languages it is very important to limit the instance to only one because of thread pools, registries and cache.<br/>
An instance of a class is needed for the same run of a whole program, for example a connection to a database. 

<pre>
$connection1 = new Connection();
$userService = new UserService($connection1);

//..... in another file

$connection2 = new Connection();
$logsService = new LogsService($connection2);
</pre>

Where $connection1 and $connection2 point to the same MySQL instance. In this case, only one database connection can be used and passed to all services or components that communicate with the same database as before. 

**The solution of the design pattern:**<br/>
The class will have a constructor that is private, and a private static member instance. The class cannot be created from outside, only from inside, using a static method getInstance. Also, the getInstance will return "itself" instance. For cases when getInstance is called again, the class will not be created again because the instance is being already created.

**Java source example:**
<pre>
public class SingleObject {
    // Create an object of SingleObject
    private static SingleObject instance = new SingleObject();
    
    private String message;

    // Make the constructor private so that this class cannot be instantiated
    private SingleObject() {
        this.message = "Hello World!"; 
    }

    public static SingleObject getInstance() {
        return this.instance;
    }

    public void getMessage() {
        return this.message;
    }
}

public class SingletonPatternDemo {
    public static void main(String[] args) {
        // Illegal construct
        // Compile Time Error: The constructor SingleObject() is not visible
        // SingleObject object = new SingleObject();

        // Get the instance of the object
        SingleObject object = SingleObject.getInstance();

        // Show the message
        System.out.println(object.getMessage());
    }
}
</pre>

This example does not give enough information about how to use correct the Singleton design pattern so another example is needed for better understanding.

<pre>
class Singleton 
{ 
    // Static variable single_instance of type Singleton 
    private static Singleton single_instance = null; 
  
    // Variable of type String 
    public String s; 
  
    // Private constructor restricted to this class itself 
    private Singleton() 
    { 
        s = "Hello I am a string part of Singleton class"; 
    } 
  
    // Static method to create instance of Singleton class 
    public static Singleton getInstance() 
    { 
        if (single_instance == null) {
            single_instance = new Singleton(); 
        }
  
        return single_instance; 
    } 
} 

class Main 
{ 
    public static void main(String args[]) 
    { 
        // Instantiating Singleton class with variable x 
        Singleton x = Singleton.getInstance(); 
  
        // Instantiating Singleton class with variable y 
        Singleton y = Singleton.getInstance(); 
  
        // Instantiating Singleton class with variable z 
        Singleton z = Singleton.getInstance(); 
  
        // Changing variable of instance x 
        x.s = (x.s).toUpperCase(); 
  
        System.out.println("String from x is " + x.s); 
        System.out.println("String from y is " + y.s); 
        System.out.println("String from z is " + z.s); 
        System.out.println("\n"); 
  
        // Changing variable of instance z 
        z.s = (z.s).toLowerCase(); 
  
        System.out.println("String from x is " + x.s); 
        System.out.println("String from y is " + y.s); 
        System.out.println("String from z is " + z.s); 
    } 
} 

Output: 
String from x is HELLO I AM A STRING PART OF SINGLETON CLASS
String from y is HELLO I AM A STRING PART OF SINGLETON CLASS
String from z is HELLO I AM A STRING PART OF SINGLETON CLASS

String from x is hello i am a string part of singleton class
String from y is hello i am a string part of singleton class
String from z is hello i am a string part of singleton class
</pre>

The code example rewritten into PHP for the [first example](https://github.com/bulbulica2/designpatternsphp/blob/master/Singleton/index.php). <br/>
The code example rewritten into PHP for the [second example](https://github.com/bulbulica2/designpatternsphp/blob/master/Singleton/connection.php).

The code idea was taken from the following websites:
* https://www.tutorialspoint.com/design_pattern/singleton_pattern.htm
* https://www.geeksforgeeks.org/singleton-class-java/
