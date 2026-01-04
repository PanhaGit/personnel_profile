---

# Go to view dashboard

```php
http://localhost/personnel_profile/template/view/dashboard/index.php?page=dashboard
```

if you localhost with post

```
http://localhost:{port_number}/personnel_profile/template/view/dashboard/index.php?page=dashboard
```

### File Helper.php

```php
<?php
function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}

```

### when we call dd()

include_once **DIR** . "/Helper.php"

```
$data = $this->skillsService->getAllSkills();
dd($data);
```

## 🔌 How to Use DBConfig

In any PHP file, include the DBConfig class and call `getConnection()`.

```php
<?php
require 'Database.php';

$db = DBConfig::getConnection();

$stmt = $db->prepare("SELECT * FROM skills");
$stmt->execute();
$skills = $stmt->fetchAll();

print_r($skills);
```

```
CREATE DATABASE portfolio

Can change variable in file
```

<a href="https://github.com/PanhaGit/personnel_profile/blob/master/config/app.php">Click this if want to change variable connection to database MYSQL</a>

### USE MYSQL PDO
