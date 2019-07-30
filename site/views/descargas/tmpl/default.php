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

<?php 
foreach ($model->getCategories() as $item) : 
$count = $model->getItemsByCategory($item->id); ?>

<div class="card mb-4">
  <div class="card-header">
    <h5><?= $item->title; ?><span class="badge badge-pill badge-info float-right" title="<?= $count; ?> Documents en aquesta categoria"><?= $count; ?></span></h5>
  </div>
  <div class="card-body">
    <p class="card-text"><?= $item->description; ?></p>
    <a href="index.php?option=com_descargas&view=documentos&id=<?= $item->id; ?>" class="btn btn-primary">Veure documents</a>
  </div>
</div>
			
<?php endforeach; ?>

