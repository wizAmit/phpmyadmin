<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 *
 * @version $Id$
 * @package phpMyAdmin
 */

/**
 * Don't display the page heading
 * @ignore
 */
define('PMA_DISPLAY_HEADING', 0);

/**
 * Gets some core libraries and displays a top message if required
 */
require_once './libraries/common.inc.php';
require_once './libraries/header.inc.php';
require_once './libraries/transformations.lib.php';

$types = PMA_getAvailableMIMEtypes();
?>

<h2><?php echo __('Available MIME types'); ?></h2>
<?php
foreach ($types['mimetype'] as $key => $mimetype) {

    if (isset($types['empty_mimetype'][$mimetype])) {
        echo '<i>' . $mimetype . '</i><br />';
    } else {
        echo $mimetype . '<br />';
    }

}
?>
<br />
<i>(<?php echo __('MIME types printed in italics do not have a separate transformation function'); ?>)</i>

<br />
<br />
<br />
<h2><?php echo __('Available transformations'); ?></h2>
<table border="0" width="90%">
<thead>
<tr>
    <th><?php echo __('Browser transformation'); ?></th>
    <th><?php echo _pgettext('for MIME transformation', 'Description'); ?></th>
</tr>
</thead>
<tbody>
<?php
$odd_row = true;
foreach ($types['transformation'] as $key => $transform) {
    $func = strtolower(str_ireplace('.inc.php', '', $types['transformation_file'][$key]));
    $desc = 'strTransformation_' . $func;
    ?>
    <tr class="<?php echo $odd_row ? 'odd' : 'even'; ?>">
        <td><?php echo $transform; ?></td>
        <td><?php echo (isset($$desc) ? $$desc : '<i>' . sprintf(__('No description is available for this transformation.<br />Please ask the author what %s does.'), 'PMA_transformation_' . $func . '()') . '</i>'); ?></td>
    </tr>
    <?php
    $odd_row = !$odd_row;
}
?>
</tbody>
</table>

<?php
/**
 * Displays the footer
 */
require_once './libraries/footer.inc.php';
?>
