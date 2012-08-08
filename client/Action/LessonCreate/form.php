Анонс урока
<form method="post">
    
    Название: 
    <input type="text" name="title" value="<?php echo $data['title']; ?>"/>
    <?php if($data['errors']['title_missing']): ?>
    <i>Укажите название!!!</i>
    <?php endif; ?>
    <br />
    
    Краткое описание:
    <br />
    <textarea name="description"><?php echo $data['description']; ?></textarea>
    <br />
    
    <input type="submit" />
    
</form>