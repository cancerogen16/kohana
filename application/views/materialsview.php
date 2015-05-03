<h2 style="text-align:center">Содержимое категории</h2>

<?php foreach ($materials as $material) { ?>
<p><?=  htmlspecialchars($material['content'])?></p>
<?php } ?>