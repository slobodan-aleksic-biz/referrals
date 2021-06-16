FROM nginx:1.15.0-alpine

RUN apk update && apk add bash
RUN mkdir -p /etc/nginx/conf.d

RUN rm /etc/nginx/conf.d/default.conf

COPY ./nginx.conf /etc/nginx/conf.d
