<h1 style="display: flex; align-items: center;">
<img src="https://mycode.freewebhostmost.com/downloads/aqua.png" height="45" alt="react logo"  />
AquaPHP
</h1> 

#### *🚀  This is AquaPHP custom MVC framework.*



## 🧠 Authors

- [@Soubhik2](https://github.com/Soubhik2/CORE-PHP)

## 📀 Used technology 
<div align="left">
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" height="40" alt="react logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" height="40" alt="bootstrap logo"  />
</div>

## 🛠️ Installation Steps

### 1. Manually Installation

*Please download this file and save it in the 'htdocs' folder of your XAMPP installation.*

### Then change `AquaPHP` to your 📁 `{folder}` name 


#### This is in your project folder first 📄 `.htaccess` file.
```
Options -Indexes

RewriteEngine On
RewriteBase /AquaPHP/ <--- change here
RewriteRule ^index\\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /CPHP/index.php [L] <--- change here
```

#### for project deploy

```
Options -Indexes

RewriteEngine On
RewriteBase /
RewriteRule ^index\\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
```

#### And now change on 📄 `index.php`.
```php
$pass_url = 'AquaPHP';
```
### OR 
### Run `setup.py` and run `init` command
### Now run your project.
[http://localhost/AquaPHP/](http://localhost/AquaPHP/) <--- change this to your file name

## 🍰 Features

- MVC Ready
- Easy to package install using `setup.py`
- Very simple
- Easy to use

## 💲 Environment Variables

`BASEPATH`
`BASEURL`
`$request`
`$requests`
`$viewDir`
`$pass_url`

#### Those are very important variables.

## 📝 Documentation

### 🚀 How to use ?

- [Configuration](#Configuration)
- [Views](#Views)
- [Routers](#Routers)
- [Controller](#Controller)
- [Model](#Model)
- [Database](#Database)
- [Input](#Input)
- [Session](#Session)
- [Authentication](#Authentication)

### 🔻 <span id="Configuration">Configuration</span>

You can locate it in the 📄 config.json file of your project's 📁 AquaPHP folder.

You can configure your project here

```json
{
    "name": "AquaPHP",
    "version": "1.0.0",
    "description": "AquaPHP is a MVC framework",
    "main": "index.php",
    "type": "php framework",
    "config": {
        "project": "development",
        "view_dir": "/app/views/",
        "controller_dir": "/app/controller/",
        "model_dir": "/app/model/",
        "router_dir": "/app/router/",
        "database": {
            "host": "localhost",
            "username": "root",
            "password": "",
            "database": "javajdbc"
        }
    },
    "author": "Soubhik Mukherjee",
    "license": "ISC",
    "dependencies": {
        "database": {
            "enable": true,
            "path": "database"
        }
    }
}
```

**⚪ development configuration**

```php
// development, deploy
"project": "development"
```
`development` is for show errors and warnings. <br>
`deploy` is for hide errors and warnings.

### 🔻 <span id="Views">Views</span>

**You can locate it in the 📁 app/views folder.<br>
Here you can add you views files like `welcome.php`**

### 🔻 <span id="Routers">Routers</span>

You can locate it in the 📄 Routes.php file of your project's 📁 app/router folder.

This is a very basic index routing,
```php 
$this->app->get("/",function($req, $res){
    $res->status(200)->render('welcome',["name"=>"ram", "user"=>["name"=>"sam"]]);
});
```

It's get 📄 file from 📁 app/views folder

__Dynamic paths__
```php
$this->app->get("/blog/{id}",function($req, $res){
    echo $req->params->id; // <- to get id
});
```

__Request `$req`__

It's get all incoming requests like `params` `query` `body` `cookie` `session`

__Accessing form data__

`Using POST, GET, COOKIE, or SERVER Data`

AquaPHP Framework comes with `$res` class that let you fetch POST, GET, COOKIE or SERVER items. The main advantage of using the provided methods rather than fetching an item directly ($_POST['something']) is that the methods will check to see if the item is set and return NULL if not. This lets you conveniently use data without having to test whether an item exists first. In other words, normally you might do something like this:

```php
$something = isset($_POST['something']) ? $_POST['something'] : NULL;
```

With Our’s built in class you can simply do this:

```php
$this->app->get("/blog",function($req, $res){
    echo $req->body->something;
});

```

**GET**

**This method is identical to post(), only it fetches GET data.**
```php
$this->app->get("/blog?something=name",function($req, $res){
    echo $req->query->something;
});
```

**COOKIES**

**This method is identical to post() and get(), only it fetches cookie data:**
```php
$this->app->get("/blog",function($req, $res){
    echo $req->cookie->something;
});
```

**Retrieving Session Data**

Any piece of information from the session array is available through the $_SESSION superglobal:
```php
$this->app->get("/blog",function($req, $res){
    echo $req->session->something;
});
```

__Response `$res`__

AquaPHP Framework comes with a `$req` class that lets you use it to send and render views.

__Send Views__

```php
$this->app->get("/blog",function($req, $res){
    $res->send('welcome');
});
```

You can also modify the HTTP response status.
```php
$this->app->get("/blog",function($req, $res){
    $res->status(200);
    $res->send('welcome');
});

OR

$this->app->get("/blog",function($req, $res){
    $res->status(200)->send('welcome');
});
```
__Rander Views__

Remember, you can use the render method to pass variables from the controller to views.
```php
$this->app->get("/blog",function($req, $res){
    $res->render('welcome');
    //OR
    $res->render('welcome',["name"=>"ram", "user"=>["name"=>"sam"]]);
});
```

__JSON Views__

You can use the json method to send JSON as a response.

```php
$this->app->get("/blog",function($req, $res){
    $res->json(["name"=>"game", "user"=>"hi"]);
});
```

__Redirect Views__

You can redirect pages using the redirect method.
```php
// This redirect only works for this project.
$this->app->get("/blog",function($req, $res){
    $res->redirect("home"); // home --> http://localhost/AquaPHP/home.
});
```
If you want to redirect to a different URL, use the following code.
```php
$this->app->get("/blog",function($req, $res){
    $res->redirect("https://example.com/", false);
});
```


**COOKIES**

For setting cookies
```php
$this->app->get("/blog",function($req, $res){
    $res->cookie('pass','hello');
});
```

**Adding Session Data**
```php
$this->app->get("/blog",function($req, $res){
    $res->session('pass','hello');
});
```
**Adding Session Data By Array**
```php
$this->app->get("/blog",function($req, $res){
    $res->session(["user"=>"name", "pass"=>"pass"]);
});
```


### 🔻 <span id="Database">Database</span>

**Using the Database Class**

**Initializing a Database**

You can locate it in the 📄 config.json file of your project's main folder and set:

```json
"dependencies": {
    "database": {
        "enable": true,
        "path": "database"
    }
}

// OR To disable the database, you should do the following.
"dependencies": {
    "database": {
        "enable": false,
        "path": "database"
    }
}
```

You can locate it in the 📄 config.json file of your project's main folder.

**Configure your database here.**
```json
"config": {
    "database": {
        "host": "localhost",
        "username": "root",
        "password": "",
        "database": "samething"
    }
}
```

This framework use `$this->db` object but it also support `$this->conn` OOPS `mysqli`

**So you can also use 🔻**
```php
$sql = "SELECT * FROM student";
$result = $this->conn->query($sql);
```

This framework have `$database` object and query builder classes for easy usage

#### 🚀 How to use `$database`, `CRUD` ?

**<span id="SELECT">Example SELECT Data from Database</span>**

```php
// 1. mysqli example
$sql = "SELECT * FROM mytable";
$result = $this->conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<pre>';
        print_r($row);
        echo '</pre>';
    }
} else {
    echo "0 results";
}


//2. Our $database object
$sql = "SELECT * FROM mytable";
$result = $this->db->query($sql)->get(); // It's return as a array of objects
```
**Query Builder Class**

- [Selecting Data](#Selecting_Data)
- [Looking for Specific Data](#Looking_for_Specific_Data)
- [Looking for Similar Data](#Looking_for_Similar_Data)
- [Counting and Results](#Counting_and_Results)
- [Inserting Data](#Inserting_Data)
- [Updating Data](#Updating_Data)
- [Deleting Data](#Deleting_Data)

Our `$this->db` object hava also support's `Query Builder Class`

**🔻 <span id="Selecting_Data">Selecting Data</span>**

The following functions allow you to build SQL SELECT statements.<br>
`$this->db->select();` 

Runs the selection query and returns the result. Can be used by itself to retrieve all records from a table:
```php
$query = $this->db->select('mytable'); // Produces: SELECT * FROM mytable
```
The second parameters enable you to set a where, limit and offset clause:

```php
$query = $this->db->select("mytable", "WHERE `name` = 'anything'");
$query = $this->db->select("mytable", "LIMIT 20, 10");

// Executes: SELECT * FROM mytable WHERE `name` = 'anything'
// Executes: SELECT * FROM mytable LIMIT 20, 10
// (in MySQL. Other databases have slightly different syntax)
```

The third parameters enable you to set select fields:
```php
$this->db->select("student", null, ["name"]);
// Executes: SELECT `name` FROM mytable
```

You’ll notice that the above function is assigned to a variable named $query, which can be used to show the results:
```php
$query = $this->db->select('mytable');

foreach ($query->get() as $row)
{
    echo $row->title;
}
```

**🔻 <span id="Looking_for_Specific_Data">Looking for Specific Data</span>**


This function enables you to set WHERE clauses using one of four methods:

**1. Simple key/value method:**

```php
$this->db->select("mytable", "WHERE `name` = 'Joe'");
// Produces: SELECT * FROM mytable WHERE name = 'Joe'

$this->db->select("mytable", ["name"=>"Joe"]);
// Produces: SELECT * FROM mytable WHERE name = 'Joe'
```
Notice that the equal sign is added for you.

If you use multiple function calls they will be chained together with AND between them:

```php
$this->db->select("mytable", ["name"=>$name, "title"=>$title, "status", $status]);

// WHERE name = 'Joe' AND title = 'boss' AND status = 'active'
```

**2. Custom key/value method:**

```php
$this->db->select("mytable", ["name !="=>$name, "id <"=>$id]);
// Produces: WHERE name != 'Joe' AND id < 45
```

This function is identical to the one above, except that multiple instances are joined by OR:

```php
$this->db->select("mytable", ["name !="=>$name, "or id <"=>$id]);
// Produces: WHERE name != 'Joe' OR id > 50
```

**🔻 <span id="Looking_for_Similar_Data">Looking for Similar Data</span>**

This method enables you to generate LIKE clauses, useful for doing searches.

**1. Simple key/value method:**

```php
$this->db->select("mytable", ["title like"=>"%match%"]);
// Produces: WHERE `title` LIKE '%match%'
```

If you use multiple method calls they will be chained together with AND between them:
```php
$this->db->select("mytable", ["title like"=>"%match%", "body like"=>"%match%"]);
// WHERE `title` LIKE '%match%' AND `body` LIKE '%match%
```

This method is identical to the one above, except that multiple instances are joined by OR:

```php
$this->db->select("mytable", ["title like"=>"%match%", "or body like"=>"%match%"]);
// WHERE `title` LIKE '%match%' OR `body` LIKE '%match%
```
**🔻 <span id="Counting_and_Results">Counting and Results</span>**

Permits you to determine the number of rows in a particular Active Record query. Queries will accept Query Builder restrictors such as where(), or_where(), like(), or_like(), etc. Example:
```php
echo $this->db->select('mytable')->count();  // Produces an integer, like 25
```


```php
$result = $this->db->select('mytable')->get();  // It's produces an object
```

Our database supports the `get(function)` object callback.

```php
$this->db->select("student", null, ["name"])->get(function ($value){
    print_r($value); // It's produces rows as objects.
});

// OR you can also do

$result = $this->db->select("mytable")->get(function ($value){
    $value->name = 'any'; // You have the option to adjust the values.
    return $value; // Return the modified values
});
```

```php
$result = $this->db->select('mytable')->get(fn($v)=>(array)$v);  // It's produces an array
```

```php
$result = $this->db->select('mytable')->get(fn($v)=>json_encode($v));  // It's produces an json
```
Completely use our callbacks object, Example.
```php
$result = $this->db->select("student", ["name like"=>"%jon%"])->get(function($value){
    $arr = $this->db->select("contact", ["id"=>$value->id])->get()[0];

    foreach ($arr as $key => $element) {
        $value->$key = $element;
    }

    return $value;
});
```

**🔻 <span id="Inserting_Data">Inserting Data</span>**

`$this->db->insert()`

Generates an insert string based on the data you supply, and runs the query. You can either pass an array or an object to the function. Here is an example using an array:

```php
$data = array(
        'title' => 'My title',
        'name' => 'My Name',
        'date' => 'My date'
);

$result = $this->db->insert('mytable', $data);
if($result->value){
    echo "DONE";
}else{
    echo "ERROR";
}

// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
```

Our `insert` method supports `then`&`catch`.
```php
$data = array(
        'title' => 'My title',
        'name' => 'My Name',
        'date' => 'My date'
);

$this->db->insert('mytable', $data)->then(function($v){
    print_r("DONE");
})->catch(function($e){
    print_r("ERROR: ".$e);
});

// Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
```

**🔻 <span id="Updating_Data">Updating Data</span>**

`$this->db->update`

Generates an update string and runs the query based on the data you supply. You can pass an **array** or an **object** to the function. Here is an example using an array:

```php
$data = array(
        'title' => $title,
        'name' => $name,
        'date' => $date
);

$this->db->update('mytable', ["id"=>$id], $data);

if($result->value){
    echo "DONE";
}else{
    echo "ERROR";
}

// Produces:
//
//      UPDATE mytable
//      SET title = '{$title}', name = '{$name}', date = '{$date}'
//      WHERE id = $id
```

Our `update` method supports `then`&`catch`.
```php
$data = array(
        'title' => $title,
        'name' => $name,
        'date' => $date
);

$this->db->update('mytable', ["id"=>$id], $data)->then(function($v){
    print_r("DONE");
})->catch(function($e){
    print_r("ERROR: ".$e);
});

// Produces:
//
//      UPDATE mytable
//      SET title = '{$title}', name = '{$name}', date = '{$date}'
//      WHERE id = $id
```

**🔻 <span id="Deleting_Data">Deleting Data</span>**

`$this->db->delete()`

Generates a delete SQL string and runs the query.

```php
$this->db->delete('mytable', ["id"=>$id]); // Produces: DELETE FROM mytable WHERE id = $id
```

Our `delete` method supports `then`&`catch`.
```php
$this->db->delete('mytable', ["id"=>$id])->then(function($v){
    echo "DONE";
})->catch(function($e){
    echo "ERROR";
});

// Produces: DELETE FROM mytable WHERE id = $id
```


### 🔻 <span id="Input">Input</span>

**Using the Input Class**

**Initializing a Input**

You can locate it in the 📄 autoload.php file of your project's 📁 app/config folder and set:
```
$autoload['input'] = true;
```

The Input Class serves two purposes:

1. It pre-processes global input data for security.
2. It provides some helper methods for fetching input data and pre-processing it.

**Accessing form data**<br>
`Using POST, GET, COOKIE, or SERVER Data`

CORE PHP Framework comes with helper methods that let you fetch POST, GET, COOKIE or SERVER items. The main advantage of using the provided methods rather than fetching an item directly ($_POST['something']) is that the methods will check to see if the item is set and return NULL if not. This lets you conveniently use data without having to test whether an item exists first. In other words, normally you might do something like this:

```php
$something = isset($_POST['something']) ? $_POST['something'] : NULL;
```

With Our’s built in methods you can simply do this:
```php
$something = $input->post('something');
```

The main methods are:

- `$input->post()`
- `$input->get()`
- `$input->cookie()`

**POST**

**The first parameter will contain the name of the POST item you are looking for:**

```
$input->post('some_data');
```

The method returns NULL if the item you are attempting to retrieve does not exist.

The second optional parameter lets you run the data through the XSS filter. It’s enabled by setting the second parameter to boolean TRUE or by setting your $config['global_xss_filtering'] to TRUE.
```
$input->post('some_data', TRUE);
To return an array of all POST items call without any parameters.
```
To return all POST items and pass them through the XSS filter set the first parameter NULL while setting the second parameter to boolean TRUE.
```
$input->post(NULL, TRUE); // returns all POST items with XSS filter
$input->post(NULL, FALSE); // returns all POST items without XSS filter
```

**GET**

**This method is identical to post(), only it fetches GET data.**
```
$input->get('some_data', TRUE);
To return an array of all GET items call without any parameters.
```
To return all GET items and pass them through the XSS filter set the first parameter NULL while setting the second parameter to boolean TRUE.
```
$input->get(NULL, TRUE); // returns all GET items with XSS filter
$input->get(NULL, FALSE); // returns all GET items without XSS filtering
```

**COOKIES**

**This method is identical to post() and get(), only it fetches cookie data:**
```
$input->cookie('some_cookie');
$input->cookie('some_cookie', TRUE); // with XSS filter
```

For setting cookies
```
$input->set_cookie("name1","hello");
```
syntax
```
$input->set_cookie($name, $value, $expires, $path, $domain, $secure, $httponly);
```

### 🔻 <span id="Session">Session</span>

**Using the Session Class**

**Initializing a Session**

To initialize the Session class manually:

You can locate it in the 📄 autoload.php file of your project's 📁 app/config folder and set:
```
$autoload['session'] = true;
```
Once loaded, the Sessions library object will be available using:
```
$session
```

**Retrieving Session Data**

Any piece of information from the session array is available through the $_SESSION superglobal:
```
$_SESSION['item']
```
Or through the magic getter:
```
$session->item
```
And for backwards compatibility, through the userdata() method:
```
$session->userdata('item');
```
Where item is the array key corresponding to the item you wish to fetch. For example, to assign a previously stored ‘name’ item to the $name variable, you will do this:
```
$name = $_SESSION['name'];

// or:

$name = $session->name

// or:

$name = $session->userdata('name');
```

**Adding Session Data**

Let’s say a particular user logs into your site. Once authenticated, you could add their username and e-mail address to the session, making that data globally available to you without having to run a database query when you need it.

You can simply assign data to the `$_SESSION` array, as with any other variable. Or as a property of `session`.

Alternatively, the old method of assigning it as “userdata” is also available. That however passing an array containing your new data to the `set_userdata()` method:
```
$session->set_userdata('some_name', 'some_value');
```

If you want to verify that a session value exists, simply check with `isset()`:
```
// returns FALSE if the 'some_name' item doesn't exist or is NULL,
// TRUE otherwise:
isset($_SESSION['some_name'])
```
Or you can call `has_userdata()`:
```
$session->has_userdata('some_name');
```

**Removing Session Data**

Just as with any other variable, unsetting a value in `$_SESSION` can be done through `unset()`:
```
unset($_SESSION['some_name']);
// or multiple values:

unset(
        $_SESSION['some_name'],
        $_SESSION['another_name']
);
```

Also, just as `set_userdata()` can be used to add information to a session, `unset_userdata()` can be used to remove it, by passing the session key. For example, if you wanted to remove ‘some_name’ from your session data array:
```
$session->unset_userdata('some_name');
```

This method also accepts an array of item keys to unset:
```
$array_items = array('username', 'email');

$session->unset_userdata($array_items);
```

**Destroying a Session**

To clear the current session (for example, during a logout), you may simply use either PHP’s `session_destroy()` function, or the `sess_destroy()` method. Both will work in exactly the same way:
```
session_destroy();

// or

$session->sess_destroy();
```

### 🔻 <span id="Authentication">Authentication</span>

Authentication Library is a read to use auth system

**Using the Auth Class**

Initializing a Auth

It's support email and password verify it's `return object("error"=>0, "error_mess"=>"", "error_code"=>"");`

```
$autoload['auth'] = true; <- in the autoload.php
$auth = new Auth($database);
```
It's also support custom reference
```
$auth = new Auth($database, 'mytable', 'user', 'pass');
```
It's Default Table is `users` and fields are `email` and `password`, you can also customise this:
```
$auth->setTableName('mytable');
$auth->setEmailName('user');
$auth->setPasswordName('pass');
```

**Sign Up**
```
$arr =  [   // Those are extra fields
            "name"=>"user name",
            "phone"=>"+91 9000000000",
        ];
$result = $auth->signUp($email, $password, $arr);

if(!$result->error){
    echo "Successfully Signed up";
}else{
    echo $result->error_mess;
}
```
The 4th parameter is for disable email verify<br>
The 5th parameter is for disable password verify<br>
```
$result = $auth->signUp($email, $password, $arr, false, false);
//                                                 ^      ^    
```

**Sign in**
```
$result = $auth->signIn($email, $password);

if(!$result->error){
    echo "Successfully Signed in";
}else{
    echo $result->error_mess;
}
```

**Check Loggedin**
```
$auth->isLoggedin();

//or

if ($auth->isLoggedin()) {
    echo "YES";
} else {
    echo "NO";
}
```

**Get logged in User data**
```
$user = $auth->getUser();
```

**Logout**
```
$auth->logout();
```


<!--![Logo](https://cdn-icons-png.flaticon.com/128/528/528261.png)-->
<img src="https://static-00.iconduck.com/assets.00/php-icon-2048x2048-79jhb719.png" height="200" alt="react logo" />
<!--
<a id="hello"></a>
# Hello

## 🛠️ Installation Steps:
## 🍰 Contribution Guidelines:
## 🛡️ License: 🔻 ♢ ⚪
## 🚀 How to use ? ✔️ 💲

<h1> 
<img src="https://static-00.iconduck.com/assets.00/php-icon-2048x2048-79jhb719.png" height="25" alt="react logo" />
CORE-PHP 
</h1>

You can locate it in the configuration file of your project's app.
-->
