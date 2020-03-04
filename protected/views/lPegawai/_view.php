<?php
/* @var $this LPegawaiController */
/* @var $data LPegawai */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pegawai')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_pegawai), array('view', 'id'=>$data->id_pegawai)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pegawai_nik')); ?>:</b>
	<?php echo CHtml::encode($data->pegawai_nik); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pegawai_nama')); ?>:</b>
	<?php echo CHtml::encode($data->pegawai_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pegawai_opd')); ?>:</b>
	<?php echo CHtml::encode($data->pegawai_opd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_updated')); ?>:</b>
	<?php echo CHtml::encode($data->is_updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_updated')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_updated); ?>
	<br />


</div>