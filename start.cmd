@echo off
if not exist ".env" copy .env-dist .env
@echo on
docker-compose up -d