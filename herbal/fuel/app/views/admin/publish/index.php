<h2><?php echo Html::img('assets/img/publish_large.png'); ?>Publish List</h2>
<br>
<?php if ($publishes): ?>

	<div id = "paginate" style = "float: right"></div><br><br>
	<div id = "status" style = "float: right; margin-right: -150px"></div>
	
<table class="table table-striped">
	<thead>
		<tr>
			<th>Comment</th>
			<th>Date Published</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($publishes as $item): ?>		<tr>

			<td><?php echo $item->comment; ?></td>
			<?php $date = date_create($item->created_at); ?>
			<td><?php echo date('F jS, Y - l g:ia', date_timestamp_get($date)); ?></td>
			<td>
				<?php echo Html::anchor('admin/publish/view/'.$item->id, Html::img('assets/img/open.png'), array('title' => 'View')); ?></a> |
				<?php echo Html::anchor('admin/publish/edit/'.$item->id, Html::img('assets/img/edit.png'), array('title' => 'Edit')); ?> |
				<?php echo Html::anchor('admin/publish/delete/'.$item->id, Html::img('assets/img/delete.png'), array('title' => 'Delete','onclick' => "return confirm('Confirm delete publish number ".$item->id."?')")); ?>
			</td>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Publishes.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/publish/create', 'New Publish', array('class' => 'btn btn-success')); ?>

</p>
