<?php
require_once('./db.php');
try{
    $stmt = $pdo->query('SELECT posts.*, categories.name as category_name FROM posts join categories on posts.category_id = categories.id');
    $posts = $stmt->fetchAll();

    $stmt = $pdo->query('SELECT * FROM categories');
    $categories = $stmt->fetchAll();
    
} catch(PDOException $e){
    die ('Error: ' . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        margin-left: auto;
        margin-right: auto;
        width: 50%;
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f5f5f5;
    }

    div {
        margin-bottom: 1rem;
        padding: 1rem;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        list-style: none !important;
        width: 50%;
        border-left: 5px solid #007bff;
        padding-left: 30px;
        margin-bottom: 25px;
    }

    ul {
        display: flex;
    }

    li {
        margin-right: 10px;
        list-style: none;
        padding: 10px;
        background-color: #007bff;
        border-radius: 10px;
        width: 20%;
        text-align: center;
        color: white;
    }

    h2 {
        margin-bottom: 1px;
    }
    </style>
</head>

<body>
    <h1>Posts:</h1>
    <?php foreach($posts as $post):?>
    <?php
        $stmt = $pdo->prepare("SELECT tags.name FROM post_tags JOIN tags ON post_tags.tag_id = tags.id WHERE post_tags.post_id = :post_id");
        $stmt->execute(['post_id' => $post['id']]);
        $tags = $stmt->fetchAll();    
        ?>
    <div>
        <h2><?php echo $post['title'];?></h2>
        <hr>
        <p><?php echo $post['text'];?></p>
        <p>
            <b>Category:</b> <?=$post['category_name']?>
        </p>
        <p><b>Tags:</b></p>
        <ul>
            <?php foreach($tags as $tag):?>
            <li>
                <?=$tag['name']?>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php endforeach;?>
    </ul>
</body>

</html>