Управление уроком

<h3><?php echo $data['title']; ?></h3>

<p><?php echo $data['description']; ?></p>

<br />
<a href="/lesson/part/create/<?php echo $data['id']; ?>/">Добавить часть</a>

<br />

<?php if (!empty($data['part_ids'])): ?>
<ul>
    <?php foreach ($data['part_ids'] as $partId): ?>
    <li>
    <a href="/lesson/part/edit/<?php echo $data['id']; ?>/<?php echo $partId; ?>/">X</a>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
