<?php foreach ($this->configuration->getValue('list.display') as $name => $field): ?>
<?php echo $this->addCredentialCondition(sprintf(<<<EOF
<td data-label="%s" class="sf_admin_%s sf_admin_list_td_%s">
  [?php echo %s ?]
</td>

EOF
, $field->getConfig('label', '', true) , strtolower($field->getType()), $name, $this->renderField($field)), $field->getConfig()) ?>
<?php endforeach; ?>
