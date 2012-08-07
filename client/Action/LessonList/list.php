Список уроков

<table>
    <?php foreach($data['lessons'] as $lesson): ?>
    <tr>
        <td><?php echo $lesson['title']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

