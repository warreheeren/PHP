<?php
require_once('./db.php');
try{
    $stmt = $pdo->query('SELECT * FROM categories');
    $categories = $stmt->fetchAll();

    $stmt = $pdo->query('SELECT * FROM tags');
    $tags = $stmt->fetchAll();
    
} catch(PDOException $e){
    die ('Error: ' . $e->getMessage());
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $pdo->beginTransaction();
    $stmt = $pdo->prepare('INSERT INTO posts (title,text,category_id) VALUES (:title,:text,:category_id)');
    $stmt->execute([
        'title' => $_POST['title'],
        'text' => $_POST['text'],
        'category_id' => $_POST['category_id']
    ]);

    $post_id = $pdo->lastInsertId();
    foreach($_POST['tags'] as $tag_id){
    $stmt = $pdo->prepare('INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id,:tag_id)');
    $stmt->execute([
        'post_id' => $post_id,
        'tag_id' => $tag_id
    ]);
}
    $pdo->commit();
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add post</title>
    <style>
    label,
    div {
        margin-bottom: 3px;
        padding: 5px;
    }
    </style>
</head>

<body>

    <h1>Add post</h1>

    <form action="" method="post">
        <div>
            <input type="text" name="title" id="title" placeholder="Title" required>
        </div>
        <div>
            <textarea name="text" id="content" cols="30" rows="10" placeholder="Content" required></textarea>
        </div>
        <div>
            <label for="category">Category</label>
            <select name="category_id" id="category">
                <?php foreach($categories as $c): ?>
                <option value="<?= $c['id'] ?>">
                    <?= $c['name']?>
                </option>
                <?php endforeach ?>
            </select>
        </div>
        <div>
            <label>Tags</label>
            <?php foreach($tags as $t): ?>
            <div>
                <input type="checkbox" name="tags[]" id="tag-<?= $t['id']?>" value="<?= $t['id'] ?>">
                <label for="tag-<?= $t['id']?>"><?= $t['name']?></label>
            </div>
            <?php endforeach ?>
        </div>
        <div>
            <button type="submit">Add post</button>
        </div>
    </form>
</body>

</html>