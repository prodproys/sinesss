<?php if (!function_exists('mixin__menu_items')) { function mixin__menu_items($block = null, $attributes = array(), $items = null) { global $■;$■['items'] = $items;?><?php if ($items) : foreach ($items as $men_item) : $■['men_item'] = $men_item; ?><li Class="<?php echo htmlspecialchars($men_item['class']) ?>"><?php if ($men_item['url']) : ?><?php mixin__link_item(null, array(), $men_item) ?><?php else : ?><?php mixin__span_item(null, array(), $men_item) ?><?php endif ?><?php if ($men_item['items']) : ?><?php if ($men_item['check']) : ?><input id="<?php echo htmlspecialchars($men_item['check']) ?>" type="checkbox"/><?php endif ?><ul class="li_cabecera"><?php mixin__menu_items(null, array(), $men_item['items']) ?></ul><?php endif ?></li><?php endforeach; endif ?><?php } } ?><?php if (!function_exists('mixin__link_item')) { function mixin__link_item($block = null, $attributes = array(), $item = null) { global $■;$■['item'] = $item;?><a href="<?php echo htmlspecialchars(strtolower($item['url'])) ?>" rel="<?php echo htmlspecialchars($item['rel']) ?>" onclick="<?php echo htmlspecialchars($item['onclick']) ?>" title="<?php echo htmlspecialchars(strtolower($item['name'])) ?>" Class="<?php echo htmlspecialchars($item['aclass']) ?>" data-url="<?php echo htmlspecialchars($item['dataurl']) ?>" for="<?php echo htmlspecialchars($item['check']) ?>" target="<?php echo htmlspecialchars($item['target']) ?>"><?php echo htmlspecialchars($item['name']) ?><?php if ($item['sub']) : ?><b><?php echo htmlspecialchars($item['sub']) ?></b><?php endif ?></a><?php } } ?><?php if (!function_exists('mixin__span_item')) { function mixin__span_item($block = null, $attributes = array(), $item = null) { global $■;$■['item'] = $item;?><a onclick="<?php echo htmlspecialchars($item['onclick']) ?>" data-url="<?php echo htmlspecialchars($item['dataurl']) ?>" Class="<?php echo htmlspecialchars($item['aclass']) ?>"><?php echo htmlspecialchars($item['name']) ?><?php if ($item['sub']) : ?><b><?php echo htmlspecialchars($item['sub']) ?></b><?php endif ?></a><?php } } ?><?php mixin__menu_items(null, array(), $items) ?>