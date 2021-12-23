<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>menu</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<style>
		#menu {
			width: 300px;
		}

		li {
			border: 1px solid black;
			list-style-type: none;
		}

		li.inner {
			padding-left: 20px;
		}
	</style>
</head>

<body>
	<script type="text/javascript" charset="utf-8">
		jQuery(function() {
			jQuery('#menu').click(function() {
				jQuery.post('menu.xml', {}, function(xml) {
					jQuery('#menu').html('');
					var menu_html = '';
					menu_html += '<ul>';
					jQuery(xml).find('menuitem').each(function() {
						if ($(this).find('menutext').text()) {
							menu_html += '<li>';
							if ($(this).find('inner_menu').text()) {
								menu_html += $(this).find('menutext').text() + "->";
								$(this).find('inner_menuitem').each(function() {
									if ($(this).find('inner_menutext').text()) {
										menu_html += '<li class="inner">';
										if ($(this).find('inner_menuhref').text()) {
											menu_html += '<a href="' + $(this).find('inner_menuhref').text() + '">';
											menu_html += $(this).find('inner_menutext').text();
											menu_html += '</a>';
										} else {
											menu_html += $(this).find('inner_menutext').text();
										}
										menu_html += '</li>';
									}
								});
							} else {
								if ($(this).find('menuhref').text()) {
									menu_html += '<a href="' + $(this).find('menuhref').text() + '">';
									menu_html += $(this).find('menutext').text();
									menu_html += '</a>';
								} else {
									menu_html += $(this).find('menutext').text();
								}
							}
							menu_html += '</li>';
						}
					});
					menu_html += '</ul>';
					jQuery('#menu').html(menu_html);
				}, 'xml');
			})
		});
	</script>
	<div id="menu">Меню(нажми на мене)</div>
</body>

</html>