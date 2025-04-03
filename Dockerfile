# 使用 PHP 的官方 Docker 镜像
FROM php:7.4-apache

# 将本地代码复制到容器的指定目录
COPY . /var/www/html/

# 设置工作目录
WORKDIR /var/www/html

# 安装必要的 PHP 扩展
RUN docker-php-ext-install mysqli

# 让 Apache 服务运行在前台
CMD ["apache2-foreground"]

# RUN chmod 777 /var/www/html/runtime
# RUN chmod 777 ./application/extra/cjfaves.php
# RUN chmod 777 ./application/extra/cjuser.php
# RUN chmod 777 ./application/extra/cjversion.php