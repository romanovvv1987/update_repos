FROM nginx:1.21-alpine

RUN rm /etc/nginx/conf.d/default.conf

COPY nginx.conf /etc/nginx/nginx.conf
COPY default.conf /etc/nginx/conf.d/

RUN mkdir -p /var/log/nginx
RUN chmod -R 755 /var/log/nginx

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]