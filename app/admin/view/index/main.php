<div class="aright">
	<div class="aright_1">
		<blockquote style="padding: 10px;border-left: 5px solid #FF5722;" class="layui-elem-quote">系统信息：</blockquote>
		<table width="100%">
			<tr><td>服务器类型</td><td>{:php_uname('s')}</td></tr>
			<tr><td>PHP版本</td><td>{:PHP_VERSION}</td></tr>
			<tr><td>ThinkPHP版本</td><td>{:app()->version()}</td></tr>
			<tr><td>Zend版本</td><td>{:Zend_Version()}</td></tr>
			<tr><td>服务器解译引擎</td><td>{:$_SERVER['SERVER_SOFTWARE']}</td></tr>
			<tr><td>服务器语言</td><td>{:$_SERVER['HTTP_ACCEPT_LANGUAGE']}</td></tr>
			<tr><td>服务器Web端口</td><td>{:$_SERVER['SERVER_PORT']}</td></tr>
		</table>
	</div>      
</div>