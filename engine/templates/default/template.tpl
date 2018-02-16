<!DOCTYPE html>
<html lang="ru">
<head>
<title>{$title}</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="keywords" content="{$keywords}" />
<meta name="description" content="{$description}" />
</head>
<body>
id:{$id}<br>
path:{$path}<br>
{$big_content}
<br>
{literal}
[COMPONENT:menu|default|{"name":"main"}]
{/literal}
</body>
</html>