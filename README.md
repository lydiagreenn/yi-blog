## 博客源码开源共享

依赖Thinkphp6.0.0搭建【需要PHP版本>=7.1】，如果有使用的小伙伴可以浏览官方文档说明进行深入研究

文档地址：https://www.kancloud.cn/manual/thinkphp6_0/1037479


<label style="color:red">__配置好database.php的数据库信息，绑定访问路径到/public，访问首页即可__</label>


## 访问说明

只要配置好 /config/database.php 中的数据库连接信息（主要修改的是 username 和 password 两个参数值）

利用phpstudy或者其他本地php服务绑定访问路径 /public 后直接访问博客首页就可以正常显示博客网站

## 如何更新Thinkphp版本

 + 详情参考[Thinkphp官方手册] https://www.kancloud.cn/manual/thinkphp6_0/1037479

如果你之前已经安装过，那么切换到你的应用根目录下面，然后执行下面的命令进行更新：

    composer update topthink/framework




