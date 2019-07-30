<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Descargas
 * @author     aficat <kim@aficat.com>
 * @copyright  2018 aficat
 * @license    Licencia Pública General GNU versión 2 o posterior. Consulte LICENSE.txt
*/

// No direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {
		
	});

	Joomla.submitbutton = function (task) {
		if (task == 'descarga.cancel') {
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
		else {
			
			if (task != 'descarga.cancel' && document.formvalidator.isValid(document.id('adminForm'))) {
				
				Joomla.submitform(task, document.getElementById('adminForm'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<div class="form-horizontal">

	<div class="row-fluid">
		<form
		action="<?= JRoute::_('index.php?option=com_descargas&layout=edit&id=' . (int) $this->item->id); ?>"
		method="post" enctype="multipart/form-data" name="adminForm" id="adminForm" class="form-validate">
		<div class="span8 form-horizontal">
			<fieldset class="adminform">

				<?php foreach($this->form->getFieldset('details') as $field): ?>
				<?php echo $field->renderField() ?>
	    		<?php endforeach; ?>		

			</fieldset>
		</div>
		<input type="hidden" name="task" value=""/>
		<?php echo JHtml::_('form.token'); ?>
		</form>
		
		<form
		action="<?php echo JRoute::_('index.php?option=com_descargas&task=descarga.upload&id=' . (int) $this->item->id); ?>"
		method="post" enctype="multipart/form-data" name="adminForm" id="documento-form" class="form-validate">
		<div class="span4 form-horizontal">
		<label><?= JText::_('COM_DESCARGAS_UPLOAD_LBL'); ?></label>
		<input type="hidden" name="jform[id]" value="<?= $this->item->id; ?>" />
		<?php echo $this->form->renderField('subida'); ?>
		<button type="submit" class="btn btn-primary btn-block"><?= JText::_('JSUBMIT'); ?></button>
		</div>
		<input type="hidden" name="task" value="descarga.upload"/>
		<?php echo JHtml::_('form.token'); ?>
		</form>
		
	</div>	

</div>
