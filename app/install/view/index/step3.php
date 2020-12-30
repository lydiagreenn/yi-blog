<div class="wrap">
	<div class="header">
		<h1 class="logo">{$powered}</h1>
		<div class="icon_install">安装向导</div>
		<div class="version">{:$version}</div>
	</div>
	<section class="section">
		<div class="step">
			<ul>
				<li class="on"><em>1</em>检测环境</li>
				<li class="current"><em>2</em>创建数据</li>
				<li><em>3</em>完成安装</li>
			</ul>
		</div>
		<form id="J_install_form" action="{:url('/index/step4')}" method="post">
			<input type="hidden" name="__token__" value="{:token()}" />
			<div class="server">
				<table width="100%">
					<tr>
						<td class="td1" width="100">数据库信息</td>
						<td class="td1" width="200">&nbsp;</td>
						<td class="td1">&nbsp;</td>
					</tr>
					<tr>
						<td class="tar">数据库驱动类型：</td>
						<td>
							<select name="dbtype" id="dbtype" class="select">
								<option value="pdo" >PDO (推荐)</option>
								<option value="mysqli" >MYSQLI</option>
								<option value="mysql" >MYSQL</option>
							</select>
						</td>
						<td><div id="J_install_tip_dbhost"><span class="gray">推荐使用PDO驱动</span></div></td>
					</tr>
					<tr>
						<td class="tar">数据库服务器：</td>
						<td><input type="text" name="dbhost" id="dbhost" value="127.0.0.1" class="input"></td>
						<td><div id="J_install_tip_dbhost"><span class="gray">数据库服务器地址，一般为 127.0.0.1</span></div></td>
					</tr>
					<tr>
						<td class="tar">数据库端口：</td>
						<td><input type="text" name="dbport" id="dbport" value="3306" class="input"></td>
						<td><div id="J_install_tip_dbport"><span class="gray">数据库服务器端口，一般为 3306</span></div></td>
					</tr>
					<tr>
						<td class="tar">数据库编码：</td>
						<td>
							<select name="dbcharset" id="dbcharset" class="select">
								<option value="utf8" >utf8 (默认)</option>
								<option value="utf8mb4" >utf8mb4</option>
							</select>
						</td>
						<td><div id="J_install_tip_dbhost"><span class="gray">Mysql 8.0 版本推荐使用 utf8mb4</span></div></td>
					</tr>
					<tr>
						<td class="tar">数据库名：</td>
						<td><input type="text" name="dbname" id="dbname" value="{$default_dbname}" class="input" disabled=""></td>
						<td><div id="J_install_tip_dbname"></div></td>
					</tr>
					<tr>
						<td class="tar">数据库用户名：</td>
						<td><input type="text" name="dbuser" id="dbuser" value="root" class="input"></td>
						<td><div id="J_install_tip_dbuser"></div></td>
					</tr>
					<tr>
						<td class="tar">数据库密码：</td>
						<td><input type="text" name="dbpw" id="dbpw" value="root" class="input" autoComplete="off" onblur="Dbtest()"></td>
						<td><div id="J_install_tip_dbpw"></div></td>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td class="td1" width="100">网站配置</td>
						<td class="td1" width="200">&nbsp;</td>
						<td class="td1">&nbsp;</td>
					</tr>
					<tr>
						<td class="tar">网站域名：</td>
						<td><input type="text" name="siteurl" value="{$domain}/" id="siteurl" class="input" autoComplete="off" readonly=""></td>
						<td><div id="J_install_tip_siteurl"><span class="gray">请以“/”结尾</span></div></td>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td class="td1" width="100">创始人信息</td>
						<td class="td1" width="200">&nbsp;</td>
						<td class="td1">&nbsp;</td>
					</tr>
					<tr>
						<td class="tar">管理员帐号：</td>
						<td><input type="text" name="manager_adminname" class="input" value="admin"></td>
						<td><div id="J_install_tip_manager_adminname"></div></td>
					</tr>
					<tr>
						<td class="tar">密码：</td>
						<td><input type="text" name="manager_pwd" id="J_manager_pwd" class="input" value="123456" autoComplete="off"></td>
						<td><div id="J_install_tip_manager_pwd"></div></td>
					</tr>
					<tr>
						<td class="tar">重复密码：</td>
						<td><input type="text" name="manager_ckpwd" class="input" value="123456" autoComplete="off"></td>
						<td><div id="J_install_tip_manager_ckpwd"></div></td>
					</tr>
				</table>
				<input type="hidden" name="webPath" value="{$webPath}" />
				<div id="J_response_tips" style="display:none;"></div>
			</div>
			<div class="bottom tac"> <a href="{:url('/index/step2')}" class="btn">上一步</a>
				<button type="submit" class="btn btn_submit J_install_btn">创建数据</button>
			</div>
		</form>
	</section>
	<div  style="width:0;height:0;overflow:hidden;"> <img src="/src/install/i/pop_loading.gif"> </div>
	<script src="/src/install/j/jquery.js"></script>
	<script src="/src/install/j/validate.js"></script>
	<script src="/src/install/j/ajaxForm.js"></script>
	<script>
								function Dbtest() {
									var dbType = $("#dbtype").val();
									var dbHost = $('#dbhost').val();
									var dbUser = $('#dbuser').val();
									var dbPw = $('#dbpw').val();
									var dbName = $('#dbname').val();
									var dbPort = $('#dbport').val();
									var dbCharset = $('#dbcharset').val();
									data = {'dbtype': dbType, 'dbhost': dbHost, 'dbuser': dbUser, 'dbpw': dbPw, 'dbname': dbName, 'dbport': dbPort, dbcharset: dbCharset};
									var url = "{:url('/index/checkdb')}";
									$.ajax({
										type: "POST",
										url: url,
										data: data,
										beforeSend: function () {
										},
										success: function (msg) {
											if (msg.code == 0) {
												$('#dbpw').val("");
												$('#J_install_tip_dbpw').html('<span for="dbname" generated="true" class="tips_error" style="">数据库链接失败</span>');
											}
										},
										complete: function () {
										},
										error: function () {
											$('#J_install_tip_dbpw').html('<span for="dbname" generated="true" class="tips_error" style="">数据库链接失败</span>');
											$('#dbpw').val("");
										}
									});
								}
								$(function () {
									//聚焦时默认提示
									var focus_tips = {
										dbhost: '数据库服务器地址，一般为127.0.0.1',
										dbport: '数据库服务器端口，一般为3306',
										dbuser: '',
										dbpw: '',
										dbname: '',
										dbprefix: '建议使用默认，同一数据库安装多个时需修改',
										manager: '创始人帐号，拥有站点后台所有管理权限',
										manager_pwd: '',
										manager_ckpwd: '',
										sitename: '',
										siteurl: '请以“/”结尾',
										sitekeywords: '',
										siteinfo: '',
										manager_adminname: ''
									};
									var install_form = $("#J_install_form"),
										reg_username = $('#J_reg_username'), //用户名表单
										reg_password = $('#J_reg_password'), //密码表单
										reg_tip_password = $('#J_reg_tip_password'), //密码提示区
										response_tips = $('#J_response_tips');				//后端返回提示

									//validate插件修改了remote ajax验证返回的response处理方式；增加密码强度提示 passwordRank
									install_form.validate({
										//debug : true,
										//onsubmit : false,
										errorPlacement: function (error, element) {
											//错误提示容器
											$('#J_install_tip_' + element[0].name).html(error);
										},
										errorElement: 'span',
										//invalidHandler : , 未验证通过 回调
										//ignore : '.ignore' 忽略验证
										//onkeyup : true,
										errorClass: 'tips_error',
										validClass: 'tips_error',
										onkeyup: false,
										focusInvalid: false,
										rules: {
											dbhost: {
												required: true
											},
											dbport: {
												required: true
											},
											dbuser: {
												required: true
											},
											dbpw: {
												required: true
											},
											dbname: {
												required: true
											},
											// dbprefix: {
											// 	required: true
											// },
											manager: {
												required: true
											},
											manager_pwd: {
												required: true,
												minlength: 6
											},
											manager_ckpwd: {
												required: true,
												equalTo: '#J_manager_pwd'
											},
											manager_adminname: {
												required: true,
											}
										},
										highlight: false,
										unhighlight: function (element, errorClass, validClass) {
											var tip_elem = $('#J_install_tip_' + element.name);

											tip_elem.html('<span class="' + validClass + '" data-text="text"><span>');

										},
										onfocusin: function (element) {
											var name = element.name;
											$('#J_install_tip_' + name).html('<span data-text="text">' + focus_tips[name] + '</span>');
											$(element).parents('tr').addClass('current');
										},
										onfocusout: function (element) {
											var _this = this;
											$(element).parents('tr').removeClass('current');

											if (element.name === 'email') {
												//邮箱匹配点击后，延时处理
												setTimeout(function () {
													_this.element(element);
												}, 150);
											} else {
												_this.element(element);

											}

										},
										messages: {
											dbhost: {
												required: '数据库服务器地址不能为空'
											},
											dbport: {
												required: '数据库服务器端口不能为空'
											},
											dbuser: {
												required: '数据库用户名不能为空'
											},
											dbpw: {
												required: '数据库密码不能为空'
											},
											dbname: {
												required: '数据库名不能为空'
											},
											// dbprefix: {
											// 	required: '数据库表前缀不能为空'
											// },
											manager: {
												required: '管理员帐号不能为空'
											},
											manager_pwd: {
												required: '密码不能为空',
												minlength: '密码长度不能低于6位'
											},
											manager_ckpwd: {
												required: '重复密码不能为空',
												equalTo: '两次输入的密码不一致。请重新输入'
											},
											manager_adminname: {
												required: '管理员账号不能为空',
											}
										},
										submitHandler: function (form) {
											form.submit();
											return true;
										}
									});
									var _data = {};
								});
	</script>
</div>