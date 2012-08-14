Демонстрация части урока
<br />
<a href="">далее</a>
<br />
<?php foreach($data['part']['widgets'] as $widget): ?>

<?php if($widget['widget_type'] == 'text'): ?>
<p><?php echo $widget['text']; ?></p>
<?php endif; ?>


<?php endforeach; ?>
