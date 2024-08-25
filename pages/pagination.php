<div class="pagination">
    <?php if ($current_page > 1): ?>
        <a href="?page=<?php echo $current_page - 1; ?>">&laquo; Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?php echo $i; ?>" class="<?php if ($i == $current_page) echo 'active'; ?>">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>

    <?php if ($current_page < $total_pages): ?>
        <a href="?page=<?php echo $current_page + 1; ?>">Next &raquo;</a>
    <?php endif; ?>
</div>