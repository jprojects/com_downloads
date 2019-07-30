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
$model = $this->getModel();
?>

<div class="page-header">
	<h1>Directori</h1>
</div>

<?php foreach ($this->items as $item) : ?>
<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title"><?= $item->title; ?></h5>
    <div class="card-text">Categoria: <?= $item->ctitle; ?></div>
    <div class="card-text">Publicat: <?= date('d-m-Y', strtotime($item->createDate)); ?></div>
    <div class="card-text">Vigència: <?= date('d-m-Y', strtotime($item->finishDate)); ?></div>
    <div class="card-text">Pes: <?= DescargasHelpersDescargas::filesizeFormatted(JPATH_ROOT.'/descargas/'.$item->filename); ?></div>
    <div class="card-text">Descarregues: <?= $item->counter; ?></div>
    <a href="<?= JURI::root(); ?>index.php?option=com_descargas&task=documentos.download&file=<?= base64_encode($item->filename); ?>&id=<?= $item->id; ?>" class="btn btn-primary mt-2">Descarrega</a>
  </div>
</div>		
<?php endforeach; ?>

<?= $this->pagination->getPagesLinks(); ?>
