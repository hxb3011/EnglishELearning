<?
global $fragment_total_pages;
global $fragment_current_page;
$fragment_prev_page = $fragment_current_page - 1; 
if ($fragment_prev_page < 1) $fragment_prev_page = 1;
$fragment_next_page = $fragment_current_page + 1;
if ($fragment_next_page > $fragment_total_pages) $fragment_next_page = $fragment_total_pages;
?>
<li class="pagination-item" data-page="<?= $fragment_prev_page ?>">
    <a href="javascript:void(0)">
        <i class="mdi-b prev"></i>
    </a>
</li>
<?
for ($i = 1; $i <= $fragment_total_pages; ++$i) {
    ?>
    <li class="pagination-item<?= $i === $fragment_current_page ? " active" : "" ?>" data-page="<?= $i ?>">
        <a href="javascript:void(0)" class="pagination-item__link"><?= $i ?></a>
    </li>
    <?
}
?>
<li class="pagination-item" data-page="<?= $fragment_prev_page ?>">
    <a href="javascript:void(0)">
        <i class="mdi-b next"></i>
    </a>
</li>