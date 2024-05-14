<?
global $fragment_total_accounts;
global $fragment_current_page;
$fragment_prev_page = $fragment_current_page - 1; 
if ($fragment_prev_page < 1) $fragment_prev_page = 1;
$fragment_next_page = $fragment_current_page + 1;
if ($fragment_next_page > $fragment_total_accounts) $fragment_next_page = $fragment_total_accounts;
?>
<li class="pagination-item" data-page="<?= $fragment_prev_page ?>">
    <a href="javascript:void(0)">
        <i class="mdi-b prev"></i>
    </a>
</li>
<?
for ($i = 1; $i <= $fragment_total_accounts; ++$i) {
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