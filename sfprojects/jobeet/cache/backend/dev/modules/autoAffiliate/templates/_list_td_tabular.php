<td data-label="Active?" class="sf_admin_boolean sf_admin_list_td_is_active">
  <?php echo get_partial('affiliate/list_field_boolean', array('value' => $jobeet_affiliate->getIsActive())) ?>
</td>
<td data-label="Url" class="sf_admin_text sf_admin_list_td_url">
  <?php echo $jobeet_affiliate->getUrl() ?>
</td>
<td data-label="Email" class="sf_admin_text sf_admin_list_td_email">
  <?php echo $jobeet_affiliate->getEmail() ?>
</td>
<td data-label="Token" class="sf_admin_text sf_admin_list_td_token">
  <?php echo $jobeet_affiliate->getToken() ?>
</td>
