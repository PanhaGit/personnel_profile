---

## 🔌 How to Use DBConfig

In any PHP file, include the DBConfig class and call `getConnection()`.

```php
<?php
require 'DBConfig.php';

$db = DBConfig::getConnection();

$stmt = $db->prepare("SELECT * FROM skills");
$stmt->execute();
$users = $stmt->fetchAll();

print_r($users);
```
