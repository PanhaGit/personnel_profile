<div class="layout-content">
    <header class="layout-header">
        <button id="toggleSidebar" class="toggle-btn">
            <i class="fa fa-bars"></i>
        </button>
        <h2>
            <?php
                $configPath = __DIR__ . "/../../../../public/config/app.php";
                if (file_exists($configPath)) {
                    $config = include $configPath;
                } else {
                    die("file not found: " . $configPath);
                }
                $timezone = isset($config['TIMEZONE']) ? $config['TIMEZONE'] : 'UTC';
                date_default_timezone_set($timezone);
                $date = new DateTime();
                echo $date->format('h:i A');
            ?>
        </h2>
    </header>

    <main class="layout-main">
        <h1>Welcome</h1>
    </main>
