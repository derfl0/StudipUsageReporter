<li>
    <input type="checkbox" id="<?= $dir ?>"></input>
    <label for="<?= $dir ?>"><?= basename($dir) ?></label>
    <? $old = $dir; ?>
    <ul>
        <? foreach(glob($dir."/*", GLOB_ONLYDIR) as $dir): ?>
            <?= $this->render_partial('show/_node', array('dir' => $dir)); ?>
        <? endforeach ?>
        <? foreach(glob($old."/*.php") as $file): ?>
            <?= $this->render_partial('show/_file', array('file' => $file)); ?>
        <? endforeach ?>
    </ul>
</li>