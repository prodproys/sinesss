<div class="container div_bloque_cuerpo"><div id="barra_titulo" class="bloque_titulo"><div class="titulo"><div><a href="pages.php?page=<?php echo htmlspecialchars($_GET['page']) ?>" class="type_file">Herramienta para resolver duplicidad</a></div></div></div><div class="alert alert-primary mb-0">Versión 1</div><div class="form-import"><?php if (!$_GET['step']) : ?><form method="get" action="pages.php"><input type="hidden" name="page" value="<?php echo htmlspecialchars($_GET['page']) ?>"/><input type="hidden" name="step" value="process"/><div class="form-group row"><label for="year-format" class="col-sm-2 col-form-label">CÓDIGO INCORRECTO</label><div class="col-sm-2"><input id="incorrect" type="text" name="incorrect" class="form-control-file"/></div></div><div class="form-group row"><label for="month-format" class="col-sm-2 col-form-label">CÓDIGO CORRECTO</label><div class="col-sm-2"><input id="correct" type="text" name="correct" class="form-control-file"/></div></div><button type="submit" class="btn btn-primary">Enviar</button></form><?php elseif ($_GET['step'] == 'process') : ?><div><?php if ($out) : foreach ($out as $item) : $■['item'] = $item; ?><?php if ($item['incorrect']['id']) : ?><div> <strong>Código Incorrecto : </strong><a href="custom/people.php?i=<?php echo htmlspecialchars($item['incorrect']['id']) ?>#filter=''" target="_blank"><?php echo htmlspecialchars($item['incorrect']['code']) ?></a></div><?php endif ?><?php if ($item['correct']['id']) : ?><div> <strong>Código Correcto : </strong><a href="custom/people.php?i=<?php echo htmlspecialchars($item['correct']['id']) ?>#filter=''" target="_blank"><?php echo htmlspecialchars($item['correct']['code']) ?></a></div><?php endif ?><?php endforeach; endif ?></div><a href="pages.php?page=<?php echo htmlspecialchars($_GET['page']) ?>&step=process2&incorrect=<?php echo htmlspecialchars($_GET['incorrect']) ?>&correct=<?php echo htmlspecialchars($_GET['correct']) ?>" target="_blank" class="btn btn-primary">Procesar</a><?php elseif ($_GET['step'] == 'process2') : ?><div>RESUELTO</div><?php endif ?></div></div>