<?php
// Print header
echo('
	<div class="wrap">
		<h2>Export Order Items</h2>
');

// Check for WooCommerce
if (!class_exists('WooCommerce')) {
	echo('<div class="error"><p>This plugin requires that WooCommerce is installed and activated.</p></div></div>');
	return;
} else if (!function_exists('wc_get_order_types')) {
	echo('<div class="error"><p>The Export Order Items plugin requires WooCommerce 2.2 or higher. Please update your WooCommerce install.</p></div></div>');
	return;
}

// Print form
echo('<div id="poststuff">
		<div id="post-body" class="columns-2">
			<div id="post-body-content" style="position: relative;">
			<form action="" method="post">
			<input type="hidden" name="hm_xoiwc_do_export" value="1" />
	');
wp_nonce_field('hm_xoiwc_do_export');
echo('
			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label for="hm_xoiwc_field_report_time">Report Period:</label>
					</th>
					<td>
						<select name="report_time" id="hm_xoiwc_field_report_time">
							<option value="0d"'.($reportSettings['report_time'] == '0d' ? ' selected="selected"' : '').'>Today</option>
							<option value="1d"'.($reportSettings['report_time'] == '1d' ? ' selected="selected"' : '').'>Yesterday</option>
							<option value="7d"'.($reportSettings['report_time'] == '7d' ? ' selected="selected"' : '').'>Previous 7 days (excluding today)</option>
							<option value="30d"'.($reportSettings['report_time'] == '30d' ? ' selected="selected"' : '').'>Previous 30 days (excluding today)</option>
							<option value="0cm"'.($reportSettings['report_time'] == '0cm' ? ' selected="selected"' : '').'>Current calendar month</option>
							<option value="1cm"'.($reportSettings['report_time'] == '1cm' ? ' selected="selected"' : '').'>Previous calendar month</option>
							<option value="+7d"'.($reportSettings['report_time'] == '+7d' ? ' selected="selected"' : '').'>Next 7 days (future dated orders)</option>
							<option value="+30d"'.($reportSettings['report_time'] == '+30d' ? ' selected="selected"' : '').'>Next 30 days (future dated orders)</option>
							<option value="+1cm"'.($reportSettings['report_time'] == '+1cm' ? ' selected="selected"' : '').'>Next calendar month (future dated orders)</option>
							<option value="all"'.($reportSettings['report_time'] == 'all' ? ' selected="selected"' : '').'>All time</option>
							<option value="custom"'.($reportSettings['report_time'] == 'custom' ? ' selected="selected"' : '').'>Custom date range</option>
						</select>
					</td>
				</tr>
				<tr valign="top" class="hm_xoiwc_custom_time">
					<th scope="row">
						<label for="hm_xoiwc_field_report_start">Start Date:</label>
					</th>
					<td>
						<input type="date" name="report_start" id="hm_xoiwc_field_report_start" value="'.$reportSettings['report_start'].'" />
					</td>
				</tr>
				<tr valign="top" class="hm_xoiwc_custom_time">
					<th scope="row">
						<label for="hm_xoiwc_field_report_end">End Date:</label>
					</th>
					<td>
						<input type="date" name="report_end" id="hm_xoiwc_field_report_end" value="'.$reportSettings['report_end'].'" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="hm_xoiwc_field_orderby">Sort By:</label>
					</th>
					<td>
						<select name="orderby" id="hm_xoiwc_field_orderby">
							<option value="product_id"'.($reportSettings['orderby'] == 'product_id' ? ' selected="selected"' : '').'>Product ID</option>
							<option value="order_id"'.($reportSettings['orderby'] == 'order_id' ? ' selected="selected"' : '').'>Order ID</option>
						</select>
						<select name="orderdir">
							<option value="asc"'.($reportSettings['orderdir'] == 'asc' ? ' selected="selected"' : '').'>ascending</option>
							<option value="desc"'.($reportSettings['orderdir'] == 'desc' ? ' selected="selected"' : '').'>descending</option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label>Show Orders With Status:</label>
					</th>
					<td>');
foreach (wc_get_order_statuses() as $status => $statusName) {
	echo('<label><input type="checkbox" name="order_statuses[]"'.(in_array($status, $reportSettings['order_statuses']) ? ' checked="checked"' : '').' value="'.$status.'" /> '.$statusName.'</label><br />');
}
			echo('</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label>Report Fields:</label>
					</th>
					<td id="hm_xoiwc_report_field_selection">');
$fieldOptions2 = $fieldOptions;
foreach ($reportSettings['fields'] as $fieldId) {
	if (!isset($fieldOptions2[$fieldId]))
		continue;
	echo('<label><input type="checkbox" name="fields[]" checked="checked" value="'.$fieldId.'"'.(in_array($fieldId, array('variation_id', 'variation_attributes')) ? ' class="variation-field"' : '').' /> '.$fieldOptions2[$fieldId].'</label>');
	unset($fieldOptions2[$fieldId]);
}
foreach ($fieldOptions2 as $fieldId => $fieldDisplay) {
	echo('<label><input type="checkbox" name="fields[]" value="'.$fieldId.'"'.(in_array($fieldId, array('variation_id', 'variation_attributes')) ? ' class="variation-field"' : '').' /> '.$fieldDisplay.'</label>');
}
unset($fieldOptions2);
			echo('</td>
				</tr>
				<tr valign="top">
					<th scope="row" colspan="2" class="th-full">
						<label>
							<input type="checkbox" name="include_header"'.(empty($reportSettings['include_header']) ? '' : ' checked="checked"').' />
							Include header row
						</label>
					</th>
				</tr>
			</table>');
			echo('<p class="submit">
				<button type="submit" class="button-primary">Export</button>
			</p>
		</form>');
		
		$potent_slug = 'export-order-items-for-woocommerce';
		include(__DIR__.'/plugin-credit.php');
		echo('</div> <!-- /post-body-content -->
		
		<div id="postbox-container-1" class="postbox-container">
			<div id="side-sortables" class="meta-box-sortables">
			
				<div class="postbox">
					<h2>Upgrade to <a href="https://potentplugins.com/downloads/export-order-items-pro-wordpress-plugin/?utm_source=export-order-items-for-woocommerce&amp;utm_medium=link&amp;utm_campaign=wp-plugin-upgrade-link" target="_blank">Export Order Items Pro</a> for the following additional features:</h2>
					<div class="inside">
						<ul>
							<li>Create multiple export presets to save time.</li>
							<li>Include product variation details.</li>
							<li>Include any custom field associated with an order, product order line item, product, or product variation.</li>
							<li>Limit the export to only include certain product IDs or product categories.</li>
							<li>Change the names and order of fields in the report.</li>
							<li>Export in XLS, XLSX, or HTML format (in addition to CSV).</li>
						</ul>
						<p><strong>Receive a 10% discount with the coupon code <span style="color: #f00;">WCEXPORT10</span>!</strong>
						<a href="https://potentplugins.com/downloads/export-order-items-pro-wordpress-plugin/?utm_source=export-order-items-for-woocommerce&amp;utm_medium=link&amp;utm_campaign=wp-plugin-upgrade-link" target="_blank">Buy Now &gt;</a><br />
						(Not valid with any other discount.)</p>
					</div>
				</div>
				
				<div class="postbox">
					<h2><a href="https://potentplugins.com/downloads/scheduled-email-reports-woocommerce-plugin/?utm_source=export-order-items&amp;utm_medium=link&amp;utm_campaign=wp-plugin-upgrade-link" target="_blank">Schedule Email Reports</a></h2>
					<div class="inside">
						<strong>Automatically send reports as email attachments on a recurring schedule.</strong><br />
						<a href="https://potentplugins.com/downloads/scheduled-email-reports-woocommerce-plugin/?utm_source=export-order-items&amp;utm_medium=link&amp;utm_campaign=wp-plugin-upgrade-link" target="_blank">Get the add-on plugin &gt;</a>
					</div>
				</div>
				<div class="postbox">
					<h2><a href="https://potentplugins.com/downloads/frontend-reports-woocommerce-plugin/?utm_source=export-order-items&amp;utm_medium=link&amp;utm_campaign=wp-plugin-upgrade-link" target="_blank">Embed Report in Frontend Pages</a></h2>
					<div class="inside">
						<strong>Display the report or a download link in posts and pages using a shortcode.</strong><br />
						<a href="https://potentplugins.com/downloads/frontend-reports-woocommerce-plugin/?utm_source=export-order-items&amp;utm_medium=link&amp;utm_campaign=wp-plugin-upgrade-link" target="_blank">Get the add-on plugin &gt;</a>
					</div>
				</div>
				
			</div> <!-- /side-sortables-->
		</div><!-- /postbox-container-1 -->
		
		</div> <!-- /post-body -->
		<br class="clear" />
		</div> <!-- /poststuff -->
	</div>
	
	<script type="text/javascript" src="'.plugins_url('js/export-order-items.js', __FILE__).'"></script>
');
?>