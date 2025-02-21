<h1 style="display: flex; align-items: center;">
<img src="https://github.com/Soubhik2/AquaPHP/blob/master/public/asset/aqua.png" height="45" alt="logo"  />
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

Run 
```
git clone https://github.com/Soubhik2/AquaPHP.git your_folder_name
```
to download the repository.

### 1. Script Installation

There are two ways to initialize this repository.

- via setup.exe
- or setup.pyc

For setup by `setup.exe`, we need to run `setup.exe` first and then run the `init` command into it.

For setup by setup.pyc.<br>
To set up the project, first ensure Python is installed.<br>
After that, run the command 
```
pip install -r requirements.txt
```
Then, execute 
```
python setup.pyc
```
and finally, run the `init` command.

### 2. Manually Installation

*Please download the file and save it in the 'htdocs' folder of your XAMPP installation.*

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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Router extends AppRouter {
    public function router() {
        $this->app->get("/",function($req, $res){
            $res->status(200)->render('welcome');
        });
    }
}
```

The app router supports two methods: `$this->app->get()` and `$this->app->post()`.

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

### 🔻 <span id="Controller">Controller</span>

You should create a file named 📄 Home.php in the 📁 app/controller folder of your project.

This is a very basic Controller.
```php 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AppController {
    public function index($req, $res){
        $res->status(200)->render('welcome');
    }
}
```

Using a controller from the router.

**_The router callback is an internal controller._**

```php
$this->app->get("/",function($req, $res){
    $res->status(200)->render('welcome');
});
```

To use a controller, you should follow the code below:
```php
$this->app->get("/", "Home/index");
```
### 🔻 <span id="Model">Model</span>

You should create a file named 📄 Test.php in the 📁 app/controller folder of your project.

This is a very basic Model.
```php 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test {
    public function hello($str){
        return "Hello $str";
    }
}
```

To use the model, you should follow the code below:
```php
$Test = $this->model->test;
echo $Test->hello("someThing");
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

This framework have `$this->db` object and query builder classes for easy usage

#### 🚀 How to use `$this->db`, `CRUD` ?

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


//2. Our $this->db object
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


<!--![Logo](https://cdn-icons-png.flaticon.com/128/528/528261.png)-->
<!--<img src="https://static-00.iconduck.com/assets.00/php-icon-2048x2048-79jhb719.png" height="200" alt="react logo" />-->
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
