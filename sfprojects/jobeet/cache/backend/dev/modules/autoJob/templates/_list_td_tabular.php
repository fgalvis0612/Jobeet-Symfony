<td data-label="Company" class="sf_admin_text sf_admin_list_td_company">
  <?php echo $jobeet_job->getCompany() ?>
</td>
<td data-label="Position" class="sf_admin_text sf_admin_list_td_position">
  <?php echo link_to($jobeet_job->getPosition(), 'jobeet_job_edit', $jobeet_job) ?>
</td>
<td data-label="Location" class="sf_admin_text sf_admin_list_td_location">
  <?php echo $jobeet_job->getLocation() ?>
</td>
<td data-label="Url" class="sf_admin_text sf_admin_list_td_url">
  <?php echo $jobeet_job->getUrl() ?>
</td>
<td data-label="Activated?" class="sf_admin_boolean sf_admin_list_td_is_activated">
  <?php echo get_partial('job/list_field_boolean', array('value' => $jobeet_job->getIsActivated())) ?>
</td>
<td data-label="Email" class="sf_admin_text sf_admin_list_td_email">
  <?php echo $jobeet_job->getEmail() ?>
</td>
