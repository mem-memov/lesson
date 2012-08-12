Список уроков

<table>
    <?php foreach($data['lessons'] as $lesson): ?>
    <tr>
        <td>
            <a href="/lesson/show/<?php echo $lesson['id']; ?>/"><?php echo $lesson['title']; ?></a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

