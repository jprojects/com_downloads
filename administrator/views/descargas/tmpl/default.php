<?php
/**
 * @version		1.0.0 botiga $
 * @package		botiga
 * @copyright   Copyright © 2010 - All rights reserved.
 * @license		GNU/GPL
 * @author		kim
 * @author mail administracion@joomlanetprojects.com
 * @website		http://www.joomlanetprojects.com
 *
*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$canOrder	= $user->authorise('core.edit.state', 'com_descargas');
$saveOrder	= $listOrder == 'a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_descargas&task=descargas.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'adminList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$sortFields = $this->getSortFields();
?>
<script type="text/javascript">
	Joomla.orderTable = function() {
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?= $listOrder; ?>') {
			dirn = 'asc';
		} else {
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>

<?php
//Joomla Component Creator code to allow adding non select list filters
if (!empty($this->extra_sidebar)) {
    $this->sidebar .= $this->extra_sidebar;
}
?>

<form action="<?= JRoute::_('index.php?option=com_descargas&view=descargas'); ?>" method="post" name="adminForm" id="adminForm">
<?php if(!empty($this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?= $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>

    	<div id="filter-bar" class="btn-toolbar">
			<div class="filter-search btn-group pull-left">
				<label for="filter_search" class="element-invisible"><?= JText::_('JSEARCH_FILTER');?></label>
				<input type="text" name="filter_search" id="filter_search" placeholder="<?= JText::_('JSEARCH_FILTER'); ?>" value="<?= $this->escape($this->state->get('filter.search')); ?>" title="<?= JText::_('JSEARCH_FILTER'); ?>" />
			</div>
			<div class="btn-group pull-left">
				<button class="btn hasTooltip" type="submit" title="<?= JText::_('JSEARCH_FILTER_SUBMIT'); ?>" onclick="this.form.submit();"><i class="icon-search"></i></button>
				<button class="btn hasTooltip" type="button" title="<?= JText::_('JSEARCH_FILTER_CLEAR'); ?>" onclick="jQuery('#filter_search').val('');this.form.submit();"><i class="icon-remove"></i></button>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="limit" class="element-invisible"><?= JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
				<?= $this->pagination->getLimitBox(); ?>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="directionTable" class="element-invisible"><?= JText::_('JFIELD_ORDERING_DESC');?></label>
				<select name="directionTable" id="directionTable" class="input-medium" onchange="Joomla.orderTable()">
					<option value=""><?= JText::_('JFIELD_ORDERING_DESC');?></option>
					<option value="asc" <?php if ($listDirn == 'asc') echo 'selected="selected"'; ?>><?= JText::_('JGLOBAL_ORDER_ASCENDING');?></option>
					<option value="desc" <?php if ($listDirn == 'desc') echo 'selected="selected"'; ?>><?= JText::_('JGLOBAL_ORDER_DESCENDING');?></option>
				</select>
			</div>
			<div class="btn-group pull-right">
				<label for="sortTable" class="element-invisible"><?= JText::_('JGLOBAL_SORT_BY');?></label>
				<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
					<option value=""><?= JText::_('JGLOBAL_SORT_BY');?></option>
					<?= JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder);?>
				</select>
			</div>
		</div>        
		<div class="clearfix"> </div>
		
		<table class="table table-striped" id="adminList">
			<thead>
				<tr>
					<?php if (isset($this->items[0]->ordering)): ?>
					<th width="1%" class="nowrap center hidden-phone">
						<?= JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
					</th>
               		<?php endif; ?>
					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value="" title="<?= JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
					</th>
                	<?php if (isset($this->items[0]->state)): ?>
					<th width="1%" class="nowrap center">
						<?= JHtml::_('grid.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
					</th>
               		<?php endif; ?>			
					<th>
						<?= JHtml::_('grid.sort',  'COM_DESCARGAS_DESCARGAS_HEADING_TITLE', 'a.title', $listDirn, $listOrder); ?>
					</th>        
					<th>
						<?= JHtml::_('grid.sort',  'COM_DESCARGAS_DESCARGAS_HEADING_CATID', 'a.category', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?= JHtml::_('grid.sort', 'COM_DESCARGAS_DESCARGAS_HEADING_FILENAME', 'a.filename', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?= JHtml::_('grid.sort', 'COM_DESCARGAS_DESCARGAS_HEADING_USERGROUP', 'a.usrgroup', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?= JHtml::_('grid.sort', 'COM_DESCARGAS_DESCARGAS_HEADING_CREATEDATE', 'a.createDate', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?= JHtml::_('grid.sort', 'COM_DESCARGAS_DESCARGAS_HEADING_FINISHDATE', 'a.finishDate', $listDirn, $listOrder); ?>
					</th>
					<th>
						<?= JHtml::_('grid.sort', 'COM_DESCARGAS_DESCARGAS_HEADING_LANGUAGE', 'a.language', $listDirn, $listOrder); ?>
					</th>
					<?php if (isset($this->items[0]->id)): ?>
					<th width="1%" class="nowrap center hidden-phone">
							<?= JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
					</th>
		            <?php endif; ?>
				</tr>
			</thead>
			<tfoot>
				<tr>
		            <?php 
		            if(isset($this->items[0])){
		                $colspan = count(get_object_vars($this->items[0]));
		            }
		            else{
		                $colspan = 10;
		            }
		        	?>
					<td colspan="<?= $colspan ?>">
						<?= $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($this->items as $i => $item) :
				$ordering   = ($listOrder == 'a.ordering');
                $canCreate	= $user->authorise('core.create',		'com_descargas');
                $canEdit	= $user->authorise('core.edit',			'com_descargas');
                $canCheckin	= $user->authorise('core.manage',		'com_descargas');
                $canChange	= $user->authorise('core.edit.state',	'com_descargas');
				?>
				<tr class="row<?= $i % 2; ?>">
                    
				<?php if (isset($this->items[0]->ordering)): ?>
					<td class="order nowrap center hidden-phone">
						<?php if ($canChange) :
							$disableClassName = '';
							$disabledLabel	  = '';
							if (!$saveOrder) :
								$disabledLabel    = JText::_('JORDERINGDISABLED');
								$disableClassName = 'inactive tip-top';
							endif; ?>
							<span class="sortable-handler hasTooltip <?= $disableClassName?>" title="<?= $disabledLabel?>">
								<i class="icon-menu"></i>
							</span>
							<input type="text" style="display:none" name="order[]" size="5" value="<?= $item->ordering;?>" class="width-20 text-area-order " />
						<?php else : ?>
							<span class="sortable-handler inactive" >
								<i class="icon-menu"></i>
							</span>
						<?php endif; ?>
					</td>
		            <?php endif; ?>
					<td class="center hidden-phone">
							<?= JHtml::_('grid.id', $i, $item->id); ?>
					</td>
		            <?php if (isset($this->items[0]->state)): ?>
					<td class="center">
							<?= JHtml::_('jgrid.published', $item->state, $i, 'descargas.', $canChange, 'cb'); ?>
					</td>
		            <?php endif; ?>		         
		            <td>
						<?php if ($canEdit) : ?>
						<a href="<?= JRoute::_('index.php?option=com_descargas&task=descarga.edit&id='.(int) $item->id); ?>">
						<?= $item->title; ?></a>
						<?php else : ?>
						<?= $item->title; ?>
						<?php endif; ?>
					</td>
					<td>
						<?= $item->category; ?>
					</td>
					<td>
						<?= $item->filename; ?>
					</td>
					<td>
						<?= $item->usrgroup; ?>
					</td>
					<td>
						<?= $item->createDate; ?>
					</td>
					<td>
						<?= $item->finishDate; ?>
					</td>
					<td>
						<?= $item->language == '' ? JText::_('JALL') : $item->language; ?>
					</td>
					<?php if (isset($this->items[0]->id)): ?>
					<td class="center hidden-phone">
						<?= (int) $item->id; ?>
					</td>
                <?php endif; ?>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?= $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?= $listDirn; ?>" />
		<?= JHtml::_('form.token'); ?>
	</div>
</form>
