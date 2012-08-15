Пополнение счёта
<br />

На счёте: <?php echo $data['amount']; ?>
<br />

<form method="post" action="/pay/">
    <input type="text" name="amount" />
    <input type="submit" name="deposit_amount" value="Зачислить">
</form>
