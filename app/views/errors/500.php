<div class="error-container">
    <h1>500</h1>
    <p><?= $data['message'] ?></p>
    
    <?php if (!empty($data['error'])): ?>
    <div style="margin-top: 20px; text-align: left;">
        <h3>Detail Error:</h3>
        <p><strong>Message:</strong> <?= $data['error']->getMessage() ?></p>
        <p><strong>File:</strong> <?= $data['error']->getFile() ?> (Line: <?= $data['error']->getLine() ?>)</p>
        
        <?php if (defined('DEBUG_MODE') && DEBUG_MODE): ?>
        <pre style="background: #f5f5f5; padding: 10px; border-radius: 5px; overflow-x: auto;">
            <?= htmlspecialchars($data['error']->getTraceAsString()) ?>
        </pre>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>