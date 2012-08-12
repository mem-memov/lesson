Редактирование части урока

<?php foreach($data['widgets'] as $widget): ?>

<?php if($widget['widget_type'] == 'text'): ?>
<p><?php echo $widget['text']; ?></p>
<?php endif; ?>

<?php endforeach; ?>

<form method="post" action="/lesson/part/edit/<?php echo $data['lesson_id']; ?>/<?php echo $data['part_id']; ?>/">
    <textarea name="text"></textarea>
    <input type="submit" name="create_text" value="Вставить текст">
</form>