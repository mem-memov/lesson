<html>
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title><?php echo $data['title']; ?></title>

    <!--link rel="shortcut icon" type="image/ico" href="client/icons/logo.png" /-->

    <?php foreach($data['styles'] as $style): ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $style; ?>"/>
    <?php endforeach; ?>

    <?php foreach($data['scripts'] as $script): ?>
    <script type="text/javascript" src="<?php echo $script; ?>"></script>
    <?php endforeach; ?>

</head>
<body>
    <div class="Start">
        
        <div class="top">
            <ul class="menu">
                <li><a href="/learn/">Научиться</a></li>
                <li><a href="/pay/">Оплатить</a></li>
                <li><a href="/teach/">Обучить</a></li>
                <li><a href="/cashout/">Получить</a></li>
                <li><a href="/signout/">Выход</a></li>
            </ul>
        </div>
        
        <div class="middle">
            <?php echo $data['content']; ?>
        </div>
        
    </div>
</body>
</html>