<div class="controls-rows"><div class="sub-controls"><?php if ($controls) : foreach ($controls as $control) : $■['control'] = $control; ?><?php echo $control ?><?php endforeach; endif ?></div></div><div class="table-responsive"><table class="table table-bordered table-sm table-striped"><thead><?php if ($labels) : foreach ($labels as $row) : $■['row'] = $row; ?><th scope="col"><?php echo htmlspecialchars($row['label']) ?></th><?php endforeach; endif ?></thead><tbody><?php if ($items) : foreach ($items as $row) : $■['row'] = $row; ?><tr><?php if ($row) : foreach ($row as $cell) : $■['cell'] = $cell; ?><td><?php echo htmlspecialchars($cell['text']) ?></td><?php endforeach; endif ?></tr><?php endforeach; endif ?></tbody></table></div>