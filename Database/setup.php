<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPWH Database Setup</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 60px auto; padding: 20px; background: #f4f4f4; }
        h2 { color: #010066; }
        .box { background: white; border-radius: 8px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .ok   { color: green; }
        .fail { color: red; }
        .warn { color: orange; }
        ul { list-style: none; padding: 0; }
        li { padding: 6px 0; border-bottom: 1px solid #eee; }
        li:last-child { border-bottom: none; }
        .done-box { background: #e8f5e9; border: 1px solid #a5d6a7; border-radius: 8px; padding: 16px; text-align: center; margin-top: 20px; }
        a.btn { display: inline-block; margin-top: 14px; background: #010066; color: white; padding: 10px 24px; border-radius: 6px; text-decoration: none; }
        .warn-box { background: #fff3cd; border: 1px solid #ffc107; border-radius: 6px; padding: 12px; margin-top: 16px; font-size: 14px; }
    </style>
</head>
<body>
<h2>DPWH Job Sheet — Database Setup</h2>

<?php
$servername = "localhost";
$root_user  = "root";
$root_pass  = "";
$dbname     = "job_sheet_db";

$results = [];
$all_ok  = true;

// 1. Connect to MySQL (no database yet)
$conn = new mysqli($servername, $root_user, $root_pass);
if ($conn->connect_error) {
    echo '<div class="box"><p class="fail">&#10008; Cannot connect to MySQL: ' . htmlspecialchars($conn->connect_error) . '</p>'
        . '<p>Make sure your local server (XAMPP, WAMP, Laragon, etc.) is running and MySQL is started.</p></div>';
    exit();
}

// 2. Create database
$r = $conn->query("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$results[] = ['label' => "Create database `$dbname`", 'ok' => $r !== false];
if (!$r) $all_ok = false;

// 3. Select database
$conn->select_db($dbname);

// 4. Table: pending_forms
$sql_pending = "CREATE TABLE IF NOT EXISTS `pending_forms` (
    `id`               INT AUTO_INCREMENT PRIMARY KEY,
    `full_name`        VARCHAR(255) NOT NULL,
    `section_division` VARCHAR(255) NOT NULL,
    `description`      TEXT         NOT NULL,
    `date_of_filing`   DATE         NOT NULL,
    `date_received`    DATETIME     NOT NULL,
    `contact_no`       VARCHAR(50)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
$r = $conn->query($sql_pending);
$results[] = ['label' => 'Create table `pending_forms`', 'ok' => $r !== false, 'err' => $conn->error];
if (!$r) $all_ok = false;

// 5. Table: job_sheet
$sql_job = "CREATE TABLE IF NOT EXISTS `job_sheet` (
    `id`                       INT AUTO_INCREMENT PRIMARY KEY,
    `full_name`                VARCHAR(255)  NOT NULL,
    `section_division`         VARCHAR(255)  NOT NULL,
    `description`              TEXT          NOT NULL,
    `date_of_filing`           VARCHAR(50)   NOT NULL,
    `contact_no`               VARCHAR(50)   NOT NULL,
    `type`                     VARCHAR(50)   NOT NULL,
    `status`                   VARCHAR(50)   NOT NULL,
    `incident_type`            VARCHAR(100)  NOT NULL DEFAULT 'Service Request',
    `hardware_type`            VARCHAR(100)  DEFAULT 'N/A',
    `serial_number`            VARCHAR(100)  DEFAULT 'N/A',
    `brand_model`              VARCHAR(100)  DEFAULT 'N/A',
    `computer_name`            VARCHAR(100)  DEFAULT 'N/A',
    `application_description`  TEXT          DEFAULT NULL,
    `version`                  VARCHAR(100)  DEFAULT 'N/A',
    `connectivity_description` TEXT          DEFAULT NULL,
    `user_account_description` TEXT          DEFAULT NULL,
    `assessment`               TEXT          DEFAULT NULL,
    `actions_taken`            TEXT          DEFAULT NULL,
    `mode_of_filing`           VARCHAR(50)   NOT NULL,
    `fulfilled_by`             VARCHAR(255)  NOT NULL,
    `date_received`            VARCHAR(50)   NOT NULL,
    `date_completed`           VARCHAR(50)   NOT NULL,
    `reviewed_by`              VARCHAR(255)  NOT NULL,
    `addressed`                VARCHAR(10)   DEFAULT NULL,
    `satisfied`                VARCHAR(50)   DEFAULT NULL,
    `effective`                VARCHAR(50)   DEFAULT NULL,
    `comments`                 TEXT          DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
$r = $conn->query($sql_job);
$results[] = ['label' => 'Create table `job_sheet`', 'ok' => $r !== false, 'err' => $conn->error];
if (!$r) $all_ok = false;

$conn->close();
?>

<div class="box">
    <h3>Results</h3>
    <ul>
        <?php foreach ($results as $item): ?>
        <li>
            <?php if ($item['ok']): ?>
                <span class="ok">&#10004;</span> <?php echo htmlspecialchars($item['label']); ?>
            <?php else: ?>
                <span class="fail">&#10008;</span> <?php echo htmlspecialchars($item['label']); ?>
                <?php if (!empty($item['err'])): ?>
                    — <em class="fail"><?php echo htmlspecialchars($item['err']); ?></em>
                <?php endif; ?>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php if ($all_ok): ?>
<div class="done-box">
    <strong class="ok">&#10004; Database is ready!</strong><br><br>
    You can now log in with:<br>
    <strong>Username:</strong> admin &nbsp;&nbsp; <strong>Password:</strong> admin<br>
    <a class="btn" href="../index.html">Go to Login Page</a>
</div>
<?php else: ?>
<div class="box">
    <p class="fail">Some steps failed. Check the errors above and try again.</p>
</div>
<?php endif; ?>

<div class="warn-box">
    &#9888; <strong>Security note:</strong> Delete or rename this file (<code>Database/setup.php</code>) after setup is complete so it cannot be run again.
</div>

</body>
</html>
