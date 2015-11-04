<li>
    <? if ($usages[$file]): ?>
        <span style="color: green"><?= basename($file) ?> (<?= $usages[$file] ?>)</span>
    <? else: ?>
        <span style="color: darkred"><?= basename($file) ?></span>
    <? endif; ?>
</li>