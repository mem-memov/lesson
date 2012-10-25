Творческая мастерская
<br />
<a href="/lesson/create/">Создать урок</a>
<br />

<?php if (!empty($data['lesson_ids'])): ?>
<ul>
    <?php foreach ($data['lesson_ids'] as $index => $lessonId): ?>
    <li>
    <a href="/lesson/to-teacher/<?php echo $lessonId; ?>/"><?php echo $data['lesson_titles'][$index]; ?></a>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>