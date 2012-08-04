Анонс урока
<form method="post">
    Название: 
    <input type="text" name="title" value="<?php echo $data['title']; ?>"/>
    <br />
    Краткое описание:
    <br />
    <textarea name="description"><?php echo $data['description']; ?></textarea>
    <br />
    <input type="submit" />
</form>