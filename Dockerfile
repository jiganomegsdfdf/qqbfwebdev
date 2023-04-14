FROM ubuntu/nginx:1.18-22.04_beta
ENV DEBIAN_FRONTEND=noninteractive

ENV TZ=Europe/Moscow

RUN apt-get update
RUN apt-get install -y sudo bash net-tools supervisor nmap whois libatlas-base-dev iputils-ping nginx php-common php-fpm php-mysqli php-cli
COPY . /system
RUN echo "daemon off;" >> /etc/nginx/nginx.conf
RUN chmod +x /system/supervisor.sh

EXPOSE 80/tcp
EXPOSE 80/udp

CMD ["/system/supervisor.sh"]
