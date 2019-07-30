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
$model  	= $this->getModel();
$app  		= JFactory::getApplication();
$route  	= $app->input->get('folder', '', 'raw');
$subfolder 	= '';
?>

<style>
.folder { color: #0075c5; }
</style>

<div class="page-header">
	<h1><?= JText::_('COM_DESCARGAS_TITLE_DOCUMENTOS'); ?></h1>
</div>

<div class="container">
<?php foreach ($model->getItems() as $item) : ?>

	<div class="row">
	<?php foreach($model->getFolders($item->path) as $folder) : ?>
		<?php 
		$title = $folder;
		$subfolder = $folder;
		if($route != '')  $subfolder = $route.DS.$folder; 
		?>
		<div class="col-xs-12 col-md-2">
			<a href="index.php?option=com_descargas&view=ftp&id=<?= $item->id; ?>&folder=<?= $subfolder; ?>">
				<i class="fa fa-folder fa-4x folder" title="<?= $title; ?>"></i>
				<br><?= $folder; ?>
			</a>
		</div>
		
		<?php /*		
		$files = $model->getFiles($item->path);
		if(count($files)) : 
		?>
		<?php foreach($files as $file) : ?>
		<div class="col-xs-12 col-md-2">
			<a href="<?= JURI::root().$item->path.DS.'principal'.DS.$route.DS.$file; ?>">
				<img src="<?= $model->getThumb($route, $file); ?>" alt="<?= $file; ?>">
				<br><?= $file; ?>
			</a>
		</div>
		<?php endforeach; ?>
		<?php endif; */ ?>
	
	<?php endforeach; ?>
	</div>
	
	<?php 
	$files = $model->getFiles($item->path);
	if(count($files)) : 
	?>
	<div class="row">
	<?php foreach($files as $file) : ?>
		<div class="col-xs-12 col-md-2">
			<a href="<?= JURI::root().$item->path.DS.'principal'.DS.$route.DS.$file; ?>">
				<img src="<?= $model->getThumb($route, $file); ?>" alt="<?= $file; ?>">
				<br><?= $file; ?>
			</a>
		</div>
	<?php endforeach; ?>
	</div>
	<?php endif; ?>
			
<?php endforeach; ?>
</div>
